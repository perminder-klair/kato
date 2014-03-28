# Configuration

For local environment change database config in:

    environments/dev/

For live environment change database config in:

    environments/live/

Structure for database connection

    'components.db' => [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;dbname=kato',
        'username' => 'root',
        'password' => 'root',
        'charset' => 'utf8',
    ],