<?php

namespace frontend\controllers;

use common\models\Desconto;
use common\models\Modelo;
use common\models\Produto;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\SignupForm;

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
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $slideshow = [
            '<img src="img/slideshow/slideshow_1.jpg"/>',
            '<img src="img/slideshow/slideshow_2.jpg"/>',
            '<img src="img/slideshow/slideshow_3.jpg"/>',
            '<img src="img/slideshow/slideshow_4.jpg"/>',
            '<img src="img/slideshow/slideshow_5.jpg"/>'
        ];
    
        $db_novidades = Produto::find()
            ->orderBy(['data' => SORT_DESC])
            ->limit(4)
            ->all();
    
        $db_descontos = Produto::find()
            ->orderBy(['data' => SORT_DESC])
            ->where(['<=', 'desconto.data_comeco', date('Y-m-d')])
            ->andWhere(['>=', 'desconto.data_final', date('Y-m-d')])
            ->leftJoin('desconto', 'desconto.id_modelo = produto.id_modelo')
            ->limit(4)
            ->all();
        
        return $this->render('index', [
            'slideshow' => $slideshow,
            'db_descontos' => $db_descontos,
            'db_novidades' => $db_novidades,
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Registo efetuado com sucesso.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }
}
