<?php

namespace frontend\controllers;

use common\models\Desconto;
use common\models\Modelo;
use common\models\Produto;
use common\models\ProdutoSearch;
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
            ]
        );
    }

    /**
     * Lists all Produto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProdutoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
    
        $dataProvider->pagination->setPageSize(8);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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

        $db_mysteryBoxesModelo = Modelo::find()->where(['nome' => 'Mystery Boxes'])->one();

        if($db_mysteryBoxesModelo != null){

                $dataProvider->query->andWhere(['id_modelo' => $db_mysteryBoxesModelo->id]);
        }
        else $dataProvider = null;

        return $this->render('mysteryboxes', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Lists all Produto models.
     * @return mixed
     */
    public function actionDescontos()
    {
        $searchModel = new ProdutoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        
        $db_descontos = Desconto::find()
            ->where(['<=', 'data_comeco', date('Y-m-d')])
            ->andWhere(['>=', 'data_final', date('Y-m-d')])
            ->all();
    
        if($db_descontos != null){
            foreach($db_descontos as $model_desconto){
                $dataProvider->query->andWhere(['id_modelo' => $model_desconto->modelo->id]);
            }
        }
        else $dataProvider = null;
    
        return $this->render('descontos', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
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
