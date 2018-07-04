<?php
use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PictureTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'PictureTypes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="PictureType-index">

	<h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create PictureType'), ['create'], ['class' => 'btn btn-success'])?>
    </p>

    <?php
    echo GridView::widget(
            [
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'export' => false,
                    'columns' => [
                            [
                                    'class' => 'yii\grid\SerialColumn'
                            ],
                            'picture_type_id',
                            'class_name:ntext',
                            'folder:ntext',
                            'has_fixed_resolution',
                            'width',
                            // [
                            // 'class' => 'kartik\grid\EditableColumn',
                            // 'attribute' => 'width',
                            // 'editableOptions' => [
                            // 'header' => Yii::t('app', 'Width'),
                            // 'formOptions' => [
                            // 'action' => [
                            // '/picturetype/edit'
                            // ]
                            // ], // point to the new action
                            // 'inputType' =>
                            // \kartik\editable\Editable::INPUT_TEXT
                            // ]
                            // // 'options' => [
                            // // 'pluginOptions' => [
                            // // 'min' => 0,
                            // // 'max' => 5000
                            // // ]
                            // // ]
                            // ,
                            // 'hAlign' => 'right',
                            // 'vAlign' => 'middle',
                            // 'width' => '100px',
                            // 'format' => [
                            // 'decimal',
                            // 2
                            // ],
                            // 'pageSummary' => true
                            // ],
                            'height',
                            'possible_formats:ntext',
                            [
                                    'class' => 'yii\grid\ActionColumn'
                            ]
                    ]
            ]);
    ?>

</div>
