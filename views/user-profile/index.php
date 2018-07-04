<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'User Profiles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-profile-index">

	<h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create User Profile'), ['create'], ['class' => 'btn btn-success'])?>
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
                            
                            'user_id',
                            'name:ntext',
                            'name_extension:ntext',
                            'nick_name:ntext',
                            'name_for_messages:ntext',
                            // 'send_mail',
                            // 'phone:ntext',
                            // 'send_phone',
                            // 'login_fails',
                            // 'last_login_at',
                            
                            [
                                    'class' => 'yii\grid\ActionColumn'
                            ]
                    ]
            ]);
    ?>
</div>
