<?php

namespace app\models;

/**
 * This is the model class for table "kato_page".
 *
 * @property integer $id
 * @property string $title
 * @property string $short_desc
 * @property string $content
 * @property string $content_html
 * @property string $slug
 * @property string $create_time
 * @property integer $created_by
 * @property string $update_time
 * @property integer $updated_by
 * @property integer $level
 * @property string $layout
 * @property integer $parent_id
 * @property integer $type
 * @property boolean $status
 * @property boolean $deleted
 */
class Page extends \common\kato\ActiveRecord
{
    const STATUS_NOT_PUBLISHED = 0;
    const STATUS_PUBLISHED = 1;

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'kato_page';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['content', 'content_html'], 'string'],
			[['create_time', 'created_by', 'update_time'], 'required'],
			[['create_time', 'update_time'], 'safe'],
			[['created_by', 'updated_by', 'level', 'parent_id', 'type'], 'integer'],
			[['status', 'deleted'], 'boolean'],
			[['title', 'slug'], 'string', 'max' => 70],
			[['short_desc'], 'string', 'max' => 160],
			[['layout'], 'string', 'max' => 25]
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
			'create_time' => 'Create Time',
			'created_by' => 'Created By',
			'update_time' => 'Update Time',
			'updated_by' => 'Updated By',
			'level' => 'Level',
			'layout' => 'Layout',
			'parent_id' => 'Parent ID',
			'type' => 'Type',
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
                $this->parent_id = 0;
                $this->status = self::STATUS_NOT_PUBLISHED;
            } else {
                $this->slug = $this->createSlug();
                $this->content_html = $this->renderBody();
                $this->short_desc = \common\kato\KatoHelper::genShortDesc($this->content_html, 'p' , '20');
            }
            return true;
        }
        return false;
    }

    /**
     * Converts Markdown to HTML
     * @return mixed
     */
    public function renderBody()
    {
        return \common\kato\PhpMarkdown::defaultTransform($this->content);
    }

    /**
     * Convert title to clean url friendly slug
     * @return mixed|string
     */
    protected function createSlug()
    {
        return \common\kato\KatoHelper::toAscii($this->title);
    }
}
