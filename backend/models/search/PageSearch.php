<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Page;

/**
 * PageSearch represents the model behind the search form about Page.
 */
class PageSearch extends Model
{
	public $id;
	public $title;
	public $short_desc;
	public $content;
	public $content_html;
	public $slug;
	public $create_time;
	public $created_by;
	public $update_time;
	public $updated_by;
	public $level;
	public $layout;
	public $parent_id;
	public $type;
	public $status;
	public $deleted;

	public function rules()
	{
		return [
			[['id', 'created_by', 'updated_by', 'level', 'parent_id', 'type'], 'integer'],
			[['title', 'short_desc', 'content', 'content_html', 'slug', 'create_time', 'update_time', 'layout'], 'safe'],
			[['status', 'deleted'], 'boolean'],
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

	public function search($params)
	{
		$query = Page::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$this->addCondition($query, 'title');
		$this->addCondition($query, 'title', true);
		$this->addCondition($query, 'short_desc');
		$this->addCondition($query, 'short_desc', true);
		$this->addCondition($query, 'content');
		$this->addCondition($query, 'content', true);
		$this->addCondition($query, 'content_html');
		$this->addCondition($query, 'content_html', true);
		$this->addCondition($query, 'slug');
		$this->addCondition($query, 'slug', true);
		$this->addCondition($query, 'layout');
		$this->addCondition($query, 'layout', true);
		return $dataProvider;
	}

	protected function addCondition($query, $attribute, $partialMatch = false)
	{
		$value = $this->$attribute;
		if (trim($value) === '') {
			return;
		}
		if ($partialMatch) {
			$value = '%' . strtr($value, ['%'=>'\%', '_'=>'\_', '\\'=>'\\\\']) . '%';
			$query->andWhere(['like', $attribute, $value]);
		} else {
			$query->andWhere([$attribute => $value]);
		}
	}
}
