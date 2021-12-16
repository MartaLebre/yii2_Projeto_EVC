<?php

namespace backend\controllers;

use Yii;
use common\models\Encomenda;
use common\models\EncomendaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EncomendaController implements the CRUD actions for Encomenda model.
 */
class EncomendaController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Encomenda models.
     * @return mixed
     */
    public function actionIndex()
    {
        $encomendas = Encomenda::find()->where(['estado' =>  'pendente'])->orWhere(['estado' => 'em processamento'])->orWhere(['estado' => 'enviado'])->orWhere(['estado' => 'entregue'])->all();

        return $this->render('index', [
            'encomendas' => $encomendas,
        ]);
    }

    public function actionUpdate($id_encomenda)
    {
        Encomenda::getUpdateStatusEncomenda($id_encomenda);

        return $this->redirect(Yii::$app->request->referrer);
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
