<?php

namespace backend\models\query;

use backend\models\Page;
use yii\db\ActiveQuery;

class PageQuery extends ActiveQuery
{
    public function live()
    {
        $this->andWhere([
            'status' => Page::STATUS_PUBLISHED,
            'revision_to' => 0,
            'deleted' => 0,
        ]);

        return $this;
    }
}