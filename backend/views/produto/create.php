<?php

use common\widgets\Alert;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Produto */

$this->title = 'Criar Produto';
$this->params['breadcrumbs'][] = ['label' => 'Produtos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="produto-create">
    
    <?= Alert::widget() ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

