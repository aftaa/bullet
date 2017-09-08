<?php

use yii\db\Migration;

/**
 * Handles the creation of table `invoice`.
 */
class m170908_015252_create_invoice_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('invoice', [
            'id' => $this->primaryKey(),
            'customer_name' => $this->string()->notNull(),
            'address' => $this->text()->notNull(),
            'INN' => $this->string()->notNull(),
            'KPP' => $this->string()->notNull(),
            'account' => $this->string()->notNull(),
            'BIK' => $this->string()->notNull(),
            'bank' => $this->text()->notNull(),
            'sum' => $this->decimal(10, 2)->notNull(),
            'created_at' => $this->timestamp()->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('invoice');
    }
}
