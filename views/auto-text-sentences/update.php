<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AutoTextSentences */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Auto Text Sentences',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Auto Text Sentences'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="auto-text-sentences-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
