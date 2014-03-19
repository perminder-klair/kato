<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Demo;

/**
 * DemoSearch represents the model behind the search form about `backend\models\Demo`.
 */
class DemoSearch extends Model
{
    public $id;
    public $title;
    public $create_time;
    public $update_time;
    public $listing_order;
    public $active;
    public $deleted;

    public function rules()
    {
        return [
            [['id', 'listing_order', 'active', 'deleted'], 'integer'],
            [['title', 'create_time', 'update_time'], 'safe'],
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
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'listing_order' => 'Listing Order',
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
        $this->addCondition($query, 'create_time');
        $this->addCondition($query, 'update_time');
        $this->addCondition($query, 'listing_order');
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
