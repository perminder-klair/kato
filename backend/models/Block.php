<?php

namespace backend\models;

use kato\ActiveRecord;
use yii\helpers\Inflector;
use yii\helpers\Json;
use kartik\markdown\Markdown;
use yii\helpers\Html;

/**
 * This is the model class for table "kato_block".
 *
 * @property string $id
 * @property string $title
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
			[['create_time', 'update_time', 'content'], 'safe'],
			[['created_by', 'updated_by', 'listing_order', 'status', 'deleted'], 'integer'],
			[['title', 'parent'], 'string', 'max' => 70],
            ['status', 'default', 'value' => self::STATUS_NOT_PUBLISHED],
            ['status', 'in', 'range' => [self::STATUS_PUBLISHED, self::STATUS_NOT_PUBLISHED]],
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
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['create_time', 'update_time', 'publish_time'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['update_time'],
                ],
                'value' => new \yii\db\Expression('NOW()'),
            ],
            'softDelete' => [
                'class' => 'kato\behaviors\SoftDelete',
                'attribute' => 'deleted',
                'safeMode' => true,
            ],
            'defaultTitle' => [
                'class' => 'kato\behaviors\DefaultTitle',
                'attribute' => 'title',
                'defaultPrefix' => 'block',
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
            $this->parent = strtolower($this->parent);

            //$this->content_html = Markdown::convert($this->content);
            $this->title = Inflector::slug($this->title);

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

    public function render()
    {
        $content = Json::decode($this->content);

        $blocks = '';
        if (!empty($content)) {
            foreach ($content['data'] as $block) {
                if ($block['type'] === 'heading') {
                    $blocks .= Html::tag('h2', $block['data']['text']);
                }
                if ($block['type'] === 'text' || $block['type'] === 'list') {
                    $blocks .= Markdown::convert($block['data']['text']);
                }
            }
        }

        return $blocks;
    }
}
