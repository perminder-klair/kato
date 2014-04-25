<?php

use yii\db\Schema;
use common\models\User;

class m140425_204944_init_insert extends \yii\db\Migration
{
    public function up()
    {
        //create user roles
        User::createRole('admin');
        User::createRole('user');

        $lorem = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis diam leo, vulputate porttitor sodales consequat, consequat a dui.';

        $this->insert('{{%kato_page}}', [
            'title' => 'About Us',
            'slug' => 'about-us',
            'short_desc' => $lorem,
            'content' => $lorem,
            'content_html' => '<p>' . $lorem . '</p>',
            'created_by' => 1,
            'status' => 1
        ]);

        $this->batchInsert('{{%kato_setting}}', ['define', 'value'], [
            ['site_name', 'Kato'],
            ['home_meta_description', ''],
            ['home_meta_keywords', ''],
            ['admin_email', ''],
            ['twitter', ''],
            ['facebook', ''],
            ['telephone', ''],
            ['mobile', ''],
            ['address', ''],
        ]);
    }

    public function down()
    {
        $this->truncateTable('{{%kato_page}}');
        $this->truncateTable('{{%kato_setting}}');
    }
}
