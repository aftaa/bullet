<?php

namespace app\modules\invoice\models;

use Yii;

/**
 * This is the model class for table "invoice".
 *
 * @property integer $id
 * @property string $customer_name
 * @property string $address
 * @property string $INN
 * @property string $KPP
 * @property string $account
 * @property string $corr_account
 * @property string $BIK
 * @property string $bank
 * @property string $sum
 * @property string $created_at
 */
class Invoice extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_name', 'address', 'INN', 'KPP', 'account', 'corr_account', 'BIK', 'bank', 'sum'], 'required'],
            [['address', 'bank'], 'string'],
            [['sum'], 'number'],
            [['customer_name', 'INN', 'KPP', 'account', 'BIK'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '№',
            'customer_name' => 'Покупатель',
            'address' => 'Адрес',
            'INN' => 'ИНН',
            'KPP' => 'КПП',
            'account' => 'Расчетный счет',
            'corr_account' => 'Кор. счет',
            'BIK' => 'БИК',
            'bank' => 'Банк',
            'sum' => 'Сумма оплаты',
            'created_at' => 'Дата',
        ];
    }

    /**
     * Добавим дату создания чека на оплату.
     * @param array $insert 
     * @return boolean
     */
    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        // только для новых записей (хоть по заданию мы и не редактируем чеки)
        if ($this->getIsNewRecord()) {
            $this->created_at = date('Y-m-d H:i:s');
        }
        
        return true;
    }

    /**
     * Возвращает дату в формате ДД.ММ.ГГГГ.
     * @return string
     */
    public function getDate()
    {
        $date = date('d.m.Y', strtotime($this->created_at));
        return $date;
    }
}
