<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use rayn2k\rzhelper\Debug;
/* @var $this yii\web\View */
/* @var $model app\models\InstanceHasConfig */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="instances-has-configs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    
    // get the corresponding config and instance object to this instance_has_config
    /* @var $config app\models\config */
    $config = $model->getConfig()->one();
    /* @var $instance app\models\instance */
    $instance = $model->getInstance()->one();
    
    echo DetailView::widget(
            [
                    'model' => $model,
                    'attributes' => [
                            [
                                    'label' => Yii::t('app', 'Instance ID'),
                                    'value' => $model->instance_id . ": " . $instance->description
                            ],
                            'config_key',
                            [
                                    'label' => Yii::t('app', 'Description'),
                                    'value' => $config->description
                            ],
                            [
                                    'label' => Yii::t('app', 'Default'),
                                    'value' => $config->default
                            ]
                    ]
            ]);
    
    // if possible values are available, use them in a listbox
    if ($config->hasPossibleValues()) {
        echo $form->field($model, 'value')->listBox($config->getPossibleValues(), 
                [
                        'multiple' => false,
                        'size' => count($config->getPossibleValues())
                ]);
    } else {
        echo $form->field($model, 'value')->textarea([
                'rows' => 1
        ]);
    }
    
    ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
