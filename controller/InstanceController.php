<?php
namespace app\controllers;
use app\models\Instance;
use app\models\InstanceSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;

/**
 * InstanceController implements the CRUD actions for Instance model.
 */
class InstanceController extends AuthController
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), 
                [
                        'verbs' => [
                                'class' => VerbFilter::className(),
                                'actions' => [
                                        'delete' => [
                                                'POST'
                                        ]
                                ]
                        ]
                ]);
    }

    /**
     * Lists all Instance models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InstanceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', 
                [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider
                ]);
    }

    /**
     * Displays a single Instance model.
     *
     * @param integer $id            
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
                'model' => $this->findModel($id)
        ]);
    }

    /**
     * Creates a new Instance model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Instance();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect([
                    'view',
                    'id' => $model->instance_id
            ]);
        } else {
            return $this->render('create', [
                    'model' => $model
            ]);
        }
    }

    /**
     * Updates an existing Instance model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id            
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect([
                    'view',
                    'id' => $model->instance_id
            ]);
        } else {
            return $this->render('update', [
                    'model' => $model
            ]);
        }
    }

    /**
     * Deletes an existing Instance model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id            
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        
        return $this->redirect([
                'index'
        ]);
    }

    /**
     * Finds the Instance model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id            
     * @return Instance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Instance::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
