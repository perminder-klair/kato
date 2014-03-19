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
    const PUBLISHED_NO = 0;
    const PUBLISHED_YES = 1;

    public $file;
    public $cacheDir = 'cache';

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

    /**
     * @inheritdoc
     */
    public function afterDelete()
    {
        //Remove file from system
        if (file_exists($this->baseSource)) {
            unlink($this->baseSource);
        }

        return parent::afterDelete();
    }

    /**
     * Returns base path for file
     * @return string
     */
    public function getBaseSource()
    {
        return dirname(\Yii::$app->params['uploadPath']) . '/' . $this->source;
    }

    public function render()
    {
        $cacheFile = \Yii::$app->params['uploadPath'] . $this->cacheDir . '/' . $this->filename;

        //http://imagine.readthedocs.org/en/latest/
        // frame, rotate and save an image
        Image::thumbnail($this->baseSource, 50, 50)
            ->save($cacheFile);

        return $cacheFile;
    }

    /**
     * @return array
     */
    public function listPublishedStatus()
    {
        return [
            self::PUBLISHED_NO => 'No',
            self::PUBLISHED_YES => 'Yes',
        ];
    }

    /**
     * @return mixed
     */
    public function getPublishedStatus()
    {
        $list = $this->listPublishedStatus();
        return $list[$this->published];
    }
}
