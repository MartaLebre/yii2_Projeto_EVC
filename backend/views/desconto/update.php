<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Desconto */

$this->title = 'Update Desconto: ' . $model->id_modelo;
$this->params['breadcrumbs'][] = ['label' => 'Descontos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_modelo, 'url' => ['view', 'id_modelo' => $model->id_modelo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="desconto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
