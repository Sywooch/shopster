<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

class ShopCategory extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'shop_category';
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
            [['name', 'status'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'status' => 'Статус',
            'created_at' => 'Создан',
            'updated_at' => 'Обновлен',
        ];
    }
    public function beforeSave($insert){
        $olds = $this->oldAttributes;
        $res = [];
        foreach ($olds as $key => $old) {
            if($old != $this[$key]){
                $res['old'][$key] = $old;
                $res['new'][$key] = $this[$key];
            }
        }
        $log = new Log();
        $log->user_id = \Yii::$app->user->identity->id;
        $log->comment = json_encode($res);
        $log->action = 'Категории магазинов номер: '.$this->id;
        $log->created = time();
        $log->save();
        return parent::beforeSave($insert);
    }
}
