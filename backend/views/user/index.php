<?php

use yii\helpers\Html;
use common\models\User;

/* @var $this yii\web\View */
/* @var $modelUsers common\models\User */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
?>
<style>
    table{
        width: 100%;
    }
    tr{
        border-bottom: 1px solid #ddd;
    }
    #tbRole{
        width: 20%;
    }
    #tbUsername{
        width: 30%;
    }
    #tbPrimeiroNome, #tbUltimoNome{
        width: 20%;
    }
    #tbButtons{
        border-bottom: 1px solid #fff;
    }
    #tbButtons th{

    }
</style>
<div class="user-index">
    <table class="table-bordered">
        <tr id="tbHeader" class="table-primary">
            <th id="tbRole">Role</th>
            <th id="tbUsername">Username</th>
            <th id="tbPrimeiroNome">Primeiro Nome</th>
            <th id="tbUltimoNome">Ultimo Nome</th>
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
                        <table class="table-borderless">
                            <tr id="tbButtons">
                                <?php if(User::isCliente($modelUser->id)){ ?>
                                    <th><?= Html::a('<i class="fas fa-eye invisible"></i>') ?></th>
                                    <th><?= Html::a('<i class="fas fa-user-edit invisible"></i>') ?></th>
                                    <th><?= Html::a('<i class="fas fa-trash-alt invisible"></i>') ?></th>
                                    <?php if($modelUser->status == User::STATUS_ACTIVE){ ?>
                                        <th><?= Html::a('<i class="fas fa-lock text-secondary"></i>', ['/user/bloquear', 'id' => $modelUser->id]) ?></th>
                                    <?php }
                                    else{ ?>
                                        <th><?= Html::a('<i class="fas fa-lock-open text-secondary"></i>', ['/user/desbloquear', 'id' => $modelUser->id]) ?></th>
                                    <?php }
                                }
                                else{ ?>
                                    <th><?= Html::a('<i class="fas fa-eye text-info"></i>', ['/user/view', 'id' => $modelUser->id]) ?></th>
                                    <th><?= Html::a('<i class="fas fa-user-edit text-warning"></i>', ['/user/update', 'id' => $modelUser->id]) ?></th>
                                    <th><?= Html::a('<i class="fas fa-trash-alt text-danger"></i>', ['/user/delete', 'id' => $modelUser->id], ['data' => ['confirm' => 'Are you sure you want to delete this item?', 'method' => 'post']]) ?></th>
                                    <th><?= Html::a('<i class="fas fa-lock invisible"></i>') ?></th>
                                <?php }?>
                            </tr>
                        </table>
                    </td>
                </tr>
            <?php }
        }?>
    </table>

</div>
