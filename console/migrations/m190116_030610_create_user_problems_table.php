<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_problems`.
 */
class m190116_030610_create_user_problems_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable( 'user_problems', [
            'id'           => $this->primaryKey(),
            'security_key' => $this->string( 85 )->unique(),
            'name'         => $this->string( 85 )->unique(),
            'is_using'     => $this->string( 55 )->defaultValue( 'On' ),
            'created_at'   => $this->integer()->notNull(),
            'updated_at'   => $this->integer()->notNull(),
            'PRIMARY KEY(id, security_key)',
        ] );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable( 'user_problems' );
    }
}
