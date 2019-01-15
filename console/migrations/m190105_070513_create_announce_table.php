<?php

use yii\db\Migration;

/**
 * Handles the creation of table `announce`.
 */
class m190105_070513_create_announce_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable( '{{%announce}}', [
            'id'         => $this->primaryKey(),
            'user_id'    => $this->string( 85 ),
            'title'      => $this->string( 125 )->unique(),
            'content'    => $this->text(),
            'is_using'   => $this->string( 25 )->defaultValue( 'Off' ),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ] );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable( '{{%announce}}' );
    }
}
