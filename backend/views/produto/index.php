<?php

use common\models\Produto;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProdutoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $produtos Produto */

$this->title = 'Lista de Produtos';
$produtos = $dataProvider->getModels();
?>
<style>
    table{
        width: 100%;
    }
    .styled-table{
        margin: 25px 0;
        font-family: sans-serif;
    }
    .styled-table th{
        background-color: #dddddd;
    }
    .styled-table tr{
        border-bottom: 1px solid #dddddd;
    }
    .styled-table tr:nth-of-type(even){
        background-color: #f3f3f3;
    }
    .unstyled-table #tbButtons{
        border-bottom: 0px;
    }
</style>


<div class="produto-index">

    <?= $this->render('_search', ['model' => $searchModel]) ?>

    <table class="styled-table">
        <tr>
            <th>Nome</th>
            <th>Genero</th>
            <th>Descrição</th>
            <th>Tamanho</th>
            <th>Preço</th>
            <th>Quantidade</th>
            <th>Data</th>
            <th>Modelo</th>
            <th></th>
        </tr>


        <?php foreach($produtos as $produto){
            if ($produto->quantidade != 0){
            ?>
            <tr>
                <td><?= $produto->nome ?></td>
                <td><?= $produto->genero ?></td>
                <td><?= $produto->descricao ?></td>
                <td><?= $produto->tamanho?></td>
                <td><?= $produto->preco ?></td>
                <td><?= $produto->quantidade ?></td>
                <td><?= $produto->data ?></td>
                <td><?= $produto->modelo->modelo ?></td>
                <td>
                    <table class="unstyled-table">
                        <tr id="tbButtons">
                            <td><?= Html::a('<i class="fas fa-eye"></i>', ['/produto/view', 'codigo_produto' => $produto->codigo_produto]) ?></td>
                            <td><?= Html::a('<i class="fas fa-edit"</i>', ['/produto/update', 'codigo_produto' => $produto->codigo_produto]) ?></td>
                        </tr>
                    </table>
                </td>
            </tr>

        <?php } }?>

    </table>

</div>
