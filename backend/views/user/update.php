<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $modelUser common\models\User */
/* @var $modelPerfil common\models\Perfil */

$this->title = 'Update User: ' . $modelUser->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $modelUser->id, 'url' => ['view', 'id' => $modelUser->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formUpdate',
        [
        'modelUser' => $modelUser,
        'modelPerfil' => $modelPerfil,
        
    ]) ?>

</div>
