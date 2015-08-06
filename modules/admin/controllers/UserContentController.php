<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\UserContent;
use app\models\UserContentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\components\UploadAction as FileAPIUpload;

/**
 * UserContentController implements the CRUD actions for UserContent model.
 */
class UserContentController extends Controller
{
    public $layout = "@app/modules/admin/views/layouts/main";
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'update', 'create', 'delete'],
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'update', 'create', 'delete'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'fileapi-upload' => [
                'class' => FileAPIUpload::className(),
                'path' => '@webroot/images/maps/'
            ]
        ];
    }

    /**
     * Lists all UserContent models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserContentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionTable()
    {
        $this->layout = "@app/modules/admin/views/layouts/table";
        $searchModel = new UserContentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('table', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserContent model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new UserContent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserContent();

        if ($model->load(Yii::$app->request->post()))
            $model->img = \yii\web\UploadedFile::getInstance($model, 'img');
            $model->banner_img = \yii\web\UploadedFile::getInstance($model, 'banner_img');
            $model->map_img = \yii\web\UploadedFile::getInstance($model, 'map_img');
            if($model->img)
                $model->image = uniqid().".".$model->img->getExtension();
            if($model->banner_img)
                $model->banner = uniqid().".".$model->banner_img->getExtension();
            if($model->map_img)
                $model->map = uniqid().".".$model->map_img->getExtension();

            if(isset($_POST['UserContent']['shops'])){
                $model->shops = json_encode($_POST['UserContent']['shops']);
            }

            if ($model->save()) {
                return $this->redirect(['index']);
            } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UserContent model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
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

            if(isset($_POST['UserContent']['shops'])){
                $model->shops = json_encode($_POST['UserContent']['shops']);
            }

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
    public function actionOkStatus($id){
        $model = UserContent::findOne($id);
        $model->status = 1;
        $model->changes = json_encode([]);
        $model->save();
        return $this->redirect(['index']);
    }
    public function actionNookStatus($id){
        $model = UserContent::findOne($id);
        $model->status = 0;
        $model->save();
        return $this->redirect(['index']);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    public function actionOk(){
        $action=Yii::$app->request->post('action');
        $selection=(array)Yii::$app->request->post('selection');//typecasting
        foreach($selection as $id){
            $e=UserContent::findOne((int)$id);//make a typecasting
            $e->status = 1;
            $e->save();
        }
        return $this->redirect(['table']);
    }
    public function actionImages($id){
        $photos = json_decode(UserContent::findOne($id)->maps, true);
        $out = "";
        if(!empty($photos))
            foreach ($photos as $key => $photo) {   
                $out = $out."<div class='col-md-3 thumbnail'>
                    <img class='img-responsive' src='/images/maps/".$photo."'>
                    <p>
                        Этаж - ".($key + 1)."
                        <input type='text' class='form-control' style='witdh:30px;' id='floor-".$key."'>
                    </p>
                    <div class='btn-group'>   
                        <a class='btn btn-primary stnwflr' id='".$key."' data-model='".$id."'>Изменить</a>
                        <a class='btn btn-danger dltbtn' id='".$key."' data-model='".$id."'>Удалить?</a>
                    </div>
                </div>";
            }
        echo $out;
    }
    public function actionDelimage($id,$model){
        $content = UserContent::findOne($model);
        $photos = json_decode($content->maps, true);
        unset($photos[$id]);
        $content->maps = json_encode($photos);
        $content->save();
        echo "success";
    }
    public function actionSetfloor($model, $old, $new){
        echo $model." ".$old." ".$new." ";
        $content = UserContent::findOne($model);
        $photos = json_decode($content->maps, true);
        $prev = $photos[$old];
        unset($photos[$old]);
        $photos[$new - 1] = $prev;
        $content->maps = json_encode($photos);
        $content->save();
        print_r($photos);
    }

    /**
     * Finds the UserContent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserContent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserContent::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
