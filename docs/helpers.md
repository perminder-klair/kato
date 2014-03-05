#Helpers

Link to site base
    \Yii::$app->urlManager->baseUrl;

Link to theme base
    \Yii::$app->view->theme->baseUrl;

Return site settings

    kato\helpers\KatoHtml::setting('site_name')