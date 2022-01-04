<?php

namespace frontend\controllers;

use common\models\Encomenda;
use common\models\EncomendaSearch;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EncomendaController implements the CRUD actions for Encomenda model.
 */
class EncomendaController extends Controller
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
     * Lists all Encomenda models.
     * @return mixed
     */
    public function actionIndex()
    {
        $encomendas = Encomenda::find()->where(['id_user' => Yii::$app->user->id])->all();

        return $this->render('index', [
            'encomendas' => $encomendas,
        ]);
    }

    /**
     * Displays a single Encomenda model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Encomenda model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($codigo_produto)
    {

        $encomenda = Encomenda::find()->where(['estado' =>  'carrinho', 'id_user' => Yii::$app->user->id])->one();

        if ($encomenda == null) {
            $model_encomenda = new Encomenda();
            $model_encomenda->estado = 'carrinho';
            $model_encomenda->data = date('Y-m-d H:i:s');
            $model_encomenda->id_user = Yii::$app->user->getId();
            $model_encomenda->save();

            return $this->redirect(['/itemcompra/create', 'id_encomenda' => $model_encomenda->id, 'codigo_produto' => $codigo_produto]);

        } else {
            return $this->redirect(['/itemcompra/create', 'id_encomenda' => $encomenda->id, 'codigo_produto' => $codigo_produto]);

        }

    }

    /**
     * Updates an existing Encomenda model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Encomenda model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Encomenda model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Encomenda the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Encomenda::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
