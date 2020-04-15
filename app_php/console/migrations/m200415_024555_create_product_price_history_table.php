<?php

/**
 * Handles the creation of table `{{%product_price_history}}`.
 */
class m200415_024555_create_product_price_history_table extends \console\migrations\models\Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_price_history}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'value' => $this->integer(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('NOW()'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('NOW()'),
        ]);

        $this->createIndex('', 'product_price_history', 'product_id');
        $this->addForeignKey('', 'product_price_history', 'product_id', 'product', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product_price_history}}');
    }
}
