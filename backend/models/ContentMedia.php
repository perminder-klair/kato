<?php

namespace backend\models;

/**
 * This is the model class for table "kato_content_media".
 *
 * @property integer $id
 * @property integer $content_id
 * @property integer $media_id
 * @property string $media_type
 */
class ContentMedia extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'kato_content_media';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['content_id', 'media_id'], 'required'],
			[['content_id', 'media_id'], 'integer'],
			[['media_type'], 'string', 'max' => 50]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'content_id' => 'Content ID',
			'media_id' => 'Media ID',
			'media_type' => 'Media Type',
		];
	}
}
