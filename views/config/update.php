<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Config */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
        'modelClass' => 'Config'
]) . ' ' . $model->config_key;

?>
<div class="config-update">

	<h1><?= Html::encode($this->title) ?></h1>

    <?=$this->render('_form', ['model' => $model])?>

</div>
