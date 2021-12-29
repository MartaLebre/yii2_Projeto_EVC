<?php

namespace backend\controllers;

use backend\models\UploadFormProduto;
use common\models\Produto;
use common\models\ProdutoSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

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

        return $this->render('index', [
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
        return $this->render('view', [
            'model' => $this->findModel($codigo_produto),
        ]);
    }
    
    /**
     * Creates a new Produto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_modelo){

        if (Yii::$app->user->can('criarProduto')) {

            $model = new Produto();
            $modelUpload = new UploadFormProduto();
            $codigoProdutos = $this->getCodigoProdutos();

            if ($this->request->isPost && $model->load($this->request->post()) && $modelUpload->load(Yii::$app->request->post())) {

                $codigo_random = rand(100, 1000);

                if ($codigoProdutos != null) {

                    $checkDisponivel['tentativas'] = 0;

                    do {
                        $codigo_random = rand(100, 1000);
                        $checkDisponivel['indisponivel'] = false;

                        foreach ($codigoProdutos as $codigo_produto) {
                            if ($codigo_random == $codigo_produto) {
                                $checkDisponivel['indisponivel'] = true;
                                break;
                            }
                        }

                        $checkDisponivel['tentativas'] += 1;

                        if ($checkDisponivel['tentativas'] >= 5) {

                            Yii::$app->session->setFlash('error', 'ERRO! Tente novamente.');
                            return $this->render('create', [
                                'model' => $model,
                            ]);
                        }
                    } while ($checkDisponivel['indisponivel'] == true);
                }

                $model->codigo_produto = $codigo_random;
                $modelUpload->imageFile = UploadedFile::getInstance($model, 'imageFile');
                $model->foto = UploadedFile::getInstance($modelUpload, 'imageFile')->name;
                $modelUpload->upload();
                $model->data = date('Y-m-d H:i:s');
                $model->id_modelo = $id_modelo;
                $model->save();

                return $this->redirect(['index']);
            } else {
                $model->loadDefaultValues();
            }

            return $this->render('create', [
                'model' => $model,
                'modelUpload' => $modelUpload,
            ]);
        }  else {

        }
    }
    
    public static function getCodigoProdutos(){
        
        $codigosProdutos = Produto::find()->all();
        
        if ($codigosProdutos != null) {
            foreach ($codigosProdutos as $codigo) {
                $codigosProduto_all[] = $codigo->codigo_produto;
            }
            return $codigosProduto_all;
        }
        
    }
    /**
     * Updates an existing Produto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $codigo_produto Codigo Produto
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($codigo_produto)
    {
        $model = $this->findModel($codigo_produto);
        
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'codigo_produto' => $model->codigo_produto]);
        }
        
        return $this->render('update', [
            'model' => $model,
        ]);
    }
    
    /**
     * Deletes an existing Produto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $codigo_produto Codigo Produto
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($codigo_produto)
    {
        $this->findModel($codigo_produto)->delete();
        
        return $this->redirect(['index']);
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
