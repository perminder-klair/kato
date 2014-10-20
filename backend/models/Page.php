<?php

namespace backend\models;

use Yii;
use kartik\markdown\Markdown;
use kato\helpers\KatoBase;
use kato\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

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

    public $pagesDir = null;

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
			[['short_desc'], 'string', 'max' => 255],
			[['layout'], 'string', 'max' => 25],
            ['status', 'default', 'value' => self::STATUS_NOT_PUBLISHED],
            ['status', 'in', 'range' => [self::STATUS_PUBLISHED, self::STATUS_NOT_PUBLISHED]],
            ['type', 'default', 'value' => self::TYPE_NON_STATIC],
            ['type', 'in', 'range' => [self::TYPE_STATIC, self::TYPE_NON_STATIC]],
            ['parent_id', 'default', 'value' => 0],
            ['slug', 'default', 'value' => null],
            [['title', 'slug'], 'unique'],
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
                    ActiveRecord::EVENT_BEFORE_INSERT => ['create_time', 'update_time'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['update_time'],
                ],
                'value' => new \yii\db\Expression('NOW()'),
            ],
            'defaultTitle' => [
                'class' => 'kato\behaviors\DefaultTitle',
                'attribute' => 'title',
                'defaultPrefix' => 'Page',
            ],
            'slug' => [
                'class' => 'kato\behaviors\Slug',
                // These parameters are optional, default values presented here:
                'sourceAttributeName' => 'title', // If you want to make a slug from another attribute, set it here
                'slugAttributeName' => 'slug', // Name of the attribute containing a slug
                'onlyIfEmpty' => true,
            ],
            'softDelete' => [
                'class' => 'kato\behaviors\SoftDelete',
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

    /**
     * TODO make it work with different themes
     * @return array
     */
    public function listLayouts()
    {
        $this->pagesDir =  Yii::getAlias('@frontend') . '/themes/basic/page';

        $files = [];
        if ($viewFiles = \kato\helpers\KatoBase::get_files($dir)) {
            foreach ($viewFiles as $key => $value) {
                $fileName = basename($value, ".php");
                $files[$fileName] = ucfirst($fileName);
            }

        }
        return $files;
    }

    public function renderContent()
    {
        return \Yii::$app->kato->renderBlock($this->content);
    }
}
