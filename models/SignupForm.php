<?php 

namespace app\models;
 
use yii\base\Model;
use Yii;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use yii\helpers\Json;
use Imagine\Image\Box;
use Imagine\Image\Point;
 
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $verifyCode;
    public $img;
    public $crop_info;
    public $image;
    public $type;

    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'match', 'pattern' => '#^[\w_-]+$#i'],
            ['username', 'unique', 'targetClass' => User::className(), 'message' => 'Данный логин уже занят.'],
            [['username', 'image'], 'string', 'min' => 2, 'max' => 255],
 
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => User::className(), 'message' => 'Данный почтовый ящик занят.'],
 
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            [
                'img', 
                'file', 
                'extensions' => ['jpg', 'jpeg', 'png', 'gif'],
                'mimeTypes' => ['image/jpeg', 'image/pjpeg', 'image/png', 'image/gif'],
            ],
            ['crop_info', 'safe'],
            ['type', 'integer'],
 
            ['verifyCode', 'captcha', 'captchaAction' => '/user/captcha', 'message' => 'Неверно заполнено.'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'username' => 'Ваш логин',
            'img' => 'Аватарка',
            'email' => 'Почта',
            'password' => 'Пароль',
            'verifyCode' => 'Введите код с картинки',
            'type' => 'Тип',
        ];
    }

    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->status = User::STATUS_WAIT;
            $user->generateAuthKey();
            $user->generateEmailConfirmToken();
            $user->type = $this->type;
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
                $cropSizeThumb = new Box(450, 450);
                $cropPointThumb = new Point($cropInfo['x'], $cropInfo['y']);
                $pathThumbImage = Yii::$app->request->BaseUrl . 'images/' . '/thumb_' . $this->image;   

                $image->copy()
                    ->resize($newSizeThumb)
                    ->crop($cropPointThumb, $cropSizeThumb)
                    ->save($pathThumbImage, ['quality' => 100]);

                //saving original
                $this->img->saveAs(Yii::$app->request->BaseUrl . 'images/' . '/thumb_' . $this->image);
            }else{
                $this->image = "/images/no-user-image.png";
            }
            $user->image = $this->image;
 
            if ($user->save()) {
                Yii::$app->mailer->compose('confirmEmail', ['user' => $user])
                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                    ->setTo($this->email)
                    ->setSubject('Email confirmation for ' . Yii::$app->name)
                    ->send();
            }
 
            return $user;
        }
 
        return null;
    }
}