<?php

namespace common\models;

use yii;
use common\kato\KatoHelper;

/**
 * This is the model class for table "kato_blog".
 *
 * @property integer $id
 * @property string $title
 * @property string $short_desc
 * @property string $content
 * @property string $content_html
 * @property string $slug
 * @property string $tags
 * @property string $create_time
 * @property integer $created_by
 * @property string $update_time
 * @property integer $updated_by
 * @property string $publish_time
 * @property integer $published_by
 * @property integer $is_revision
 * @property integer $parent_id
 * @property integer $status
 * @property integer $deleted
 */
class Blog extends \common\kato\ActiveRecord
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
			[['content', 'content_html', 'tags'], 'string'],
			[['title'], 'required'],
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

    /**
     * Actions to be taken before saving the record.
     * @param bool $insert
     * @return bool whether the record can be saved
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->title = $this->newPostTitle;
                $this->created_by = Yii::$app->user->identity->id;
                $this->is_revision = self::NOT_REVISION;
                $this->parent_id = 0;
                $this->status = self::STATUS_NOT_PUBLISHED;
            } else {
                $this->updated_by = Yii::$app->user->identity->id;
                $this->slug = $this->createSlug();
                $this->content_html = $this->renderBody();
                $this->short_desc = KatoHelper::genShortDesc($this->content_html, 'p' , '20');
            }
            return true;
        }
        return false;
    }

    /**
     * Returns New Post's Title
     * @return string
     */
    protected function getNewPostTitle()
    {
        return 'New Post ' . $this->getLastRow()->id;
    }

    /**
     * Convert title to clean url friendly slug
     * @return mixed|string
     */
    protected function createSlug()
    {
        return KatoHelper::toAscii($this->title);
    }

    /**
     * Converts Markdown to HTML
     * @return mixed
     */
    public function renderBody()
    {
        return \common\kato\PhpMarkdown::defaultTransform($this->content);
    }
}
