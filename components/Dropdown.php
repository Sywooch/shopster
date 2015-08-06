<?php
namespace app\components;

use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Widget;

class Dropdown extends \yii\bootstrap\Dropdown
{
    public function init()
    {
        parent::init();
        Html::addCssClass($this->options, 'treeview-menu');
    }
}