<?php
use app\models\User;
use rayn2k\rzhelper\UtilUI;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserProfile */

$this->title = Yii::t('app', 'Update') . " " . Yii::t('app', 'User Profile') . ": " . $model->name;

?>
<div class="user-profile-update">

	<h1><?=Html::encode($this->title)?></h1>

	<div class="button-bar">
		<?php
echo UtilUI::getButtonDiv(
        Html::a(Yii::t('app', 'Save'), [
                'update',
                'id' => $model->user_id
        ], [
                'class' => 'btn btn-primary'
        ]));

echo UtilUI::getButtonDiv(
        Html::a(Yii::t('app', 'Back to View'), [
                'view',
                'id' => $model->user_id
        ], [
                'class' => 'btn btn-success'
        ]));

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
            Html::a(Yii::t('app', 'Delete'),
                    [
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

    <?=$this->render('_form', ['model' => $model])?>

</div>
