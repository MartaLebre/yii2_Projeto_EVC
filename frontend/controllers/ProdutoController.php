<?php

namespace frontend\controllers;

use common\models\Desconto;
use common\models\Modelo;
use common\models\Produto;
use common\models\ProdutoSearch;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProdutoController implements the CRUD actions for Produto model.
 */
class ProdutoController extends Controller
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
                    'class' => AccessControl::className(),
                    'only' => ['index', 'novidades', 'homem', 'mulher', 'modelo', 'mysteryboxes', 'descontos', 'view'],
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['index', 'novidades', 'homem', 'mulher', 'modelo', 'mysteryboxes', 'view' ,'descontos'],
                            'roles' => ['@'],
                        ],
                       [
                           'allow' => true,
                           'actions' => ['index', 'novidades', 'homem', 'mulher', 'modelo', 'mysteryboxes', 'view'],
                           'roles' => ['?'],
                       ],

                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Produto models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->can('visualizarProdutos')) {
            $searchModel = new ProdutoSearch();
            $dataProvider = $searchModel->search($this->request->queryParams);
            
            $pages = new Pagination(['totalCount' => $dataProvider->query->count()]);
    
            $dataProvider->query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'title' => 'Produtos',
                'pages' => $pages,
            ]);
        }else {
            Yii::$app->session->setFlash('danger', ' N??o tem permiss??es para visualizar produtos');
            return $this->redirect(['site/index']);
        }
    }
    
    public function actionNovidades()
    {
        $searchModel = new ProdutoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
    
        $dataProvider->pagination->setPageSize(8);
        
        $pages = new Pagination(['totalCount' => $dataProvider->pagination->getPageSize()]);
    
        $dataProvider->query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
    
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'title' => 'Novidades',
            'pages' => $pages,
        ]);

    }

    public function actionHomem()
    {
        $searchModel = new ProdutoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
    
        $dataProvider->query
            ->leftJoin('modelo', 'modelo.id = produto.id_modelo')
            ->where(['<>', 'modelo.nome', 'Mystery Boxes'])
            ->andWhere(['=', 'produto.genero', 'masculino'])
            ->andWhere(['<>', 'produto.quantidade', 0])
            ->all();
    
        $pages = new Pagination(['totalCount' => $dataProvider->query->count()]);
    
        $dataProvider->query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
    
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'modelos' => Modelo::getModelos(),
            'title' => 'Masculino',
            'pages' => $pages,
        ]);

    }

    public function actionMulher()
    {
        $searchModel = new ProdutoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
    
        $dataProvider->query
            ->leftJoin('modelo', 'modelo.id = produto.id_modelo')
            ->where(['<>', 'modelo.nome', 'Mystery Boxes'])
            ->andWhere(['=', 'produto.genero', 'feminino'])
            ->andWhere(['<>', 'produto.quantidade', 0])
            ->all();
    
        $pages = new Pagination(['totalCount' => $dataProvider->query->count()]);
    
        $dataProvider->query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
    
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'modelos' => Modelo::getModelos(),
            'title' => 'Feminino',
            'pages' => $pages,
        ]);

    }


    public function actionModelo($genero, $id_modelo)
    {
        $searchModel = new ProdutoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $dataProvider->query->andWhere(['genero' => $genero])->andWhere(['id_modelo' => $id_modelo]);
    
        $pages = new Pagination(['totalCount' => $dataProvider->query->count()]);
    
        $dataProvider->query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        
        $model_modelo = Modelo::find()->where(['id' => $id_modelo])->one();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'title' => $model_modelo->nome,
            'pages' => $pages,
        ]);

    }


    /**
     * Lists all Produto models.
     * @return mixed
     */
    public function actionMysteryboxes()
    {
        $searchModel = new ProdutoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
    
        $modelo_mysteryBoxes = Modelo::find()->where(['nome' => 'Mystery Boxes'])->one();
    
        if ($modelo_mysteryBoxes != null) {
            $dataProvider->query->andWhere(['id_modelo' => $modelo_mysteryBoxes->id]);
        }
    
        $pages = new Pagination(['totalCount' => $dataProvider->query->count()]);
    
        $dataProvider->query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'title' => 'Mystery Boxes',
            'pages' => $pages,
        ]);
    }
    
    /**
     * Lists all Produto models.
     * @return mixed
     */
    public function actionDescontos()
    {
        if (Yii::$app->user->can('visualizarDesconto')) {
            $searchModel = new ProdutoSearch();
            $dataProvider = $searchModel->search($this->request->queryParams);

            $dataProvider->query
                ->leftJoin('desconto', 'desconto.id_modelo = produto.id_modelo')
                ->where(['<=', 'desconto.data_comeco', date('Y-m-d')])
                ->andWhere(['>=', 'desconto.data_final', date('Y-m-d')])
                ->andWhere(['<>', 'produto.quantidade', 0])
                ->all();
            
            $pages = new Pagination(['totalCount' => $dataProvider->query->count()]);
    
            $dataProvider->query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'title' => 'Promo????es',
                'pages' => $pages,
            ]);
        }else {
            Yii::$app->session->setFlash('danger', ' N??o tem permiss??es para visualizar  descontos - Fa??a Login');
            return $this->redirect(['site/login']);
        }
    }

    /**
     * Displays a single Produto model.
     * @param int $codigo_produto Codigo Produto
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($codigo_produto)
    {
            $model_produto = $this->findModel($codigo_produto);

            $db_produtos = Produto::find()
                ->where(['id_modelo' => $model_produto->id_modelo])
                ->limit(4)
                ->all();

            return $this->render('view', [
                'model_produto' => $model_produto,
                'db_produtos' => $db_produtos,
            ]);

    }

    /**
     * Finds the Produto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $codigo_produto Codigo Produto
     * @return Produto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($codigo_produto)
    {
        if (($model = Produto::findOne($codigo_produto)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
