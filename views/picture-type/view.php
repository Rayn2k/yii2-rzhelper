<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PictureType */

$this->title = $model->class_name;
$this->params['breadcrumbs'][] = [
        'label' => Yii::t('app', 'PictureTypes'),
        'url' => [
                'index'
        ]
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="PictureType-view">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->picture_type_id], ['class' => 'btn btn-primary'])?>
        <?=Html::a(Yii::t('app', 'Delete'), ['delete','id' => $model->picture_type_id], ['class' => 'btn btn-danger','data' => ['confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),'method' => 'post']])?>
    </p>

    <?=DetailView::widget(['model' => $model,'attributes' => ['picture_type_id','class_name:ntext','folder:ntext','has_fixed_resolution','width','height','possible_formats:ntext']])?>

</div>
