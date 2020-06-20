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
            <?= $form->field($model, 'from_currency')->dropDownList($currencies, ['prompt' => 'Нет значения', 'label' => '']) ?>
        </div>

        <div class="col-lg-3">
            <?= $form->field($model, 'to_currency')->dropDownList($currencies, ['prompt' => 'Нет значения']) ?>    
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'status')->dropDownList($model->statuses) ?>    
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

    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'min_amount_from',)->textInput() ?>
        </div>

        <div class="col-lg-3">
            <?= $form->field($model, 'min_amount_to',)->textInput() ?> 
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'max_amount_from',)->textInput() ?>
        </div>

        <div class="col-lg-3">
            <?= $form->field($model, 'max_amount_to',)->textInput() ?> 
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
