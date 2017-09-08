<?php

use yii\db\Migration;

/**
 * Handles the creation of table `seller`.
 */
class m170908_015639_create_seller_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('seller', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'address' => $this->text(),
            'INN' => $this->string(),
            'account' => $this->string(),
            'corr_account' => $this->string(),
            'BIK' => $this->string(),
            'bank' => $this->text(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('seller');
    }
}
