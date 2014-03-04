<?php

namespace common\models;

use yii\helpers\Html;
use kartik\markdown\Markdown;
use common\kato\helpers\KatoBase;
use common\kato\behaviors\Slug;
use common\kato\ActiveRecord;

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
            [['short_desc'], 'string', 'max' => 160]
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
            'slug' => [
                'class' => Slug::className(),
                // These parameters are optional, default values presented here:
                'sourceAttributeName' => 'title', // If you want to make a slug from another attribute, set it here
                'slugAttributeName' => 'slug', // Name of the attribute containing a slug
                'replacement' => '-', // The replacement to use for spaces in the slug
                'lowercase' => true, // Whether to return the string in lowercase or not
                'unique' => true, // Check if the slug value is unique, add number if not
            ],
            'softDelete' => [
               'class' => 'common\kato\behaviors\SoftDelete',
               'attribute' => 'deleted',
               'safeMode' => true,
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

            if ($this->isNewRecord) {
                $this->is_revision = self::NOT_REVISION;
                $this->parent_id = 0;
                $this->status = self::STATUS_NOT_PUBLISHED;
                $this->slug = null;
            } else {
                $this->content_html = Markdown::convert($this->content);
                $this->short_desc = KatoBase::genShortDesc($this->content_html, 'p' , '20');
            }
            return true;
        }
        return false;
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

    public function listStatus()
    {
        return [
            self::STATUS_NOT_PUBLISHED => 'Not Published',
            self::STATUS_PUBLISHED => 'Published',
        ];
    }
}
