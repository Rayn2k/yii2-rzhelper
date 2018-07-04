<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserHasPicture */

$this->title = Yii::t('app', 'Create Users Has Pictures');
$this->params['breadcrumbs'][] = [
        'label' => Yii::t('app', 'Users Has Pictures'),
        'url' => [
                'index'
        ]
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-has-pictures-create">

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
