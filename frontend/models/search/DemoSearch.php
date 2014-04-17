<?php

namespace frontend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Demo;

/**
 * DemoSearch represents the model behind the search form about `frontend\models\Demo`.
 */
class DemoSearch extends Model
{
    public $id;
    public $title;
    public $description;
    public $tags;
    public $create_time;
    public $update_time;
    public $active;
    public $deleted;

    public function rules()
    {
        return [
            [['id', 'tags', 'active', 'deleted'], 'integer'],
            [['title', 'description', 'create_time', 'update_time'], 'safe'],
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
            'description' => 'Description',
            'tags' => 'Tags',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'active' => 'Active',
            'deleted' => 'Deleted',
        ];
    }

    public function search($params)
    {
        $query = Demo::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'tags' => $this->tags,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'active' => $this->active,
            'deleted' => $this->deleted,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description]);

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
