/*
Title: Managing Pages
*/

#Pages

To get page link

    \kato\helpers\KatoHtml::page('page-slug');

To get a block (non static) page

    \Yii::$app->kato->block('block_slug');

To get all blocks of a system (non static) page

    $this->getPageBlocks()