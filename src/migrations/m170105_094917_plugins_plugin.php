<?php
namespace lo\plugins\migrations;

use lo\plugins\models\Plugin;

class m170105_094917_plugins_plugin extends Migration
{
    public function up()
    {
        $this->createTable($this->tn(self::TBL_PLUGIN), [
            'id' => $this->primaryKey(),
            'status' => $this->tinyInteger(1)->notNull()->defaultValue(0),
            'name' => $this->string(),
            'url' => $this->string(),
            'version' => $this->string(),
            'author' => $this->string(),
            'author_url' => $this->string(),
            'text' => $this->text(),
            'hash' => $this->string(32),
        ]);

        $this->createIndex('idx_plugins_item_status', $this->tn(self::TBL_PLUGIN), 'status');

        $this->insert($this->tn(self::TBL_PLUGIN), [
            'id' => Plugin::CORE_EVENT,
            'status' => Plugin::STATUS_ACTIVE,
            'name' => 'Core Events',
            'url' => '',
            'version' => '1.0',
            'author' => 'Lukyanov Andrey',
            'author_url' => 'https://github.com/loveorigami',
            'text' => 'Core events in our system',
            'hash' => '',
        ]);

        $this->insert($this->tn(self::TBL_PLUGIN), [
            'id' => Plugin::CORE_EVENT + 1,
            'status' => Plugin::STATUS_ACTIVE,
            'name' => 'Hello World plugin',
            'url' => 'https://github.com/loveorigami/yii2-plugins-system/tree/master/src/core/code',
            'version' => '1.6',
            'author' => 'Lukyanov Andrey',
            'author_url' => 'https://github.com/loveorigami',
            'text' => 'A simple hello world plugin',
            'hash' => md5('lo\plugins\core\helloworld\HelloWorld'),
        ]);
    }

    public function down()
    {
        $this->dropTable($this->tn(self::TBL_PLUGIN));
    }

}