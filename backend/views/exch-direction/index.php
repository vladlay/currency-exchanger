<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ExchDirectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Exch Directions';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="exch-direction-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Exch Direction', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'from_currency',
                'value' => 'fromCurrency.name',
            ],
            [
                'attribute' => 'to_currency',
                'value' => 'receiveCurrency.name',
            ],
            'status',
            'rate_from',
            'rate_to',

            ['class' => 'common\classes\MyActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
</div>
