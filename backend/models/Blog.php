<?php

namespace backend\models;

use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use kartik\markdown\Markdown;
use kato\helpers\KatoBase;
use kato\ActiveRecord;
use common\models\User;

/**
 * This is the model class for table "kato_blog".
 *
 * @property string $id
 * @property string $title
 * @property string $short_desc
 * @property string $content
 * @property string $content_html
 * @property string $slug
 * @property string $tags
 * @property string $create_time
 * @property string $created_by
 * @property string $update_time
 * @property integer $updated_by
 * @property string $publish_time
 * @property string $published_by
 * @property integer $is_revision
 * @property integer $parent_id
 * @property integer $status
 * @property integer $deleted
 */
class Blog extends ActiveRecord
{
    const IS_REVISION = 1;
    const NOT_REVISION = 0;
    const STATUS_NOT_PUBLISHED = 0;
    const STATUS_PUBLISHED = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kato_blog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['content', 'content_html', 'tags'], 'string'],
            [['create_time', 'created_by', 'update_time', 'publish_time'], 'required'],
            [['create_time', 'update_time', 'publish_time'], 'safe'],
            [['created_by', 'updated_by', 'published_by', 'is_revision', 'parent_id', 'status', 'deleted'], 'integer'],
            [['title', 'slug'], 'string', 'max' => 70],
            [['short_desc'], 'string', 'max' => 255],
            ['status', 'default', 'value' => self::STATUS_NOT_PUBLISHED],
            ['status', 'in', 'range' => [self::STATUS_PUBLISHED, self::STATUS_NOT_PUBLISHED]],
            ['parent_id', 'default', 'value' => 0],
            ['slug', 'default', 'value' => null],
            ['is_revision', 'default', 'value' => self::NOT_REVISION],
            ['is_revision', 'in', 'range' => [self::IS_REVISION, self::NOT_REVISION]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'short_desc' => 'Short Desc',
            'content' => 'Content',
            'content_html' => 'Content Html',
            'slug' => 'Slug',
            'tags' => 'Tags',
            'create_time' => 'Create Time',
            'created_by' => 'Created By',
            'update_time' => 'Update Time',
            'updated_by' => 'Updated By',
            'publish_time' => 'Publish Time',
            'published_by' => 'Published By',
            'is_revision' => 'Is Revision',
            'parent_id' => 'Parent ID',
            'status' => 'Status',
            'deleted' => 'Deleted',
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['create_time', 'update_time', 'publish_time'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['update_time'],
                ],
                'value' => new \yii\db\Expression('NOW()'),
            ],
            'slug' => [
                'class' => 'kato\behaviors\Slug',
                // These parameters are optional, default values presented here:
                'sourceAttributeName' => 'title', // If you want to make a slug from another attribute, set it here
                'slugAttributeName' => 'slug', // Name of the attribute containing a slug
            ],
            'slugUpdate' => [
                'class' => 'kato\behaviors\Slug',
                // These parameters are optional, default values presented here:
                'sourceAttributeName' => 'slug', // If you want to make a slug from another attribute, set it here
                'slugAttributeName' => 'slug', // Name of the attribute containing a slug
                'onlyIfEmpty' => true
            ],
            'softDelete' => [
               'class' => 'kato\behaviors\SoftDelete',
               'attribute' => 'deleted',
               'safeMode' => true,
            ],
            'normalizeTags' => [
                'class' => 'kato\behaviors\NormalizeTags',
                'attribute' => 'tags',
                'updateTags' => true,
                'tagType' => self::className(),
            ],
            'defaultTitle' => [
                'class' => 'kato\behaviors\DefaultTitle',
                'attribute' => 'title',
                'defaultPrefix' => 'Post',
            ],
        ];
    }

    /**
     * Actions to be taken before saving the record.
     * @param bool $insert
     * @return bool whether the record can be saved
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->createShortDesc();

            return true;
        }
        return false;
    }

    /**
     * Render short_desc and content_html
     * @return bool
     */
    public function createShortDesc()
    {
        $shortDescDone = false;
        $this->content_html = '';
        $content_decoded = Json::decode($this->content);

        if (isset($content_decoded['data'])) {
            foreach ($content_decoded['data'] as $key => $value) {
                if ($value['type'] === 'text' && $shortDescDone === false) {
                    $this->short_desc = KatoBase::limit_words($value['data']['text'], '20');
                    $shortDescDone = true;
                }

                $this->content_html .= $value['data']['text'] . ' ';
            }
        }

        $this->content_html = Markdown::convert($this->content_html);

        return true;
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getNewerLink()
    {
        if (!$model = $this->findNewerOne())
            return null;

        return Html::a(Html::encode($model->title), ['post/view', 'id' => $model->id]);
    }

    public function findNewerOne()
    {
        return static::find()
            ->where('id > :id', [':id' => $this->id])
            ->orderBy('id asc')
            ->one();
    }

    public function getOlderLink()
    {
        if (!$model = $this->findOlderOne())
            return null;

        return Html::a(Html::encode($model->title), ['post/view', 'id' => $model->id]);
    }

    public function findOlderOne()
    {
        return static::find()
            ->where('id < :id', [':id' => $this->id])
            ->orderBy('id desc')
            ->one();
    }

    public function getAuthorName()
    {
        return $this->user->username;
    }

    /**
     * @return string the URL that shows the detail of the post
     */
    public function getPermalink()
    {
        if(!empty($this->slug)) {
            $title = $this->slug;
        } else {
            $title = $this->title;
        }

        return Url::to(['blog/view', 'id' => $this->id, 'title' => Html::encode($title)]);
    }

    public function renderContent()
    {
        return \Yii::$app->kato->renderBlock($this->content);
    }

}
