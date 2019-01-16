<?php

use yii\db\Migration;

/**
 * Handles the creation of table `menu_model`.
 */
class m190116_032631_create_menu_model_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable( 'menu_model', [
            'id'          => $this->primaryKey(),
            'model_key'   => $this->string( 85 )->unique(),
            'sort_id'     => $this->integer(),
            'menu_type'   => $this->string( 85 )->defaultValue( 'model' )->comment( 'Url 类型' ),
            'menu_key'    => $this->string( 85 )->unique(),
            'name'        => $this->string( 85 )->unique(),
            'is_using'    => $this->string( 55 )->defaultValue( 'On' ),
            'is_classify' => $this->string( 55 )->defaultValue( 'On' )->comment( '是否启用,启用后分类后,就自动选择指定模型进行分类' ),
            'created_at'  => $this->integer()->notNull(),
            'updated_at'  => $this->integer()->notNull(),
            'PRIMARY KEY(id, m_key, menu_key)',
        ] );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable( 'menu_model' );
    }
}
