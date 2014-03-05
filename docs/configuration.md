# Configuration

For local environment change database config in:

    common/config/params-local.php

For live environment change database config in:

    common/config/params.php

Structure for database connection

    'components.db' => [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;dbname=kato2',
        'username' => 'root',
        'password' => 'root',
        'charset' => 'utf8',
    ],