<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Config */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="config-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'config_key')->textarea(['rows' => 1])?>

    <?= $form->field($model, 'description')->textarea(['rows' => 1])?>

    <?= $form->field($model, 'possible_values')->textarea(['rows' => 1])?>

    <?= $form->field($model, 'default')->textarea(['rows' => 1])?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
