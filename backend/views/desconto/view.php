<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Desconto */
/* @var $form yii\bootstrap4\ActiveForm */

$this->registerCssFile("@web/css/create_form.css");

$this->title = 'Detalhes Desconto';
?>
<div class="desconto-create">
    <div class="col-4 offset-4">
        <div class="card">
            <div class="card-header">
                <h4><?= $this->title ?></h4>
                <p>Por favor preencha os seguintes campos</p>
            </div>
    
            <div class="card-body">
                
                <input class="form-control" type="text" placeholder="<?= $model->getAttribute('data_comeco') ?>" readonly>
                
                <input class="form-control" type="text" placeholder="<?= $model->getAttribute('data_final') ?>" readonly>
                
                <input class="form-control" type="text" placeholder="<?= $model->getAttribute('valor') ?>" readonly>
                
                <div class="text-right">
                    <?= Html::a('Apagar Desconto', ['/desconto/delete', 'id_modelo' => $model->id_modelo],
                        ['class'=>'btn btn-dark btn-deletedesconto shadow-sm', 'data-method' => 'post']); ?>
                </div>
            </div>
        </div>
    </div>
</div>
