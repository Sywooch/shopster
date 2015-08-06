<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use yii\helpers\Json;
use Imagine\Image\Box;
use Imagine\Image\Point;
use app\components\UploadBehavior;

class UserContent extends \yii\db\ActiveRecord
{
    public $img;
    public $crop_info;
    public $banner_img;
    public $banner_crop_info;
    public $map_img;
    public $map_crop_info;
    public $preview_url;
    public $image_url;

    public static function tableName()
    {
        return 'user_content';
    }
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            'uploadBehavior' => [
                'class' => UploadBehavior::className(),
                'attributes' => [
                    'preview_url' => [
                        'path' => '@webroot/images/maps/',
                        'tempPath' => '@webroot/images/maps',
                        'url' => '/images/maps'
                    ],
                    'image_url' => [
                        'path' => '@webroot/images/maps/',
                        'tempPath' => '@webroot/images/maps',
                        'url' => '/images/maps'
                    ]
                ]
            ]
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
            [
                'banner_img', 
                'file', 
                'extensions' => ['jpg', 'jpeg', 'png', 'gif'],
                'mimeTypes' => ['image/jpeg', 'image/pjpeg', 'image/png', 'image/gif'],
            ],
            ['banner_crop_info', 'safe'],
            [
                'map_img', 
                'file', 
                'extensions' => ['jpg', 'jpeg', 'png', 'gif'],
                'mimeTypes' => ['image/jpeg', 'image/pjpeg', 'image/png', 'image/gif'],
            ],
            ['map_crop_info', 'safe'],
            ['changes', 'safe'],
            [['user_id'], 'required'],
            [['user_id', 'city_id', 'category_id', 'shop_category_id', 'created_at', 'updated_at', 'status'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['shops'], 'safe'],
            [['title', 'image', 'description', 'phone', 'banner', 'img_map', 'website', 'working_hours', 'map'], 'string', 'max' => 255]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Пользователь',
            'title' => 'Название',
            'image' => 'Картинка',
            'description' => 'Описание',
            'latitude' => 'Долгота',
            'longitude' => 'Широта',
            'city_id' => 'Город',
            'category_id' => 'Тип',
            'shop_category_id' => 'Категория магазина',
            'phone' => 'Телефон',
            'banner' => 'Баннер',
            'website' => 'Сайт',
            'working_hours' => 'Рабочие часы',
            'map' => 'Карта',
            'shops' => 'Магазины',
            'created_at' => 'Создан',
            'updated_at' => 'Обновлен',
            'status' => 'Статус',
            'img' => 'Лого',
            'banner_img' => 'Баннер',
            'map_img' => 'Картинка карты',
            'changes' => 'Изминения',
            'preview_url' => 'Картинки этажей',
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
        if($this->banner_img){
            // open image
            $image = Image::getImagine()->open($this->banner_img->tempName);
            $cropInfo = Json::decode($this->banner_crop_info)[0];
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
            $pathThumbImage = Yii::$app->request->BaseUrl . 'images/' . '/thumb_' . $this->banner;   

            $image->copy()
                ->resize($newSizeThumb)
                ->crop($cropPointThumb, $cropSizeThumb)
                ->save($pathThumbImage, ['quality' => 100]);

            //saving original
            $this->banner_img->saveAs(Yii::$app->request->BaseUrl . 'images/' . $this->banner);
        }
        if($this->map_img){
            // open image
            $image = Image::getImagine()->open($this->map_img->tempName);
            $cropInfo = Json::decode($this->map_crop_info)[0];
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
            $pathThumbImage = Yii::$app->request->BaseUrl . 'images/' . '/thumb_' . $this->map;   

            $image->copy()
                ->resize($newSizeThumb)
                ->crop($cropPointThumb, $cropSizeThumb)
                ->save($pathThumbImage, ['quality' => 100]);

            //saving original
            $this->map_img->saveAs(Yii::$app->request->BaseUrl . 'images/' . $this->map);
        }
        parent::afterSave($insert, $changeAttributes);
    }
    public function getImageUrl(){
        if($this->image != "")
            return '/images/thumb_' . $this->image;
        else
            return '/images/no-user-image.png';
    }
    public function getBannerUrl(){
        if($this->banner != "")
            return '/images/thumb_' . $this->banner;
        else
            return '/images/no-user-image.png';
    }
    public function getMapUrl(){
        if($this->map != "")
            return '/images/thumb_' . $this->map;
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
        $log->action = 'Магазины и Тц. номер: '.$this->id;
        $log->created = time();
        $log->save();
        return parent::beforeSave($insert);
    }
}
