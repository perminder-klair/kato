<?php

namespace backend\models;

use Yii;
use kartik\markdown\Markdown;
use kato\helpers\KatoBase;
use kato\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\BadRequestHttpException;
use yii\web\HttpException;

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
 * @property string $layout
 * @property integer $parent_id
 * @property integer $type
 * @property boolean $status
 * @property boolean $deleted
 * @property string $menu_title
 * @property boolean $menu_hidden
 * @property integer $listing_order
 */
class Page extends ActiveRecord
{
    const STATUS_NOT_PUBLISHED = 0;
    const STATUS_PUBLISHED = 1;
    const TYPE_STATIC = 0;
    const TYPE_NON_STATIC = 1;
    const MENU_HIDDEN_NO = 0;
    const MENU_HIDDEN_YES = 1;

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
			[['created_by', 'updated_by', 'parent_id', 'type', 'listing_order', 'menu_hidden'], 'integer'],
			[['status', 'menu_hidden', 'deleted'], 'boolean'],
			[['title', 'slug', 'menu_title'], 'string', 'max' => 70],
			[['short_desc'], 'string', 'max' => 255],
			[['layout'], 'string', 'max' => 25],
            ['status', 'default', 'value' => self::STATUS_NOT_PUBLISHED],
            ['status', 'in', 'range' => [self::STATUS_PUBLISHED, self::STATUS_NOT_PUBLISHED]],
            ['type', 'default', 'value' => self::TYPE_STATIC],
            ['type', 'in', 'range' => [self::TYPE_STATIC, self::TYPE_NON_STATIC]],
            ['parent_id', 'default', 'value' => 0],
            ['slug', 'default', 'value' => null],
            [['title', 'slug'], 'unique'],
            ['menu_hidden', 'default', 'value' => 1],
            ['menu_hidden', 'in', 'range' => [self::MENU_HIDDEN_NO, self::MENU_HIDDEN_YES]],
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
			'layout' => 'Layout',
			'parent_id' => 'Parent',
			'type' => 'Page Type',
			'status' => 'Status',
			'deleted' => 'Deleted',
            'menu_title' => 'Menu Title',
            'menu_hidden' => 'Hidden in Menu',
            'listing_order' => 'Listing Order',
		];
	}

    public function getBlocks()
    {
        // Page has_many Block via Block.parent -> slug
        return $this->hasMany(Block::className(), ['parent' => 'slug']);
    }

    public function getChildren()
    {
        return $this->hasMany(self::className(), ['parent_id' => 'id']);
    }

    public function getMenuChildren()
    {
        return $this->hasMany(self::className(), ['parent_id' => 'id'])
            ->where([
                'menu_hidden' => Page::MENU_HIDDEN_NO,
                'status' => Page::STATUS_PUBLISHED,
                'deleted' => 0,
            ])
            ->orderBy('listing_order ASC');
    }

    public function getActiveBlocks()
    {
        $groups = array(
            'categories' => array(),
            'blocks' => array(),
        );

        foreach ($this->blocks as $block) {
            //get categories
            if (!in_array($block->category, $groups['categories'])) {
                $groups['categories'][] = $block->category;
            }

            //get blocks
            if ($this->layout == $block->parent_layout || $this->type == self::TYPE_NON_STATIC) {
                $group = $block->category;
                if (!isset($groups['blocks'][$group])) {
                    $groups['blocks'][$group] = array();
                }
                $groups['blocks'][$group][] = $block;
            }
        }

        return $groups;
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
            'defaultMenuTitle' => [
                'class' => 'kato\behaviors\DefaultTitle',
                'attribute' => 'menu_title',
                'defaultPrefix' => 'Page',
            ],
            'defaultSlug' => [
                'class' => 'kato\behaviors\DefaultTitle',
                'attribute' => 'slug',
                'defaultPrefix' => 'page',
            ],
            'slug' => [
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
            'listingOrder' => [
                'class' => 'kato\behaviors\ListingOrder',
                'attribute' => 'listing_order',
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
            //$this->createShortDesc();

            return true;
        }
        return false;
    }

    /**
     * Render short_desc and content_html
     * @return bool
     */
    /*public function createShortDesc()
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
    }*/

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
     * List all available layouts
     * @return array
     */
    public function listLayouts()
    {
        $this->pagesDir =  Yii::getAlias('@frontend') . str_replace('/admin','',Yii::$app->view->theme->basePath) . DIRECTORY_SEPARATOR. 'page';

        $files = [];
        if ($viewFiles = \kato\helpers\KatoBase::get_files($dir)) {
            foreach ($viewFiles as $key => $value) {
                $fileName = basename($value, ".php");
                $files[$fileName] = ucfirst($fileName);
            }

        }
        return $files;
    }

    /*public function renderContent()
    {
        return \Yii::$app->kato->renderBlock($this->content);
    }*/

    public function loadBlocks()
    {
        if ($this->type == self::TYPE_NON_STATIC) {
            $layout = null;
            $json_file = $this->slug;
        } else {
            $json_file = $layout = $this->layout;
        }

        $pages_dir = Yii::getAlias('@frontend') . str_replace('/admin','',Yii::$app->view->theme->basePath) . DIRECTORY_SEPARATOR . 'blocks' . DIRECTORY_SEPARATOR;
        $page_json = $pages_dir . $json_file . '.json';

        if (file_exists($page_json)) {

            $string = file_get_contents($page_json);
            $encoded_data = json_decode($string);
            if (count($encoded_data->blocks) !== 0) {
                foreach ($encoded_data->blocks as $data) {
                    if (($block = Block::findOne([
                            'title' => $data->name,
                            'parent' => $this->slug,
                            'parent_layout' => $layout,
                        ]) === null)
                    ) {
                        //if not found, create it
                        $block = new Block();
                        $block->parent = $this->slug;
                        $block->title = $data->name;
                        $block->block_type = isset($data->type) ? $data->type : 'text-area';
                        $block->parent_layout = $layout;
                        if (isset($data->comments)) $block->comments = $data->comments;
                        $block->category = isset($data->category) ? $data->category : 'General';

                        if (!$block->save()) {
                            //throw error
                            throw new HttpException('Unable to load blocks to database');

                        }
                    }
                }
            }

        }

        return true;
    }

    public function updateBlocks()
    {
        $post = Yii::$app->request->post();

        //update blocks
        if (isset($post['Block'])) {
            foreach ($post['Block'] as $key => $val) {
                if ($this->type == self::TYPE_NON_STATIC) {
                    $layout = null;
                } else {
                    $layout = $this->layout;
                }

                if ($block = Block::findOne([
                    'title' => $key,
                    'parent' => $this->slug,
                    'parent_layout' => $layout,
                ])) {
                    $block->content = $val;
                    if (!$block->save()) {
                        //throw error
                        throw new HttpException('Unable to load blocks to database');
                    }
                }

            }

            return true;
        }

        return false;
    }

    public function getPermalink()
    {
        if ($this->type == self::TYPE_NON_STATIC) {
            return Yii::$app->urlManager->createUrl([str_replace("-", "/", $this->slug)]);
        } else {

            if (is_null($this->slug)) {
                throw new BadRequestHttpException('Page slug not specified.');
            }

            return Yii::$app->urlManager->createUrl(['page/view', 'slug' => $this->slug]);
        }
    }
}
