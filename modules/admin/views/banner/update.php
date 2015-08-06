<?php

use yii\helpers\Html;

$this->title = 'Изменить баннер: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Баннер', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="banner-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
