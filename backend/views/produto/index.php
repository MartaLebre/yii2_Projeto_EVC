<?php

use common\widgets\Alert;
use common\models\Produto;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProdutoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model_produtos Produto */

$this->registerCssFile("@web/css/index_produto.css");

$model_produtos = $dataProvider->getModels();

$this->title = 'Lista de Produtos';
?>
<?= Alert::widget() ?>

<div class="produto-index">
    <div class="row">
        <div class="col-10 offset-1">
            <div class="card">
                <div class="card-header">
                    <p class="card-title"><?= $this->title ?></p>

                    <div class="card-tools">
                        <?= $this->render('_search', ['model' => $searchModel]) ?>
                    </div>
                </div>
                <?php if($model_produtos != null){ ?>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Genero</th>
                            <th scope="col">Tamanho</th>
                            <th scope="col">Preço</th>
                            <th scope="col">Quantidade</th>
                            <th scope="col">Data</th>
                            <th scope="col">Modelo</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php foreach($model_produtos as $model_produto){
                            if($model_produto->quantidade != 0){ ?>
                                <tr>
                                    <th scope="row" ><?= $model_produto->codigo_produto ?></th>
                                    <td><?= $model_produto->nome ?></td>
                                    <td><?= $model_produto->genero ?></td>
                                    <td><?= $model_produto->tamanho?></td>
                                    <td><?= $model_produto->preco ?></td>
                                    <td><?= $model_produto->quantidade ?></td>
                                    <td><?= $model_produto->data ?></td>
                                    <td><?= $model_produto->modelo->nome ?></td>
                                    <td class="td-btn">
                                        <?= Html::a('<i class="fas fa-info"></i>', ['produto/view', 'codigo_produto' => $model_produto->codigo_produto],
                                            ['class'=>'btn']) ?>
                                        <?= Html::a('<i class="fas fa-pen"></i>', ['produto/update', 'codigo_produto' => $model_produto->codigo_produto],
                                            ['class'=>'btn']) ?>
                                    </td>
                                </tr>
                            <?php }
                        }?>
                        </tbody>
                    </table>
                    <?php }
                    else{ ?>
                        <div class="produtos-null">
                            <h5>Não existem produtos disponíveis</h5>
                        </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
</div>
