<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Faturacao */

$this->title = 'Faturação';
$this->params['breadcrumbs'][] = ['label' => 'Faturacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faturacao-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
