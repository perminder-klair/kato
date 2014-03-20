<?php

namespace frontend\models;

/**
* This is the model class for table "demo".
*
    * @property string $id
    * @property string $title
    * @property string $tags
    * @property string $create_time
    * @property string $update_time
    * @property integer $listing_order
    * @property integer $active
    * @property integer $deleted
*/
class Demo extends \kato\ActiveRecord
{

    const STATUS_NOT_PUBLISHED = 0;
    const STATUS_PUBLISHED = 1;

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
            [['tags'], 'string'],
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
            'tags' => 'Tags',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'listing_order' => 'Listing Order',
            'active' => 'Active',
            'deleted' => 'Deleted',
        ];
    }
    
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    \kato\ActiveRecord::EVENT_BEFORE_INSERT => ['create_time', 'update_time'],
                    \kato\ActiveRecord::EVENT_BEFORE_UPDATE => ['update_time'],
                ],
                'value' => new \yii\db\Expression('NOW()'),
            ],

            'softDelete' => [
                'class' => 'kato\behaviors\SoftDelete',
                'attribute' => 'deleted',
                'safeMode' => true,
            ],
            'normalizeTags' => [
                'class' => 'kato\behaviors\NormalizeTags',
                'attribute' => 'tags',
                'updateTags' => true,
                'tagType' => self::className(),
            ],
        ];
    }

}
