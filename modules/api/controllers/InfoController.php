<?php

namespace app\modules\api\controllers;

use app\models\City;
use app\models\Category;
use app\models\ShopCategory;
use app\models\Banner;
use yii\web\Response;

class InfoController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	$this->enableCsrfValidation = false;

    	$cities = City::find()->all();
    	$categories = Category::find()->all();
    	$res = [];
        $banners = Banner::find()->where(['status' => 1])->orderBy('created_at DESC')->all();
    	foreach ($cities as $city) {
    		$res['cities'][] = ['id' => $city->id, 'name' => $city->name];
    	}
    	foreach ($categories as $category) {
    		$res['categories'][] = ['id' => $category->id, 'name' => $category->name];
    	}
        foreach ($banners as $banner) {
            $res['banners'][] = ['id' => $banner->id, 'category' => $banner->category, 'image' => $banner->imageurl, 'link' => $banner->link];
        }
        $cats = ShopCategory::find()->where(['status' => 1])->all();
        foreach ($cats as $cat) {
            $res['shop_categories'][] = ['id' => $cat->id, 'name' => $cat->name];
        }
    	$res = json_encode($res);
    	echo $res;
    }

}
