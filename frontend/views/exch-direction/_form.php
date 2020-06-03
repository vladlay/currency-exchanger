<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ExchDirection */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exch-direction-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= 

    $form->field($model, 'give_currency')->dropDownList($currencies, ['prompt' => 'Нет значения']) ?>

    <?= $form->field($model, 'receive_currency')->dropDownList($currencies, ['prompt' => 'Нет значения']) ?>

    <?= $form->field($model, 'status')->dropDownList(['Активно', 'Не активно']) ?>

    <?= $form->field($model, 'rate_from')->textInput() ?>

    <?= $form->field($model, 'rate_to')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
