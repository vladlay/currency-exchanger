<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

Выбери валюту<br>
<div class="currency-form">

    
    <?php $form = ActiveForm::begin(); ?>

    <?= $form
            ->field($model_template, 'id')
            ->label(false)
            ->dropDownList($currenciesCodes)
    ?>

    <?= $form->field($model_template, 'reserve')->textInput(['maxlength' => true]) ?>

    

    <div class="form-group">
        <?= Html::submitButton('Добавить резерв', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>