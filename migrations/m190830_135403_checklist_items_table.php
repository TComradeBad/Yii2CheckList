<?php

use yii\db\Migration;

/**
 * Class m190830_135403_checklist_items_table
 */
class m190830_135403_checklist_items_table extends Migration
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
        echo "m190830_135403_checklist_items_table cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable("check_list_item",
            [
                "id" => $this->primaryKey(),
                "check_list_id" => $this->integer(),
                "name" => $this->string()->defaultValue("task"),
                "done" => $this->boolean()->defaultValue("0"),
                "created_at" => $this->timestamp()
            ]);

        $this->createIndex(
            "idx-item-checklist",
            "check_list_item",
            "check_list_id"
        );

        $this->addForeignKey(
            "fk-item-checklist",
            "check_list_item",
            "check_list_id",
            "check_list",
            "id"
        );

    }

    public function down()
    {
        $this->dropTable("check_lists_item");
        $this->dropForeignKey("fk-item-checklist",
            "check_list_item");
        $this->dropIndex("idx-item-checklist",
            "check_list_item");
    }

}
