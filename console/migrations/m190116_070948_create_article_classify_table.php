<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article_classify`.
 */
class m190116_070948_create_article_classify_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable( 'article_classify', [
            'id'          => $this->primaryKey(),
            'c_key'       => $this->string( 85 )->unique()->notNull(),
            'sort_id'     => $this->integer(),
            'name'        => $this->string( 85 )->unique()->notNull(),
            'description' => $this->text(),
            'keywords'    => $this->string( 125 )->unique(),
            'parent_id'   => $this->string( 85 ),
            'is_using'    => $this->string( 55 )->defaultValue( 'On' ),
            'created_at'  => $this->integer()->notNull(),
            'updated_at'  => $this->integer()->notNull(),
            'PRIMARY KEY(id, c_key)',
        ] );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable( 'article_classify' );
    }
}
