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
        $this->createTable( 'user_conf', [
            'id'          => $this->primaryKey(),
            'user_id'     => $this->string( 85 )->unique(),
            'get_praise'  => $this->string( 55 )->defaultValue( 'On' ),
            'get_comment' => $this->string( 55 )->defaultValue( 'On' ),
            'is_access' => $this->string(55)->defaultValue('On'),
            'is_show_phone' => $this->string(55)->defaultValue('On'),
            'is_show_sex' => $this->string(55)->defaultValue('On'),
            'is_show_address' => $this->string(55)->defaultValue('On'),
            'created_at'  => $this->integer()->notNull(),
            'updated_at'  => $this->integer()->notNull(),
            'PRIMARY KEY(id, user_id)',
        ] );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable( 'user_conf' );
    }
}
