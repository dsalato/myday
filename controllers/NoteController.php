<?php

namespace app\controllers;

use app\models\Note;
use app\models\NoteSearch;
use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\data\Sort;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NoteController implements the CRUD actions for Note model.
 */
class NoteController extends Controller
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
                                $note = Note::findAll(['id'=>Yii::$app->request->getQueryParam('id')]);
                                if ( $note[0]->id_user == Yii::$app->user->identity->id)
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
        $sort = new Sort([
            'attributes' => [
                'priority' => ['label' => 'Приоритет'],
                'id' => ['label' => 'Дата'],
                'done' => ['label' => 'Выполненные']
            ],
        ]);

        $query = Note::find()
            ->where(['id_user' => Yii::$app->user->identity->id])
            ->orderBy($sort->orders);



        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
            ],
            'sort' => [
                'defaultOrder' => [
                    'priority' => SORT_DESC,
                ]
            ],
        ]);

        $notes = $provider->getModels();
        $pages = $provider->pagination;

        $count = count(Note::findAll(['id_user' => Yii::$app->user->identity->id]));
        $done = count(Note::findAll(['id_user' => Yii::$app->user->identity->id, 'done' => 1]));
        $urgent = count(Note::findAll(['id_user' => Yii::$app->user->identity->id, 'priority' => 1, 'done' => 0]));

        if ($this->request->isPost) {
            $model = Note::findOne(['id' => Yii::$app->request->post('Note')['id']]);
            $model->done = Yii::$app->request->post('Note')['done'];
            $model->save();
            $this->redirect('list');
        }
        $data = [
            'labels' => ['Обычные', 'Срочные', 'Выполненные'],
            'datasets' => [
                [
                    'label' => 'Заметки',
                    'backgroundColor' => ['#9699CA', '#F47D6C', '#77C7B9'],
                    'data' => [$count-$done-$urgent, $urgent, $done],
                ]
            ],
        ];
        return $this->render('list', [
            'notes' => $notes,
            'done' => $done,
            'count' => $count,
            'pages' => $pages,
            'sort' => $sort,
            'data' => $data,
        ]);

    }

    /**
     * Displays a single Note model.
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
     * Creates a new Note model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Note();

        if ($this->request->isPost) {
            $model->id_user = Yii::$app->user->identity->id;
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['list', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Note model.
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
     * Deletes an existing Note model.
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
     * Finds the Note model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Note the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Note::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
