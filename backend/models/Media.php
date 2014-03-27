<?php

namespace backend\models;

use Yii;
use yii\imagine\Image;
use kato\ActiveRecord;

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
 * @property integer $status
 * @property string $content_type
 */
class Media extends ActiveRecord
{
    const STATUS_NOT_PUBLISHED = 0;
    const STATUS_PUBLISHED = 1;

    public $file;
    public $title;
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
			[['filename', 'source'], 'required'],
			[['create_time', 'media_type'], 'safe'],
			[['byteSize', 'status'], 'integer'],
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
			'status' => 'Status',
            'media_type' => 'Media Type',
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

        parent::afterDelete();
    }

    /**
     * Returns base path for file
     * @return string
     */
    public function getBaseSource()
    {
        return dirname(Yii::$app->params['uploadPath']) . '/' . $this->source;
    }

    public function listMediaType()
    {
        $types = [];
        if (!empty(Yii::$app->params['mediaTypes'])) {
            foreach (Yii::$app->params['mediaTypes'] as $key => $value) {
                $types[$value] = ucfirst($value);
            }
        }
        return $types;
    }

    /**
     * TODO complete this properly
     * @return string
     */
    public function render()
    {
        $cacheFile = Yii::$app->params['uploadPath'] . $this->cacheDir . '/' . $this->filename;

        //http://imagine.readthedocs.org/en/latest/
        // frame, rotate and save an image
        Image::thumbnail($this->baseSource, 50, 50)
            ->save($cacheFile);

        return '/files/' . $this->cacheDir . '/' . $this->filename;
    }

}
