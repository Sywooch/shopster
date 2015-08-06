<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\UserCall;
use app\models\UserCallSearch;
use yii\data\ActiveDataProvider;

class DefaultController extends Controller
{
	public $layout = "@app/modules/admin/views/layouts/main";

	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionCalls(){
        $searchModel = new UserCallSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('calls', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionOkStatus($id){
        $call = UserCall::findOne($id);
        $call->status = 3;
        $call->save();
        return $this->redirect(['calls']);
    }
    public function actionTakeStatus($id){
        $call = UserCall::findOne($id);
        $call->status = 1;
        $call->save();
        return $this->redirect(['calls']);
    }
    public function actionProccessStatus($id){
        $call = UserCall::findOne($id);
        $call->status = 2;
        $call->save();
        return $this->redirect(['calls']);
    }
    public function actionPaidStatus($id){
        $call = UserCall::findOne($id);
        $call->paid_status = 1;
        $call->save();
        return $this->redirect(['calls']);
    }
    public function actionNopaidStatus($id){
        $call = UserCall::findOne($id);
        $call->paid_status = 0;
        $call->save();
        return $this->redirect(['calls']);
    }
    public function actionDelete($id){
        $call = UserCall::findOne($id);
        $call->delete();
        
        return $this->redirect(['index']);
    }
}
