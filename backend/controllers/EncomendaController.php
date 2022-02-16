<?php

namespace backend\controllers;

use common\models\Faturacao;
use common\models\ItemCompra;
use common\models\Pagamento;
use Yii;
use common\models\Encomenda;
use common\models\EncomendaSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EncomendaController implements the CRUD actions for Encomenda model.
 */
class EncomendaController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'update', 'view'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'update', 'view'],
                        'roles' => ['@'],
                    ]
                ]
            ]
        ];
    }

    /**
     * Lists all Encomenda models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->can('visualizarEncomendas')) {
            $encomendas = Encomenda::find()->where(['estado' => 'pendente'])->orWhere(['estado' => 'em processamento'])->orWhere(['estado' => 'enviado'])->orWhere(['estado' => 'entregue'])->orWhere(['estado' => 'cancelado'])->all();

            return $this->render('index', [
                'encomendas' => $encomendas,
            ]);
        }else {
            Yii::$app->session->setFlash('danger', ' Não tem permissões para Visualizar encomendas');
            return $this->redirect(['site/index']);
        }
    }

    public function actionUpdate($id_encomenda)
    {
        if (Yii::$app->user->can('atualizarEncomendas')) {
            Encomenda::getUpdateStatusEncomenda($id_encomenda);

            return $this->redirect(Yii::$app->request->referrer);
        }else{
            Yii::$app->session->setFlash('danger', ' Não tem permissões para Atualizar encomendas');
            return $this->redirect(['site/index']);
        }
    }
    
    public function actionDetalhes($id_encomenda)
    {
        if(Yii::$app->user->can('atualizarEncomendas')){
            if(Encomenda::findOne($id_encomenda)->getAttribute('estado') == 'pendente')
                Encomenda::getUpdateStatusEncomenda($id_encomenda);
            
            $model_encomenda = Encomenda::findOne($id_encomenda);
            $models_itemcompra = ItemCompra::find()->where(['id_encomenda' => $id_encomenda])->all();
            $model_faturacao = Faturacao::find()->where(['id_user' => $model_encomenda->id_user])->one();
            $model_pagamento = Pagamento::find()->where(['id_user' => $model_encomenda->id_user])->one();
            
            return $this->render('detalhes', [
                'models_itemcompra' => $models_itemcompra,
                'model_encomenda' => $model_encomenda,
                'model_faturacao' => $model_faturacao,
                'model_pagamento' => $model_pagamento,
            ]);
        }else{
            Yii::$app->session->setFlash('danger', ' Não tem permissões para Atualizar encomendas');
            return $this->redirect(['site/index']);
        }
    }
    
    public function actionCancelar($id_encomenda)
    {
        if (Yii::$app->user->can('atualizarEncomendas')) {
            Encomenda::findOne($id_encomenda)->updateAttributes(['estado' => 'cancelado']);
        
            return $this->redirect(Yii::$app->request->referrer);
        }else{
            Yii::$app->session->setFlash('danger', ' Não tem permissões para Atualizar encomendas');
            return $this->redirect(['site/index']);
        }
    }


    /**
     * Displays a single Encomenda model.
     * @param int $id ID
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
     * Finds the Encomenda model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Encomenda the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Encomenda::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
