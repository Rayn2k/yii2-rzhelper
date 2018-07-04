<?php
use rayn2k\rzhelper\UtilUI;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/**
 *
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\User $model
 * @var app\models\UserProfile $user_profile
 */

$this->title = Yii::t('app', 'Change password for') . ": " . $user_profile->name;

if (! is_null($user_profile->nick_name) && $user_profile->nick_name != "") {
    $this->title .= ' (' . $user_profile->nick_name . ')';
}
?>
<div class="user-profile-update">

	<h1><?=Html::encode($this->title)?></h1>
	
	<?php

$form = ActiveForm::begin([
        'id' => 'user',
        'layout' => 'horizontal'
]);
?>
	
	<div class="button-bar">
	 	<?php

// BUTTON BAR
echo UtilUI::getButtonDiv(Html::submitButton(Yii::t('app', 'Save'), [
        'class' => 'btn btn-primary'
]));

echo UtilUI::getButtonDiv(
        Html::a(Yii::t('app', 'Back to View'), [
                'view',
                'id' => $user_profile->user_id
        ], [
                'class' => 'btn btn-success'
        ]));

?>

    </div>
	
	<div class="panel panel-default">
			<div class="panel-heading"><?=$this->title?></div>
		<div class="panel-body">


				

				<?=$form->field($model, 'password')->passwordInput(['maxlength' => 255,'autocomplete' => 'off'])?>

				<?=$form->field($model,'repeat_password')->passwordInput(['maxlength' => 255,'autocomplete' => 'off'])?>


				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-9">
						<?php
    
    if ($model->isNewRecord) :
        ?>
							<?=Html::submitButton(Yii::t('app', 'Save'),['class' => 'btn btn-success'])?>
						<?php
    
    else :
        ?>
							<?=Html::submitButton(Yii::t('app', 'Save'),['class' => 'btn btn-primary'])?>
						<?php
    
    endif;
    ?>
					</div>
				</div>

				<?php
    
    ActiveForm::end();
    ?>

			
		</div>
	</div>

</div>
