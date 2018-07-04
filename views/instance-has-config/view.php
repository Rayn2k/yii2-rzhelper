<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use rayn2k\rzhelper\UtilUI;

/* @var $this yii\web\View */
/* @var $model app\models\InstanceHasConfig */

/* @var $config app\models\config */
$config = $model->getConfig()->one();

$this->title = $config->config_key;

?>
<div class="instances-has-configs-view">

	<h1><?= Html::encode($this->title) ?></h1>
	<h3><?= $config->description ?></h3>

	<div class="button-bar">
		<?= UtilUI::getButtonDiv(Html::a(Yii::t('app', 'Update'), ['update', 'key' => $model->config_key], ['class' => 'btn btn-primary']))?>
        <?= UtilUI::getButtonDiv(Html::a(Yii::t('app', 'Delete'), ['delete','id' => $model->id], ['class' => 'btn btn-danger','data' => ['confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),'method' => 'post']]))?>
        <?= UtilUI::getButtonDiv(Html::a(Yii::t('app', 'Configuration for Instance'), ['/instance-has-config/index'], ['class' => 'btn btn-success']))?>	
    </div>


    <?=DetailView::widget(['model' => $model,'attributes' => ['id','instance_id','config_key','value:ntext']])?>

</div>
