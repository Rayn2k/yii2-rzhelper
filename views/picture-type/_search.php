<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PictureTypeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="PictureType-search">

    <?php
    
$form = ActiveForm::begin([
            'action' => [
                    'index'
            ],
            'method' => 'get'
    ]);
    ?>

    <?= $form->field($model, 'picture_type_id')?>

    <?= $form->field($model, 'class_name')?>

    <?= $form->field($model, 'folder')?>

    <?= $form->field($model, 'has_fixed_resolution')?>

    <?= $form->field($model, 'width')?>

    <?php // echo $form->field($model, 'height') ?>

    <?php // echo $form->field($model, 'possible_formats') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary'])?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default'])?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
