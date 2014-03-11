<?php

namespace backend\models;

use kato\ActiveRecord;

/**
 * This is the model class for table "kato_tag".
 *
 * @property string $id
 * @property string $name
 * @property integer $frequency
 * @property string $tag_type
 */
class Tag extends ActiveRecord
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

    /**
     * Returns array of tags by tag type
     * @param null $tagType
     * @param int $limit
     * @return array
     */
    public static function listTags($tagType=null, $limit=30)
    {
        //TODO complete this

        $data = self::find()
            ->select('name')
            ->orderBy('frequency DESC, Name')
            ->limit($limit)
            //if (!is_null($tagType))
                //->where('tag_type > :type', [':type' => $tagType])
            ->all();

        $return = [];
        if (!empty($data)) {
            foreach ($data as $tag) {
                $return[] = $tag->name;
            }
        }
        return $return;
    }
}
