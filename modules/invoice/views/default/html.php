<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = "Счет №$invoice->id от {$invoice->getDate()}";

/* @var $this yii\web\View */
/* @var $invoice app\modules\invoice\models\Invoice */
/* @var $seller app\modules\invoice\models\Seller */
/* @var $isPartial boolean */
?>

<div class="invoice-default-index">
    <div>Продавец: <?= $seller->name ?></div>
    <div>Адрес: <?= $seller->address ?></div>
    <div>ИНН: <?= $seller->INN ?></div>
    <div>Расчетный счет: <?= $seller->account ?></div>
    <div>Кор. счет: <?= $seller->corr_account ?></div>
    <div>БИК: <?= $seller->BIK ?></div>
    <div>Банк: <?= $seller->bank ?></div>

    <br>
    
    <div>Покупатель: <?= $invoice->customer_name ?></div>
    <div>Адрес: <?= $invoice->address ?></div>
    <div>ИНН: <?= $invoice->INN ?></div>
    <div>КПП: <?= $invoice->KPP ?></div>
    <div>Расчетный счет: <?= $invoice->account ?></div>
    <div>Кор. счет: <?= $invoice->corr_account ?></div>
    <div>БИК: <?= $invoice->BIK ?></div>
    <div>Банк: <?= $invoice->bank ?></div>
    
    <h3 align="center"><?= $this->title ?></h3>
    
    <table border="2" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>№</th>
                <th>Наименование</th>
                <th>Ед. изм.</th>
                <th>Кол-во</th>
                <th>Цена</th>
                <th>Сумма</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= $invoice->id ?></td>
                <td>Оказание услуг по обслуживанию компьютерной техники</td>
                <td>шт.</td>
                <td>1</td>
                <td><?= $invoice->sum ?></td>
                <td><?= $invoice->sum ?></td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td colspan="2">Итого</td>
                <td>1</td>
                <td></td>
                <td><?= $invoice->sum ?></td>
            </tr>
        </tfoot>
    </table>
    
    <div>
        Сумма прописью: <?= $invoice->getSumInWords() ?>. Без НДС.
    </div>
    
    <br>
    
    <div style="overflow: hidden;">
        <div style="float: right;">(<?= str_repeat('_', 20) ?>)</div>
        <div style="float: right; margin-right: 10%;"><?= str_repeat('_', 25) ?></div>
        <div style="float: right; margin-right: 10%;">Индивидуальный предприниматель</div>
    </div>
    
    <?php if (!$isPartial): ?>
        <br>
        <a href="?id=<?= $invoice->id ?>&partial=1" target="_blank">версия для печати</a>
    <?php endif ?>
</div>
