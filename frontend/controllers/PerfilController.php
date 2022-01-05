<?php

namespace frontend\controllers;

use common\models\User;
use common\models\Perfil;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PerfilController implements the CRUD actions for Perfil model.
 */
class PerfilController extends Controller
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
     * Updates an existing Perfil model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->can('editarPerfil')) {

            $model_user = $this->findModel($id);
            $model_perfil = $model_user->perfil;

            if ($this->request->isPost && $model_user->load($this->request->post()) && $model_perfil->load($this->request->post())) {
                $model_user->update();
                $model_perfil->update();
                Yii::$app->session->setFlash('success', 'Dados atualizados com sucesso.');
                return $this->redirect(['update', 'id' => $model_user->id]);
            }

            return $this->render('update', [
                'model_user' => $model_user,
                'model_perfil' => $model_perfil,

            ]);
        }else{
            Yii::$app->session->setFlash('danger', ' Não têm permissões para editar o perfil');
            return $this->redirect(['site/index']);
        }
    }

    /**
     * Finds the Perfil model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Perfil the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
