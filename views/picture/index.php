<?php
use app\models\Picture;
use app\models\PictureType;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PictureSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Pictures');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="picture-index">

    <h1><?=Html::encode($this->title)?></h1>
    <?php
    // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?=Html::a(Yii::t('app', 'Create Picture'),['create'],['class' => 'btn btn-success'])?>
    </p>

    <?php
    /* @var $model app\models\Picture */
    echo GridView::widget(
            [
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                            [
                                    // PICTURE COLUMN
                                    'label' => Yii::t('app', 'Picture'),
                                    'format' => 'html',
                                    'headerOptions' => [
                                            'class' => 'whitespace-normal'
                                    ],
                                    'contentOptions' => [
                                            'class' => 'width-5-percent'
                                    ],
                                    'value' => function ($model)
                                    {
                                        return Html::img($model->getImagePath(),
                                                [
                                                        'class' => 'width-100-percent'
                                                ]);
                                    }
                            ],
                            'picture_id',
                            [
                                    // PICTURE_TYPE_ID COLUMN
                                    'attribute' => 'picture_type_id',
                                    'label' => Yii::t('app', 'Picture Type Id'),
                                    'format' => 'html',
                                    'filter' => ArrayHelper::map(PictureType::find()->asArray()->all(), 'picture_type_id', 'class_name')
                            ],
                            'format:ntext',
                            'file_name:ntext',
                            [
                                    'class' => 'yii\grid\ActionColumn'
                            ]
                    ]
            ]);
    ?>

</div>
