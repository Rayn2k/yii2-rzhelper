<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use rayn2k\rzhelper\UtilNumber;
use app\models\User;
use app\models\UserProfile;
use app\models\Picture;
use rayn2k\rzhelper\Debug;
use rayn2k\rzhelper\UtilDate;
use rayn2k\rzhelper\UtilString;
use kartik\switchinput\SwitchInput;
use rayn2k\rzhelper\UtilUI;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $userFilterForm app\models\form\UserFilterForm    */

$this->title = Yii::t('app', 'Users');

// Debug::dump($query->createCommand()->getRawSql());

// create get parameters for button
$params = Yii::$app->request->queryParams;
$params[0] = "user/index"; // route target has to be on index 0
unset($params["r"]); // remove r target, this is already available on params 0

if ($userFilterForm->use_zero_account) {
    $zero_account_button_text = Yii::t('app', 'Hide Users having 0€');
    $params['use_zero_account'] = 0;
} else {
    $zero_account_button_text = Yii::t('app', 'Show Users having 0€');
    $params['use_zero_account'] = 1;
}
?>
<div class="user-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<div class="button-bar">
	 	<?= UtilUI::getButtonDiv(Html::a(Yii::t('app', 'Create User'), ['user-profile/create'], ['class' => 'btn btn-success']))?>
	 	<?= UtilUI::getButtonDiv(Html::a($zero_account_button_text, $params, ['class' => 'btn btn-success']))?>
    </div>
    
    <?php
    
    // Debug::dump($dataProvider->query->createCommand()->getRawSql());
    /* @var $model app\models\User*/
    echo GridView::widget(
            [
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
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
                                                    'width-30-percent',
                                                    'vertical-align-middle'
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
                                                    'width-15-percent',
                                                    'vertical-align-middle'
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
                                    // LAST_EVENT COLUMN
                                    'attribute' => 'last_event_date_utc',
                                    'format' => 'html',
                                    'filter' => false,
                                    'headerOptions' => [
                                            'class' => 'whitespace-normal'
                                    ],
                                    'contentOptions' => [
                                            'class' => [
                                                    'width-25-percent',
                                                    'vertical-align-middle'
                                            ]
                                    ],
                                    'value' => function ($model)
                                    {
                                        $timestamp_utc = UtilDate::sqlstring_to_datetime_utc($model->last_event_date_utc);
                                        $timestamp_germany = UtilDate::set_to_timezone_germany($timestamp_utc);
                                        
                                        $day_name = UtilDate::get_day_name($timestamp_germany);
                                        $date_formatted = UtilDate::get_formatted_date_german($timestamp_germany);
                                        $last_event_name = UtilString::truncate($model->last_event_name, 30);
                                        
                                        return $date_formatted . " (" . $day_name . ")<br>" . $last_event_name;
                                    }
                            ],
                            [
                                    // LAST_LOGIN_AT COLUMN
                                    'attribute' => 'last_login_at',
                                    'format' => 'html',
                                    'filter' => false,
                                    'headerOptions' => [
                                            'class' => 'whitespace-normal'
                                    ],
                                    'contentOptions' => [
                                            'class' => [
                                                    'width-20-percent',
                                                    'vertical-align-middle'
                                            ]
                                    ],
                                    'value' => function ($model)
                                    {
                                        $timestamp_utc = UtilDate::sqlstring_to_datetime_utc($model->last_login_at);
                                        $timestamp_germany = UtilDate::set_to_timezone_germany($timestamp_utc);
                                        
                                        $day_name = UtilDate::get_day_name($timestamp_germany);
                                        $date_formatted = UtilDate::get_formatted_date_german($timestamp_germany);
                                        $time_formatted = UtilDate::get_formatted_time_german($timestamp_germany) . " " .
                                                 yii::t('app', "o'clock");
                                        
                                        return $date_formatted . " (" . $day_name . ")<br>" . $time_formatted;
                                    }
                            ],
                            [
                                    'class' => 'yii\grid\ActionColumn',
                                    'contentOptions' => [
                                            'class' => [
                                                    'width-5-percent',
                                                    'vertical-align-middle'
                                            ]
                                    ],
                                    'template' => '{view}<br>{update}',
                                    'buttons' => [
                                            'update' => function ($url, $model, $key)
                                            {
                                                $url = Yii::$app->urlManager->createUrl(
                                                        [
                                                                '/user-profile/update',
                                                                'id' => $model->id
                                                        ]);
                                                
                                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, 
                                                        [
                                                                'title' => Yii::t('yii', 'Update')
                                                        ]);
                                            },
                                            'view' => function ($url, $model, $key)
                                            {
                                                $url = Yii::$app->urlManager->createUrl(
                                                        [
                                                                '/user-profile/view',
                                                                'id' => $model->id
                                                        ]);
                                                
                                                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, 
                                                        [
                                                                'title' => Yii::t('yii', 'Update')
                                                        ]);
                                            }
                                    ]
                            ]
                    ],
                    'responsive' => true,
                    'hover' => true,
                    'pjax' => false,
                    'export' => false
            ]);
    
    ?>

</div>
