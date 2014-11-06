<?php

namespace backend\models;

use Yii;
use yii\helpers\Html;
use yii\imagine\Image;
use kato\ActiveRecord;

/**
 * This is the model class for table "kato_media".
 *
 * @property string $id
 * @property string $title
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
    public $cacheDir = 'cache';

    public function init()
    {
        parent::init();

        Yii::setAlias('cacheDir', '/files/' . $this->cacheDir);
        Yii::setAlias('cachePath', Yii::$app->params['uploadPath'] . $this->cacheDir);
    }

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
			[['create_time', 'media_type', 'title'], 'safe'],
			[['byteSize', 'status'], 'integer'],
			[['filename', 'source', 'source_location', 'title'], 'string', 'max' => 255],
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
            'title' => 'Title',
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
     * Actions to be taken before saving the record.
     * @param bool $insert
     * @return bool whether the record can be saved
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->createTitle();
            }

            return true;
        }
        return false;
    }

    /**
     * Before deletion, remove media file from source and also delete from relation table
     * @inheritdoc
     */
    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            //Remove file from system
            if (file_exists($this->baseSource)) {
                unlink($this->baseSource);
            }

            //Delete from relation table
            if ($contentMedia = ContentMedia::find()->where(['media_id' => $this->id])->all()) {
                foreach ($contentMedia as $data)  {
                    $data->delete();
                }
            }

            return true;
        }

        return false;
    }

    private function createTitle()
    {
        $title_parts = pathinfo($this->filename);
        $this->title = $title_parts['filename'];
        $this->title = \kato\helpers\KatoBase::sanitizeFile($this->title);
        $this->title = str_replace('_', ' ', str_replace('-', ' ', $this->title));
        $this->title = ucwords($this->title);
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

    public function statusDropDownList()
    {
        $data = [];
        if ($this->listStatus()) {
            foreach ($this->listStatus() as $key => $value) {
               $data[] = [
                   'id' => $key,
                   'text' => $value,
               ];
            }
        }

        return $data;
    }

    public function renderPdf($data = [])
    {
        if (isset($data['imgTag'])) {
            $pdfPreview = Yii::$app->request->adminBaseUrl . '/img/pdf-preview.jpg';

            $options = [];
            if (isset($data['width'])) $options['width'] = $data['width'];
            if (isset($data['height'])) $options['height'] = $data['height'];
            return Html::img($pdfPreview, $options);
        }

        return '/' . $this->source;
    }

    public function renderImage($data = [])
    {
        $cacheFile = Yii::getAlias('@cachePath/' . $this->filename);

        if (!isset($data['width']) && !isset($data['height'])) {
            $image = Image::getImagine();
            $newImage = $image->open($this->baseSource);
            $newImage->save($cacheFile);

            return Yii::getAlias('@cacheDir/' . $this->filename);
        } else {
            $path_parts = pathinfo($cacheFile);
            $newFileName = $path_parts['filename'] . '-' . $data['width'] . '-' . $data['height'] . '.' . $path_parts['extension'];
            //http://imagine.readthedocs.org/en/latest/
            //dump($newFileName);exit;
            Image::thumbnail($this->baseSource, $data['width'], $data['height'])
                ->save(Yii::getAlias('@cachePath/' . $newFileName));
        }
        if (isset($data['imgTag'])) {
            return Html::img(Yii::getAlias('@cacheDir/' . $newFileName));
        } else {
            return Yii::getAlias('@cacheDir/' . $newFileName);
        }
    }

    /**
     * Renders media
     */
    public function render($data = [])
    {
        //if file exists
        if (!file_exists($this->baseSource)) {
            return false;
        }

        //check if it's pdf file
        if ($this->mimeType === 'application/pdf') {
            return $this->renderPdf($data);
        } else {
            return $this->renderImage($data);
        }
    }

}
