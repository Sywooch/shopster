<?php

use yii\helpers\Html;

$this->title = 'Управление содержанием: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Мои магазины', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="user-content-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
