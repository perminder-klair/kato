<?php

namespace common\models;

/**
 * This is the model class for table "kato_tag".
 *
 * @property integer $id
 * @property string $name
 * @property integer $frequency
 * @property string $tag_type
 */
class Tag extends \common\kato\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'kato_tag';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['frequency'], 'integer'],
			[['name'], 'string', 'max' => 255],
			[['tag_type'], 'string', 'max' => 50]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'name' => 'Name',
			'frequency' => 'Frequency',
			'tag_type' => 'Tag Type',
		];
	}
}
