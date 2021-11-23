<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Produto */

$this->title = $model->codigo_produto;
$this->params['breadcrumbs'][] = ['label' => 'Produtos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="produto-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'codigo_produto' => $model->codigo_produto], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'codigo_produto' => $model->codigo_produto], [
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
            'nome',
            'genero',
            'descrição',
            'tamanho',
            'preço',
            'quantidade',
            'data',
            'id_modelo',
        ],
    ]) ?>

</div>
