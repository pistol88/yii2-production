<?php

namespace dvizh\production\controllers;

use Yii;
use dvizh\production\models\Template;
use dvizh\production\models\search\TemplateSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class TemplateController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => $this->module->adminRoles,
                    ],
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new TemplateSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Template;

        $model->model_name = $this->module->productionModel;
        $model->name = "" . rand(0, 99999);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if($componentAmounts = yii::$app->request->post('counts')) {
                foreach($componentAmounts as $componentId => $count) {
                    $model->setComponentAmount($componentId, $count);
                }
            }

            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'module' => $this->module,
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            if($componentAmounts = yii::$app->request->post('counts')) {
                foreach($componentAmounts as $componentId => $count) {
                    $model->setComponentAmount($componentId, $count);
                }
            }

            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'module' => $this->module,
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        $model = new Template;

        if (($model = $model::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelBySlug($slug)
    {
        $model = new Template;

        if (($model = $model::findOne(['slug' => $slug])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
