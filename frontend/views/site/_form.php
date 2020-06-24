<?php

use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Currency;
use backend\models\ExchDirection;


/* @var $this yii\web\View */
/* @var $model common\models\ExchOrder */
/* @var $form yii\widgets\ActiveForm */
// dd($to_currencies);

$this->registerJs( <<< JS

    $(document).on('change', '#exchorder-from_currency', () => {

        let checked_from_currency = $('input[name="ExchOrder[from_currency]"]:checked').val();

        $.pjax({
            async: false,
            url: '/site/index', 
            container: '#main-form',  
            data: {
                from: checked_from_currency 
            },
            scrollTo: false,
            type: 'POST'
        });
    })

    $(document).on('change', '#exchorder-to_currency', () => {

        let checked_from_currency = $('input[name="ExchOrder[from_currency]"]:checked').val();
        let checked_to_currency = $('input[name="ExchOrder[to_currency]"]:checked').val();

        $.pjax({
            async: false,
            url: '/site/index', 
            container: '#main-form',  
            data: {
                from: checked_from_currency,
                to: checked_to_currency 
            },
            scrollTo: false,
            type: 'GET'
        })
    })

    $(document).on('keyup', '#exchorder-from_amount', () => {
        $('#exchorder-to_amount').val(
            ($('#exchorder-from_amount').val() 
                / $('#course-from').text()
                * $('#course-to').text())
                .toFixed(4)
        )
        console.log($('#exchorder-from_amount').val());
    })

    $(document).on('keyup', '#exchorder-to_amount', () => {
        $('#exchorder-from_amount').val(
            ($('#exchorder-to_amount').val() 
                / $('#course-to').text()
                * $('#course-from').text())
                .toFixed(4)
        )
        console.log($('#exchorder-from_amount').val());
    })
JS);

?>

<?php Pjax::begin(['id' => 'main-form']); ?>

<div class="exch-order-form">


    <?php $form = ActiveForm::begin([
        'id' => 'contact-form',
        'enableAjaxValidation' => true,
    ]); ?>

    <div class="row">
        <div class="col col-8">
            <div class="content-inner rounded shadow">
                <div class="row">
                    <div class="col col-5">
                        <h5><b>Отдаете</b></h5>
                        <?= $form->field($model, 'from_currency')
                            ->label(false)
                            ->radioList($from_currencies, [
                                'class' => 'd-flex flex-column',
                                // $index = 0, 1, 2, 3
                                // $label = Bitcoin Приват 24 Сбер Etherium
                                // $name = ExchOrder[from_currency]
                                // $checked = 1 - выбранное поле
                                // value = 20, 21, 23, 24
                                
                                'item' => function($index, $label, $name, $checked, $value) use ($icons, $currenciesCodes) {

                                    $check_img = '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 20C4.477 20 0 15.523 0 10S4.477 0 10 0s10 4.477 10 10-4.477 10-10 10z" fill="#3413FD"></path><path d="M13.835 6.292a.571.571 0 0 1 .902.702l-5 6.428a.571.571 0 0 1-.815.09l-2.857-2.357a.571.571 0 1 1 .727-.881l2.404 1.982 4.639-5.964z" fill="#fff"></path></svg>';
                                    $icon_src = $icons[$value];
                                    // $icon_img = '<img class="icon mr-3" src="' . $icon_src . '">';
                                    $icon_img = Html::img('@uploads/'. $icon_src, ['class' => 'icon mr-3']);
                                    // <?= Html::img('@web/images/logo.png', ['alt' => 'Наш логотип'])

                                    
                                    $checked = $checked ? 'checked' : false;

                                    $input_id = 'from_currency_' . $value;
                                    $input = '<input id="' 
                                                . $input_id 
                                                . '" type="radio" name="' 
                                                . $name 
                                                . '" value="' 
                                                . $value 
                                                . '"'
                                                . $checked
                                                .'>';
                                    $item = '<div class="item">'
                                        .$icon_img
                                        .$label
                                        .'</div>';

                                    $label_tag = '<label class="p-2 d-flex justify-content-between align-items-center" for="' . $input_id . '">'
                                        .$item
                                        .$check_img
                                        .'</label>';
                                

                                    $result = $input
                                        .$label_tag;

                                    return $result;
                                }
                                ]) ?>
                    </div>
                
                    <div class="col col-7">
                        
                            <div class="row d-flex justify-content-between pl-3 pr-4">
                                <h5><b>Получаете</b></h5>
                                <span>Доступный резерв</span>
                                
                            </div>

                            <?= $form
                                ->field($model, 'to_currency')
                                ->label(false)
                                // ->radioList($to_currencies, ['class' => 'd-flex flex-column'])->label(false) 
                                ->radioList($to_currencies_list, [
                                    'class' => 'd-flex flex-column',
                                    // $index = 0, 1, 2, 3
                                    // $label = Bitcoin Приват 24 Сбер Etherium
                                    // $name = ExchOrder[from_currency]
                                    // $checked = 1 - выбранное поле
                                    // value = 20, 21, 23, 24
                                    
                                    'item' => function($index, $label, $name, $checked, $value) use ($icons, $to_currencies_reserves) {
                                        
                                        $check_img = '<svg class="check_img" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 20C4.477 20 0 15.523 0 10S4.477 0 10 0s10 4.477 10 10-4.477 10-10 10z" fill="#3413FD"></path><path d="M13.835 6.292a.571.571 0 0 1 .902.702l-5 6.428a.571.571 0 0 1-.815.09l-2.857-2.357a.571.571 0 1 1 .727-.881l2.404 1.982 4.639-5.964z" fill="#fff"></path></svg>';
                                        
                                        $icon_src = $icons[$value];
                                        
                                        // $icon_img = '<img class="icon mr-3" src="' . $icon_src . '">';
                                        $icon_img = Html::img('@uploads/'. $icon_src, ['class' => 'icon mr-3']);

                                        // $checked = $checked ? 'checked' : false;

                                        // $input_id = 'from_currency_' . $value;
                                        // $input = '<input id="' 
                                        //             . $input_id 
                                        //             . '" type="radio" name="' 
                                        //             . $name 
                                        //             . '" value="' 
                                        //             . $value 
                                        //             . '"'
                                        //             . $checked
                                        //             .'>';

                                        $checked = $checked ? 'checked' : false;

                                        $input_id = 'to_currency_' . $value;
                                        $input = '<input id="' 
                                                    . $input_id 
                                                    . '" type="radio" name="' 
                                                    . $name 
                                                    . '" value="' 
                                                    . $value 
                                                    . '"'
                                                    . $checked
                                                    .'>';

                                        $item = '<div class="item   ">'
                                            .$icon_img
                                            .$label
                                            
                                            .'</div>';

                                        $label_tag = '<label class="p-2 d-flex justify-content-between align-items-center" for="' . $input_id . '">'
                                            .$item
                                            
                                            .$check_img
                                            .'<span class="reserve">'
                                            .$to_currencies_reserves[$value]
                                            .'</span>'
                                            .'</label>';
                                    
                                        $result = $input
                                            .$label_tag;

                                        return $result;
                                    }
                                    ])
                            ?>


                    </div>  
                </div>
            </div>
        </div>



        <div class="col col-4">
            <div class="content-inner shadow rounded right-block">       
                <?php
                    if ($course) {
                        echo '<h6><i>Курс: '
                            .'<span class="course">'
                                .'<span id="course-from">'
                                    .$course['from']
                                .'</span>'
                            .'<i class="fas fa-arrow-circle-right pl-2 pr-2"></i>'
                                .'<span id="course-to">'
                                    .$course['to']
                                .'</span>'
                            .'</span>';
                    }
                ?>

                    <span class="d-flex justify-content-between align-items-center">
                        <h5><b>Сумма обмена</b></h5>
                    </span>
                    
                    <div class="from_to-amount">
                        <?= $form->field($model, 'from_amount')->textInput(
                                [
                                    'maxlength' => true, 
                                    'placeholder' => 
                                        'Min: ' 
                                        . $model->min_amount_from . '; ' 
                                        .'Max: '
                                        . $model->max_amount_from,
                       ]) ?>

                        <span class="from_to-amount-icon">
                            <?php
                                if ($icon_from){
                                    // dump($icon_from);
                                    // dump($icons[$icon_from]);
                                    echo Html::img('@uploads/' . $icons[$icon_from], ['class' => 'icon_in_form']);
                                }
                            ?>                            
                        </span>
                    </div>

                    <div class="from_to-amount">

                        <?= $form->field($model, 'to_amount')->textInput(
                            [
                                'maxlength' => true,
                                'placeholder' => 
                                    'Min: ' 
                                    . $model->min_amount_to . '; ' 
                                    .'Max: '
                                    . $model->max_amount_to,
                        ]) ?>

                        <span class="from_to-amount-icon">
                            <?php
                                if ($icon_from){
                                    // dump($icon_from);
                                    // dump($icons[$icon_from]);
                                    echo Html::img('@uploads/' . $icons[$icon_to], ['class' => 'icon_in_form']);
                                }
                            ?>                            
                        </span>

                    </div>
                    

                    

                    <h5><b>Реквизиты</b></h5>

                    <?= $form->field($model, 'from_account')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'to_account')->textInput(['maxlength' => true]) ?>

                
                
                <?= $form->field($model, 'person')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                <label>
                    <input type="checkbox" required oninvalid="$('#mymodal').click()" oninput="setCustomValidity('')">
                    <span>Я согласен с </span>
                    <a href="/">правилами</a>
                </label>

                <!-- Button to Open the Modal -->
                <button id="mymodal" type="button" class="btn btn-primary d-none" data-toggle="modal" data-target="#myModal">
                </button>

                <!-- The Modal -->
                <div class="modal" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Внимание!</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        Вы не согласились с правилами!
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                    </div>
                </div>
                </div>

                <div class="form-group">
                <?= Html::submitButton('Обменять', ['class' => 'btn btn-success bg-color-main mt-3 w-100 shadow']) ?>
                </div>
            </div>
        </div>

    <?php // echo $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?php // echo $form->field($model, 'update_date')->textInput(['maxlength' => true]) ?>

    <?php // echo $form->field($model, 'ip_address')->textInput(['maxlength' => true]) ?>

   

    <?php ActiveForm::end(); ?>

    
</div>

<?php Pjax::end(); ?>