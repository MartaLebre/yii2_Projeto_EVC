<?php

namespace frontend\controllers;

use common\models\ItemCompra;
use common\models\ItemCompraSearch;
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
        $searchModel = new ItemCompraSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ItemCompra model.
     * @param int $codigo_produto Codigo Produto
     * @param int $id_encomenda Id Encomenda
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($codigo_produto, $id_encomenda)
    {
        return $this->render('view', [
            'model' => $this->findModel($codigo_produto, $id_encomenda),
        ]);
    }

    /**
     * Creates a new ItemCompra model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_encomenda, $codigo_produto)
    {
        $model = new ItemCompra();


        $model->codigo_produto = $codigo_produto;
        $model->id_encomenda = $id_encomenda;
        $model->quantidade = 1;
        $model->preço_venda = $model->codigoProduto->preco;
        $model->save();

        return $this->redirect(['produto/index']);

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

    /**
     * Deletes an existing ItemCompra model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $codigo_produto Codigo Produto
     * @param int $id_encomenda Id Encomenda
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($codigo_produto, $id_encomenda)
    {
        $this->findModel($codigo_produto, $id_encomenda)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ItemCompra model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $codigo_produto Codigo Produto
     * @param int $id_encomenda Id Encomenda
     * @return ItemCompra the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($codigo_produto, $id_encomenda)
    {
        if (($model = ItemCompra::findOne(['codigo_produto' => $codigo_produto, 'id_encomenda' => $id_encomenda])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
