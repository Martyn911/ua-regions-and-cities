<?php

use yii\db\Migration;

/**
 * Class m180413_063204_region
 */
class m180413_063204_region extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%region}}', [
            'id' => $this->primaryKey(),
            'name_ru' => $this->string(100)->notNull(),
            'name_uk' => $this->string(100)->notNull(),
            'url' => $this->string(50),
            'status' => $this->integer()->defaultValue(1),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ], $tableOptions);

        $this->createIndex('idx_region_url', '{{%region}}', 'url', true);
        $this->createIndex('idx_region_status', '{{%region}}', 'status');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%region}}');
    }
}
