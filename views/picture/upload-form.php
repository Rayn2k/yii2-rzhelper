<?php
use bupy7\cropbox\CropboxWidget;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<h2>
    <?=Yii::t('app', 'Upload picture of type: ')?>
    <?=Yii::t('app', $pictureType->class_name)?>
    </h2>

<?php
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

// Debug::dump($pictureType->picture_type_id);

echo $form->field($model, 'picture_type_id')
    ->widget(Select2::classname(),
        [
                'data' => $pictureTypes,
                'hideSearch' => true,
                'language' => 'de',
                'options' => [
                        'id' => 'select_picture_type',
                        'options' => [
                                $pictureType->picture_type_id => [
                                        'selected' => 'selected'
                                ]
                        ]
                ],
                'pluginOptions' => [
                        'allowClear' => false
                ]
        ])
    ->label(Yii::t('app', 'Select Picture Type'));

// Debug::dump($showAdditionalSelect);

// show user-selection, if picture-type is user
if ($showUserSelect) {
    echo $form->field($model, 'user_id')
        ->widget(Select2::classname(),
            [
                    'data' => $users,
                    'language' => 'de',
                    'options' => [
                            'id' => 'select_user'
                    ],
                    'pluginOptions' => [
                            'allowClear' => false
                    ]
            ])
        ->label(Yii::t('app', 'Select User'));
}

echo $form->field($model, 'picture_base_name')->textInput([
        'id' => 'picture_base_name'
]);

echo $form->field($model, 'image')->widget(CropboxWidget::className(),
        [
                'id' => 'upload_picture_1',
                'croppedDataAttribute' => 'crop_info',
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

echo Html::submitButton('Submit', [
        'class' => 'btn btn-primary',
        'name' => 'upload-button'
]);

ActiveForm::end();
?>

<div id="picture_upload_div"></div>