<?php

use yii\db\Migration;

/**
 * Class m180413_063212_city
 */
class m180413_063212_city extends Migration
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

        $this->createTable('{{%city}}', [
            'id' => $this->primaryKey(),
            'region_id' => $this->integer()->notNull(),
            'name_ru' => $this->string(100)->notNull(),
            'name_uk' => $this->string(100)->notNull(),
            'name_long_ru' => $this->string(255),
            'name_long_uk' => $this->string(255),
            'url' => $this->string(50),
            'status' => $this->integer()->defaultValue(1),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ], $tableOptions);

        $this->createIndex('idx_city_region_id', '{{%city}}', 'region_id');
        $this->createIndex('idx_city_url', '{{%city}}', 'url', true);
        $this->createIndex('idx_city_status', '{{%city}}', 'status');

        $this->addForeignKey('fk_city_region', '{{%city}}', 'region_id', '{{%region}}', 'id', 'cascade', 'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_city_region', '{{%city}}');
        $this->dropTable('{{%city}}');
    }
}
