<?php

namespace backend\controllers;

use common\models\Desconto;
use common\models\Encomenda;
use common\models\Faturacao;
use common\models\Favorito;
use common\models\LoginForm;
use common\models\Modelo;
use common\models\Produto;
use common\models\User;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\rbac\Role;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public static function actionTotalUsers()
    {
        $users = User::find()
            ->where(['status' => User::STATUS_ACTIVE])
            ->count();

        return $users;

    }

    public static function actionTotalFavoritos()
    {
        $favoritos = Favorito::find()
            ->count();

        return $favoritos;

    }

    public static function actionTotalEncomendas()
    {
        $compras = Encomenda::find()
            ->where(['estado' => 'pendente'])
            ->count();

        return $compras;

    }

    public static function actionTotalProdutos()
    {
        $produtos = Produto::find()
            ->where(['<>', 'quantidade', 0])->count();

        return $produtos;

    }

    public static function actionTotalDescontos()
    {
        $descontos = Desconto::find()
            ->count();

        return $descontos;

    }

    public static function actionTotalMysteryBoxes()
    {
        $mysteryBoxes = Modelo::find()
            ->where(['nome' => 'Mystery Boxes'])
            ->count();

        return $mysteryBoxes;

    }


    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if(!Yii::$app->user->isGuest){
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();

        if($model->load(Yii::$app->request->post())){
            
            $checkUser = User::findByUsername($model->username);
            
            if($checkUser['status'] == User::STATUS_ACTIVE && !Yii::$app->authManager->getAssignment('cliente', $checkUser->id)){
                $model->login();
                
                return $this->redirect('index');
            }

        }
        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
