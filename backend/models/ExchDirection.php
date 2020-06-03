<?php

namespace backend\models;

use common\models\Currency;

use Yii;

/**
 * This is the model class for table "exch_direction".
 *
 * @property int $id
 * @property string $give_currency
 * @property string $receive_currency
 * @property string $status
 * @property float $rate_from
 * @property int $rate_to
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
            [['give_currency', 'receive_currency', 'status', 'rate_from', 'rate_to'], 'required'],
            [['rate_from'], 'number'],
            [['rate_to'], 'integer'],
            [['give_currency', 'receive_currency'], 'string', 'max' => 100],
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
            'give_currency' => 'Отдаете',
            'receive_currency' => 'Получаете',
            'status' => 'Статус',
            'rate_from' => 'Курс отдаете',
            'rate_to' => 'Курс получаете',
        ];
    }

    public function getCurrencies() {
        return $this->hasMany(Currency::className(), ['id' => 'give_currency']);
    }

    public function getCurrency() {
        return $this->hasOne(Currency::className(), ['id' => 'give_currency']);
    }

    public function getReceiveCurrency() {
        return $this->hasOne(Currency::className(), ['id' => 'receive_currency']);
    }
}
