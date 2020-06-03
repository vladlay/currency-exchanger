<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ExchDirection */

$this->title = 'Create Exch Direction';
$this->params['breadcrumbs'][] = ['label' => 'Exch Directions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exch-direction-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'currencies' => $currencies,
    ]) ?>

</div>
