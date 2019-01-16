<?php

use yii\db\Migration;

/**
 * Handles the creation of table `menu`.
 */
class m190116_030546_create_menu_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable( 'menu', [
            'id'          => $this->primaryKey(),
            'm_key'       => $this->string( 85 )->unique(),
            'sort_id'     => $this->integer()->defaultValue( 1 ),
            'menu_model'  => $this->string( 85 )->unique()->comment( '菜单模型的关键KEY' ),
            'url_data'    => $this->string( 255 )->comment( '菜单数据' ),
            'r_key'       => $this->string( 85 )->comment( '角色关键KEY' ),
            'description' => $this->text()->unique(),
            'parent_id'   => $this->string( 85 ),
            'name'        => $this->string( 85 )->unique(),
            'is_url'      => $this->string( 55 )->defaultValue( 'On' ),
            'is_using'    => $this->string( 55 )->defaultValue( 'On' ),
            'created_at'  => $this->integer()->notNull(),
            'updated_at'  => $this->integer()->notNull(),
            'PRIMARY KEY(id, security_key)',
        ] );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable( 'menu' );
    }
}
