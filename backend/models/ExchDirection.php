<?php

namespace backend\models;

use Yii;
use common\models\Currency;
use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "exch_direction".
 *
 * @property int $id
 * @property string $from_currency
 * @property string $to_currency
 * @property string $status
 * @property float $rate_from
 * @property int $rate_to
 * @property float $min_amount_from
 * @property float $min_amount_to
 * @property float $max_amount_from
 * @property float $max_amount_to
 */
class ExchDirection extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'exch_direction';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['from_currency', 'to_currency', 'status', 'rate_from', 'rate_to'], 'required'],
            [['rate_from', 'rate_to'], 'number'],
            [
                [
                    'min_amount_from',
                    'min_amount_to', 
                    'max_amount_from',
                    'max_amount_to'
                ], 
                'number', 
                'min' => 0
            ],
            [['from_currency', 'to_currency'], 'string', 'max' => 100],
            [['status'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'from_currency' => 'Отдаете',
            'to_currency' => 'Получаете',
            'status' => 'Статус',
            'rate_from' => 'Курс отдаете',
            'rate_to' => 'Курс получаете',
            'min_amount_from' => 'Минимальная сумма обмена', 
            'min_amount_to' => 'Минимальная сумма обмена', 
            'max_amount_from' => 'Максимальная сумма обмена',
            'max_amount_to' => 'Максимальная сумма обмена'
        ];
    }

    /**
     * доступные статусы направления обмена
     */
    public $statuses = [
        1 => 'Активно',
        0 => 'Не активно'
    ];

    /**
     * связи
     */
    public function getCurrencies() 
    {
        return $this->hasMany(Currency::className(), ['id' => 'from_currency']);
    }

    public function getFromCurrency() 
    {
        return $this->hasOne(Currency::className(), ['id' => 'from_currency']);
    }

    public function getToCurrency() 
    {
        return $this->hasOne(Currency::className(), ['id' => 'to_currency']);
    }

    public function getReceiveCurrency() 
    {
        return $this->hasOne(Currency::className(), ['id' => 'to_currency']);
    }

    /**
     * статические методы получения данных из базы
     */
    public static function getActiveExchangeDirections()
    {
        return ExchDirection::find()->where(['status' => 1])->all();
    }

    public static function getFromCurrencies()
    {
        return ArrayHelper::map(self::getActiveExchangeDirections(), 'fromCurrency.code', 'fromCurrency.name');
    }

    public static function getReserves()
    {
        return ArrayHelper::map(self::getActiveExchangeDirections(), 'fromCurrency.code', 'fromCurrency.name');
    }

    public static function getToCurrencies($from_currency) 
    {
        $query = static::find()
            ->joinWith(['fromCurrency from'])
            ->joinWith(['toCurrency to'])
            ->where(['status' => 1])
            ->andWhere(['from.code' => $from_currency])
            ->andWhere(['>', 'to.reserve', 0])
            // ->createCommand()->rawSql;
            ->all();

            return $query;
    }

    public static function getCourse($from_currency, $to_currency)
    {
        return self::find()
                ->where(['from_currency' => $from_currency])
                ->andWhere(['to_currency' => $to_currency])
                ->one();
    }    

    public static function getToCurreniesBesidesChecked($checked)
    {
        return ArrayHelper::map(ExchDirection::find()->where(['from_currency' => $checked])->all(), 'to_currency', 'toCurrency.name');
    }   
}
