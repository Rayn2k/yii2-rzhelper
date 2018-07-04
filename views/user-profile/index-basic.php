<?php
use yii\helpers\Html;
use yii\widgets\Pjax;
use rayn2k\rzhelper\Debug;
use rayn2k\rzhelper\UtilString;
use app\models\UserProfile;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$js = <<< JS
 
JS;

$this->registerJs($js);

?>

<div class="user-index">

	<div class="form-group row">
		<div class="col-md-10">
			<?= Html::label(Yii::t('app', 'Filter User'), 'user_search_input', []); ?>
        	<?= Html::textInput('search_text', '', ['id' => 'user_search_input', 'class'=>'form-control']); ?>
   		</div>
		<div class="col-md-2 padding-top-20 padding-left-0">
        	<?= Html::button(Yii::t('app', 'Search'), ['id' => 'user_search_button','class' => 'btn btn-primary width-100-percent'])?>
		</div>
	</div>

 
   <?php
/* @var $model app\models\UserProfile */
echo GridView::widget(
        [
                'dataProvider' => $dataProvider,
                'summary' => false,
                'columns' => [
                        [
                                // PICTURE COLUMN
                                'label' => Yii::t('app', 'Picture ID'),
                                'format' => 'html',
                                'contentOptions' => [
                                        'class' => [
                                                'width-5-percent',
                                                '_add-user',
                                                'cursor-pointer'
                                        ]
                                ],
                                'value' => function ($model)
                                {
                                    $picture = $model->getGeneralChosenPicture();
                                    return Html::img($picture->getImagePath(), 
                                            [
                                                    'class' => 'width-100-percent'
                                            ]);
                                }
                        ],
                        [
                                'label' => Yii::t('app', 'Name'),
                                'format' => 'html',
                                'contentOptions' => [
                                        'class' => [
                                                'vertical-align-middle',
                                                '_add-user',
                                                'cursor-pointer',
                                                'padding-top-0',
                                                'padding-bottom-0'
                                        ]
                                ],
                                'value' => function ($model)
                                {
                                    // build unser link text
                                    
                                    // main user name
                                    $user_name_text = $model->getDisplayName();
                                    
                                    $line1 = Html::tag('div', $user_name_text, 
                                            [
                                                    'class' => [
                                                            'font-size-12',
                                                            '_user_name'
                                                    ]
                                            ]);
                                    
                                    $line2 = Html::tag('div', $model->name_extension, 
                                            [
                                                    'class' => [
                                                            'font-size-08',
                                                            'italic '
                                                    ]
                                            ]);
                                    
                                    return $line1 . $line2;
                                }
                        ]
                ]
        ]);

?>
</div>
