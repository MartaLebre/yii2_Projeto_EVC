<?php

namespace frontend\controllers;

use common\models\User;
use common\models\UserSearch;
use common\models\Perfil;
use app\models\PerfilSearch;
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
        $modelUser = $this->findModel($id);
        $modelPerfil = $modelUser->perfil;
    
        if($this->request->isPost && $modelUser->load($this->request->post()) && $modelPerfil->load($this->request->post())){
            $modelUser->update();
            $modelPerfil->update();
            return $this->redirect(['site/index']);
        }
    
        return $this->render('update', [
            'modelUser' => $modelUser,
            'modelPerfil' => $modelPerfil,
    
        ]);
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
