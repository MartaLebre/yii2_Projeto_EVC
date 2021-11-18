<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Faturacao */

$this->title = 'Create Faturacao';
$this->params['breadcrumbs'][] = ['label' => 'Faturacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faturacao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
