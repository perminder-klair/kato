#Pages

To get page link

    \kato\helpers\KatoHtml::page('page-slug');

To get a block of static page

    echo \Yii::$app->kato->getBlock('block-name', 'page-slug, 'page-layout');
    
To get a block of dynamic (cms driven) page

    echo \Yii::$app->kato->getBlock('block-name', 'page-slug');

To get all blocks of a system (non static) page

    $this->getPageBlocks()