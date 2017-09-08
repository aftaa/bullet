<?php

use yii\db\Migration;

class m170908_105831_add_corr_account_to_invoice_table extends Migration
{
    private $table = 'invoice';
    private $column = 'corr_account';
    
    public function up()
    {
        $this->addColumn($this->table, $this->column, $this->string());
    }

    public function down()
    {
        $this->dropColumn($this->table, $this->column);
    }
}
