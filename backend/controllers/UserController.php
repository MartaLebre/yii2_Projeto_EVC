<?php

namespace backend\controllers;

use backend\models\UserForm;
use common\models\Perfil;
use common\models\User;
use common\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $modelUsers = User::find()
            ->where(['status' => User::STATUS_ACTIVE])
            ->orWhere(['status' => User::STATUS_INACTIVE])
            ->all();

        return $this->render('index', [
            'modelUsers' => $modelUsers,
        ]);
    }

    /**
     * Displays a single User model.
     * @param int $id
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserForm();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->createUser()) {
                return $this->redirect(['index']);
               // return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            //$model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
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
            return $this->redirect(['view', 'id' => $modelUser->id]);
        }
        
        return $this->render('update', [
            'modelUser' => $modelUser,
            'modelPerfil' => $modelPerfil,
            
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        //Perfil::deleteAll(['id_user' => $id]);
        $user = User::findOne(['id' => $id]);

        $user->status  = User::STATUS_DELETED;

        $user->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionBloquear($id){

        $this->findModel($id)->updateAttributes(['status' => User::STATUS_INACTIVE]);

         return $this->redirect(['index']);
    }

    public function actionDesbloquear($id){

        $this->findModel($id)->updateAttributes(['status' => User::STATUS_ACTIVE]);

        return $this->redirect(['index']);
    }

}
