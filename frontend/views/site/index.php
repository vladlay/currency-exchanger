<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ExchOrder */

$this->title = 'Create Exch Order';
$this->params['breadcrumbs'][] = ['label' => 'Exch Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exch-order-create">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', compact(
        'model', 
        'from_currencies', 
        'to_currencies_list',
        'icons',
        'currenciesCodes',
        'to_currencies_reserves',
        'icon_from',
        'icon_to',
        'course',
    )) ?>

</div>