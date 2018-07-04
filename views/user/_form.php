<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */

$user_profile = $model->getUserProfile();
?>

<div class="user-form">

    <?php
    $form = ActiveForm::begin();
    
    if ($model->hasPermission('access_all_user_data', false)) {
        echo $form->field($model, 'auth_key')->textInput([
                'maxlength' => true
        ]);
        
        echo $form->field($model, 'password_hash')->textInput([
                'maxlength' => true
        ]);
        
        echo $form->field($model, 'confirmation_token')->textInput([
                'maxlength' => true
        ]);
        
        echo $form->field($model, 'status')->textInput();
        
        echo $form->field($model, 'superadmin')->textInput();
        
        echo $form->field($model, 'created_at')->textInput();
        
        echo $form->field($model, 'updated_at')->textInput();
        
        echo $form->field($model, 'registration_ip')->textInput([
                'maxlength' => true
        ]);
        
        echo $form->field($model, 'bind_to_ip')->textInput([
                'maxlength' => true
        ]);
        
        echo $form->field($model, 'email_confirmed')->textInput();
    }
    ?>
    

    <?= $form->field($model, 'username')->textInput(['maxlength' => true])?>
    
    <?= $form->field($model, 'email')->textInput(['maxlength' => true])?>

 	<?= $form->field($model, 'phone')->textarea(['rows' => 1])?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
