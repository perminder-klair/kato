#Helpers

Link to site base

    \Yii::$app->urlManager->baseUrl;

Link to theme base

    \Yii::$app->view->theme->baseUrl;

Return site settings

    \Yii::$app->kato->setting('site_name')

Upload $_FILES file into system, returns back Json array of media data

    echo \Yii::$app->kato->mediaUpload();