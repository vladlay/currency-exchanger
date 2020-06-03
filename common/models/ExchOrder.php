<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "exch_order".
 *
 * @property int $id
 * @property string $date
 * @property string $description
 * @property float $rate
 * @property string $from_account
 * @property string $to_account
 * @property string $person
 * @property string $status
 */
class ExchOrder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'exch_order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'description', 'rate', 'from_account', 'to_account', 'person', 'status'], 'required'],
            [['rate'], 'number'],
            [['date', 'from_account', 'to_account', 'status'], 'string', 'max' => 100],
            [['description', 'person'], 'string', 'max' => 300],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Дата',
            'description' => 'Обмен',
            'rate' => 'Курс',
            'from_account' => 'Со счета',
            'to_account' => 'На счет',
            'person' => 'Личные данные',
            'status' => 'Статус',
        ];
    }
}
