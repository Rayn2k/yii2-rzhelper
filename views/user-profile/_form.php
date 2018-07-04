<?php
use app\models\User;
use rayn2k\rzhelper\UtilDate;
use rayn2k\rzhelper\UtilUI;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UserProfile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-profile-form">

<?php

if (! $model->isNewRecord) :
    ?>
	<div class="panel panel-default">
		<div class="panel-heading"><?=yii::t('app', "Basic Information")?></div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-4">
                    <?php
    /* @var $picture app\models\Picture */
    $picture = $model->getGeneralChosenPicture();
    echo Html::img($picture->getImagePath(), [
            'class' => 'width-100-percent'
    ]);
    ?>
              	</div>
				<div class="col-md-8">
                     <?php
    
    $attributes = array();
    
    if (User::hasPermission("access_all_user_data", false)) {
        $attributes[] = 'user_id';
        $attributes[] = [
                'attribute' => 'status',
                'value' => function ($model)
                {
                    return \webvimark\modules\UserManagement\models\User::getStatusList()[$model->status];
                }
        ];
        $attributes[] = [
                'attribute' => 'created_at',
                'value' => function ($model)
                {
                    $timestamp_utc = UtilDate::get_utc_datetime_from_long($model->created_at);
                    $timestamp_germany = UtilDate::set_to_timezone_germany($timestamp_utc);
                    
                    $day_name_short = UtilDate::get_day_name_short($timestamp_germany);
                    $date_formatted = UtilDate::get_formatted_date_german($timestamp_germany);
                    $time_formatted = UtilDate::get_formatted_time_german($timestamp_germany) . " " . yii::t('app', "o'clock");
                    
                    return $date_formatted . " (" . $day_name_short . "), " . $time_formatted;
                }
        ];
        $attributes[] = [
                'attribute' => 'updated_at',
                'value' => function ($model)
                {
                    $timestamp_utc = UtilDate::get_utc_datetime_from_long($model->updated_at);
                    $timestamp_germany = UtilDate::set_to_timezone_germany($timestamp_utc);
                    
                    $day_name_short = UtilDate::get_day_name_short($timestamp_germany);
                    $date_formatted = UtilDate::get_formatted_date_german($timestamp_germany);
                    $time_formatted = UtilDate::get_formatted_time_german($timestamp_germany) . " " . yii::t('app', "o'clock");
                    
                    return $date_formatted . " (" . $day_name_short . "), " . $time_formatted;
                }
        ];
    }
    
    $attributes[] = [
            'attribute' => 'last_login_at',
            'value' => function ($model)
            {
                $timestamp_utc = UtilDate::sqlstring_to_datetime_utc($model->last_login_at);
                $timestamp_germany = UtilDate::set_to_timezone_germany($timestamp_utc);
                
                $day_name_short = UtilDate::get_day_name_short($timestamp_germany);
                $date_formatted = UtilDate::get_formatted_date_german($timestamp_germany);
                $time_formatted = UtilDate::get_formatted_time_german($timestamp_germany) . " " . yii::t('app', "o'clock");
                
                return $date_formatted . " (" . $day_name_short . "), " . $time_formatted;
            }
    ];
    $attributes[] = 'login_fails';
    
    if (User::hasPermission("access_all_user_data", false)) {
        $attributes[] = 'auth_key';
        $attributes[] = 'confirmation_token';
        $attributes[] = 'registration_ip';
        $attributes[] = 'bind_to_ip';
    }
    
    echo DetailView::widget([
            'model' => $model,
            'attributes' => $attributes
    ])?>
              	</div>

			</div>

		</div>
	</div>
<?php endif;

?>

	<?php

$form = ActiveForm::begin();

?>
	
	
	<div class="panel panel-default">
		<div class="panel-heading"><?=yii::t('app', "Name attributes")?></div>
		<div class="panel-body">
					
                <?php
                if (User::hasPermission("access_all_user_data", false)) {
                    echo $form->field($model, 'name')->textInput();
                    echo $form->field($model, 'name_extension')->textInput();
                    echo $form->field($model, 'nick_name')->textInput();
                    echo $form->field($model, 'name_for_messages')->textInput();
                } else {
                    echo DetailView::widget(
                            [
                                    'model' => $model,
                                    'attributes' => [
                                            'name',
                                            'name_extension',
                                            'nick_name'
                                    ]
                            ]);
                }
                ?>       
  		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading"><?=yii::t('app', "Login attributes")?></div>
		<div class="panel-body">
				
				 
				 <?php
    
    // if (User::hasPermission("access_all_user_data", false)) {
    echo $form->field($model, 'username', [
            'enableAjaxValidation' => true
    ])->textInput();
    // } else {
    // $attributes = array();
    // $attributes[] = 'username';
    
    // echo DetailView::widget([
    // 'model' => $model,
    // 'attributes' => $attributes
    // ]);
    // }
    
    if ($model->isNewRecord) :
        ?>
            		<?=$form->field($model,'password')->passwordInput(['maxlength' => 255,'autocomplete' => 'off'])?>            
            		<?=$form->field($model,'repeat_password')->passwordInput(['maxlength' => 255,'autocomplete' => 'off'])?>
            	<?php endif;
    
    ?>
  		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading"><?=yii::t('app', "Other attributes")?></div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-2">
                    <?=UtilUI::getYesNoSelectDropDown($form, $model,'send_mail')?>
              	</div>
				<div class="col-md-4">
                    <?=$form->field($model, 'email')->textInput()?>
              	</div>
				<div class="col-md-1"></div>
				<div class="col-md-2">
                     <?=UtilUI::getYesNoSelectDropDown($form, $model,'send_phone')?>
              	</div>
				<div class="col-md-3">
                    <?=$form->field($model, 'phone')->textInput()?>
              	</div>
			</div>
		</div>
	</div>

	<div class="form-group">
        <?=Html::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save'),['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])?>
    </div>

    <?php
    
    ActiveForm::end();
    ?>

</div>
