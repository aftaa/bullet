<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Новый счет';

/* @var $this yii\web\View */
/* @var $model app\modules\invoice\models\Invoice */
/* @var $form ActiveForm */
?>
<div class="invoice-default-index">
    <h1><?= $this->title ?></h1>

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'customer_name') ?>
        <?= $form->field($model, 'address') ?>
        <?= $form->field($model, 'INN') ?>
        <?= $form->field($model, 'KPP') ?>
        <?= $form->field($model, 'account') ?>
        <?= $form->field($model, 'corr_account') ?>
        <?= $form->field($model, 'BIK') ?>
        <?= $form->field($model, 'bank') ?>
        <?= $form->field($model, 'sum') ?>

        <div class="form-group">
            <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>
