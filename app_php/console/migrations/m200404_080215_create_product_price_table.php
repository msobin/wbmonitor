<?php

/**
 * Handles the creation of table `{{%product_price}}`.
 */
class m200404_080215_create_product_price_table extends \console\migrations\models\Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_price}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'value' => $this->integer(),
            'value_prev' => $this->integer(),
            'status' => $this->tinyInteger()->notNull()->defaultValue(1),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('NOW()'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('NOW()'),
        ]);

        $this->createIndex('', 'product_price', 'product_id', true);
        $this->addForeignKey('', 'product_price', 'product_id', 'product', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product_price}}');
    }
}
