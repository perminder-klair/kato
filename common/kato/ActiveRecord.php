<?php

namespace common\kato;

//use yii\behaviors\AutoTimestamp;

class ActiveRecord extends \yii\db\ActiveRecord
{
    /**
     * Actions to be taken before saving the record.
     * @param bool $insert
     * @return bool whether the record can be saved
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            $now = date('Y-m-d H:i:s', time());
            $user_id = \Yii::$app->user->id;

            if ($this->isNewRecord) {

                // We are creating a new record.
                if ($this->hasAttribute('create_time'))
                    $this->create_time = $now;

                if ($this->hasAttribute('update_time'))
                    $this->update_time = $now;

                if ($this->hasAttribute('publish_time'))
                    $this->publish_time = $now;

                if ($this->hasAttribute('created_by'))
                    $this->created_by = $user_id;

                if ($this->hasAttribute('title'))
                    $this->title = $this->newPostTitle;

            } else {
                // We are updating an existing record.
                if ($this->hasAttribute('update_time'))
                    $this->update_time = $now;

                if ($this->hasAttribute('updated_by'))
                    $this->updated_by = $user_id;
            }
            return true;
        }
        return false;
    }

    /**
     * Return basic select options for the record.
     * @return array the options.
     */
    public static function getSelectOptions()
    {
        //return CHtml::listData(static::model()->findAll(), 'id', 'title'); TODO fix it
    }

    /**
     * Return last row inserted
     * @return mixed
     */
    public function getLastRow()
    {
        return static::find()
            ->orderBy('id DESC')
            ->one();
    }

    /**
     * Returns New Post's Title
     * @return string
     */
    protected function getNewPostTitle()
    {
        $id = $this->getLastRow()->id + 1;
        return 'New ' . $id;
    }
}
