<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ExchOrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exch-order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'rate') ?>

    <?= $form->field($model, 'from_currency') ?>

    <?= $form->field($model, 'to_currency') ?>

    <?php // echo $form->field($model, 'from_amount') ?>

    <?php // echo $form->field($model, 'to_amount') ?>

    <?php // echo $form->field($model, 'from_account') ?>

    <?php // echo $form->field($model, 'to_account') ?>

    <?php // echo $form->field($model, 'person') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'update_date') ?>

    <?php // echo $form->field($model, 'ip_address') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
