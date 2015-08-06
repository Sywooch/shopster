<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

class UserCall extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'user_call';
    }
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    public function rules()
    {
        return [
            [['status', 'type', 'user_id', 'text'], 'required'],
            [['status', 'type', 'user_id', 'created_at', 'updated_at', 'paid_status', 'user_content_id'], 'integer'],
            [['text'], 'string']
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Статус',
            'type' => 'Тип запроса',
            'user_id' => 'Пользователь',
            'created_at' => 'Создан',
            'updated_at' => 'Обновлен',
            'text' => 'Текст',
            'paid_status' => 'Оплачен',
            'user_content_id' => 'Магазин',
        ];
    }
}
