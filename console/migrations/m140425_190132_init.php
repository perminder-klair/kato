<?php

use yii\db\Schema;

class m140425_190132_init extends \yii\db\Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $schema = $this->db->schema;

        $this->createTable('{{%demo}}', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'description' => Schema::TYPE_TEXT,
            'tags' => Schema::TYPE_TEXT,
            'create_time' => Schema::TYPE_TIMESTAMP . ' NULL DEFAULT 0',
            'update_time' => Schema::TYPE_TIMESTAMP . ' NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'active' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 1',
            'deleted' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
        ], $tableOptions);

        $this->createTable('{{%kato_auth_assignment}}', array(
            'item_name' => Schema::TYPE_STRING . '(64) NOT NULL REFERENCES ' . $schema->quoteTableName('{{%kato_auth_item}}') . ' (name) ON DELETE CASCADE ON UPDATE CASCADE',
            'user_id' => Schema::TYPE_STRING . '(64) NOT NULL REFERENCES ' . $schema->quoteTableName('{{%kato_user}}') . ' (id) ON DELETE CASCADE ON UPDATE CASCADE',
            'created_at' => Schema::TYPE_INTEGER,
            'PRIMARY KEY(item_name, user_id)',
        ));

        $this->createTable('{{%kato_auth_item}}', array(
            'name' => Schema::TYPE_STRING . '(64) NOT NULL',
            'type' => Schema::TYPE_INTEGER . ' NOT NULL',
            'description' => Schema::TYPE_TEXT,
            'rule_name' => Schema::TYPE_STRING . '(64)',
            'data' => Schema::TYPE_TEXT,
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
            'PRIMARY KEY(name)',
        ));

        $this->createTable('{{%kato_auth_item_child}}', array(
            'parent' => Schema::TYPE_STRING . '(64) NOT NULL REFERENCES ' . $schema->quoteTableName('{{%kato_auth_item}}') . ' (name) ON DELETE CASCADE ON UPDATE CASCADE',
            'child' => Schema::TYPE_STRING . '(64) NOT NULL REFERENCES ' . $schema->quoteTableName('{{%kato_auth_item}}') . ' (name) ON DELETE CASCADE ON UPDATE CASCADE',
            'PRIMARY KEY(parent, child)',
        ));

        $this->createTable('{{%kato_auth_rule}}', array(
            'name' => Schema::TYPE_STRING . '(64) not null',
            'data' => Schema::TYPE_TEXT,
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
            'PRIMARY KEY(name)',
        ));

        $this->createTable('{{%kato_block}}', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . '(70) NOT NULL',
            'content' => Schema::TYPE_TEXT,
            'parent' => Schema::TYPE_STRING,
            'block_type' => Schema::TYPE_STRING . '(50)',
            'parent_layout' => Schema::TYPE_STRING . '(50)',
            'comments' => Schema::TYPE_STRING . '(100)',
            'category' => Schema::TYPE_STRING . '(50)',
            'listing_order' => Schema::TYPE_INTEGER,
            'created_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_by' => Schema::TYPE_INTEGER,
            'create_time' => Schema::TYPE_TIMESTAMP . ' NULL DEFAULT 0',
            'update_time' => Schema::TYPE_TIMESTAMP . ' NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'deleted' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
        ], $tableOptions);

        $this->createTable('{{%kato_blog}}', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . '(70) NOT NULL',
            'slug' => Schema::TYPE_STRING . '(70)',
            'short_desc' => Schema::TYPE_STRING . '(255)',
            'content' => Schema::TYPE_TEXT,
            'content_html' => Schema::TYPE_TEXT,
            'created_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_by' => Schema::TYPE_INTEGER,
            'published_by' => Schema::TYPE_INTEGER,
            'create_time' => Schema::TYPE_TIMESTAMP . ' NULL DEFAULT 0',
            'update_time' => Schema::TYPE_TIMESTAMP . ' NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'publish_time' => Schema::TYPE_TIMESTAMP . ' NULL DEFAULT 0',
            'parent_id' => Schema::TYPE_STRING,
            'is_revision' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'tags' => Schema::TYPE_TEXT,
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'deleted' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
        ], $tableOptions);

        $this->createTable('{{%kato_content_media}}', [
            'id' => Schema::TYPE_PK,
            'content_id' => Schema::TYPE_INTEGER,
            'media_id' => Schema::TYPE_INTEGER,
            'content_type' => Schema::TYPE_STRING . '(50)',
        ], $tableOptions);

        $this->createTable('{{%kato_media}}', [
            'id' => Schema::TYPE_PK,
            'filename' => Schema::TYPE_STRING . '(255) DEFAULT NULL',
            'source' => Schema::TYPE_STRING . '(255) DEFAULT NULL',
            'source_location' => Schema::TYPE_STRING,
            'create_time' => Schema::TYPE_TIMESTAMP . ' NULL DEFAULT CURRENT_TIMESTAMP',
            'extension' => Schema::TYPE_STRING . '(50)',
            'mimeType' => Schema::TYPE_STRING . '(50)',
            'byteSize' => Schema::TYPE_INTEGER,
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 1',
            'media_type' => Schema::TYPE_STRING . '(50)',
        ], $tableOptions);

        $this->createTable('{{%kato_page}}', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'slug' => Schema::TYPE_STRING . '(70)',
            'short_desc' => Schema::TYPE_STRING,
            'content' => Schema::TYPE_TEXT,
            'content_html' => Schema::TYPE_TEXT,
            'layout' => Schema::TYPE_STRING . '(25) NOT NULL DEFAULT "default"',
            'parent_id' => Schema::TYPE_STRING,
            'type' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 1',
            'menu_title' => Schema::TYPE_STRING . '(70)',
            'menu_hidden' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 1',
            'created_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_by' => Schema::TYPE_INTEGER,
            'create_time' => Schema::TYPE_TIMESTAMP . ' NULL DEFAULT 0',
            'update_time' => Schema::TYPE_TIMESTAMP . ' NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'deleted' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
        ], $tableOptions);

        $this->createTable('{{%kato_setting}}', [
            'id' => Schema::TYPE_PK,
            'define' => Schema::TYPE_STRING . '(50) NOT NULL',
            'value' => Schema::TYPE_STRING . '(255)',
        ], $tableOptions);

        $this->createTable('{{%kato_tag}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . '(255) NOT NULL',
            'frequency' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'tag_type' => Schema::TYPE_STRING . '(50)',
        ], $tableOptions);

        $this->createTable('{{%kato_user}}', array(
            'id' => Schema::TYPE_PK,
            'username' => Schema::TYPE_STRING . ' NOT NULL',
            'auth_key' => Schema::TYPE_STRING . '(32) NOT NULL',
            'password_hash' => Schema::TYPE_STRING . ' NOT NULL',
            'password_reset_token' => Schema::TYPE_STRING . '(32)',
            'email' => Schema::TYPE_STRING . ' NOT NULL',
            'role' => Schema::TYPE_STRING . '(10)',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
            'create_time' => Schema::TYPE_TIMESTAMP . ' NULL DEFAULT 0',
            'update_time' => Schema::TYPE_TIMESTAMP . ' NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'login_time' => Schema::TYPE_TIMESTAMP,
            'login_ip' => Schema::TYPE_STRING . '(20)',
        ));

        $this->createTable('{{%kato_user_profile}}', array(
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . ' NOT NULL REFERENCES ' . $schema->quoteTableName('{{%kato_user}}') . ' (id) ON DELETE CASCADE ON UPDATE CASCADE',
            'create_time' => Schema::TYPE_TIMESTAMP . ' NULL DEFAULT 0',
            'update_time' => Schema::TYPE_TIMESTAMP . ' NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'full_name' => Schema::TYPE_STRING,
            'location' => Schema::TYPE_STRING,
            'website' => Schema::TYPE_STRING,
            'bio' => Schema::TYPE_STRING,
        ));
    }

    public function down()
    {
        $this->dropTable('{{%demo}}');
        $this->dropTable('{{%kato_auth_assignment}}');
        $this->dropTable('{{%kato_auth_item}}');
        $this->dropTable('{{%kato_auth_item_child}}');
        $this->dropTable('{{%kato_auth_rule}}');
        $this->dropTable('{{%kato_block}}');
        $this->dropTable('{{%kato_blog}}');
        $this->dropTable('{{%kato_content_media}}');
        $this->dropTable('{{%kato_page}}');
        $this->dropTable('{{%kato_setting}}');
        $this->dropTable('{{%kato_tag}}');
        $this->dropTable('{{%kato_user}}');
        $this->dropTable('{{%kato_user_profile}}');
    }
}
