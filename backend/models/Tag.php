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
class Tag extends \yii\db\ActiveRecord
{
    const DEFAULT_FREQUENCY = 1;

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
			[['tag_type'], 'string', 'max' => 50],
            [['tags', 'match', 'pattern'=>'/^[\w\s,]+$/', 'message'=>'Tags can only contain word characters.']],
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
        /*$criteria=new CDbCriteria;
        $criteria->order = 'frequency DESC, Name';
        $criteria->limit = $limit;
        if (!empty($tagType))
            $criteria->addCondition('tag_type = '. '"'.$tagType.'"');

        $data = array();
        foreach (KatoTag::model()->findAll($criteria) as $tag) {
            $data[] = $tag->name;
        }

        return $data;*/

        $data = self::find()
            ->select('name')
            ->orderBy('frequency DESC, Name')
            ->limit($limit)
            ->all();

        $return = [];
        if (!empty($data)) {
            foreach ($data as $tag) {
                $return[] = $tag->name;
            }
        }
        return $return;
    }

    /**
     * Returns tag names and their corresponding weights.
     * Only the tags with the top weights will be returned.
     * @param integer the maximum number of tags that should be returned
     * @return array weights indexed by tag names.
     */
    public function findTagWeights($limit=20)
    {
        $models = self::find()
            ->orderBy('frequency DESC')
            ->limit($limit)
            -all();

        $total=0;
        foreach ($models as $model) {
            $total+=$model->frequency;
        }

        $tags=[];
        if ($total > 0)
        {
            foreach ($models as $model) {
                $tags[$model->name] = 8 + (int)(16*$model->frequency/($total+10));
            }
            ksort($tags);
        }

        return $tags;
    }

    /**
     * Update count of tags already exists
     * if tag does not exists, insert it
     * @param $tags
     * @param $tagType
     */
    public static function addTags($tags, $tagType)
    {
        foreach ($tags as $name) {
            $tag = self::find()
                ->where(['name' => $name])
                ->andWhere(['tag_type' => $tagType])
                ->one();

            //if tag does not exists, insert it
            if (is_null($tag)) {
                $tag = new self();
                $tag->name = $name;
                $tag->tag_type = $tagType;
                $tag->frequency = self::DEFAULT_FREQUENCY;
                $tag->save(false);
            } else {
                //Update count of tags already exists
                $tag->updateCounters(['frequency' => self::DEFAULT_FREQUENCY]);
            }
        }
    }

    /**
     * Decrement frequency
     * if less then or equal to zero then delete row
     * @param $tags
     * @param $tagType
     */
    public static function removeTags($tags, $tagType)
    {
        if (empty($tags)) {
            return;
        }

        foreach ($tags as $name) {
            $tag = self::find()
                ->where(['name' => $name])
                ->andWhere(['tag_type' => $tagType])
                ->one();
            if (!is_null($tag)) {
                $tag->updateCounters(['frequency' => '-' . self::DEFAULT_FREQUENCY]);

                if ($tag->frequency <= 0) {
                    $tag->delete();
                }
            }
        }
    }

}
