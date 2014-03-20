<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Blog as BlogModel;

/**
 * Blog represents the model behind the search form about `common\models\Blog`.
 */
class Blog extends Model
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
        $query = BlogModel::find()
            ->where(['deleted' => 0])
            ->andWhere(['status' => BlogModel::STATUS_PUBLISHED]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $this->addCondition($query, 'id');
        $this->addCondition($query, 'title', true);
        $this->addCondition($query, 'short_desc', true);
        $this->addCondition($query, 'content', true);
        $this->addCondition($query, 'content_html', true);
        $this->addCondition($query, 'slug', true);
        $this->addCondition($query, 'tags', true);
        $this->addCondition($query, 'create_time');
        $this->addCondition($query, 'created_by');
        $this->addCondition($query, 'update_time');
        $this->addCondition($query, 'updated_by');
        $this->addCondition($query, 'publish_time');
        $this->addCondition($query, 'published_by');
        $this->addCondition($query, 'is_revision');
        $this->addCondition($query, 'parent_id');
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
