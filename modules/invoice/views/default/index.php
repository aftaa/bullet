<?php

use yii\grid\GridView;

$this->title = 'Просмотр счетов';

/* @var $invoiceDataProvider yii\data\ActiveDataProvider */
?>
<div class="invoice-default-index">
    <h1><?= $this->title ?></h1>
    <?= GridView::widget([
        'dataProvider' => $invoiceDataProvider,
        'columns' => [
            'id',
            'customer_name',
            'address',
            'INN',
            'KPP',
            'account',
            'corr_account',
            'BIK',
            'bank',
            'sum',
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:d.m.Y'],
                'label' => 'Создан'
            ],
            [
                'class' => yii\grid\ActionColumn::class,
                'template' => '{view}',
                'buttons' => [
                    'view' => function($url, $model, $key) {
                        $url = "/invoice/default/html/?id=$model->id&partial=1";
                        $a = "<a href=\"$url\" target=\"_blank\">HTML</a>";
                        return $a;
                    }
                ]
            ]
        ]
    ]) ?>
</div>
