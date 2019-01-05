<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Handles the creation of table `conf`.
 */
class m190105_022448_create_conf_table extends Migration
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

        $this->createTable( '{{%conf}}', [
            'id'          => $this->primaryKey(),
            'lang_key'    => $this->string( 85 )->notNull()->unique(),
            'name'        => $this->string( 85 )->notNull(),
            'title'       => $this->string( 85 )->notNull(),
            'email'       => $this->string( 85 )->notNull(),
            'phone'       => $this->string( 85 )->notNull(),
            'keywords'    => $this->string( 125 ),
            'site_url'    => $this->string( 85 ),
            'developers'  => $this->string( 155 ),
            'icp'         => $this->string( 85 ),
            'description' => $this->string( 125 ),
            'created_at'  => $this->integer()->notNull(),
            'updated_at'  => $this->integer()->notNull(),
            'PRIMARY KEY(id, lang_key)',
        ], $tableOptions );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable( '{{%conf}}' );
    }
}
