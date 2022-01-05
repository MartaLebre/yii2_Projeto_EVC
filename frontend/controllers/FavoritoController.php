<?php

namespace frontend\controllers;

use common\models\Favorito;
use common\models\FavoritoSearch;
use Yii;
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
        if (Yii::$app->user->can('visualizarFavoritos')) {
            $db_favoritos = Favorito::find()
                ->where(['id_user' => Yii::$app->user->id])
                ->all();

            return $this->render('index', [
                'db_favoritos' => $db_favoritos,
            ]);
        }else{
            Yii::$app->session->setFlash('danger', ' Não têm permissões para visualizar os favoritos');
            return $this->redirect(['site/index']);
        }
    }

    /**
     * Creates a new Favorito model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($codigo_produto)
    {
        if (Yii::$app->user->can('adicionarProdutosFavoritos')) {

            $model_favorito = new Favorito();

            $model_favorito->codigo_produto = $codigo_produto;
            $model_favorito->id_user = Yii::$app->user->getId();
            $model_favorito->save();

            Yii::$app->session->setFlash('success', $model_favorito->produto->modelo->nome . ' ' . $model_favorito->produto->nome . ' foi adicionado à sua lista de favoritos.');
            return $this->redirect(Yii::$app->request->referrer);
        }else{
            Yii::$app->session->setFlash('danger', ' Não têm permissões para adicionar aos favoritos');
            return $this->redirect(['site/index']);
        }
    }

    /**
     * Deletes an existing Favorito model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->can('eliminarFavoritos')) {
            $model_favorito = $this->findModel($id);
            $model_favorito->delete();

            Yii::$app->session->setFlash('danger', $model_favorito->produto->modelo->nome . ' ' . $model_favorito->produto->nome . ' foi removido da sua lista de favoritos.');
            return $this->redirect(Yii::$app->request->referrer);
        }else {
            Yii::$app->session->setFlash('danger', ' Não têm permissões para eliminar favoritos');
            return $this->redirect(['site/index']);
        }
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
