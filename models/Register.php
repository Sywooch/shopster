<?php

namespace app\models;

use Yii;

class Register extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'register';
    }

    public function rules()
    {
        return [
            [['push_id', 'os'], 'string', 'max' => 255],
            ['push_id', 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
        ];
    }
}
