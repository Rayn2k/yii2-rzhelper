<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\InstanceHasConfig */

$this->title = Yii::t('app', 'Create Instances Has Configs');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Instances Has Configs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="instances-has-configs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
