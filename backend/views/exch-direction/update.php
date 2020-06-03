<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ExchDirection */

$this->title = 'Update Exch Direction: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Exch Directions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="exch-direction-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'currencies' => $currencies,
    ]) ?>

</div>
