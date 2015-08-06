<?php

namespace app\controllers;

use Yii;
use app\models\UserContent;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\UserCall;
use app\models\Promo;
use yii\helpers\ArrayHelper;
use app\components\UploadAction as FileAPIUpload;

class ShopController extends Controller
{
    public function actions()
    {
        return [
            'fileapi-upload' => [
                'class' => FileAPIUpload::className(),
                'path' => '@webroot/images/maps/'
            ]
        ];
    }
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => UserContent::find()->where(['user_id' => Yii::$app->user->identity->id]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())){
            $model->img = \yii\web\UploadedFile::getInstance($model, 'img');
            $model->banner_img = \yii\web\UploadedFile::getInstance($model, 'banner_img');
            $model->map_img = \yii\web\UploadedFile::getInstance($model, 'map_img');
            if($model->img)
                $model->image = uniqid().".".$model->img->getExtension();
            if($model->banner_img)
                $model->banner = uniqid().".".$model->banner_img->getExtension();
            if($model->map_img)
                $model->map = uniqid().".".$model->map_img->getExtension();
            
            $model->status = 0;
            $olds = $model->oldAttributes;
            if($model->changes)
                $res = json_decode($model->changes, true);
            else $res = [];
            foreach ($olds as $key => $old) {
                    if($old != $model[$key]){
                        $res[$key] = $old;
                    }
                }
                $model->changes = json_encode($res);
            if ($model->save()) {
                return $this->redirect(['index']);
            }
            else{ 
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    public function actionCallBack(){
        $usercall = new UserCall();
        $usercall->user_id = Yii::$app->user->identity->id;
        $usercall->status = 0;
        $usercall->type = 1;
        $usercall->paid_status = 2;
        $usercall->text = "Прошу добавить вас новый магазин";
        $usercall->save();
        Yii::$app->getSession()->setFlash('success', 'Вы отправили запрос, Ждите ответа модератора.');
        return $this->redirect(['index']);
    }
    public function actionCallFeature($id){
        $usercall = new UserCall();
        $usercall->user_id = Yii::$app->user->identity->id;
        $usercall->status = 0;
        $usercall->type = 2;
        $usercall->paid_status = 0;
        $usercall->text = "Прошу вас добавить расширенные услуги";
        $usercall->user_content_id = $id;
        $usercall->save();
        Yii::$app->getSession()->setFlash('success', 'Вы отправили запрос, Ждите ответа модератора.');
        return $this->redirect(['index']);
    }
    public function actionCallPromo($id){
        $usercall = new UserCall();
        $userContent = UserContent::findOne($id);
        $usercall->user_id = Yii::$app->user->identity->id;
        $usercall->status = 0;
        $usercall->type = 3;
        $usercall->paid_status = 0;
        $usercall->text = "Прошу вас добавить акцию к магазину ".$userContent->name;
        $usercall->user_content_id = $id;
        $usercall->save();
        Yii::$app->getSession()->setFlash('success', 'Вы отправили запрос, Ждите ответа модератора.');
        return $this->redirect(['index']);
    }
    public function actionFeature($id){
        $content = UserContent::findOne($id);
        $call = UserCall::find()->where(['user_id' => Yii::$app->user->identity->id, 'type' => 2, 'user_content_id' => $id])->one();
        if(empty($call)){
            return $this->render('request', ['id' => $id]);
        }else{
            if($call->paid_status == 0){
                return $this->render('request', ['id' => $id]);
            }
            else{
                if ($content->load(Yii::$app->request->post())){
                    $content->img = \yii\web\UploadedFile::getInstance($content, 'img');
                    $content->banner_img = \yii\web\UploadedFile::getInstance($content, 'banner_img');
                    $content->map_img = \yii\web\UploadedFile::getInstance($content, 'map_img');
                    if($content->img)
                        $content->image = uniqid().".".$content->img->getExtension();
                    if($content->banner_img)
                        $content->banner = uniqid().".".$content->banner_img->getExtension();
                    if($content->map_img)
                        $content->map = uniqid().".".$content->map_img->getExtension();

                    $content->status = 0;
                    $olds = $content->oldAttributes;
                    if($model->changes)
                        $res = json_decode($model->changes, true);
                    else $res = [];
                    foreach ($olds as $key => $old) {
                            if($old != $content[$key]){
                                $res[$key] = $old;
                            }
                        }
                    $content->changes = json_encode($res);
                    if ($content->save()) {
                        return $this->redirect(['index']);
                    }
                    else{ 
                        return $this->render('shopupdate', [
                            'model' => $content,
                        ]);
                    }
                } else {
                    return $this->render('shopupdate', [
                        'model' => $content,
                    ]);
                }
            }
        }
    }
    public function actionAction($id){
        $promo = Promo::find()->where(['content_id' => $id])->one();
        $call = UserCall::find()->where(['user_id' => Yii::$app->user->identity->id, 'type' => 3, 'user_content_id' => $id])->one();
        if(empty($call)){
            return $this->render('request_promo', ['id' => $id]);
        }else{
            if($call->paid_status == 0){
                return $this->render('request', ['id' => $id]);
            }
            else{
                if ($promo->load(Yii::$app->request->post())){
                    $promo->img = \yii\web\UploadedFile::getInstance($promo, 'img');
                    if($promo->img)
                        $promo->image = uniqid().".".$promo->img->getExtension();

                    $promo->status = 0;
                    if ($promo->save()) {
                        return $this->redirect(['index']);
                    }
                    else{ 
                        return $this->render('promoupdate', [
                            'model' => $promo,
                        ]);
                    }
                } else {
                    return $this->render('promoupdate', [
                        'model' => $promo,
                    ]);
                }
            }
        }
    }
    public function actionPay($id){
        $content = UserContent::findOne($id);
        return $this->render('paid', ['model' => $content]);
    }
    public function actionAdd($id){
        $content = UserContent::findOne($id);
        if($content->category_id == 1)
            $data = ArrayHelper::map(UserContent::find()->where(['category_id' => 2])->all(), 'id', 'title');
        if($content->category_id == 2)
            $data = ArrayHelper::map(UserContent::find()->where(['category_id' => 1])->all(), 'id', 'title');

        if ($content->load(Yii::$app->request->post())){
            $content->img = \yii\web\UploadedFile::getInstance($content, 'img');
            if($content->img)
                $content->image = uniqid().".".$content->img->getExtension();

            if(isset($_POST['UserContent']['shops'])){
                $content->shops = json_encode($_POST['UserContent']['shops']);
            }

            $content->status = 0;
            $olds = $content->oldAttributes;
            if($model->changes)
                $res = json_decode($model->changes, true);
            else $res = [];
            foreach ($olds as $key => $old) {
                    if($old != $content[$key]){
                        $res[$key] = $old;
                    }
                }
            $content->changes = json_encode($res);

            if ($content->save()) {
                return $this->redirect(['index']);
            }
            else{ 
                return $this->render('add', [
                    'model' => $content,
                    'data' => $data,
                ]);
            }
        } else {
            return $this->render('add', [
                'model' => $content,
                'data' => $data,
            ]);
        }
        return $this->render('add', ['model' => $content]);
    }
    public function actionGeo($id){
        $content = UserContent::findOne($id);
        if ($content->load(Yii::$app->request->post())){

            $content->map_img = \yii\web\UploadedFile::getInstance($content, 'map_img');
            if($content->map_img)
                $content->map = uniqid().".".$content->map_img->getExtension();
            
            $content->status = 0;
            $olds = $content->oldAttributes;
            if($model->changes)
                $res = json_decode($model->changes, true);
            else $res = [];
            foreach ($olds as $key => $old) {
                    if($old != $content[$key]){
                        $res[$key] = $old;
                    }
                }
            $content->changes = json_encode($res);

            if ($content->save()) {
                return $this->redirect(['index']);
            }
            else{ 
                return $this->render('geo', [
                    'model' => $content,
                ]);
            }
        } else {
            return $this->render('geo', [
                'model' => $content,
            ]);
        }
        return $this->render('geo', ['model' => $content]);
    }
    protected function findModel($id)
    {
        if (($model = UserContent::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
