<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article`.
 */
class m190116_070939_create_article_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable( 'article', [
            'id'           => $this->primaryKey(),
            'article_id'   => $this->string( 85 )->unique(),
            'user_id'      => $this->string( 85 )->notNull(),
            'c_key'        => $this->string( 85 )->unique()->notNull(),
            'title'        => $this->string( 125 )->unique()->notNull(),
            'content'      => $this->text(),
            'introduction' => $this->string( 255 )->unique(),
            'keywords'     => $this->string( 125 ),
            'thumb'        => $this->string( 125 ),
            'images'       => $this->string( 255 ),
            'praise'       => $this->integer(),
            'forward'      => $this->integer(),
            'collection'   => $this->integer(),
            'share'        => $this->integer(),
            'attention'    => $this->integer(),
            'is_promote'   => $this->string( 55 )->defaultValue( 'On' ),
            'is_hot'       => $this->string( 55 )->defaultValue( 'On' ),
            'is_classic'   => $this->string( 55 )->defaultValue( 'On' ),
            'is_winnow'    => $this->string( 55 )->defaultValue( 'On' ),
            'is_recommend' => $this->string( 55 )->defaultValue( 'On' ),
            'is_comments'  => $this->string( 55 )->defaultValue( 'On' ),
            'is_using'     => $this->string( 55 )->defaultValue( 'On' ),
            'created_at'   => $this->integer()->notNull(),
            'updated_at'   => $this->integer()->notNull(),
            'PRIMARY KEY(id, c_key, article_id)',
        ] );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable( 'article' );
    }
}
