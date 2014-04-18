<?php

namespace backend\models;

use kato\ActiveRecord;

/**
 * This is the model class for table "kato_setting".
 *
 * @property string $id
 * @property string $define
 * @property string $value
 */
class Setting extends ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'kato_setting';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['define'], 'string', 'max' => 50],
			[['value'], 'string', 'max' => 255]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'define' => 'Define',
			'value' => 'Value',
		];
	}

    public function defineEncoded()
    {
        return ucwords(str_replace('_', ' ', $this->define));
    }
}
