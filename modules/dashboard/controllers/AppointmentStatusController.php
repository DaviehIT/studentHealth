<?php

namespace dashboard\controllers;

use Yii;
use dashboard\models\AppointmentStatus;
use dashboard\models\searches\AppointmentStatusSearches;
use helpers\DashboardController;
use yii\web\NotFoundHttpException;

/**
 * AppointmentStatusController implements the CRUD actions for AppointmentStatus model.
 */
class AppointmentStatusController extends DashboardController
{
    public $permissions = [
        'dashboard-appointment-status-list'=>'View AppointmentStatus List',
        'dashboard-appointment-status-create'=>'Add AppointmentStatus',
        'dashboard-appointment-status-update'=>'Edit AppointmentStatus',
        'dashboard-appointment-status-delete'=>'Delete AppointmentStatus',
        'dashboard-appointment-status-restore'=>'Restore AppointmentStatus',
        ];

        public function getViewPath()
        {
            return Yii::getAlias('@ui/views/hms/AppointmentStatus');
        }    
    public function actionIndex()
    {
        Yii::$app->user->can('dashboard-appointment-status-list');
        $searchModel = new AppointmentStatusSearches();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionCreate()
    {
        Yii::$app->user->can('dashboard-appointment-status-create');
        $model = new AppointmentStatus();
        if ($this->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate()) {
                    if ($model->save()) {
                        Yii::$app->session->setFlash('success', 'AppointmentStatus created successfully');
                        return $this->redirect(['index']);
                    }
                }
            }
        } else {
            $model->loadDefaultValues();
        }
        if ($this->request->isAjax) {
                return $this->renderAjax('create', [
                    'model' => $model,
                ]);
            }else{
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
    }
    public function actionUpdate($id)
    {
        Yii::$app->user->can('dashboard-appointment-status-update');
        $model = $this->findModel($id);

        if ($this->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate()) {
                    if ($model->save()) {
                        Yii::$app->session->setFlash('success', 'AppointmentStatus updated successfully');
                        return $this->redirect(['index']);
                    }
                }
            }
        }
      if ($this->request->isAjax) {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }else{
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    public function actionTrash($id)
    {
        $model = $this->findModel($id);
        if ($model->is_deleted) {
            Yii::$app->user->can('dashboard-appointment-status-restore');
            $model->restore();
            Yii::$app->session->setFlash('success', 'AppointmentStatus has been restored');
        } else {
            Yii::$app->user->can('dashboard-appointment-status-delete');
            $model->delete();
            Yii::$app->session->setFlash('success', 'AppointmentStatus has been deleted');
        }
        return $this->redirect(['index']);
    }
    protected function findModel($id)
    {
        if (($model = AppointmentStatus::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
