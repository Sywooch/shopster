<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use yii\helpers\Json;
use Imagine\Image\Box;
use Imagine\Image\Point;


class Promo extends \yii\db\ActiveRecord
{
    public $img;
    public $crop_info;

    public static function tableName()
    {
        return 'promo';
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
            [
                'img', 
                'file', 
                'extensions' => ['jpg', 'jpeg', 'png', 'gif'],
                'mimeTypes' => ['image/jpeg', 'image/pjpeg', 'image/png', 'image/gif'],
            ],
            ['crop_info', 'safe'],
            [['content_id', 'description', 'duration'], 'required'],
            [['content_id', 'created_at', 'updated_at', 'status', 'paid'], 'integer'],
            [['image', 'description', 'duration'], 'string', 'max' => 255]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content_id' => 'Магазин или тц',
            'image' => 'Картинка',
            'description' => 'Описание',
            'duration' => 'Продлится до',
            'created_at' => 'Создан',
            'updated_at' => 'Обновлен',
            'img' => 'Картинка акции',
            'status' => 'Статус',
            'paid' => 'Платная?',
        ];
    }
    public function afterSave($insert, $changeAttributes){
        if($this->img){
            // open image
            $image = Image::getImagine()->open($this->img->tempName);
            $cropInfo = Json::decode($this->crop_info)[0];
            $cropInfo['dw'] = (int)$cropInfo['dw']; //new width image
            $cropInfo['dh'] = (int)$cropInfo['dh']; //new height image
            $cropInfo['x'] = abs($cropInfo['x']); //begin position of frame crop by X
            $cropInfo['y'] = abs($cropInfo['y']); //begin position of frame crop by Y
            $cropInfo['w'] = (int)$cropInfo['w']; //width of cropped image
            $cropInfo['h'] = (int)$cropInfo['h']; //height of cropped image
            // Properties bolow we don't use in this example
            //$cropInfo['ratio'] = $cropInfo['ratio'] == 0 ? 1.0 : (float)$cropInfo['ratio']; //ratio image. 

            //saving thumbnail
            $newSizeThumb = new Box($cropInfo['dw'], $cropInfo['dh']);
            $cropSizeThumb = new Box(450, 300);
            $cropPointThumb = new Point($cropInfo['x'], $cropInfo['y']);
            $pathThumbImage = Yii::$app->request->BaseUrl . 'images/' . '/thumb_' . $this->image;   

            $image->copy()
                ->resize($newSizeThumb)
                ->crop($cropPointThumb, $cropSizeThumb)
                ->save($pathThumbImage, ['quality' => 100]);

            //saving original
            $this->img->saveAs(Yii::$app->request->BaseUrl . 'images/' . $this->image);
        }
        parent::afterSave($insert, $changeAttributes);
    }
    public function getImageUrl(){
        if($this->image != "")
            return '/images/thumb_' . $this->image;
        else
            return '/images/no-user-image.png';
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
        $log->action = 'Акции номер: '.$this->id;
        $log->created = time();
        $log->save();
        return parent::beforeSave($insert);
    }
}
