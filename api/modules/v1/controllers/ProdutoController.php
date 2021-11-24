<?php

namespace api\modules\v1\controllers;

use common\models\Produto;
use yii\rest\ActiveController;

class ProdutoController extends ActiveController
{
    public $modelClass = 'common\models\Produto';

    public function actionPesquisa($pesquisa){
        $pesquisaCodigo = Produto::find()
            ->andFilterWhere(['like', 'codigo_produto', $pesquisa])
            ->one();

        if ($pesquisaCodigo != null){
            $codigoproduto = $pesquisaCodigo;
        }
    }
}