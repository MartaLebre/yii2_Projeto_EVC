<?php

use yii\helpers\Html;
use common\models\User;

/* @var $this yii\web\View */
/* @var $modelUsers common\models\User */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lista de Utilizadores';
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
    <table class="styled-table">
        <tr>
            <th>Role</th>
            <th>Username</th>
            <th>Primeiro Nome</th>
            <th>Ultimo Nome</th>
            <th></th>
        </tr>
        <?php foreach($modelUsers as $modelUser){
            $userRole = \Yii::$app->authManager->getRolesByUser($modelUser->id);
            
            if(!Yii::$app->authManager->getAssignment('admin', $modelUser->id)){ ?>
                <tr>
                    <td><?= array_keys($userRole)[0]?></td>
                    <td><?= $modelUser->username ?></td>
                    <td><?= $modelUser->perfil['primeiro_nome'] ?></td>
                    <td><?= $modelUser->perfil['ultimo_nome'] ?></td>
                    <td>
                        <table class="unstyled-table">
                            <tr id="tbButtons">
                                <?php if(User::isCliente($modelUser->id)){ ?>
                                    <td><?= Html::a('<i class="fas fa-eye invisible"></i>') ?></td>
                                    <td><?= Html::a('<i class="fas fa-user-edit invisible"></i>') ?></td>
                                    <td><?= Html::a('<i class="fas fa-trash-alt invisible"></i>') ?></td>
                                    <?php if($modelUser->status == User::STATUS_ACTIVE){ ?>
                                        <td><?= Html::a('<i class="fas fa-lock text-secondary"></i>', ['/user/bloquear', 'id' => $modelUser->id]) ?></td>
                                    <?php }
                                    else{ ?>
                                        <td><?= Html::a('<i class="fas fa-lock-open text-secondary"></i>', ['/user/desbloquear', 'id' => $modelUser->id]) ?></td>
                                    <?php }
                                }
                                else{ ?>
                                    <td><?= Html::a('<i class="fas fa-eye text-info"></i>', ['/user/view', 'id' => $modelUser->id]) ?></td>
                                    <td><?= Html::a('<i class="fas fa-user-edit text-warning"></i>', ['/user/update', 'id' => $modelUser->id]) ?></td>
                                    <td><?= Html::a('<i class="fas fa-trash-alt text-danger"></i>', ['/user/delete', 'id' => $modelUser->id], ['data' => ['confirm' => 'Are you sure you want to delete this item?', 'method' => 'post']]) ?></td>
                                    <td><?= Html::a('<i class="fas fa-lock invisible"></i>') ?></td>
                                <?php }?>
                            </tr>
                        </table>
                    </td>
                </tr>
            <?php }
        }?>
    </table>

</div>
