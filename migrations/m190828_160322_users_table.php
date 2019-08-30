<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Class m190828_160322_users_table
 */
class m190828_160322_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190828_160322_users_table cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable("user",
            [
                "id" => $this->primaryKey(),
                "username" => $this->string()->notNull()->unique(),
                "email" => $this->string()->notNull()->unique(),
                "password" => $this->string()->notNull(),
                "auth_key" => $this->string(),
                "banned" => $this->boolean()->defaultValue("0"),
                "max_check_list_count" => $this->integer()->defaultValue("15"),
                "max_check_list_item_count" => $this->integer()->defaultValue("10"),
                "created_at" => $this->timestamp()
            ]);
    }

    public function down()
    {
        $this->dropTable("user");

    }

}
