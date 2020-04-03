<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m200402_111957_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     * @throws \yii\base\NotSupportedException
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'domain' => $this->string(255)->notNull(),
            'code' => $this->integer()->notNull(),
            'name' => $this->string(255),
            'status' => $this->tinyInteger()->defaultValue(1),
            'ref_count' => $this->integer()->defaultValue(0),
            'images' => $this->getDb()->getSchema()->createColumnSchemaBuilder('text[]')->defaultValue('{}'),
            'picker' => $this->getDb()->getSchema()->createColumnSchemaBuilder('integer[]')->defaultValue('{}'),
            'sizes' => $this->getDb()->getSchema()->createColumnSchemaBuilder('text[]')->defaultValue('{}'),
            'categories_ids' => $this->getDb()->getSchema()->createColumnSchemaBuilder('text[]')->defaultValue('{}'),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->notNull(),
        ]);

        $this->createIndex('product_domain_code_unq', 'product', ['domain', 'code'], true);
        $this->createIndex('product_status_idx', 'product', ['status']);
        $this->createIndex('product_name_idx', 'product', ['name']);
        $this->createIndex('product_ref_count_idx', 'product', ['ref_count']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product}}');
    }
}
