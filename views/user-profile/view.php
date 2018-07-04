<?php
use app\models\User;
use rayn2k\rzhelper\UtilDate;
use rayn2k\rzhelper\UtilUI;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UserProfile */

$this->title = Yii::t('app', 'User Profile') . ": " . $model->name;

?>
<div class="user-profile-view">

	<h1><?=Html::encode($this->title)?></h1>

	<div class="button-bar">
	 	<?php
// BUTTON BAR
if (User::hasPermission("access_own_user_data", false)) {
    echo UtilUI::getButtonDiv(
            Html::a(Yii::t('app', 'Update'), [
                    'update',
                    'id' => $model->user_id
            ], [
                    'class' => 'btn btn-success'
            ]));
}

if (User::hasPermission("change_own_password", false)) {
    echo UtilUI::getButtonDiv(
            Html::a(Yii::t('app', 'Change Password'),
                    [
                            'change-password',
                            'id' => $model->user_id
                    ], [
                            'class' => 'btn btn-success'
                    ]));
}

if (User::hasPermission("access_all_user_data", false)) {
    echo UtilUI::getButtonDiv(
            Html::a(Yii::t('app', 'Delete'), [
                    'delete',
                    'id' => $model->user_id
            ],
                    [
                            'class' => 'btn btn-danger',
                            'data' => [
                                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                    'method' => 'post'
                            ]
                    ]));
}
?>

    </div>

	<div class="panel panel-default">
		<div class="panel-heading"><?=yii::t('app', "Basic Information")?></div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-4">
                    <?php
                    /* @var $picture app\models\Picture */
                    $picture = $model->getGeneralChosenPicture();
                    echo Html::img($picture->getImagePath(),
                            [
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
                                    $time_formatted = UtilDate::get_formatted_time_german($timestamp_germany) . " " .
                                             yii::t('app', "o'clock");
                                    
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
                                    $time_formatted = UtilDate::get_formatted_time_german($timestamp_germany) . " " .
                                             yii::t('app', "o'clock");
                                    
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
                        $attributes[] = 'password_hash';
                        $attributes[] = 'registration_ip';
                        $attributes[] = 'bind_to_ip';
                    }
                    
                    echo DetailView::widget(
                            [
                                    'model' => $model,
                                    'attributes' => $attributes
                            ])?>
              	</div>
			</div>
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading"><?=yii::t('app', "Name attributes")?></div>
		<div class="panel-body">
					
                <?php
                $attributes = array();
                
                if (User::hasPermission("access_all_user_data", false)) {
                    $attributes[] = 'name';
                    $attributes[] = 'name_extension';
                    $attributes[] = 'nick_name';
                    $attributes[] = 'name_for_messages';
                } else {
                    $attributes[] = 'name';
                    $attributes[] = 'nick_name';
                }
                
                echo DetailView::widget(
                        [
                                'model' => $model,
                                'attributes' => $attributes
                        ]);
                ?>       
  		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading"><?=yii::t('app', "Login attributes")?></div>
		<div class="panel-body">		
				<?php
    $attributes = array();
    
    if (User::hasPermission("access_all_user_data", false)) {
        $attributes[] = 'username';
    } else {
        $attributes[] = 'username';
    }
    
    echo DetailView::widget([
            'model' => $model,
            'attributes' => $attributes
    ]);
    ?>     
  		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading"><?=yii::t('app', "Other attributes")?></div>
		<div class="panel-body">
		
		  <?php
    $attributes = array();
    
    $attributes[] = 'send_mail:boolean';
    $attributes[] = 'email';
    $attributes[] = 'send_phone:boolean';
    $attributes[] = 'phone';
    
    echo DetailView::widget([
            'model' => $model,
            'attributes' => $attributes
    ]);
    ?>    
				
		</div>
	</div>

</div>