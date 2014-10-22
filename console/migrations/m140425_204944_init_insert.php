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

        $this->insert('{{%kato_page}}', [
            'id' => 1,
            'title' => 'Home',
            'slug' => 'index',
            'parent_id' => 0,
            'type' => 1,
            'short_desc' => $lorem,
            'menu_title' => 'Home',
            'menu_hidden' => 0,
            'created_by' => 1,
            'status' => 1
        ]);

        $this->insert('{{%kato_page}}', [
            'id' => 2,
            'title' => 'About Us',
            'slug' => 'about-us',
            'short_desc' => $lorem,
            'menu_title' => 'About',
            'menu_hidden' => 0,
            'parent_id' => 0,
            'type' => 0,
            'created_by' => 1,
            'status' => 1
        ]);

        $this->insert('{{%kato_page}}', [
            'id' => 3,
            'title' => 'Contact',
            'slug' => 'contact',
            'parent_id' => 0,
            'type' => 1,
            'short_desc' => $lorem,
            'menu_title' => 'Contact',
            'menu_hidden' => 0,
            'created_by' => 1,
            'status' => 1
        ]);

        $this->insert('{{%kato_block}}', [
            'title' => 'details',
            'content' => '<p>' . $lorem . '</p>',
            'parent' => 1,
            'block_type' => 'text-area',
            'category' => 'general',
            'created_by' => 1,
            'updated_by' => 1,
            'status' => 1
        ]);

        $this->insert('{{%kato_block}}', [
            'title' => 'details',
            'content' => '<p>' . $lorem . '</p>',
            'parent' => 2,
            'parent_layout' => 'basic',
            'block_type' => 'text-area',
            'category' => 'general',
            'created_by' => 1,
            'updated_by' => 1,
            'status' => 1
        ]);

        $this->insert('{{%kato_block}}', [
            'title' => 'contact-intro',
            'content' => '<p>' . $lorem . '</p>',
            'parent' => 3,
            'block_type' => 'text-area',
            'category' => 'general',
            'created_by' => 1,
            'updated_by' => 1,
            'status' => 1
        ]);
    }

    public function down()
    {
        $this->truncateTable('{{%kato_page}}');
        $this->truncateTable('{{%kato_block}}');
        $this->truncateTable('{{%kato_setting}}');
    }
}
