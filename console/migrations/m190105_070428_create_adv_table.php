<?php

use yii\db\Migration;

/**
 * Handles the creation of table `adv`.
 */
class m190105_070428_create_adv_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%adv}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%adv}}');
    }
}
