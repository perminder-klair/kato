<?php

namespace backend\models;

use yii\imagine\Image;

/**
 * This is the model class for table "kato_media".
 *
 * @property string $id
 * @property string $filename
 * @property string $source
 * @property string $source_location
 * @property string $create_time
 * @property string $extension
 * @property string $mimeType
 * @property string $byteSize
 * @property integer $media_type
 * @property integer $published
 */
class Media extends \yii\db\ActiveRecord
{
    public $file;

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'kato_media';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['source_location', 'create_time', 'byteSize'], 'required'],
			[['create_time'], 'safe'],
			[['byteSize', 'media_type', 'published'], 'integer'],
			[['filename', 'source', 'source_location'], 'string', 'max' => 255],
			[['extension', 'mimeType'], 'string', 'max' => 50]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'filename' => 'Filename',
			'source' => 'Source',
			'source_location' => 'Source Location',
			'create_time' => 'Create Time',
			'extension' => 'Extension',
			'mimeType' => 'Mime Type',
			'byteSize' => 'Byte Size',
			'media_type' => 'Media Type',
			'published' => 'Published',
		];
	}

    public function render()
    {
        //http://imagine.readthedocs.org/en/latest/
        // frame, rotate and save an image
//        Image::frame('path/to/image.jpg', 5, '666', 0)
//            ->rotate(-8)
//            ->save('path/to/destination/image.jpg', ['quality' => 50]);

    }
}
