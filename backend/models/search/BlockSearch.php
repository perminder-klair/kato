<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Block;

/**
 * BlockSearch represents the model behind the search form about `backend\models\Block`.
 */
class BlockSearch extends Model
{
	public $id;
	public $title;
	public $slug;
	public $content;
	public $content_html;
	public $create_time;
	public $created_by;
	public $update_time;
	public $updated_by;
	public $parent;
	public $listing_order;
	public $status;
	public $deleted;

	public function rules()
	{
		return [
			[['id', 'created_by', 'updated_by', 'listing_order', 'status', 'deleted'], 'integer'],
			[['title', 'slug', 'content', 'content_html', 'create_time', 'update_time', 'parent'], 'safe'],
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

	public function search($params)
	{
		$query = Block::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$this->addCondition($query, 'id');
		$this->addCondition($query, 'title', true);
		$this->addCondition($query, 'slug', true);
		$this->addCondition($query, 'content', true);
		$this->addCondition($query, 'content_html', true);
		$this->addCondition($query, 'create_time');
		$this->addCondition($query, 'created_by');
		$this->addCondition($query, 'update_time');
		$this->addCondition($query, 'updated_by');
		$this->addCondition($query, 'parent', true);
		$this->addCondition($query, 'listing_order');
		$this->addCondition($query, 'status');
		$this->addCondition($query, 'deleted');
		return $dataProvider;
	}

	protected function addCondition($query, $attribute, $partialMatch = false)
	{
		if (($pos = strrpos($attribute, '.')) !== false) {
			$modelAttribute = substr($attribute, $pos + 1);
		} else {
			$modelAttribute = $attribute;
		}

		$value = $this->$modelAttribute;
		if (trim($value) === '') {
			return;
		}
		if ($partialMatch) {
			$query->andWhere(['like', $attribute, $value]);
		} else {
			$query->andWhere([$attribute => $value]);
		}
	}
}
