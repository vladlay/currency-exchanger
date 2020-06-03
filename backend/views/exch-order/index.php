<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\grid\GridView;

use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ExchOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Exch Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exch-order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Exch Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            
            'id',
            'date',
            'description',
            'rate',
            'from_account',
            'to_account',
            'person',
            'status',
            

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
