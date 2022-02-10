<?php

namespace api\modules\v1\controllers;

use common\models\Produto;
use yii\rest\ActiveController;

class ProdutoController extends ActiveController
{
    public $modelClass = 'common\models\Produto';

    public function actionAll()
    {
        $produtos = Produto::find()->all();

        if ($produtos == null) {
            return null;
        } else {
            foreach ($produtos as $produto) {
                $model_modelo = $produto->modelo;
                $model_desconto = $model_modelo->desconto;

                if ($model_desconto != null && $model_desconto->getDescontoActivo($model_desconto->id_modelo)) {
                    $preco = $produto->preco - ($produto->preco * ($model_desconto->valor / 100));
                } else {
                    $preco = $produto->preco;
                }

                $produto->preco = $preco;

                $produto->foto = 'http://192.168.1.177:8080/imagens/' . $produto->foto;
            }
            return $produtos;
        }
    }

    public function actionPesquisa($pesquisa)
    {
        $produtos = Produto::find()
            ->andFilterWhere(['like', 'codigo_produto', $pesquisa])
            ->one();

        if ($produtos != null) {
            return $produtos;
        } else {
            throw new \yii\web\NotFoundHttpException("Produto não encontrado");
        }
    }

    public function actionDetalhes($codigo_produto)
    {
        $produto = Produto::findOne(['codigo_produto' => $codigo_produto]);

        $model_modelo = $produto->modelo;
        $model_desconto = $model_modelo->desconto;

        if ($model_desconto != null && $model_desconto->getDescontoActivo($model_desconto->id_modelo)) {
            $preco = $produto->preco - ($produto->preco * ($model_desconto->valor / 100));
        } else {
            $preco = $produto->preco;
        }

        if ($produto != null) {
            return [
                'codigo_produto' => $produto->codigo_produto,
                'nome' => $produto->nome,
                'genero' => $produto->genero,
                'descricao' => $produto->descricao,
                'tamanho' => $produto->tamanho,
                'preco' => $preco,
                'foto' => $produto->foto = 'http://192.168.1.177:8080/imagens/' . $produto->foto,
            ];
        } else {
            throw new \yii\web\NotFoundHttpException("O produto não foi encontrado");
        }
    }

    public function actionAdicionar()
    {
        $codigo_produto = \Yii::$app->request->post('codigo_produto');
        $nome = \Yii::$app->request->post('nome');
        $genero = \Yii::$app->request->post('genero');
        $descricao = \Yii::$app->request->post('descricao');
        $tamanho = \Yii::$app->request->post('tamanho');
        $preco = \Yii::$app->request->post('preco');
        $quantidade = \Yii::$app->request->post('quantidade');
        $data = \Yii::$app->request->post('data');
        $id_modelo = \Yii::$app->request->post('id_modelo');
        $foto = \Yii::$app->request->post('foto');

        $produtomodel = new $this->modelClass;

        $produtomodel->codigo_produto = $codigo_produto;
        $produtomodel->nome = $nome;
        $produtomodel->genero = $genero;
        $produtomodel->descricao = $descricao;
        $produtomodel->tamanho = $tamanho;
        $produtomodel->preco = $preco;
        $produtomodel->quantidade = $quantidade;
        $produtomodel->data = $data;
        $produtomodel->id_modelo = $id_modelo;
        $produtomodel->foto = $foto;

        $rec = $produtomodel->save();
        return ['SaveError' => $rec];
    }
}