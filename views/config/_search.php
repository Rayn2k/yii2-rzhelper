<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ConfigSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="config-search">

    <?php
    
    $form = ActiveForm::begin(
            [
                    'action' => [
                            'index'
                    ],
                    'method' => 'get'
            ]);
    ?>

    
    <?= $form->field($model, 'config_key')?>

    <?= $form->field($model, 'description')?>

    <?= $form->field($model, 'possible_values')?>

    <?= $form->field($model, 'default')?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary'])?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default'])?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
