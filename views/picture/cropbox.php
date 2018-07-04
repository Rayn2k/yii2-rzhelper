<?php
use bupy7\cropbox\CropboxWidget;
use yii\base\UserException;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/*  @var $model UploadForm   */
/*  @var $PictureType PictureType   */

if (! isset($pictureType))
    throw new UserException(Yii::t('app', 'Variable "{varName}" is not set.', [
            'varName' => 'PictureType'
    ]));

?>

<h2>
<?=Yii::t('app', 'Please choose: ')?>
<?=Yii::t('app', $pictureType->class_name)?>
</h2>
<?php
// Yii::$app->session->setFlash('error', 'Message here');
$form = ActiveForm::begin(
        [
                'id' => 'crop_image_upload_form',
                'action' => [
                        'store'
                ],
                'options' => [
                        'enctype' => 'multipart/form-data'
                ]
        ]);

// store the picture type id for the post submit in a hidden input field
echo Html::activeHiddenInput($model, 'picture_type_id');

echo $form->field($model, 'picture_base_name');

echo $form->field($model, 'image')->widget(CropboxWidget::className(),
        [
                'id' => 'upload_picture_1',
                'attributeCropInfo' => 'crop_info',
                'pluginOptions' => [
                        'variants' => [
                                [
                                        'width' => $pictureType->width,
                                        'height' => $pictureType->height,
                                        'minWidth' => $pictureType->width,
                                        'minHeight' => $pictureType->height,
                                        'maxWidth' => $pictureType->width,
                                        'maxHeight' => $pictureType->height
                                ]
                        ]
                ]
        ]);

?>

<?=Html::submitButton('Submit',['class' => 'btn btn-primary','name' => 'upload-button'])?>

<?php

ActiveForm::end()?>
