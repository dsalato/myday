<?php

namespace app\controllers;

use app\models\Task;
use app\models\TaskSearch;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
/**
 * TaskController implements the CRUD actions for Task model.
 */
class TaskController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'only' => ['create', 'list', 'view', 'update', 'delete'],
                    'rules' => [
                        [
                            'actions' => ['create', 'list', 'delete'],
                            'allow' => true,
                            'roles' => ['@'],
                            'matchCallback' => function () {
                                return !Yii::$app->user->identity->role;
                            }
                        ],
                        [
                            'actions' => ['view', 'update'],
                            'allow' => true,
                            'roles' => ['@'],
                            'matchCallback' => function () {
                                $task = Task::findAll(['id'=>Yii::$app->request->getQueryParam('id')]);
                                if ( $task[0]->id_user == Yii::$app->user->identity->id)
                                    return true;
                            }
                        ]
                    ],
                    'denyCallback' => function () {
                        return $this->goHome();
                    },
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }
    public function actionList()
    {
        if (Yii::$app->request->getQueryParam('date'))
            $query = Task::find()->where(['id_user'=>Yii::$app->user->identity->id, 'date' => Yii::$app->request->getQueryParam('date')]);
        else
            $query = Task::find()->where(['id_user'=>Yii::$app->user->identity->id, 'date' => date('Y-m-d')]);

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
            ],
            'sort' => [
                'defaultOrder' => [
                    'time' => SORT_ASC,
                ]
            ],
        ]);

        $tasks = $provider->getModels();
        $pages = $provider->pagination;


        if (empty($tasks)){
            Yii::$app->session->setFlash('Notask', "Нет запланированных дел!");

        }
        return $this->render('list',['tasks'=>$tasks, 'pages' => $pages ]);
    }

    /**
     * Displays a single Task model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Task model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Task();

        if ($this->request->isPost) {
            $model->id_user = Yii::$app->user->identity->id;
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['list', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Task model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['list', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Task model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['list']);
    }

    /**
     * Finds the Task model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Task the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Task::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
