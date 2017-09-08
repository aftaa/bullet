<?php

namespace app\modules\invoice\models;

use Yii;

/**
 * This is the model class for table "seller".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $INN
 * @property string $account
 * @property string $corr_account
 * @property string $BIK
 * @property string $bank
 */
class Seller extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seller';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['address', 'bank'], 'string'],
            [['name', 'INN', 'account', 'corr_account', 'BIK'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'address' => 'Address',
            'INN' => 'Inn',
            'account' => 'Account',
            'corr_account' => 'Corr Account',
            'BIK' => 'Bik',
            'bank' => 'Bank',
        ];
    }
}
