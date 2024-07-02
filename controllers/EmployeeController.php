<?php

namespace app\controllers;

use app\models\Employees;
use app\models\EmployeesSearch;
use RuntimeException;
use Yii;
use yii\helpers\Json;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;

/**
 * EmployeeController implements the CRUD actions for Employees model.
 */
class EmployeeController extends Controller
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                [
                    'class' => 'yii\filters\ContentNegotiator',
                    'formats' => [
                        'application/json' => \yii\web\Response::FORMAT_JSON,
                    ],
                ],
            ],

        );
    }
    public function verbs()
    {
        return [
            'index' => ['GET'],
            'view' => ['GET'],
            'create' => ['POST'],
            'update' => ['PUT', 'PATCH'],
            'delete' => ['DELETE'],
        ];
    }

    /**
     * Lists all Employees models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new EmployeesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $data = $dataProvider->getModels();
        $jsonData = Json::encode($data);
        Yii::$app->response->setStatusCode(200);
        return $jsonData;

    }

    /**
     * Displays a single Employees model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        Yii::$app->response->setStatusCode(200);
        return Json::encode($model);
    }

    /**
     * Creates a new Employees model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Employees();

        if ($model->load($this->request->post()) && $model->validate()) {
            if ($model->save()) {
                Yii::$app->response->setStatusCode(201);
                return Json::encode($model);
            } else {
                Yii::$app->response->setStatusCode(500);
                throw new RuntimeException('Error save. ' . implode(',', $model->getErrors()));
            }
        }
    }

    /**
     * Updates an existing Employees model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load($this->request->post()) && $model->validate()) {
            if ($model->save()) {
                Yii::$app->response->setStatusCode(200);
                return Json::encode($model);
            } else {
                Yii::$app->response->setStatusCode(500);
                throw new RuntimeException('Error update. ' . implode(',', $model->getErrors()));
            }
        }
    }

    /**
     * Deletes an existing Employees model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->delete()) {
            Yii::$app->response->setStatusCode(200);
            return Json::encode($model->id);
        } else {
            Yii::$app->response->setStatusCode(500);
            throw new RuntimeException('Error delete. ' . implode(',', $model->getErrors()));
        }
    }

    /**
     * Finds the Employees model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Employees the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Employees::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
