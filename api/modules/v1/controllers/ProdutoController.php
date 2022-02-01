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

        $model_modelo = $produto->modelo;
        $model_desconto = $model_modelo->desconto;

        if ($model_desconto != null && $model_desconto->getDescontoActivo($model_desconto->id_modelo)) {
            $preco = $produto->preco - ($produto->preco * ($model_desconto->valor / 100));
        } else {
            $preco = $produto->preco;
        }

        if($produto != null){
            return[
                'codigo_produto' => $produto->codigo_produto,
                'nome' => $produto->nome,
                'genero' => $produto->genero,
                'descricao' => $produto->descricao,
                'tamanho' => $produto->tamanho,
                'preco' => $preco,
                'foto' => $produto->foto = 'http://192.168.1.177:8080/imagens/' . $produto->foto,
            ];
        }else{
            throw new \yii\web\NotFoundHttpException("O produto não foi encontrado");
        }

    }
}