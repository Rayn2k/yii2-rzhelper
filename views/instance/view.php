<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Instance */

$this->title = $model->instance_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Instances'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="instance-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->instance_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->instance_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'instance_id',
            'description:ntext',
            'description_short:ntext',
        ],
    ]) ?>

</div>
