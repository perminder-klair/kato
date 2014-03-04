<?php

namespace common\kato\behaviors;

use yii\base\Behavior;
use yii\base\Event;
use yii\db\ActiveRecord;

/**
 * SoftDelete

 * Usage:
 *
 * ~~~
 * public function behaviors() {
 *     return [
 *         'softDelete' => ['class' => 'common\kato\behaviors\SoftDelete',
 *             'attribute' => 'deleted',
 *             'safeMode' => true,
 *         ],
 *     ];
 * }
 * ~~~
 * Call functions
 * soft-delete model
 * $model->remove();
 *
 * restore model
 * $model->restore();
 *
 * delete model from db
 * $model->forceDelete();
 *
 * soft-delete model if $safeMode = true
 * delete model from db if $safeMode = false
 * $model->delete();
 */
class SoftDelete extends Behavior {

    const IS_DELETED = 1;
    const NOT_DELETED = 0;

    /**
     * @var string SoftDelete attribute
     */
    public $attribute = "deleted";

    /**
     * @var bool If true, this behavior will process '$model->delete()' as a soft-delete. Thus, the
     *           only way to truely delete a record is to call '$model->forceDelete()'
     */
    public $safeMode = true;

    /**
     * @inheritdoc
     */
    public function events() {
        return [ActiveRecord::EVENT_BEFORE_DELETE => 'doDelete'];
    }

    /**
     * Set the attribute with the current timestamp to mark as deleted
     *
     * @param Event $event
     */
    public function doDelete($event) {

        // do nothing if safeMode is disabled. this will result in a normal deletion
        if (!$this->safeMode) {
            return;
        }

        // remove and mark as invalid to prevent real deletion
        $this->remove();
        $event->isValid = false;
    }

    /**
     * Remove (aka soft-delete) record
     */
    public function remove() {

        // evaluate timestamp and set attribute
        //$timestamp = $this->evaluateTimestamp();
        $attribute = $this->attribute;
        $this->owner->$attribute = self::IS_DELETED;

        // save record
        $this->owner->save(false, [$attribute]);
    }

    /**
     * Restore soft-deleted record
     */
    public function restore() {

        // mark attribute as null
        $attribute = $this->attribute;
        $this->owner->$attribute = self::NOT_DELETED;

        // save record
        $this->owner->save(false, [$attribute]);
    }

    /**
     * Delete record from database regardless of the $safeMode attribute
     */
    public function forceDelete() {

        // store model so that we can detach the behavior and delete as normal
        $model = $this->owner;
        $this->detach();
        $model->delete();
    }
}