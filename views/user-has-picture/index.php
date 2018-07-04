<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserHasPictureSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users Has Pictures');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-has-pictures-index">

	<h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Users Has Pictures'), ['create'], ['class' => 'btn btn-success'])?>
    </p>

    <?php
    echo GridView::widget(
            [
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                            [
                                    'class' => 'yii\grid\SerialColumn'
                            ],
                            
                            'id' => [
                                    'label' => 'Size',
                                    'attribute' => 'id',
                                    'value' => function ($model)
                                    {
                                        return "bal";
                                    }
                            ],
                            'user_id',
                            'picture_id',
                            'chosen_individual',
                            'chosen_general',
                            
                            [
                                    'class' => 'yii\grid\ActionColumn'
                            ]
                    ]
            ]);
    ?>

</div>
