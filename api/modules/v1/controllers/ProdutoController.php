<?php

namespace api\modules\v1\controllers;

use common\models\Perfil;
use common\models\Produto;
use common\models\User;
use yii\rest\ActiveController;

class ProdutoController extends ActiveController
{
    public $modelClass = 'common\models\Produto';

    public function actionPesquisa($pesquisa){
        $produtos = Produto::find()
            ->andFilterWhere(['like', 'codigo_produto', $pesquisa])
            ->one();

        if($produtos != null){
            return $produtos;
        }else{
            throw new \yii\web\NotFoundHttpException("Produto não encontrado");
        }
    }
}