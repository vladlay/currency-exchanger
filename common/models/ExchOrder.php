<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "exch_order".
 *
 * @property int $id
 * @property string $date
 * @property string $rate
 * @property string $from_currency
 * @property string $to_currency
 * @property string $from_amount
 * @property string $to_amount
 * @property string $from_account
 * @property string $to_account
 * @property string $person
 * @property string $phone_number
 * @property string $email
 * @property string $status
 * @property string $update_date
 * @property string $ip_address
 */
class ExchOrder extends \yii\db\ActiveRecord
{

    /**
     * доступные статусы заявок
     */
    public $statuses = [
        'not_paid' => 'Не оплачена',
        'in_processing' => 'В обработке',
        'completed' => 'Выполнена',
        'error' => 'Ошибка',
        'deleted' => 'Удалена',
    ];

    /**
     * validator vars
     */
    public $min_amount_from;
    public $max_amount_from;
    public $min_amount_to;
    public $max_amount_to;

    /***
     * construct
     */
    public function __construct($min_from = 0, $max_from = 0, $min_to = 0, $max_to = 0)
    {
        $this->min_amount_from = $min_from;
        $this->max_amount_from = $max_from;
        $this->min_amount_to = $min_to;
        $this->max_amount_to = $max_to;  
        
        parent::__construct();  
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'exch_order';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['date', 'update_date'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['update_date'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rate', 'from_currency', 'to_currency', 'from_amount', 'to_amount', 'from_account', 'to_account', 'person', 'phone_number', 'email', 'status'], 'required'],
            [['date', 'person', 'email', 'update_date', 'rate'], 'string', 'max' => 100],
            [['from_currency', 'to_currency', 'from_account', 'to_account', 'status', 'ip_address'], 'string', 'max' => 30],
            [['phone_number'], 'string', 'max' => 15],
            [
                [
                    'from_amount'
                ],
                'number',
                'min' => $this->min_amount_from,
                'max' => $this->max_amount_from
            ],
            [
                [
                    'to_amount'
                ],
                'number',
                'min' => $this->min_amount_to,
                'max' => $this->max_amount_to
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Дата создания',
            'rate' => 'Курс',
            'from_currency' => 'Валюта отдаете',
            'to_currency' => 'Валюта получаете',
            'from_amount' => 'Отдаете',
            'to_amount' => 'Получаете',
            'from_account' => 'Со счета',
            'to_account' => 'На счет',
            'person' => 'ФИО',
            'phone_number' => 'Телефон',
            'email' => 'E-mail',
            'status' => 'Статус',
            'update_date' => 'Дата изменения',
            'ip_address' => 'IP адрес',
        ];
    }
}
