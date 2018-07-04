<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AutoTextItem */

$this->title = Yii::t('app', 'Create Auto Text Item');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Auto Text Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auto-text-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
