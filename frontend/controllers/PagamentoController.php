<?php

namespace frontend\controllers;

use common\models\Encomenda;
use common\models\ItemCompra;
use common\models\Pagamento;
use common\models\PagamentoSearch;
use common\models\Produto;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PagamentoController implements the CRUD actions for Pagamento model.
 */
class PagamentoController extends Controller
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
                'access' => [
                    'class' => AccessControl::className(),
                    'only' => ['index', 'view', 'create', 'update', 'delete'],
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['index', 'view', 'create', 'update', 'delete'],
                            'roles' => ['@'],
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Pagamento models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PagamentoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pagamento model.
     * @param int $id_user Id User
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_user)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_user),
        ]);
    }

    /**
     * Creates a new Pagamento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate(){

        if (Yii::$app->user->can('encomendarProdutos')) {
            $model_pagamento = $this->findModel(Yii::$app->user->id);

            if ($model_pagamento == null) {
                $model_pagamento = new Pagamento();

                if ($this->request->isPost) {
                    if ($model_pagamento->load($this->request->post())) {
                        $model_pagamento->id_user = Yii::$app->user->id;
                        $model_pagamento->save();

                        $model_encomenda = Encomenda::find()
                            ->where(['id_user' => $model_pagamento->id_user, 'estado' => 'carrinho'])
                            ->one();

                        $models_itemcompra = ItemCompra::find()
                            ->where(['id_encomenda' => $model_encomenda->id])
                            ->all();

                        foreach ($models_itemcompra as $model_itemcompra) {
                            $model_produto = Produto::find()
                                ->where(['codigo_produto' => $model_itemcompra->codigo_produto])
                                ->one();

                            $model_produto->updateAttributes(['quantidade' => $model_produto->quantidade - $model_itemcompra->quantidade]);
                        }

                        Encomenda::getUpdateStatusEncomenda($model_encomenda->id);

                        Yii::$app->session->setFlash('success', 'Obrigado pela sua compra! Para mais informações sobre o estado da sua encomenda aceda à área "Minhas Encomendas"! ');
                        return $this->redirect(Url::home());
                    }
                } else {
                    $model_pagamento->loadDefaultValues();
                }
            } else {
                if ($this->request->isPost && $model_pagamento->load($this->request->post())    ) {
                    $model_pagamento->update();

                    $model_encomenda = Encomenda::find()
                        ->where(['id_user' => $model_pagamento->id_user, 'estado' => 'carrinho'])
                        ->one();

                    $models_itemcompra = ItemCompra::find()
                        ->where(['id_encomenda' => $model_encomenda->id])
                        ->all();

                    foreach ($models_itemcompra as $model_itemcompra) {
                        $model_produto = Produto::find()
                            ->where(['codigo_produto' => $model_itemcompra->codigo_produto])
                            ->one();

                        $model_produto->updateAttributes(['quantidade' => $model_produto->quantidade - $model_itemcompra->quantidade]);
                    }

                    Encomenda::getUpdateStatusEncomenda($model_encomenda->id);

                    Yii::$app->session->setFlash('success', 'Obrigado pela sua compra! Para mais informações sobre o estado da sua encomenda aceda à área "Minhas Encomendas"!');
                    return $this->redirect(Url::home());
                }
            }

            return $this->render('create', [
                'model' => $model_pagamento,
            ]);

        }else {
            Yii::$app->session->setFlash('danger', ' Não tem permissões para finalizar encomenda');
            return $this->redirect(['site/index']);
        }

    }

    /**
     * Updates an existing Pagamento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_user Id User
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_user)
    {
        $model = $this->findModel($id_user);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_user' => $model->id_user]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Pagamento model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_user Id User
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_user)
    {
        $this->findModel($id_user)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pagamento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_user Id User
     * @return Pagamento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_user)
    {
        if (($model = Pagamento::findOne($id_user)) !== null) {
            return $model;
        }
        return null;

        //throw new NotFoundHttpException('The requested page does not exist.');
    }
}
