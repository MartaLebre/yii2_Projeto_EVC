<?php

namespace backend\controllers;

use common\models\Desconto;
use Yii;
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
     * Displays a single Desconto model.
     * @param int $id_modelo Id Modelo
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_modelo)
    {
        if (Yii::$app->user->can('visualizarDesconto')) {
            return $this->render('view', [
                'model' => $this->findModel($id_modelo),
            ]);
        }else {
            Yii::$app->session->setFlash('danger', ' Não têm permissões para Visualizar descontos');
            return $this->redirect(['site/index']);
        }
    }

    /**
     * Creates a new Desconto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_modelo)
    {
        if (Yii::$app->user->can('criarDesconto')) {
            $model = new Desconto();

            if ($this->request->isPost) {
                if ($model->load($this->request->post())) {
                    $model->id_modelo = $id_modelo;
                    $model->save();
                    
                    return $this->redirect(['modelo/index']);
                }
            } else{
                $model->loadDefaultValues();
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        }else{
            Yii::$app->session->setFlash('danger', ' Não têm permissões para criar descontos');
            return $this->redirect(['site/index']);
        }
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
        if (Yii::$app->user->can('apagarDesconto')) {
            $this->findModel($id_modelo)->delete();
            
            return $this->redirect(['modelo/index']);
        }else {
            Yii::$app->session->setFlash('danger', ' Não têm permissões para apagar descontos');
            return $this->redirect(['modelo/index']);
        }
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
