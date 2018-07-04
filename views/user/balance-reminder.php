<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use rayn2k\rzhelper\UtilNumber;
use kartik\grid\GridView;
use app\models\AutoTextItemChainSearch;
use app\models\Event;
use app\models\UserProfile;
use yii\helpers\Url;
use app\models\Sale;
use app\controllers\UserController;
use app\models\User;
use rayn2k\rzhelper\Debug;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use rayn2k\rzhelper\UtilString;
use rayn2k\rzhelper\UtilUI;
use rayn2k\rzhelper\UtilDate;

/* @var $this yii\web\View */
/* @var $model app\models\sale */

$this->title = Yii::t('app', 'Balance Reminder Overview');

?>
<div class="sale-create">

	<h1><?=Html::encode($this->title)?></h1>


	
    <?php
    
    echo GridView::widget(
            [
                    'dataProvider' => $dataProvider,
                    'summary' => false,
                    'columns' => [
                            [
                                    // PICTURE COLUMN
                                    // 'attribute' => 'picture_id',
                                    'label' => Yii::t('app', 'Picture ID'),
                                    'format' => 'html',
                                    'headerOptions' => [
                                            'class' => 'whitespace-normal'
                                    ],
                                    'contentOptions' => [
                                            'class' => 'width-5-percent'
                                    ],
                                    'value' => function ($model)
                                    {
                                        $picture = UserProfile::findOne($model->used_user_id)->getGeneralChosenPicture();
                                        return Html::img($picture->getImagePath(),
                                                [
                                                        'class' => 'width-100-percent'
                                                ]);
                                    }
                            ],
                            [
                                    // USER COLUMN
                                    'attribute' => 'user_name',
                                    'label' => Yii::t('app', 'User'),
                                    'format' => 'html',
                                    'headerOptions' => [
                                            'class' => 'whitespace-normal'
                                    ],
                                    'contentOptions' => [
                                            'class' => [
                                                    'width-20-percent'
                                            ]
                                    ],
                                    'value' => function ($model)
                                    {
                                        // build unser link text
                                        
                                        // main user name
                                        $user_name_text = UserProfile::findOne($model->used_user_id)->getDisplayName();
                                        
                                        $line1 = Html::tag('div', $user_name_text,
                                                [
                                                        'class' => 'font-size-15'
                                                ]);
                                        
                                        $line2 = Html::tag('div', $model->name_extension,
                                                [
                                                        'class' => [
                                                                'font-size-10'
                                                        ]
                                                ]);
                                        
                                        return Html::a($line1 . $line2,
                                                Url::to(
                                                        [
                                                                'sale/index-user',
                                                                'user_id' => $model->used_user_id
                                                        ], true),
                                                [
                                                        'class' => 'main-font-color'
                                                ]);
                                    }
                            ],
                            [
                                    // TOTAL COLUMN
                                    'attribute' => 'total',
                                    'filter' => false,
                                    'format' => 'html',
                                    'headerOptions' => [
                                            'class' => 'whitespace-normal'
                                    ],
                                    'contentOptions' => [
                                            'class' => [
                                                    'width-15-percent'
                                            ]
                                    ],
                                    'value' => function ($model)
                                    {
                                        return Html::tag('div', UtilNumber::get_money_value($model->total),
                                                [
                                                        'class' => 'font-size-15'
                                                ]);
                                    }
                            ],
                            [
                                    // TEXT
                                    'filter' => false,
                                    'format' => 'html',
                                    'headerOptions' => [
                                            'class' => 'whitespace-normal'
                                    ],
                                    'contentOptions' => [
                                            'class' => [
                                                    'width-40-percent',
                                                    'vertical-align-middle'
                                            ]
                                    ],
                                    'value' => function ($model)
                                    {
                                        $autoTextModel = new AutoTextItemChainSearch();
                                        
                                        if ($model->total < 0) {
                                            $auto_text = $autoTextModel->getAutoText('message_balance_negative');
                                        } else {
                                            $auto_text = $autoTextModel->getAutoText('message_balance_positive');
                                        }
                                        
                                        // find user
                                        $user_name_for_messages = UserProfile::findOne($model->used_user_id)->getNameForMessages();
                                        
                                        $auto_text = UtilString::replace($auto_text, "{message_name}", $user_name_for_messages);
                                        $auto_text = UtilString::replace($auto_text, "{amount}", $model->total);
                                        
                                        return $auto_text;
                                    }
                            ]
                    ],
                    'responsive' => true,
                    'hover' => true,
                    'pjax' => false,
                    'export' => false
            ]);
    ?>

</div>
