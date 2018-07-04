<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AutoTextItemSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auto-text-item-search">

    <?php
    
$form = ActiveForm::begin([
            'action' => [
                    'index'
            ],
            'method' => 'get'
    ]);
    ?>

    <?=$form->field($model, 'id')?>

    <?=$form->field($model, 'name')?>

    <?=$form->field($model, 'item_type')?>

    <div class="form-group">
        <?=Html::submitButton(Yii::t('app', 'Search'),['class' => 'btn btn-primary'])?>
        <?=Html::resetButton(Yii::t('app', 'Reset'),['class' => 'btn btn-default'])?>
    </div>

    <?php
    
ActiveForm::end();
    ?>

</div>