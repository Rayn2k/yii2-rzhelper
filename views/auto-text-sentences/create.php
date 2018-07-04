<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AutoTextSentences */

$this->title = Yii::t('app', 'Create Auto Text Sentences');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Auto Text Sentences'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auto-text-sentences-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
