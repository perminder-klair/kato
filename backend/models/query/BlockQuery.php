<?php

namespace backend\models\query;

use backend\models\Block;
use yii\db\ActiveQuery;

class BlockQuery extends ActiveQuery
{
    public function live()
    {
        $this->andWhere([
            'status' => Block::STATUS_PUBLISHED,
            'revision_to' => 0,
            'deleted' => 0,
        ]);

        return $this;
    }
}