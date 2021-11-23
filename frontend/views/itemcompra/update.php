<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ItemCompra */

$this->title = 'Update Item Compra: ' . $model->codigo_produto;
$this->params['breadcrumbs'][] = ['label' => 'Item Compras', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->codigo_produto, 'url' => ['view', 'codigo_produto' => $model->codigo_produto, 'id_encomenda' => $model->id_encomenda]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="item-compra-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
