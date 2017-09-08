<?php

use yii\db\Migration;
use app\modules\invoice\models\Seller;

class m170908_021608_fill_seller_table extends Migration
{
    public function up()
    {
        $seller = new Seller;
        $seller->name = 'Индивидуальный предприниматель Иванов Сергей Петрович';
        $seller->address = 'Санкт-Петербург, ул. Садовая, д. 2, корп. 2, оф. 22';
        $seller->INN = '1234567890';
        $seller->account = '112223344556677889900';
        $seller->corr_account = '33445566778899001122';
        $seller->BIK = '123456789';
        $seller->bank = 'ОАО БАНК "МОЙ БАНК" Г. САНКТ-ПЕТЕРБУРГ';
        $seller->save();
    }

    public function down()
    {
        Yii::$app->db->createCommand()->truncateTable('seller');
    }
}
