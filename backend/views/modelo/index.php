<?php

use common\widgets\Alert;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $modeloProduto common\models\Modelo */

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
                            ['class' => 'btn btn-dark btn-block shadow-sm']) ?>
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
                                    <?php
                                    if($modeloProduto->desconto != null){
                                        if($modeloProduto->desconto->getDescontoActivo($modeloProduto->desconto->id_modelo)){
                                            echo Html::a('Desconto Ativo', ['/desconto/view', 'id_modelo' => $modeloProduto->id],
                                                ['class'=>'btn btn-success shadow-sm btn-detalhesdesconto']);
                                        }
                                        else{
                                            echo Html::a('Desconto Inativo', ['/desconto/view', 'id_modelo' => $modeloProduto->id],
                                                ['class'=>'btn btn-danger shadow-sm btn-descontoinativo']);
                                        }
                                    }
                                    else{
                                        echo Html::a('Adicionar Desconto', ['/desconto/create', 'id_modelo' => $modeloProduto->id],
                                            ['class'=>'btn btn-dark shadow-sm btn-desconto']);
                                    }?>
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
                            <h5>N??o existem modelos dispon??veis</h5>
                        </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
</div>

