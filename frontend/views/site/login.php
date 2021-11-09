<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */

/* @var $model \common\models\LoginForm */

use yii\bootstrap4\Html;

$this->title = 'Login';
?>
<br>
<div class="col-6 offset-3">
    <div class="card">
        <div class="card-body login-card-body">
            <h4>Iniciar sessão</h4>
            <p>Por favor preencha os seguintes campos</p>

            <?php $form = \yii\bootstrap4\ActiveForm::begin(['id' => 'login-form']) ?>

            <?= $form->field($model, 'username', [
                'options' => ['class' => 'form-group has-feedback'],
                'inputTemplate' => '{input}',
                'template' => '{beginWrapper}{input}{error}{endWrapper}'])
                ->label(false)
                ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

            <?= $form->field($model, 'password', [
                'options' => ['class' => 'form-group has-feedback'],
                'inputTemplate' => '{input}<div class="input-group-append"></div>',
                'template' => '{beginWrapper}{input}{error}{endWrapper}'])
                ->label(false)
                ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

            <div class="row">
                <div class="col-6">
                    <p>Não têm uma conta? <?= Html::a('Registe-se', ['/site/signup'], ['name' => 'signin-button']) ?></p>
                </div>
                <div class="col-3 offset-3">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
                </div>
            </div>

            <?php \yii\bootstrap4\ActiveForm::end(); ?>
        </div>
    </div>
</div>
<!-- /.login-card-body -->
</div>
</div>
