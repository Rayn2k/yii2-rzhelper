<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserHasPicture */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-has-pictures-form">

    <?php $form = ActiveForm::begin(); ?>

    
    <?php
    echo $form->field($model, 'user_id')->widget('dosamigos\formhelpers\Select', 
            [
                    'items' => $users,
                    'clientOptions' => [
                            'filter' => 'true'
                    ]
            ]);
    ?>
    
     <?php
    echo $form->field($model, 'picture_id')->widget('dosamigos\formhelpers\Select', 
            [
                    'items' => $pictures,
                    'clientOptions' => [
                            'filter' => 'true'
                    ]
            ]);
    ?>

   
      <?php
    echo $form->field($model, 'chosen_individual')->widget('dosamigos\formhelpers\Select', 
            [
                    'items' => $boolNames
            ]);
    ?>

    
       <?php
    echo $form->field($model, 'chosen_general')->widget('dosamigos\formhelpers\Select', 
            [
                    'items' => $boolNames
            ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
