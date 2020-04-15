<?php

/**
 * Handles the creation of table `{{%product}}`.
 */
class m200402_111957_create_product_table extends \console\migrations\models\Migration
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
            'description' => $this->text(),
            'status' => $this->tinyInteger()->notNull()->defaultValue(1),
            'ref_count' => $this->integer()->notNull()->defaultValue(0),
            'images' => $this->getDb()->getSchema()->createColumnSchemaBuilder('text[]')->defaultValue('{}'),
            'picker' => $this->getDb()->getSchema()->createColumnSchemaBuilder('integer[]')->defaultValue('{}'),
            'sizes' => $this->getDb()->getSchema()->createColumnSchemaBuilder('text[]')->defaultValue('{}'),
            'brand_id' => $this->integer()->null(),
            'category_ids' => $this->getDb()->getSchema()->createColumnSchemaBuilder('integer[]')->defaultValue('{}'),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('NOW()'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('NOW()'),
        ]);

        $this->createIndex('', 'product', ['domain', 'code'], true);
        $this->createIndex('', 'product', ['status']);
        $this->createIndex('', 'product', ['name']);
        $this->createIndex('', 'product', ['ref_count']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product}}');
    }
}
