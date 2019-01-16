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
        $this->createTable( 'user_level', [
            'id'         => $this->primaryKey(),
            'l_key'      => $this->string( 55 )->unique(),
            'name'       => $this->string( 85 )->unique(),
            'is_using'   => $this->string( 55 )->defaultValue( 'On' ),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'PRIMARY KEY(id, l_key)',
        ] );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable( 'user_level' );
    }
}
