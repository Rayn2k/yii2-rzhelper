<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PictureType */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
        'modelClass' => 'PictureType'
]) . ' ' . $model->class_name;
$this->params['breadcrumbs'][] = [
        'label' => Yii::t('app', 'PictureTypes'),
        'url' => [
                'index'
        ]
];
$this->params['breadcrumbs'][] = [
        'label' => $model->class_name,
        'url' => [
                'view',
                'id' => $model->picture_type_id
        ]
];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="PictureType-update">

	<h1><?= Html::encode($this->title) ?></h1>

    <?=$this->render('_form', ['model' => $model])?>

</div>
