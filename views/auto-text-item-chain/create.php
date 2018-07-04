<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AutoTextItemChain */

$this->title = Yii::t('app', 'Create Auto Text Item Chain');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Auto Text Item Chains'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auto-text-item-chain-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
