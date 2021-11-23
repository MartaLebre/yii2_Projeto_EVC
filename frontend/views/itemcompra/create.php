<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ItemCompra */

$this->title = 'Create Item Compra';
$this->params['breadcrumbs'][] = ['label' => 'Item Compras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-compra-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
