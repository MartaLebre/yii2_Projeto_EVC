<?php

use common\models\Encomenda;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $encomendas Encomenda */

$this->registerCssFile("@web/css/index_encomenda.css");

$this->title = 'Lista de Encomendas';
?>

<div class="encomenda-index">
    <div class="row">
        <div class="col-8 offset-2">
            <div class="card">
                <div class="card-header">
                    <p class="card-title"><?= $this->title ?></p>
                </div>
                <?php if($encomendas != null){ ?>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Data</th>
                            <th scope="col">Atualizar Estado</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php foreach($encomendas as $encomenda){?>
                            <tr>
                                <th scope="row" ><?= $encomenda->id ?></th>
                                <td><?= $encomenda->user->perfil->primeiro_nome . ' ' . $encomenda->user->perfil->ultimo_nome ?></td>
                                <td><?= $encomenda->estado ?></td>
                                <td><?= $encomenda->data ?></td>
                                <td class="td-btn">
                                    <?= Html::a('Atualizar', ['encomenda/detalhes', 'id_encomenda' => $encomenda->id],
                                        ['class'=>'btn btn-dark'])?>
                                </td>
                            </tr>
                        <?php }?>
                        </tbody>
                    </table>
                    <?php }
                    else{ ?>
                        <div class="encomendas-null">
                            <h5>N??o existem encomendas dispon??veis</h5>
                        </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
</div>

