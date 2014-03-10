<?php

namespace backend\models;

use backend\controllers\SiteController;
use kato\ActiveRecord;
use kato\behaviors\Slug;
use kato\behaviors\SoftDelete;
use kartik\markdown\Markdown;

/**
 * This is the model class for table "kato_block".
 *
 * @property string $id
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property string $content_html
 * @property string $create_time
 * @property integer $created_by
 * @property string $update_time
 * @property integer $updated_by
 * @property string $parent
 * @property integer $listing_order
 * @property integer $status
 * @property integer $deleted
 */
class Block extends ActiveRecord
{
    const STATUS_NOT_PUBLISHED = 0;
    const STATUS_PUBLISHED = 1;

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'kato_block';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['content', 'content_html'], 'string'],
			[['create_time', 'created_by', 'update_time', 'updated_by'], 'required'],
			[['create_time', 'update_time'], 'safe'],
			[['created_by', 'updated_by', 'listing_order', 'status', 'deleted'], 'integer'],
			[['title', 'slug', 'parent'], 'string', 'max' => 70]
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
			'slug' => 'Slug',
			'content' => 'Content',
			'content_html' => 'Content Html',
			'create_time' => 'Create Time',
			'created_by' => 'Created By',
			'update_time' => 'Update Time',
			'updated_by' => 'Updated By',
			'parent' => 'Parent',
			'listing_order' => 'Listing Order',
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
                'class' => SoftDelete::className(),
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
                $this->status = self::STATUS_NOT_PUBLISHED;
                $this->slug = null;
            } else {
                $this->content_html = Markdown::convert($this->content);
            }

            $this->parent = strtolower($this->parent);

            return true;
        }
        return false;
    }

    /**
     * List all actions in site controller
     * @return array
     */
    public function listParents()
    {
        $help = new \yii\console\controllers\HelpController('', '');
        $actions = $help->getActions(new \frontend\controllers\SiteController('', ''));

        $data = [];
        foreach ($actions as $key => $value) {
            $data[$value] = ucwords($value);
        }

        return $data;
    }

    public function renderParent()
    {
        if (!is_null($this->parent)) {
            return ucwords($this->parent);
        }

        return '-';
    }
}
