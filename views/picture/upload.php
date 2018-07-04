<?php
use app\assets\PictureUploadAsset;
use yii\base\UserException;

/*  @var $model UploadForm   */
/*  @var $pictureType PictureType   */
$this->title = Yii::t('app', 'Upload Picture');
PictureUploadAsset::register($this);

if (! isset($pictureType))
    throw new UserException(Yii::t('app', 'Variable "{varName}" is not set.', [
            'varName' => 'pictureType'
    ]));
?>

<div id="picture_upload_form">
	<?=$this->render('upload-form',['model' => $model,'pictureType' => $pictureType,'pictureTypes' => $pictureTypes,'showUserSelect' => $showUserSelect,'users' => $users]);?>
</div>
