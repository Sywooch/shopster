<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Магазины', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-content-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <div class="col-md-offset-4" style="background:url('/images/frame.png') no-repeat; font-size:10px;">
        <div style="width:250px;height:510px;">
            <div class="col-md-12" style="margin-top: 55px;margin-left: 5px;height: 380px;width: 246px;overflow-y: scroll;overflow-x: hidden;">
                <div style="height:40px;background-color:#f56954;">
                    <h3 align="center"> <?=$model->title?> </h3>
                </div>
                <img src="<?=$model->bannerurl?>">
                <img src="<?=$model->imageurl?>" class="img-circle" style="margin-top: -35px;width: 100px;margin-left: 55px;">
                <h5 align="center"> <?=$model->title?> </h5>
                <p align="center"><?=$model->description?></p>
                <table class="table table-condensed">
                <tr>
                    <td align="left">Позвонить</td> <td align="right"><?=$model->phone?></td>
                </tr>
                <tr>
                    <td align="left">Сайт</td> <td align="right"><?=$model->website?></td>
                </tr>
                <tr>
                    <td align="left">Время работы</td> <td align="right"><?=$model->working_hours?></td>
                </tr>
                </table>
            </div>
        </div>
    </div>

</div>
