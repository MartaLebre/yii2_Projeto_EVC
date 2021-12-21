<?php

namespace frontend\controllers;

use common\models\Faturacao;
use common\models\FaturacaoSearch;
use common\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FaturacaoController implements the CRUD actions for Faturacao model.
 */
class FaturacaoController extends Controller
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
     * Lists all Faturacao models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FaturacaoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Faturacao model.
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
     * Creates a new Faturacao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = $this->findModel(\Yii::$app->user->id);

        if ($model == null) {
            $model = new Faturacao();
            if ($this->request->isPost) {
                if ($model->load($this->request->post())) {

                    $model->id_user = \Yii::$app->user->id;
                    $model->save();

                    return $this->redirect(['pagamento/create']);
                }
            } else {
                $model->loadDefaultValues();
            }
        } else {
            if ($this->request->isPost && $model->load($this->request->post())) {
                $model->update();
                return $this->redirect(['pagamento/create']);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);

    }


    /**
     * Updates an existing Faturacao model.
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
     * Deletes an existing Faturacao model.
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
     * Finds the Faturacao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_user Id User
     * @return Faturacao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_user)
    {
        if (($model = Faturacao::findOne($id_user)) !== null) {
            return $model;
        }

        return null;
    }
}
