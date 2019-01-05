<?php

use yii\db\Migration;

/**
 * Handles the creation of table `assist`.
 */
class m190105_022530_create_assist_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable( '{{%assist}}', [
            'id'          => $this->primaryKey(),
            'a_key'       => $this->string( 85 )->unique(),
            'name'        => $this->string( 85 )->unique(),
            'content'     => $this->string( 255 ),
            'description' => $this->string( 255 ),
            'is_using'    => $this->string( 25 )->defaultValue( 'Off' )->comment( '是否启用' ),
            'created_at'  => $this->integer()->notNull(),
            'updated_at'  => $this->integer()->notNull(),
        ], $tableOptions );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable( '{{%assist}}' );
    }
}
