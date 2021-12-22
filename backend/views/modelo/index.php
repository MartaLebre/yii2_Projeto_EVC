<?php

use common\widgets\Alert;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->registerCssFile("@web/css/index_modelo.css");

$this->title = 'Lista de Modelos';
?>
<?= Alert::widget() ?>

<div class="modelo-index">
    <div class="row">
        <div class="col-7 offset-2">
            <div class="card">
                <div class="card-header">
                    <p class="card-title"><?= $this->title ?></p>

                    <div class="card-tools">
                        <?= Html::a('Criar Modelo', ['create'],
                            ['class' => 'btn btn-modelo btn-block shadow-sm']) ?>
                    </div>
                </div>
                <?php if($modelo != null){ ?>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Modelo</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php foreach($modelo as $modeloProduto){ ?>
                            <tr>
                                <th scope="row" ><?= $modeloProduto->id ?></th>
                                <td><?= $modeloProduto->nome ?></td>
                                <td class="td-btn text-right">
                                    <?= Html::a('Adicionar Desconto', ['/desconto/create', 'id_modelo' => $modeloProduto->id],
                                        ['class'=>'btn btn-dark shadow-sm btn-desconto']) ?>
                                    <?= Html::a('Adicionar Produto', ['/produto/create', 'id_modelo' => $modeloProduto->id],
                                        ['class'=>'btn btn-dark shadow-sm']) ?>
                                </td>
                            </tr>
                        <?php }?>
                        </tbody>
                    </table>
                    <?php }
                    else{ ?>
                        <div class="modelos-null">
                            <h5>Não existem modelos disponíveis</h5>
                        </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
</div>

