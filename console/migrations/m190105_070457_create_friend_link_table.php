<?php

use yii\db\Migration;

/**
 * Handles the creation of table `friend_link`.
 */
class m190105_070457_create_friend_link_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%friend_link}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%friend_link}}');
    }
}
