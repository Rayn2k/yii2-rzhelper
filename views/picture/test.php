<?php
use yii\helpers\Html;
use rayn2k\rzhelper\Debug;
?>
<?php

if (! isset($model)) {
    echo "no model set.";
} else {
    echo "model is set.";
    Debug::dump($model);
}

?>

<?php

$options = [
        'width' => '30%',
        'height' => '30%'
];

$posts = Yii::$app->db->createCommand('SELECT * FROM {{%users}}')->queryAll();

// Debug::dump($posts);
echo "<br>";

?>
<strong>YEAAAHH! </strong>
<?php

// Html::img("https://i.ytimg.com/vi/EkhFza9IhrM/maxresdefault.jpg", $options);
?> 