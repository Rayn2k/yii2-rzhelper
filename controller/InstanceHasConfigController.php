<?php
namespace app\controllers;
use app\models\InstanceHasConfig;
use app\models\InstanceHasConfigSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;
use app\models\ConfigSearch;
use rayn2k\rzhelper\Debug;
use rayn2k\rzhelper\ConstantsGeneral;
use app\models\Instance;
use app\models\Config;

/**
 * InstanceHasConfigController implements the CRUD actions for InstanceHasConfig
 * model.
 */
class InstanceHasConfigController extends AuthController
{

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(),
                [
                        'verbs' => [
                                'class' => VerbFilter::className(),
                                'actions' => [
                                        'delete' => [
                                                'post'
                                        ]
                                ]
                        ]
                ]);
    }

    /**
     * Lists all InstanceHasConfig models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $active_instance_id = \Yii::$app->session->get(ConstantsGeneral::ACTIVE_INSTANCE_ID);
        
        $searchModel = new ConfigSearch();
        $dataProvider = $searchModel->searchConfigInInstance(Yii::$app->request->queryParams, $active_instance_id);
        $dataProvider->setSort(
                [
                        'defaultOrder' => [
                                'config_key' => SORT_ASC
                        ]
                ]);
        
        return $this->render('index',
                [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'instance_id' => $active_instance_id
                ]);
    }

    /**
     * Displays a single InstanceHasConfig model.
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
     * Creates a new InstanceHasConfig model.
     * If creation is successful, the browser will be redirected to the 'view'
     * page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new InstanceHasConfig();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect([
                    'view',
                    'id' => $model->id
            ]);
        } else {
            return $this->render('create', [
                    'model' => $model
            ]);
        }
    }

    /**
     * Updates an existing InstanceHasConfig model.
     * If update is successful, the browser will be redirected to the 'view'
     * page.
     *
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($key)
    {
        $searchModel = new InstanceHasConfigSearch();
        $model = $searchModel->findOrCreateConfigEntry($key);
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect([
                    'index'
            ]);
        } else {
            return $this->render('update', [
                    'model' => $model
            ]);
        }
    }

    /**
     * Deletes an existing InstanceHasConfig model.
     * If deletion is successful, the browser will be redirected to the 'index'
     * page.
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
     * Finds the InstanceHasConfig model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     * @return InstanceHasConfig the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InstanceHasConfig::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     *
     * @param integer $instance_id
     */
    public function actionInitDefault($instance_id)
    {
        $instanceHasConfig = new InstanceHasConfig();
        $instanceHasConfig->initializeInstanceWithDefaultConfigValues($instance_id);
        
        Yii::$app->session->setFlash('success',
                Yii::t("app", "Configuration values, which were not set yet, are initialized with default values."));
        
        return $this->redirect([
                'index'
        ]);
    }
}
