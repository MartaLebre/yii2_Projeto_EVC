<?php

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
<div class="user-index">
    <p>
        <?= Html::a('Criar Modelo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <table class="styled-table">
        <tr>
            <th>Modelo</th>
            <th></th>
        </tr>
        <?php foreach($modelo as $modeloProduto){ ?>

                <tr>
                    <td><?= $modeloProduto->modelo ?></td>

                    <td>
                        <table class="unstyled-table">
                            <tr id="tbButtons">
                                    <td><?= Html::a('<i class="fas fa-eye text-info"></i>', ['/produto/create', 'id_modelo' => $modeloProduto->id]) ?></td>

                            </tr>
                        </table>
                    </td>
                </tr>

       <?php }?>
    </table>

</div>

