<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ExchOrder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exch-order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'from_currency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'to_currency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'from_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'to_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'from_account')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'to_account')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'person')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'update_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ip_address')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
