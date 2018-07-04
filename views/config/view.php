<?php
use rayn2k\rzhelper\UtilUI;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Config */

$this->title = $model->config_key;

?>
<div class="config-view">

	<h1><?=Html::encode($this->title)?></h1> 
	<h3><?=$model->description?></h3>

	<div class="button-bar">
		<?=UtilUI::getButtonDiv(Html::a(Yii::t('app','Create Config'),['create'],['class' => 'btn btn-success']))?>
		<?=UtilUI::getButtonDiv(Html::a(Yii::t('app','Configuration for Instance'),['/instance-has-config/index'],['class' => 'btn btn-success']))?>		
    </div>

    <?php
    echo DetailView::widget(
            [
                    'model' => $model,
                    'attributes' => [
                            'config_key:ntext',
                            'description:ntext',
                            'possible_values:ntext',
                            'default:ntext'
                    ]
            ])?>

</div>
