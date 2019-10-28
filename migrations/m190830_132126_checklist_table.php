<?php

use yii\db\Migration;

/**
 * Class m190830_132126_checklist_table
 */
class m190830_132126_checklist_table extends Migration
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
        echo "m190830_132126_checklist_table cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable("check_list",
            [
                "id" => $this->primaryKey(),
                "user_id" => $this->integer(),
                "name" => $this->string()->defaultValue("My tasks"),
                "done" => $this->boolean()->defaultValue("0"),
                "created_at" => $this->timestamp()
            ]);

        $this->createIndex(
            "idx-checklist-user",
            "check_list",
            "user_id");
        $this->addForeignKey(
            "fk-checklist-user",
            "check_list",
            "user_id",
            "user",
            "id",
            "CASCADE"
        );


    }

    public function down()
    {
        $this->dropTable("check_list");
        $this->dropForeignKey("fk-checklist-user",
            "check_list");
        $this->dropIndex("idx-checklist-user",
            "check_list");
    }

}
