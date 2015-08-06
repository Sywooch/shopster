<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\UserContent */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Магазины', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-content-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="changes">
        <?php 
            $attributes = json_decode($model->changes);
            if(!empty($attributes)):
        ?>
            <h2>
                Изминения
            </h2>
            <table class="table table-condensed table-hover table-bordered table-striped">
                <tr>
                    <td>Изменилось поле</td> <td>Изменилось на</td>
                </tr>
                <?php foreach ($attributes as $key => $value) {?>
                    <tr>
                        <?php if($key == 'status') continue;?>
                        <td><?=$model->getAttributeLabel($key)?></td>
                        <td><?=$value?></td>
                    </tr>
                <?php } ?>
            </table>
            <a href="<?=Url::to(['/admin/user-content/ok-status', 'id' => $model->id])?>" class="btn btn-success">
                Одобрить
            </a>
        <?php endif; ?>
    </div>

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
