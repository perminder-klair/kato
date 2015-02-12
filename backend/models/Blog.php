<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use kartik\markdown\Markdown;
use kato\helpers\KatoBase;
use kato\ActiveRecord;
use common\models\User;
use yii\web\HttpException;

/**
 * This is the model class for table "kato_blog".
 *
 * @property string $id
 * @property string $title
 * @property string $short_desc
 * @property string $content
 * @property string $content_html
 * @property integer $revision_to
 * @property string $slug
 * @property string $tags
 * @property string $create_time
 * @property string $created_by
 * @property string $update_time
 * @property integer $updated_by
 * @property string $publish_time
 * @property string $published_by
 * @property integer $status
 * @property integer $deleted
 * @property string $permalink
 */
class Blog extends ActiveRecord
{
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
            [['created_by', 'updated_by', 'published_by', 'revision_to', 'status', 'deleted'], 'integer'],
            [['title', 'slug'], 'string', 'max' => 70],
            [['short_desc'], 'string', 'max' => 255],
            ['status', 'default', 'value' => self::STATUS_NOT_PUBLISHED],
            ['status', 'in', 'range' => [self::STATUS_PUBLISHED, self::STATUS_NOT_PUBLISHED]],
            //['slug', 'default', 'value' => null],
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
            'status' => 'Status',
            'deleted' => 'Deleted',
            'revision_to ' => 'Revision To',
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
                'sourceAttributeName' => 'title', // If you want to make a slug from another attribute, set it here
                'slugAttributeName' => 'slug', // Name of the attribute containing a slug
                'onlyIfEmpty' => false,
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
            if (!$this->isNewRecord) {
                $this->createRevision();
            }

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

    public function getRevisions()
    {
        return $this->hasMany(self::className(), ['revision_to' => 'id'])
            ->orderBy('id DESC');
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function revisionsProvider()
    {
        return new ActiveDataProvider([
            'query' => $this->getRevisions(),
        ]);
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
        return $this->user->displayName;
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
        return $this->content_html;//\Yii::$app->kato->renderBlock($this->content);
    }

    private function createRevision()
    {
        $revision = new self();
        $revision->attributes = $this->attributes;
        unset($revision->id);
        $revision->revision_to = $this->id;
        if ($revision->save()) {
            return true;
        } else{
            throw new HttpException(500, 'Unable to create blog post revision');
        }
    }

    public function restore()
    {
        $blog = self::findOne($this->revision_to);

        //set attributes
        $blog->title = $this->title;
        $blog->short_desc = $this->short_desc;
        $blog->content = $this->content;
        $blog->content_html = $this->content_html;
        $blog->tags = $this->tags;
        $blog->status = $this->status;

        if ($blog->save()) {
            return true;
        } else {
            return false;
        }
    }
}
