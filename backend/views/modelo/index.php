<?php

use common\widgets\Alert;
use yii\helpers\Html;
use common\models\User;

/* @var $this yii\web\View */

$this->title = 'Lista de Modelos';

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

<?= Alert::widget() ?>

<div class="user-index">
    <p>
        <?= Html::a('Criar Modelo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <table class="styled-table">
        <tr>
            <th>Modelo</th>
            <th>Adicionar Produto</th>
            <th>Adicionar Desconto</th>
            <th></th>
        </tr>
        <?php foreach($modelo as $modeloProduto){ ?>

                <tr>
                    <td><?= $modeloProduto->nome ?></td>

                    <td>
                        <table class="unstyled-table">
                            <tr id="tbButtons">
                                    <td><?= Html::a('Adicionar Produto', ['/produto/create', 'id_modelo' => $modeloProduto->id], ['class'=>'btn btn-primary']) ?></td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table class="unstyled-table">
                            <tr id="tbButtons">
                                <td><?= Html::a('Adicionar Desconto', ['/desconto/create', 'id_modelo' => $modeloProduto->id], ['class'=>'btn btn-primary']) ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>

       <?php }?>
    </table>

</div>

