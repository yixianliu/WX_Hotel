<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_level`.
 */
class m190115_084724_create_user_level_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user_level', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user_level');
    }
}
