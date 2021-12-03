<?php

namespace backend\controllers;

use common\models\Desconto;
use common\models\DescontoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DescontoController implements the CRUD actions for Desconto model.
 */
class DescontoController extends Controller
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
     * Lists all Desconto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DescontoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Desconto model.
     * @param int $id_modelo Id Modelo
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_modelo)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_modelo),
        ]);
    }

    /**
     * Creates a new Desconto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_modelo)
    {
        $model = new Desconto();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->id_modelo = $id_modelo;
                $model->save();

                return $this->redirect(['view', 'id_modelo' => $model->id_modelo]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Desconto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_modelo Id Modelo
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_modelo)
    {
        $model = $this->findModel($id_modelo);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_modelo' => $model->id_modelo]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Desconto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_modelo Id Modelo
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_modelo)
    {
        $this->findModel($id_modelo)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Desconto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_modelo Id Modelo
     * @return Desconto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_modelo)
    {
        if (($model = Desconto::findOne($id_modelo)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
