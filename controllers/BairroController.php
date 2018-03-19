<?php

namespace app\controllers;

use Yii;
use app\models\Bairro;
use app\models\BairroSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BairroController implements the CRUD actions for Bairro model.
 */
class BairroController extends Controller
{
    /**
     * @inheritdoc
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
        ];
    }

    /**
     * Lists all Bairro models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BairroSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Bairro model.
     * @param integer $id
     * @param integer $cidade_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $cidade_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $cidade_id),
        ]);
    }

    /**
     * Creates a new Bairro model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Bairro();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'cidade_id' => $model->cidade_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Bairro model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $cidade_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $cidade_id)
    {
        $model = $this->findModel($id, $cidade_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'cidade_id' => $model->cidade_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Bairro model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $cidade_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $cidade_id)
    {
        $this->findModel($id, $cidade_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Bairro model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $cidade_id
     * @return Bairro the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $cidade_id)
    {
        if (($model = Bairro::findOne(['id' => $id, 'cidade_id' => $cidade_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
