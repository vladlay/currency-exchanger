<?php

namespace common\models;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

use Yii;

/**
 * This is the model class for table "review".
 *
 * @property int $id
 * @property int $created_at
 * @property string $created_by
 * @property string $text
 */
class Review extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'review';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
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
            [['created_by', 'text'], 'required'],
            [['created_at'], 'integer'],
            [['created_by'], 'string', 'max' => 50],
            [['text'], 'string', 'max' => 300],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Дата создания',
            'created_by' => 'Ваше имя',
            'text' => 'Отзыв',
        ];
    }
}
