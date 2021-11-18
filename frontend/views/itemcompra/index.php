<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ItemCompraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Item Compras';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-compra-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Item Compra', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'codigo_produto',
            'id_encomenda',
            'quantidade',
            'preço_venda',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
