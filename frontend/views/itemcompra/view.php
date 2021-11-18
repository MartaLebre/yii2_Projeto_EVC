<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ItemCompra */

$this->title = $model->codigo_produto;
$this->params['breadcrumbs'][] = ['label' => 'Item Compras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="item-compra-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'codigo_produto' => $model->codigo_produto, 'id_encomenda' => $model->id_encomenda], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'codigo_produto' => $model->codigo_produto, 'id_encomenda' => $model->id_encomenda], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'codigo_produto',
            'id_encomenda',
            'quantidade',
            'preço_venda',
        ],
    ]) ?>

</div>
