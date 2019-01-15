<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m190115_084647_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable( 'user', [
            'id'       => $this->primaryKey(),
            'user_id'  => $this->string( 85 )->notNull(),
            'username' => $this->string( 85 )->notNull(),
            'password' => $this->string( 125 )->notNull(),
            'r_key'    => $this->string( 85 ),
            'l_key'    => $this->string( 85 ),
            'credit'   => $this->float(),
            'nickname' => $this->string(85),
            'signature'=> $this->string(255),
        ] );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable( 'user' );
    }
}
