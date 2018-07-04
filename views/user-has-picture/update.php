<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserHasPicture */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
        'modelClass' => 'Users Has Pictures'
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = [
        'label' => Yii::t('app', 'Users Has Pictures'),
        'url' => [
                'index'
        ]
];
$this->params['breadcrumbs'][] = [
        'label' => $model->id,
        'url' => [
                'view',
                'id' => $model->id
        ]
];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="users-has-pictures-update">

	<h1><?= Html::encode($this->title) ?></h1>

     <?php
    echo $this->render('_form', 
            [
                    'model' => $model,
                    'users' => $users,
                    'pictures' => $pictures,
                    'boolNames' => $boolNames
            ]);
    ?>

</div>
