<?php

namespace backend\models;

use kartik\markdown\Markdown;
use kato\helpers\KatoBase;
use kato\behaviors\Slug;
use kato\behaviors\SoftDelete;
use kato\ActiveRecord;
use yii\helpers\ArrayHelper;

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
class Page extends ActiveRecord
{
    const STATUS_NOT_PUBLISHED = 0;
    const STATUS_PUBLISHED = 1;
    const TYPE_STATIC = 0;
    const TYPE_NON_STATIC = 1;

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
			[['layout'], 'string', 'max' => 25],
            ['status', 'default', 'value' => self::STATUS_NOT_PUBLISHED],
            ['status', 'in', 'range' => [self::STATUS_PUBLISHED, self::STATUS_NOT_PUBLISHED]],
            ['type', 'default', 'value' => self::TYPE_NON_STATIC],
            ['type', 'in', 'range' => [self::TYPE_STATIC, self::TYPE_NON_STATIC]],
            ['parent_id', 'default', 'value' => 0],
            ['slug', 'default', 'value' => null],
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
			'parent_id' => 'Parent',
			'type' => 'Type',
			'status' => 'Status',
			'deleted' => 'Deleted',
		];
	}

    public function getBlocks()
    {
        // Page has_many Block via Block.parent -> slug
        return $this->hasMany(Block::className(), ['parent' => 'slug']);
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
            $this->content_html = Markdown::convert($this->content);
            $this->short_desc = KatoBase::genShortDesc($this->content_html, 'p' , '20');

            return true;
        }
        return false;
    }

    public function listStatus()
    {
        return [
            self::STATUS_NOT_PUBLISHED => 'Not Published',
            self::STATUS_PUBLISHED => 'Published',
        ];
    }

    public function getStatusLabel()
    {
        if ($status =$this->listStatus()) {
            return $status[$this->status];
        }
        return false;
    }

    /**
     * Returns id, title of all parents
     * @return array
     */
    public function listParents()
    {
        $parents = self::find()
            ->where('id != ' . $this->id)
            ->all();

        return ArrayHelper::map($parents, 'id', 'title');
    }

    public function listLayouts()
    {
        return [
            'default' => 'default',
        ];
    }
}
