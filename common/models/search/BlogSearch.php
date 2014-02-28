<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Blog;

/**
 * BlogSearch represents the model behind the search form about Blog.
 */
class BlogSearch extends Model
{
	public $id;
	public $title;
	public $short_desc;
	public $content;
	public $content_html;
	public $slug;
	public $tags;
	public $create_time;
	public $created_by;
	public $update_time;
	public $updated_by;
	public $publish_time;
	public $published_by;
	public $is_revision;
	public $parent_id;
	public $status;
	public $deleted;

	public function rules()
	{
		return [
			[['id', 'created_by', 'updated_by', 'published_by', 'is_revision', 'parent_id', 'status', 'deleted'], 'integer'],
			[['title', 'short_desc', 'content', 'content_html', 'slug', 'tags', 'create_time', 'update_time', 'publish_time'], 'safe'],
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

	public function search($params)
	{
		$query = Blog::find();
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
		$this->addCondition($query, 'tags');
		$this->addCondition($query, 'tags', true);
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
