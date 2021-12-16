<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EncomendaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Encomendas';
$this->params['breadcrumbs'][] = $this->title;
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

    <table class="styled-table">
        <tr>
            <th>Utilizador</th>
            <th>Estado</th>
            <th>Data</th>
            <th>Atualizar Estado Encomenda</th>

            <th></th>
        </tr>


        <?php foreach($encomendas as $encomenda)
        {?>
                <tr>
                    <td><?= $encomenda->user->perfil->primeiro_nome . ' ' . $encomenda->user->perfil->ultimo_nome ?></td>
                    <td><?= $encomenda->estado ?></td>
                    <td><?= $encomenda->data ?></td>
                    <td>
                        <table class="unstyled-table">
                            <tr id="tbButtons">
                                <td><?= Html::a('Atualizar Estado Encomenda', ['/encomenda/update', 'id_encomenda' => $encomenda->id], ['class'=>'btn btn-primary']) ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
        <?php }?>

    </table>

</div>

