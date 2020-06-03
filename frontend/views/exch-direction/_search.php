<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ExchDirectionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exch-direction-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'give_currency') ?>

    <?= $form->field($model, 'receive_currency') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'rate_from') ?>

    <?php // echo $form->field($model, 'rate_to') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
