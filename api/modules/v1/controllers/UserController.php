<?php

namespace api\modules\v1\controllers;

use common\models\LoginForm;
use frontend\models\SignupForm;
use Yii;
use yii\rest\ActiveController;
use common\models\User;
use common\models\Perfil;


class UserController extends ActiveController
{
    public $modelClass = 'common\models\User';
    public $modelClassPerfil = 'common\models\Perfil';

    public function actionRegisto(){

        //user
        $user = new User();
        $user->username = \Yii::$app->request->post('username');
        $user->email = \Yii::$app->request->post('email');
        $user->setPassword(\Yii::$app->request->post('password'));
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->save();

        //perfil
        $perfil = new Perfil();
        $perfil->primeiro_nome = \Yii::$app->request->post('primeiro_nome');
        $perfil->ultimo_nome = \Yii::$app->request->post('ultimo_nome');
        $perfil->telemovel = \Yii::$app->request->post('telemovel');
        $perfil->id_user = $user->id;
        $perfil->save();

        $auth = \Yii::$app->authManager;
        $clienteRole = $auth->getRole('cliente');
        $auth->assign($clienteRole, $user->getId());

        return true;
    }

    public function actionLogin(){
        $model = new LoginForm();

        $model->username = \Yii::$app->request->post('username');
        $model->password = \Yii::$app->request->post('password');

        $modeluser = User::findByUsername($model->username);

        if($modeluser['status'] == User::STATUS_ACTIVE && Yii::$app->authManager->getAssignment('cliente', $modeluser->id)){
            $model->login();

            return true;
        } else {
            throw new \yii\web\NotFoundHttpException("Esta conta não pode ser acedida.");
        }
    }

    public function actionEditar($username){
        $user = User::find()->where(['username' => $username])->one();

        if($user != null){
            $perfil = Perfil::find()->where(['id_user' => $user->id])->one();

            $user->username = \Yii::$app->request->post('username');
            $user->email = \Yii::$app->request->post('email');
            $user->password = \Yii::$app->request->post('password');
            $perfil->primeiro_nome = \Yii::$app->request->post('primeiro_nome');
            $perfil->ultimo_nome = \Yii::$app->request->post('ultimo_nome');
            $perfil->telemovel = \Yii::$app->request->post('telemovel');

            $user->save(false);
            $perfil->id_user = $user->getId();
            $perfil->save(false);

            if($user->save() == true && $perfil->save() == true){
                return true;
            }
        }
        return "Utilizador não encontrado/atualizado";
    }

    public function actionDetalhes($id){

        $user = User::findOne(['id' => $id]);
        $perfil = Perfil::findOne(['id_user' => $id]);

        if($user != null && $perfil != null){
            return ['Utilizador' => [
                'ID' => $perfil->id_user,
                'Username' => $user->username,
                'Email' => $user->email,
                'Primeiro Nome' => $perfil->primeiro_nome,
                'Ultimo Nome' => $perfil->ultimo_nome,
                'Telemovel' => $perfil->telemovel,
            ]];
        } else {
            throw new \yii\web\NotFoundHttpException("O utilizador não foi encontrado");
        }
    }

    public function actionApagar($username){
        $statusDelete = 0;

        $user = User::findOne(['username' => $username]);

        if($user != null){
            $user->status = $statusDelete;
            $user->save(false);
        } else {
            throw new \yii\web\NotFoundHttpException("Utilizador não encontrado");
        }
    }
}