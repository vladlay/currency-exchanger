<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "currency".
 *
 * @property int $id
 * @property string $name
 * @property string $icon
 * @property string $code
 * @property float $reserve
 */
class Currency extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'currency';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 50],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            [['icon'], 'string', 'max' => 300],
            [['code'], 'string', 'max' => 30],
            [['reserve'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'icon' => 'Иконка',
            'imageFile' => 'Иконка',
            'code' => 'Код валюты',
            'reserve' => "Резерв"
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function upload()
        {
            if ($this->validate()) {
                $filePath = '@uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
                $this->imageFile->saveAs($filePath, false);
                // $this->imageFile = null;
                $this->icon = 'uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
                return true;
            } else {
                return false;
            }
        }
    
    /**
     * {@inheritdoc}
     */
    public static function getCurrencies() 
    {
        return ArrayHelper::map(Currency::find()->all(), 'id', 'name');
    }

    public static function getCurrenciesCodes() 
    {
        return ArrayHelper::map(Currency::find()->all(), 'id', 'code');
    }

    public function getIcons() 
    {
        return ArrayHelper::map(Currency::find()->all(), 'code', 'icon');
    }
}
