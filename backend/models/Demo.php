<?php

namespace backend\models;

/**
 * This is the model class for table "demo".
 *
 * @property string $id
 * @property string $title
 * @property string $create_time
 * @property string $update_time
 * @property integer $listing_order
 * @property integer $active
 * @property integer $deleted
 */
class Demo extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'demo';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['create_time', 'update_time'], 'safe'],
			[['listing_order', 'active', 'deleted'], 'integer'],
			[['title'], 'string', 'max' => 255]
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
}
