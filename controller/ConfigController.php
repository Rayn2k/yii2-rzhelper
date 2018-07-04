<?php
namespace app\controllers;
use app\models\Config;
use app\models\ConfigSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;
use rayn2k\rzhelper\ConstantsGeneral;
use app\models\InstanceHasConfig;

/**
 * ConfigController implements the CRUD actions for Config model.
 */
class ConfigController extends AuthController
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
     * Lists all Config models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ConfigSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', 
                [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider
                ]);
    }

    /**
     * Displays a single Config model.
     *
     * @param String $key            
     * @return mixed
     */
    public function actionView($key)
    {
        return $this->render('view', [
                'model' => $this->findModel($key)
        ]);
    }

    /**
     * Creates a new Config model.
     * If creation is successful, the browser will be redirected to the 'view'
     * page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Config();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect([
                    'view',
                    'key' => $model->config_key
            ]);
        } else {
            return $this->render('create', [
                    'model' => $model
            ]);
        }
    }

    /**
     * Updates an existing Config model.
     * If update is successful, the browser will be redirected to the 'view'
     * page.
     *
     * @param String $key            
     * @return mixed
     */
    public function actionUpdate($key)
    {
        $model = $this->findModel($key);
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect([
                    'view',
                    'key' => $model->config_key
            ]);
        } else {
            return $this->render('update', [
                    'model' => $model
            ]);
        }
    }

    /**
     * Deletes an existing Config model.
     * If deletion is successful, the browser will be redirected to the 'index'
     * page.
     *
     * @param String $key            
     * @return mixed
     */
    public function actionDelete($key)
    {
        // first delete all occurences of instance_has_config
        foreach (InstanceHasConfig::find()->andWhere([
                'config_key' => $key
        ])->all() as $instance_has_config) {
            $instance_has_config->delete();
        }
        
        // afterwards delete the config key itself
        $this->findModel($key)->delete();
        
        return $this->redirect([
                'index'
        ]);
    }

    /**
     * Finds the Config model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param String $key            
     * @return Config the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($key)
    {
        if (($model = Config::findOne($key)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
