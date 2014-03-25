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
            [['id', 'active', 'deleted'], 'integer'],
            [['title', 'description', 'tags', 'create_time', 'update_time'], 'safe'],
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

        $this->addCondition($query, 'id');
        $this->addCondition($query, 'title', true);
        $this->addCondition($query, 'description', true);
        $this->addCondition($query, 'tags', true);
        $this->addCondition($query, 'create_time');
        $this->addCondition($query, 'update_time');
        $this->addCondition($query, 'active');
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
