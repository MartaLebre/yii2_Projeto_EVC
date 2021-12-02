<?php

namespace frontend\controllers;

use common\models\Favorito;
use common\models\FavoritoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FavoritoController implements the CRUD actions for Favorito model.
 */
class FavoritoController extends Controller
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
     * Lists all Favorito models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FavoritoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Favorito model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($codigo_produto){
        $modelFavorito = new Favorito();
        
        $modelFavorito->codigo_produto = $codigo_produto;
        $modelFavorito->id_user = \Yii::$app->user->getId();
        $modelFavorito->save();
    
        return $this->redirect(\Yii::$app->request->referrer);
    }

    /**
     * Deletes an existing Favorito model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id){
        $this->findModel($id)->delete();
    
        return $this->redirect(\Yii::$app->request->referrer);
    }
    
    /**
     * Finds the Favorito model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Favorito the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if(($model = Favorito::findOne($id)) !== null){
            return $model;
        }
    
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
