<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\User as UserModel;

/**
 * User represents the model behind the search form about `common\models\User`.
 */
class User extends Model
{
	public $id;
	public $username;
	public $auth_key;
	public $password_hash;
	public $password_reset_token;
	public $email;
	public $role;
	public $status;
	public $create_time;
	public $update_time;

	public function rules()
	{
		return [
			[['id', 'role', 'status', 'create_time', 'update_time'], 'integer'],
			[['username', 'auth_key', 'password_hash', 'password_reset_token', 'email'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'username' => 'Username',
			'auth_key' => 'Auth Key',
			'password_hash' => 'Password Hash',
			'password_reset_token' => 'Password Reset Token',
			'email' => 'Email',
			'role' => 'Role',
			'status' => 'Status',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
		];
	}

	public function search($params)
	{
		$query = UserModel::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$this->addCondition($query, 'id');
		$this->addCondition($query, 'username', true);
		$this->addCondition($query, 'auth_key', true);
		$this->addCondition($query, 'password_hash', true);
		$this->addCondition($query, 'password_reset_token', true);
		$this->addCondition($query, 'email', true);
		$this->addCondition($query, 'role');
		$this->addCondition($query, 'status');
		$this->addCondition($query, 'create_time');
		$this->addCondition($query, 'update_time');
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
