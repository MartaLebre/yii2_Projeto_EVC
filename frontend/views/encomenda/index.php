<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EncomendaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->registerCssFile("@web/css/index_encomenda.css");

$this->title = 'Encomendas';
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
                        </tr>
                        </thead>

                        <tbody>
                        <?php foreach($encomendas as $encomenda){?>
                            <tr>
                                <th scope="row" ><?= $encomenda->id ?></th>
                                <td><?= $encomenda->user->perfil->primeiro_nome . ' ' . $encomenda->user->perfil->ultimo_nome ?></td>
                                <td><?= $encomenda->estado ?></td>
                                <td><?= $encomenda->data ?></td>
                            </tr>
                        <?php }?>
                        </tbody>
                    </table>
                    <?php }
                    else{ ?>
                        <div class="encomendas-null">
                            <h5>Não existem encomendas disponíveis</h5>
                        </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
</div>