<?php

namespace app\controllers;

use app\models\BookingFields;
use app\models\Tour;
use Yii;
use app\models\Booking;
use app\models\search\BookingSearch;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BookingController implements the CRUD actions for Booking model.
 */
class BookingController extends Controller
{
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
     * Lists all Booking models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BookingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Booking model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionList($id = 0)
    {
        if(Yii::$app->request->isAjax)
        {
            if(!$id)
            {
                echo '';
                Yii::$app->end();
            }
            $tourFields = Tour::find()->with('tourFields')->where(['id' => $id])->one();
            $booking = new Booking();
            $bookingFields = new BookingFields();
            $bookingColumns = $booking->getTableSchema()->columns;
            $sort = Json::decode($tourFields->sort);
            $data = array_merge_recursive($sort, $bookingColumns);
            $addField = [];
            if($tourFields->tourFields){
                foreach($tourFields->tourFields as $field){
                    $addField['add_field_'. $field->id] = [
                        'sort' => $field->sort,
                        'name' => $field->name,
                        'type' => $field->type,
                        'tour_id' => $field->tour_id
                    ];

                }
            }
            $data = array_merge ($data, $addField);
            unset($data['id']);
            unset($data['tour_id']);
            $data = $booking->customMultiSort($data, 'sort');
            echo $this->renderAjax('_list', [
                'booking' => $booking,
                'bookingFields' => $bookingFields,
                'data' => $data
            ]);
            Yii::$app->end();
        }
        return $this->redirect(Url::home());

    }

    /**
     * Creates a new Booking model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Booking();
        $bookingField = new BookingFields();
        $data = Yii::$app->request->post();

        if ($model->load(Yii::$app->request->post()))
        {
            if($model->save())
            {
                if(isset($data['BookingFields']['fields']))
                {
                    $bookingField->fields = Json::encode($data['BookingFields']['fields']);
                    $bookingField->booking_id = $model->id;
                    $bookingField->save();
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
            return $this->render('create', [
                'model' => $model,
            ]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Booking model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Booking model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Booking model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Booking the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Booking::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
