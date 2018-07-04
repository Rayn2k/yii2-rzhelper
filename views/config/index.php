<?php
use yii\helpers\Html;
use yii\grid\GridView;
use rayn2k\rzhelper\Debug;
use rayn2k\rzhelper\UtilUI;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ConfigSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Config Keys');
?>
<div class="config-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<div class="button-bar">
		<?= UtilUI::getButtonDiv(Html::a(Yii::t('app', 'Create Config'), ['create'], ['class' => 'btn btn-success']))?>
		<?= UtilUI::getButtonDiv(Html::a(Yii::t('app', 'Configuration for Instance'), ['/instance-has-config/index'], ['class' => 'btn btn-success']))?>	
    </div>

    <?php
    $dataProvider->pagination = false;
    echo GridView::widget(
            [
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'summary' => false,
                    'columns' => [
                            'config_key',
                            'possible_values:ntext',
                            'default:ntext',
                            [
                                    'class' => 'yii\grid\ActionColumn',
                                    'template' => '{view}{update}{delete}',
                                    'buttons' => [
                                            'view' => function ($url, $model, $key)
                                            {
                                                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 
                                                        [
                                                                '/config/view',
                                                                'key' => $model->config_key
                                                        ], 
                                                        [
                                                                'title' => Yii::t('yii', 'View'),
                                                                'aria-label' => Yii::t('yii', 'View'),
                                                                'data-pjax' => '0'
                                                        ]);
                                            },
                                            'update' => function ($url, $model, $key)
                                            {
                                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 
                                                        [
                                                                '/config/update',
                                                                'key' => $model->config_key
                                                        ], 
                                                        [
                                                                'title' => Yii::t('yii', 'Update'),
                                                                'aria-label' => Yii::t('yii', 'Update'),
                                                                'data-pjax' => '0'
                                                        ]);
                                            },
                                            'delete' => function ($url, $model, $key)
                                            {
                                                return Html::a('<span class="glyphicon glyphicon-trash"></span>', 
                                                        [
                                                                '/config/delete',
                                                                'key' => $model->config_key
                                                        ], 
                                                        [
                                                                'title' => Yii::t('yii', 'Delete'),
                                                                'aria-label' => Yii::t('yii', 'Delete'),
                                                                'data-confirm' => Yii::t('yii', 
                                                                        'Are you sure you want to delete this item with all occurences linked to instances?'),
                                                                'data-method' => 'post',
                                                                'data-pjax' => '0'
                                                        ]);
                                            }
                                    ]
                            ]
                    ]
            ]);
    ?>

</div>
