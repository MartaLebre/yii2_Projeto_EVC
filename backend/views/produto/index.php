<?php

use common\widgets\Alert;
use common\models\Produto;
use yii\helpers\Html;
use yii\bootstrap4\LinkPager;

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
                        <?php foreach($model_produtos as $model_produto){?>
                            <tr>
                                <th scope="row" ><?= $model_produto->codigo_produto ?></th>
                                <td><?= $model_produto->nome ?></td>
                                <td><?= $model_produto->genero ?></td>
                                <td><?= $model_produto->tamanho?></td>
                                <td><?= $model_produto->preco ?></td>
                                <td><?= $model_produto->quantidade ?></td>
                                <td><?= $model_produto->data ?></td>
                                <td><?= $model_produto->modelo->nome ?></td>
                                <td><?= Html::a('<i class="fas fa-info"></i>', ['produto/view', 'codigo_produto' => $model_produto->codigo_produto])?></td>
                            </tr>
                        <?php }?>
                        </tbody>
                    </table>
                    <?php }
                    else{ ?>
                        <div class="produtos-null">
                            <h5>Não existem produtos disponíveis</h5>
                        </div>
                    <?php }?>
                </div>
                <br>
                <div class="offset-5">
                    <?= LinkPager::widget([
                        'pagination' => $pages,
                    ])?>
                </div>
            </div>
        </div>
    </div>
</div>