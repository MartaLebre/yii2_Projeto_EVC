<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Faturacao */

$this->title = 'Update Faturacao: ' . $model->id_user;
$this->params['breadcrumbs'][] = ['label' => 'Faturacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_user, 'url' => ['view', 'id_user' => $model->id_user]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="faturacao-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
