<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PictureType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="PictureType-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'class_name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'folder')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'has_fixed_resolution')->textInput() ?>

    <?= $form->field($model, 'width')->textInput() ?>

    <?= $form->field($model, 'height')->textInput() ?>

    <?= $form->field($model, 'possible_formats')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
