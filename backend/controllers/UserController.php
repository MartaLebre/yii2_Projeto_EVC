<?php

namespace backend\controllers;

use backend\models\UserForm;
use common\models\Perfil;
use common\models\User;
use common\models\UserSearch;
use Yii;
use yii\filters\AccessControl;
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
                'access' => [
                    'class' => AccessControl::class,
                    'only' => ['index', 'view', 'create', 'update', 'delete'],
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['index', 'view', 'create', 'update', 'delete'],
                            'roles' => ['@'],
                        ]
                    ]
                ]
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
        $modelUser = $this->findModel($id);
        $modelPerfil = $modelUser->perfil;
        
        return $this->render('view', [
            'modelUser' => $modelUser,
            'modelPerfil' => $modelPerfil,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->can('adicionarGestor')) {
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
        } else {
            Yii::$app->session->setFlash('danger', ' Não têm permissões para adicionar Gestores de Stock');
            return $this->redirect(['site/index']);
        }
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
        if (Yii::$app->user->can('editarGestor')) {

            $modelUser = $this->findModel($id);
            $modelPerfil = $modelUser->perfil;

            if ($this->request->isPost && $modelUser->load($this->request->post()) && $modelPerfil->load($this->request->post())) {
                $modelUser->update();
                $modelPerfil->update();
                return $this->redirect(['index']);
            }

            return $this->render('update', [
                'modelUser' => $modelUser,
                'modelPerfil' => $modelPerfil,

            ]);

        } else {
            Yii::$app->session->setFlash('danger', ' Não têm permissões para atualizar Gestores de Stock');
            return $this->redirect(['site/index']);
        }
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
        if (Yii::$app->user->can('apagarGestor')) {

            //Perfil::deleteAll(['id_user' => $id]);
            $user = User::findOne(['id' => $id]);

            $user->status = User::STATUS_DELETED;

            $user->save();

            return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('danger', ' Não têm permissões para apagar Gestores de Stock');
            return $this->redirect(['site/index']);
        }
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

        if (Yii::$app->user->can('bloquearCliente')) {

            $this->findModel($id)->updateAttributes(['status' => User::STATUS_INACTIVE]);

            return $this->redirect(['index']);
        }else {
            Yii::$app->session->setFlash('danger', ' Não têm permissões para bloquear clientes');
            return $this->redirect(['site/index']);
        }
    }

    public function actionDesbloquear($id){

        if (Yii::$app->user->can('desbloquearCliente')) {

            $this->findModel($id)->updateAttributes(['status' => User::STATUS_ACTIVE]);

            return $this->redirect(['index']);
        }else{
            Yii::$app->session->setFlash('danger', ' Não têm permissões para desbloquear clientes');
            return $this->redirect(['site/index']);
        }
    }

}
