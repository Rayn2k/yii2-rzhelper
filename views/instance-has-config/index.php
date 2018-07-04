<?php
use yii\helpers\Html;
use yii\grid\GridView;
use rayn2k\rzhelper\Debug;
use app\models\Instance;
use rayn2k\rzhelper\ConstantsGeneral;
use rayn2k\rzhelper\UtilUI;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InstanceHasConfigSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$instance = Instance::findOne($instance_id);
$this->title = Yii::t('app', 'Configuration for Instance') . ": " . $instance->description . " (" . $instance->instance_id . ")";
?>
<div class="instances-has-configs-index">

	<h1><?= Html::encode($this->title) ?></h1>


	<div class="button-bar">
	 	<?= UtilUI::getButtonDiv(Html::a(Yii::t('app', 'Config Keys'), ['config/index'], ['class' => 'btn btn-success']))?>
     	<?= UtilUI::getButtonDiv(Html::a(Yii::t('app', 'Create New Config Key'), ['config/create'], ['class' => 'btn btn-success']))?>
     	<?= UtilUI::getButtonDiv(Html::a(Yii::t('app', 'Initialize With Default Values'), ['instance-has-config/init-default','instance_id' => \Yii::$app->session->get(ConstantsGeneral::ACTIVE_INSTANCE_ID)], ['class' => 'btn btn-success']))?>
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
                            [
                                    'attribute' => 'description',
                                    'format' => 'html',
                                    'value' => function ($model)
                                    {
                                        return $model->description;
                                    }
                            ],
                            [
                                    'attribute' => 'default',
                                    'contentOptions' => [
                                            'class' => 'italic'
                                    ],
                                    'format' => 'html',
                                    'value' => function ($model)
                                    {
                                        return $model->default;
                                    }
                            ],
                            [
                                    'attribute' => 'value',
                                    'contentOptions' => [
                                            'class' => 'bold'
                                    ],
                                    'format' => 'html',
                                    'value' => function ($model)
                                    {
                                        return $model->value;
                                    }
                            ],
                            [
                                    'class' => 'yii\grid\ActionColumn',
                                    'template' => '{update}',
                                    'buttons' => [
                                            'update' => function ($url, $model, $key)
                                            {
                                                // Debug::dump($model);
                                                $url = Yii::$app->urlManager->createUrl(
                                                        [
                                                                '/instance-has-config/update',
                                                                'key' => $model->config_key
                                                        ]);
                                                
                                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, 
                                                        [
                                                                'title' => Yii::t('yii', 'Update')
                                                        ]);
                                            }
                                    ]
                            ]
                    ]
            ]);
    ?>

</div>
