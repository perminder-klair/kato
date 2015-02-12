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

    public function fromParent($layout)
    {
        $this->andWhere([
            'parent_layout' => $layout,
        ]);
        //dump($this);exit;
        return $this;
    }
}