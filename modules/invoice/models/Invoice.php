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

    /**
     * Возвращает сумму прописью. Нашел на хабре.
     * Убрал приведение к float (у нас decimal -> string без потери точности).
     * @url https://habrahabr.ru/post/53210/
     * @author runcore
     * @uses morph(...)
     */
    public function getSumInWords()
    {
        $num = $this->sum;
        $nul = 'ноль';
        $ten = array(
            array('', 'один', 'два', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять'),
            array('', 'одна', 'две', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять'),
        );
        $a20 = array('десять', 'одиннадцать', 'двенадцать', 'тринадцать', 'четырнадцать', 'пятнадцать', 'шестнадцать', 'семнадцать', 'восемнадцать', 'девятнадцать');
        $tens = array(2 => 'двадцать', 'тридцать', 'сорок', 'пятьдесят', 'шестьдесят', 'семьдесят', 'восемьдесят', 'девяносто');
        $hundred = array('', 'сто', 'двести', 'триста', 'четыреста', 'пятьсот', 'шестьсот', 'семьсот', 'восемьсот', 'девятьсот');
        $unit = array(// Units
            array('копейка', 'копейки', 'копеек', 1),
            array('рубль', 'рубля', 'рублей', 0),
            array('тысяча', 'тысячи', 'тысяч', 1),
            array('миллион', 'миллиона', 'миллионов', 0),
            array('миллиард', 'милиарда', 'миллиардов', 0),
        );
        //
        list($rub, $kop) = explode('.', sprintf("%015.2f", $num));

        $out = array();
        if (intval($rub) > 0) {
            foreach (str_split($rub, 3) as $uk => $v) { // by 3 symbols
                if (!intval($v)) {
                    continue;
                }
                $uk = sizeof($unit) - $uk - 1; // unit key
                $gender = $unit[$uk][3];
                list($i1, $i2, $i3) = array_map('intval', str_split($v, 1));
                // mega-logic
                $out[] = $hundred[$i1]; # 1xx-9xx
                if ($i2 > 1) {
                    $out[] = $tens[$i2] . ' ' . $ten[$gender][$i3]; # 20-99
                } else {
                    $out[] = $i2 > 0 ? $a20[$i3] : $ten[$gender][$i3]; # 10-19 | 1-9
                }
                // units without rub & kop
                if ($uk > 1) {
                    $out[] = $this->morph($v, $unit[$uk][0], $unit[$uk][1], $unit[$uk][2]);
                }
            } //foreach
        } else {
            $out[] = $nul;
        }
        $out[] = $this->morph(intval($rub), $unit[1][0], $unit[1][1], $unit[1][2]); // rub
        $out[] = $kop . ' ' . $this->morph($kop, $unit[0][0], $unit[0][1], $unit[0][2]); // kop
        return trim(preg_replace('/ {2,}/', ' ', join(' ', $out)));
    }

    /**
     * Склоняем словоформу
     * @ author runcore
     */
    private function morph($n, $f1, $f2, $f5)
    {
        $n = abs(intval($n)) % 100;
        if ($n > 10 && $n < 20) {
            return $f5;
        }
        $n = $n % 10;
        if ($n > 1 && $n < 5) {
            return $f2;
        }
        if ($n == 1) {
            return $f1;
        }
        return $f5;
    }

}
