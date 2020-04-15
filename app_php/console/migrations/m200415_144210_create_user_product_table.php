<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_product}}`.
 */
class m200415_144210_create_user_product_table extends \console\migrations\models\Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_product}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('NOW()'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('NOW()'),
        ]);

        $this->addForeignKey('', 'user_product', 'product_id', 'product', 'id');
        $this->addForeignKey('', 'user_product', 'user_id', 'user', 'id');

        $this->createIndex('', 'user_product', 'user_id');
        $this->createIndex('', 'user_product', 'product_id');
        $this->createIndex('', 'user_product', ['user_id', 'product_id'], true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_product}}');
    }
}
