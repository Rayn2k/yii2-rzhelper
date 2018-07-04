<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PictureType */

$this->title = Yii::t('app', 'Create PictureType');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'PictureTypes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="PictureType-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
