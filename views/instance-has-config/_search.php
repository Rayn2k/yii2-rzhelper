<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\InstanceHasConfigSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="instances-has-configs-search">

    <?php
    
$form = ActiveForm::begin([
            'action' => [
                    'index'
            ],
            'method' => 'get'
    ]);
    ?>

    <?= $form->field($model, 'id')?>

    <?= $form->field($model, 'instance_id')?>

    <?= $form->field($model, 'config_key')?>

    <?= $form->field($model, 'value')?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary'])?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default'])?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
