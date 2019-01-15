<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_conf`.
 */
class m190115_084715_create_user_conf_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user_conf', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user_conf');
    }
}
