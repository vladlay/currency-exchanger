<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ExchDirectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Exch Directions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exch-direction-index">

    <!-- <h1><?php // Html::encode($this->title) ?></h1> -->

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'summary' => false,

        'columns' => [
            [
                'attribute' => 'give_currency',
                'value' => 'currency.name',
            ],
            [
                'attribute' => 'receive_currency',
                'value' => 'receiveCurrency.name',
            ],
            'rate_from',
            'rate_to',
        ],
    ]); ?>

    <p>
        <?= Html::a('Создать заявку', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::end(); ?>
    
</div>
