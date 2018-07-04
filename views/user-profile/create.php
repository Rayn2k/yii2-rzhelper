<?php
use yii\helpers\Html;
use rayn2k\rzhelper\UtilUI;

/* @var $this yii\web\View */
/* @var $model app\models\UserProfile */

$this->title = Yii::t('app', 'Create User Profile');
$this->params['breadcrumbs'][] = [
        'label' => Yii::t('app', 'User Profiles'),
        'url' => [
                'index'
        ]
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-profile-create">

	<h1><?= Html::encode($this->title) ?></h1>

	<div class="button-bar">
		<?= UtilUI::getButtonDiv(Html::a(Yii::t('app', 'Create'), ['create', 'id' => $model->user_id], ['class' => 'btn btn-success']))?>	 		 	
    </div>

    <?=$this->render('_form', ['model' => $model])?>

</div>
