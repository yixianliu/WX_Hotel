<?php

use yii\db\Migration;

/**
 * Handles the creation of table `language`.
 */
class m190105_024313_create_language_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('language', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('language');
    }
}
