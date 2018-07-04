<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserProfileSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-profile-search">

    <?php
    
    $form = ActiveForm::begin(
            [
                    'action' => [
                            'index'
                    ],
                    'method' => 'get'
            ]);
    ?>

    <?= $form->field($model, 'user_id')?>


	<?= $form->field($model, 'name')?>

    <?= $form->field($model, 'name_extension')?>

    <?= $form->field($model, 'nick_name')?>

    <?= $form->field($model, 'name_for_messages')?>

    <?php // echo $form->field($model, 'send_mail') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'send_phone') ?>

    <?php // echo $form->field($model, 'login_fails') ?>

    <?php // echo $form->field($model, 'last_login_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary'])?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default'])?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
