<?php

namespace app\controllers;

use Yii;
use app\models\Livro;
use app\models\LivroSearch;
use app\models\ProximaLeitura;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
use yii\helpers\VarDumper;

/**
 * LivroController implements the CRUD actions for Livro model.
 */
class LivroController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
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
     * Lists all Livro models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new LivroSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Livro model.
     * @param integer $id
     * @param integer $editora_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $editora_id) {
        return $this->render('view', [
                    'model' => $this->findModel($id, $editora_id),
        ]);
    }

    /**
     * Creates a new Livro model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Livro();
//        $endereco_imagem ='/var/www/html/biblioteca/web/imagens/';

        if ($model->load(Yii::$app->request->post())) {
            $tmp = UploadedFile::getInstance($model, 'capa');

            if ($tmp != NULL) {
                $nome = md5($model->titulo);
                $nomeCompleto = $nome . '.' . $tmp->getExtension();
                $tmp->saveAs($nomeCompleto);
                $model->capa = $nomeCompleto;
            }
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id, 'editora_id' => $model->editora_id]);
            }
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Livro model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $editora_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $editora_id) {
        $model = $this->findModel($id, $editora_id);
        $capa = $model->capa;

        if ($model->load(Yii::$app->request->post())) {
            $tmp = UploadedFile::getInstance($model, 'capa');
            var_dump($tmp);
            if ($tmp != NULL) {
                $nome = md5($model->titulo);
                $tmp->saveAs($nome . '.' . $tmp->getExtension());
                $model->capa = $nome . '.' . $tmp->getExtension();
            } else {
                $model->capa = $capa;
            }

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id, 'editora_id' => $model->editora_id]);
            }
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Livro model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $editora_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $editora_id) {
        $this->findModel($id, $editora_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Livro model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $editora_id
     * @return Livro the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $editora_id) {
        if (($model = Livro::findOne(['id' => $id, 'editora_id' => $editora_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function LivroAleatorio() {

        $sql = 'SELECT * FROM livro WHERE status_leitura = 0 ORDER BY RAND() LIMIT 1 ';
        $livro = Livro::findBySql($sql)->one();
        $proximaLeitura = new ProximaLeitura ();
        $proximaLeitura->finalizado = 0;
        $proximaLeitura->livro_id = $livro->id;
        $proximaLeitura->save();
        return $livro;
    }

    public function actionProximaLeitura() {
        // se a leitura não terminou
        if ($model = ProximaLeitura::find()->where(['finalizado' => FALSE])->one()) {
            $livro = Livro::find()->where(['id' => $model->livro_id])->one();
            //se o livro não estiver lido    
            if (!$livro->status_leitura) {

                return $this->actionView($livro->id, $livro->editora_id);
                //livro lido    
            } else {

                $model->finalizado = 1;
                $model->save(FALSE);
            }
        }
        //Nova leitura
        $livro = $this->LivroAleatorio();
        return $this->actionView($livro->id, $livro->editora_id);
    }

}
