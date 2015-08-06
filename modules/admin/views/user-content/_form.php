<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\User;
use app\models\Category;
use app\models\ShopCategory;
use app\models\City;
use bupy7\cropbox\Cropbox;
use kartik\select2\Select2;
use dosamigos\selectize\SelectizeDropDownList;
use app\models\UserContent;
use vova07\fileapi\Widget as FileAPI;

$model->shops = json_decode($model->shops);

?>

<div class="user-content-form">

    <?php $form = ActiveForm::begin([
         'options' => ['enctype'=>'multipart/form-data'],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?= $form->field($model, 'user_id')->dropDownList(ArrayHelper::map(User::find()->all(), 'id', 'username')) ?>

    <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(Category::find()->where(['status' => 1])->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'shop_category_id')->dropDownList(ArrayHelper::map(ShopCategory::find()->where(['status' => 1])->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'city_id')->dropDownList(ArrayHelper::map(City::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?php echo $form->field($model, 'img')->widget(Cropbox::className(), [
        'attributeCropInfo' => 'crop_info',
        'optionsCropbox' => [
            'boxWidth' => 600,
            'boxHeight' => 600,
            'cropSettings' => [
                [
                    'width' => 450,
                    'height' => 300,
                ],
            ],
        ],
        'previewUrl' => [
            $model->imageurl
        ],
        'originalUrl' => '/images/' . $model->image, 
    ]); ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '+7 (999) 99-99-999']) ?>

    <?php echo $form->field($model, 'banner_img')->widget(Cropbox::className(), [
        'attributeCropInfo' => 'banner_crop_info',
        'optionsCropbox' => [
            'boxWidth' => 600,
            'boxHeight' => 600,
            'cropSettings' => [
                [
                    'width' => 450,
                    'height' => 300,
                ],
            ],
        ],
        'previewUrl' => [
            $model->bannerurl,
        ],
        'originalUrl' => '/images/' . $model->banner, 
    ]); ?>

    <?= $form->field($model, 'website')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'working_hours')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'status')->checkbox() ?>

    <?= $form->field($model, 'shops')->widget(\dosamigos\selectize\SelectizeDropDownList::className(), [
        'items' => ArrayHelper::map(UserContent::find()->all(), 'id', 'title'),
        'options' => ['class' => 'form-control', 'multiple' => true],
        'clientOptions' => [
            'plugins' => ['remove_button'],
            'valueField' => 'id',
            'labelField' => 'name',
            'searchField' => ['name'],
            'create' => false,
        ],
    ]); ?>

    <script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>

    Местоположение: <input type="text" id="us2-address" style="width: 200px"/>

    <?= $form->field($model, 'latitude')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'longitude')->textInput(['maxlength' => 255]) ?>
    
    <div id="us2" style="height: 600px; margin-top:40px;" class="col-md-12"></div>

    <?php echo $form->field($model, 'map_img')->widget(Cropbox::className(), [
        'attributeCropInfo' => 'map_crop_info',
        'optionsCropbox' => [
            'boxWidth' => 600,
            'boxHeight' => 600,
            'cropSettings' => [
                [
                    'width' => 450,
                    'height' => 300,
                ],
            ],
        ],
        'previewUrl' => [
            $model->mapUrl
        ],
        'originalUrl' => '/images/' . $model->img_map, 
    ]); ?>
    <?php 
        echo $form->field($model, 'preview_url')->widget(
            FileAPI::className(),
            [
                'settings' => [
                    'autoUpload' => true,
                    'url' => Url::to(['/admin/user-content/fileapi-upload/', 'model' => $model->id]),
                ],
                'jcropSettings' => [
                    'aspectRatio' => 1,
                    'bgColor' => '#ffffff',
                    'maxSize' => [1200, 1200],
                    'minSize' => [50, 50],
                    'keySupport' => false, // Important param to hide jCrop radio button.
                    'selection' => '100%'
                ],
                'preview' => false,
                'crop' => true,
            ]
        );
    ?>
    <div id="gallery" class="col-md-12">
            
    </div>
    <!-- <div class="inputs">
        
    </div> -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php $lat = 43.2220146; $lon = 76.8512485; if($model->latitude || $model->longitude) {$lat = $model->latitude; $lon = $model->longitude;} ?>
<?php $this->registerJs("
    $('#us2').locationpicker({
    location: {latitude: ".$lat.", longitude: ".$lon."},    
    radius: 100,
    enableAutocomplete: true,
    inputBinding: {
        latitudeInput: $('#usercontent-latitude'),
        longitudeInput: $('#usercontent-longitude'),
        radiusInput: $('#us2-radius'),
        locationNameInput: $('#us2-address')
    }
    });
    // $('.crop').on('click', function(){
    //     var floor = $('#floor').val();
    //     $(\"<input type='hidden' value=\" + floor + \" name='floors[]'>\").appendTo(\" .inputs \");
    //     console.log($('#floor').val());
    // });
  ", \yii\web\View::POS_END, 'my-share');
?>
<?php 
$this->registerJs('
    $(document).ready(function(){
        function getImages(){
            $.ajax({
              type: "GET",
              url: "/admin/user-content/images/?id='.$model->id.'",
              success: function(data){
                $("#gallery").html(data);
                $(".dltbtn").click(function(){
                    $.ajax({
                        type: "GET",
                        url: "/admin/user-content/delimage/?id=" + $(this).attr("id") + "&model=" + "'.$model->id.'",
                        success: function(data){
                            getImages();
                        }
                    });
                });
                $(".stnwflr").click(function(){
                    var a = $("#floor-" + $(this).attr("id")).val();
                    console.log($("#floor-" + $(this).attr("id")).val());
                    $.ajax({
                        type: "GET",
                        url: "/admin/user-content/setfloor/?old=" + $(this).attr("id") + "&model=" + "'.$model->id.'" + "&new=" + a,
                        success: function(data){
                            getImages();
                        }
                    });
                });
              }
            });
        }
        getImages();   
        $(".crop").click(function(){
            setTimeout(function(){ 
                getImages();
                $(".browse-text").next().text("Загрузить дальше");
            }, 5000);
        });
    });
', \yii\web\View::POS_END);
?>
