<?php

namespace frontend\controllers;

use common\models\Encomenda;
use common\models\Pagamento;
use common\models\PagamentoSearch;
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
    public function actionCreate()
    {
        $model = new Pagamento();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->id_user = \Yii::$app->user->id;
                $model->save();

               $encomenda = Encomenda::find()->where(['id_user' =>  $model->id_user, 'estado' => 'carrinho'])->one();
               Encomenda::getUpdateStatusEncomenda($encomenda->id);

                return $this->redirect(Url::home());

            }
        } else {
            $model->loadDefaultValues();
        }




        return $this->render('create', [
            'model' => $model,
        ]);
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
        if (($model = Pagamento::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
