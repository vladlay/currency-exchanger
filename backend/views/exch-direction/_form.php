<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ExchDirection */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exch-direction-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'give_currency')->dropDownList($currencies, ['prompt' => 'Нет значения', 'label' => '']) ?>
        </div>

        <div class="col-lg-3">
            <?= $form->field($model, 'receive_currency')->dropDownList($currencies, ['prompt' => 'Нет значения']) ?>    
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'status')->dropDownList(['Активно', 'Не активно']) ?>    
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'rate_from')->textInput() ?>
        </div>

        <div class="col-lg-3">
            <?= $form->field($model, 'rate_to')->textInput() ?> 
        </div>
    </div>

    



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
