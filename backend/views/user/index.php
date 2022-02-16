<?php

use yii\helpers\Html;
use common\models\User;

/* @var $this yii\web\View */
/* @var $modelUsers common\models\User */

$this->registerCssFile("@web/css/index_user.css");

$this->title = 'Lista de Utilizadores';
?>
<div class="user-index">
    <div class="row">
        <div class="col-8 offset-2">
            <div class="card">
                <div class="card-header">
                    <p class="card-title"><?= $this->title ?></p>
                </div>
                <?php if($modelUsers != null){ ?>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Username</th>
                            <th scope="col">Primeiro Nome</th>
                            <th scope="col">Último Nome</th>
                            <th scope="col">Role</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
    
                        <tbody>
                        <?php foreach($modelUsers as $modelUser){
                            $userRole = \Yii::$app->authManager->getRolesByUser($modelUser->id)?>
                            <tr>
                                <th scope="row" ><?= $modelUser->id ?></th>
                                <td><?= $modelUser->username ?></td>
                                <td><?= $modelUser->perfil['primeiro_nome'] ?></td>
                                <td><?= $modelUser->perfil['ultimo_nome'] ?></td>
                                <td><?= array_keys($userRole)[0]?></td>
    
                                <?php
                                if(User::isAdmin($modelUser->id)){ ?>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                <?php }
                                elseif(User::isCliente($modelUser->id)){ ?>
                                    <td><?= Html::a('<i class="fas fa-info"></i>', ['user/view', 'id' => $modelUser->id]) ?></td>
                                    <td></td>
                                    <td></td>
                                    <?php
                                    if($modelUser->status == User::STATUS_ACTIVE){ ?>
                                        <td><?= Html::a('<i class="fas fa-lock"></i>', ['user/bloquear', 'id' => $modelUser->id]) ?></td>
                                    <?php }
                                    else{ ?>
                                        <td><?= Html::a('<i class="fas fa-lock-open"></i>', ['user/desbloquear', 'id' => $modelUser->id]) ?></td>
                                    <?php }
                                }
                                else{ ?>
                                    <td><?= Html::a('<i class="fas fa-info"></i>', ['user/view', 'id' => $modelUser->id]) ?></td>
                                    <td><?= Html::a('<i class="fas fa-user-edit"></i>', ['user/update', 'id' => $modelUser->id]) ?></td>
                                    <td><?= Html::a('<i class="fas fa-trash-alt"></i>', ['user/delete', 'id' => $modelUser->id], ['data' => ['confirm' => 'Tem a certeza que quer eliminar este utilizador?', 'data-method' => 'post']]) ?></td>
                                    <td></td>
                                <?php }?>
                            </tr>
                        <?php }?>
                        </tbody>
                    </table>
                    <?php }
                    else{ ?>
                        <div class="user-null">
                            <h5>Não existem utilizadores disponíveis</h5>
                        </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
</div>
