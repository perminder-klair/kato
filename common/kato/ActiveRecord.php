<?php

namespace common\kato;

use yii\behaviors\AutoTimestamp;

class ActiveRecord extends \yii\db\ActiveRecord
{
    const IS_DELETED = 1;
    const NOT_DELETED = 0;

    /**
     * Actions to be taken before saving the record.
     * @param bool $insert
     * @return bool whether the record can be saved
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            $now = date('Y-m-d H:i:s', time());

            if ($this->isNewRecord) {

                // We are creating a new record.
                if ($this->hasAttribute('create_time'))
                    $this->create_time = $now;

                if ($this->hasAttribute('update_time'))
                    $this->update_time = $now;

                if ($this->hasAttribute('deleted'))
                    $this->deleted = self::NOT_DELETED;

                if ($this->hasAttribute('publish_time'))
                    $this->publish_time = $now;

            } else {
                // We are updating an existing record.
                if ($this->hasAttribute('update_time'))
                    $this->update_time = $now;
            }
            return true;
        }
        return false;
    }

    /**
     * Deletes the row corresponding to this active record.
     * @return bool|int whether the deletion is successful.
     */
    public function delete()
    {
        if ($this->hasAttribute('deleted')) {
            $this->deleted = self::IS_DELETED;
            $this->save();
            return true; // prevents hard deletion
        }

        return parent::delete();
    }

    /**
     * Hard deletes the record.
     * @return boolean whether the deletion is successful.
     */
    public function hardDelete()
    {
        return parent::delete();
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
}
