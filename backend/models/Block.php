<?php

namespace backend\models;

use backend\models\query\BlockQuery;
use kato\ActiveRecord;
use yii\helpers\Inflector;
use yii\helpers\ArrayHelper;
use yii\web\HttpException;

/**
 * This is the model class for table "kato_block".
 *
 * @property string $id
 * @property string $title
 * @property string $content
 * @property string $create_time
 * @property integer $created_by
 * @property string $update_time
 * @property integer $updated_by
 * @property string $parent_layout
 * @property string $block_type
 * @property string $comments
 * @property string $category
 * @property integer $revision_to
 * @property integer $status
 * @property integer $deleted
 * @property integer $parent
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
     * @return BlockQuery
     */
    public static function find()
    {
        return new BlockQuery(get_called_class());
    }

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['content'], 'string'],
			[['create_time', 'update_time', 'content'], 'safe'],
			[['created_by', 'updated_by', 'status', 'deleted', 'parent'], 'integer'],
			[['title'], 'string', 'max' => 70],
            [['parent_layout', 'block_type', 'category'], 'string', 'max' => 50],
            [['comments'], 'string', 'max' => 100],
            ['status', 'default', 'value' => self::STATUS_PUBLISHED],
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
			'create_time' => 'Create Time',
			'created_by' => 'Created By',
			'update_time' => 'Update Time',
			'updated_by' => 'Updated By',
			'parent' => 'Parent',
            'block_type' => 'Block Type',
            'parent_layout' => 'Parent Layout',
            'comments' => 'Comments',
            'category' => 'Category',
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
                    ActiveRecord::EVENT_BEFORE_INSERT => ['create_time', 'update_time'],
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

            $this->title = Inflector::slug($this->title);

            $this->category = Inflector::slug($this->category);

            return true;
        }
        return false;
    }

    /**
     * List all actions in site controller
     * @return array
     */
    /*public function listParents()
    {
        $help = new \yii\console\controllers\HelpController('', '');
        $actions = $help->getActions(new \frontend\controllers\SiteController('', ''));

        $data = [];
        foreach ($actions as $key => $value) {
            $data[$value] = ucwords($value);
        }

        return $data;
    }*/

    /*public function renderParent()
    {
        if (!is_null($this->parent)) {
            return ucwords($this->parent);
        }

        return '-';
    }*/

    /**
     * List all actions in site controller
     * @return array
     */
    public function listParents()
    {
        $parents = self::find()
            ->where('id != ' . $this->id)
            ->all();

        return ArrayHelper::map($parents, 'id', 'title');
    }

    public function render()
    {
        return \Yii::$app->kato->renderBlock($this->content);
    }

    public function getLabel()
    {
        $label = ucwords(str_replace("-", " ", $this->title));

        if ($this->comments) {
            //$label = '<span data-toggle="tooltip" title="' . $this->comments . '" data-placement="top" data-trigger="hover" style="border-bottom: 1px dotted #000;">' .$label.'</span>';
        }

        return '<label class="col-sm-3 control-label">' . $label . '</label>';
    }

    public function createRevision($parentId = null)
    {
        $revision = new self();
        $revision->attributes = $this->attributes;
        unset($revision->id);
        $revision->parent = $parentId;
        $revision->revision_to = $this->id;
        if (!$revision->save(false)) {
            throw new HttpException(500, 'Unable to create block revision');
        }

        return true;
    }

    public function restore()
    {
        $block = self::findOne($this->revision_to);

        //set attributes
        $block->title = $this->title;
        $block->content = $this->content;
        $block->block_type = $this->block_type;
        $block->parent_layout = $this->parent_layout;
        $block->comments = $this->comments;
        $block->category = $this->category;

        if ($block->save()) {
            return true;
        } else {
            return false;
        }
    }
}
