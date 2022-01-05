<?php

namespace frontend\controllers;

use common\models\Encomenda;
use common\models\ItemCompra;
use common\models\Produto;
use common\models\ProdutoSearch;
use Yii;
use yii\rbac\Item;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ItemcompraController implements the CRUD actions for ItemCompra model.
 */
class ItemcompraController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all ItemCompra models.
     * @return mixed
     */
    public function actionIndex()
    {
        $encomenda = Encomenda::find()->where(['estado' => 'carrinho', 'id_user' => Yii::$app->user->id])->one();

        if ($encomenda != null) {
            $db_carrinho = ItemCompra::find()->where(['id_encomenda' => $encomenda->id])->all();
        } else {
            $db_carrinho = null;
        }
        return $this->render('index', [
            'db_carrinho' => $db_carrinho
        ]);
    }

    /**
     * Creates a new ItemCompra model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_encomenda, $codigo_produto)
    {
        if (Yii::$app->user->can('adicinarProdutosAoCarrinho')) {


            $checkItemcompra = ItemCompra::find()
                ->where(['codigo_produto' => $codigo_produto])
                ->andWhere(['id_encomenda' => $id_encomenda])
                ->one();

            if ($checkItemcompra != null) {
                Yii::$app->session->setFlash('info', $checkItemcompra->produto->modelo->nome . ' ' . $checkItemcompra->produto->nome . ' já foi adicionado ao seu carrinho.');
                return $this->redirect(['produto/index']);
            } else {
                $model_itemcompra = new ItemCompra();

                $model_itemcompra->codigo_produto = $codigo_produto;
                $model_itemcompra->id_encomenda = $id_encomenda;
                $model_itemcompra->quantidade = 1;

                $model_modelo = $model_itemcompra->produto->modelo;
                $model_desconto = $model_modelo->desconto;
                if ($model_desconto != null && $model_desconto->getDescontoActivo($model_desconto->id_modelo)) {
                    $model_itemcompra->preco_venda = $model_itemcompra->produto->preco - ($model_itemcompra->produto->preco * ($model_desconto->valor / 100));
                } else {

                    $model_itemcompra->preco_venda = $model_itemcompra->produto->preco;
                }
                $model_itemcompra->save();

                Yii::$app->session->setFlash('success', $model_itemcompra->produto->modelo->nome . ' ' . $model_itemcompra->produto->nome . ' foi adicionado ao seu carrinho.');
                return $this->redirect(['produto/index']);
            }
        }else {
            Yii::$app->session->setFlash('danger', ' Não têm permissões para adicionar produtos do carrinho');
            return $this->redirect(['site/index']);
        }
    }

            /**
             * Updates an existing ItemCompra model.
             * If update is successful, the browser will be redirected to the 'view' page.
             * @param int $codigo_produto Codigo Produto
             * @param int $id_encomenda Id Encomenda
             * @return mixed
             * @throws NotFoundHttpException if the model cannot be found
             */
            public function actionUpdate($codigo_produto, $id_encomenda)
            {
                $model = $this->findModel($codigo_produto, $id_encomenda);

                if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                    return $this->redirect(['view', 'codigo_produto' => $model->codigo_produto, 'id_encomenda' => $model->id_encomenda]);
                }

                return $this->render('update', [
                    'model' => $model,
                ]);
            }

            public function actionQuantidade_add($codigo_produto, $id_encomenda)
            {
                $model_itemcompra = $this->findModel($codigo_produto, $id_encomenda);

                if ($model_itemcompra->quantidade < $model_itemcompra->produto->quantidade) {
                    $model_itemcompra->quantidade += 1;
                    $model_itemcompra->update();
                }

                return $this->redirect(Yii::$app->request->referrer);
            }

            public function actionQuantidade_sub($codigo_produto, $id_encomenda)
            {
                $model_itemcompra = $this->findModel($codigo_produto, $id_encomenda);

                if ($model_itemcompra->quantidade > 1) {
                    $model_itemcompra->quantidade -= 1;
                    $model_itemcompra->update();
                }

                return $this->redirect(Yii::$app->request->referrer);
            }

            /**
             * Deletes an existing ItemCompra model.
             * If deletion is successful, the browser will be redirected to the 'index' page.
             * @param int $codigo_produto Codigo Produto
             * @param int $id_encomenda Id Encomenda
             * @return mixed
             * @throws NotFoundHttpException if the model cannot be found
             */
            public
            function actionDelete($codigo_produto, $id_encomenda)
            {
                if (Yii::$app->user->can('eliminarProdutosAoCarrinho')) {

                    $this->findModel($codigo_produto, $id_encomenda)->delete();
                    $model_produto = Produto::findOne($codigo_produto);

                    Yii::$app->session->setFlash('danger', $model_produto->modelo->nome . ' ' . $model_produto->nome . ' foi removido do seu carrinho de compras.');
                    return $this->redirect(Yii::$app->request->referrer);
                }else{
                    Yii::$app->session->setFlash('danger', ' Não têm permissões para eliminar produtos do carrinho');
                    return $this->redirect(['site/index']);
                }
            }

            /**
             * Finds the ItemCompra model based on its primary key value.
             * If the model is not found, a 404 HTTP exception will be thrown.
             * @param int $codigo_produto Codigo Produto
             * @param int $id_encomenda Id Encomenda
             * @return ItemCompra the loaded model
             * @throws NotFoundHttpException if the model cannot be found
             */
            protected
            function findModel($codigo_produto, $id_encomenda)
            {
                if (($model = ItemCompra::findOne(['codigo_produto' => $codigo_produto, 'id_encomenda' => $id_encomenda])) !== null) {
                    return $model;
                }

                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }
