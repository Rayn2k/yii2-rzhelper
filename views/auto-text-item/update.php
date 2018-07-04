<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AutoTextItem */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Auto Text Item',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Auto Text Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="auto-text-item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
