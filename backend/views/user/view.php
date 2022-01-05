<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $modelUser common\models\User */
/* @var $modelPerfil common\models\Perfil */
/* @var $form yii\bootstrap4\ActiveForm */

$this->registerCssFile("@web/css/create_form.css");

$this->title = 'Detalhes';
?>
<div class="user-update">
    <div class="col-5 offset-3">
        <div class="card">
            <div class="card-header">
                <h4><?= $this->title ?></h4>
                <p>Por favor preencha os seguintes campos</p>
            </div>
            <div class="card-body">
                <input class="form-control" type="text" placeholder="<?= $modelUser->getAttribute('username') ?>" readonly>

                <div class="row">
                    <div class="col-6">
                        <input class="form-control" type="text" placeholder="<?= $modelPerfil->getAttribute('primeiro_nome') ?>" readonly>
                    </div>
                    <div class="col-6">
                        <input class="form-control" type="text" placeholder="<?= $modelPerfil->getAttribute('ultimo_nome') ?>" readonly>
                    </div>
                </div>
                
                <input class="form-control" type="text" placeholder="<?= $modelPerfil->getAttribute('telemovel') ?>" readonly>

                <input class="form-control" type="text" placeholder="<?= $modelUser->getAttribute('email') ?>" readonly>
            </div>
        </div>
    </div>
</div>
