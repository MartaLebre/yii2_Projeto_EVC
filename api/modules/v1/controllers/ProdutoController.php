<?php

namespace api\modules\v1\controllers;

use common\models\Produto;
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

    public function actionDetalhes($codigo_produto){
        $produto = Produto::findOne(['codigo_produto' => $codigo_produto]);

        if($produto != null){
            return[
                'codigo_produto' => $produto->codigo_produto,
                'nome' => $produto->nome,
                'genero' => $produto->genero,
                'descricao' => $produto->descricao,
                'tamanho' => $produto->tamanho,
                'preco' => $produto->preco,
            ];
        }else{
            throw new \yii\web\NotFoundHttpException("O produto não foi encontrado");
        }

    }
}