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
            'id'              => $this->primaryKey(),
            'user_id'         => $this->string( 85 )->notNull(),
            'username'        => $this->string( 85 )->notNull(),
            'password'        => $this->string( 125 )->notNull(),
            'r_key'           => $this->string( 85 )->notNull(),
            'l_key'           => $this->string( 85 )->notNull(),
            'credit'          => $this->float()->defaultValue( 0.1 ),
            'nickname'        => $this->string( 85 ),
            'signature'       => $this->string( 255 ),
            'address'         => $this->string( 125 ),
            'tel_phone'       => $this->string( 55 ),
            'birthday'        => $this->integer(),
            'answer'          => $this->string( 85 ),
            'problems_key'    => $this->string( 85 )->comment( '问题相关KEY' ),
            'reg_time'        => $this->integer(),
            'last_login_time' => $this->integer(),
            'login_ip'        => $this->string(),
            'sex'             => $this->string( 55 )->defaultValue( 'Male' ),
            'is_display'      => $this->string( 55 )->defaultValue( 'On' ),
            'is_head'         => $this->string( 55 )->defaultValue( 'On' ),
            'is_using'        => $this->string( 55 )->defaultValue( 'On' ),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable( 'user' );
    }
}
