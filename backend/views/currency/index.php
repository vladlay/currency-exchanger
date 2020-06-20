<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CurrencySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Currencies';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="currency-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Currency', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'code',
            [
                'attribute' => 'icon',
                'value' => fn($model) => ('http://diploma.net/uploads/' . $model->icon),
                'format' => ['image', ['height' => '50']],  
            ],
            
            [
                'attribute' => 'icon',
                'label' => 'Адрес иконки'
            ],
            'reserve',

            ['class' => 'common\classes\MyActionColumn'],
        ]
    ]); ?>
    <?php Pjax::end(); ?>
    
</div>
