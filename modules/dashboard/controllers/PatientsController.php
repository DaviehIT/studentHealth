<?php

namespace dashboard\controllers;

use Yii;
use dashboard\models\Patients;
use dashboard\models\searches\PatientsSearches;
use helpers\DashboardController;
use yii\web\NotFoundHttpException;

/**
 * PatientsController implements the CRUD actions for Patients model.
 */
class PatientsController extends DashboardController
{
    
    public $permissions = [
        'dashboard-patients-list'=>'View Patients List',
        'dashboard-patients-create'=>'Add Patients',
        'dashboard-patients-update'=>'Edit Patients',
        'dashboard-patients-delete'=>'Delete Patients',
        'dashboard-patients-restore'=>'Restore Patients',
        ];

        public function getViewPath()
        {
            return Yii::getAlias('@ui/views/hms/patients');
        }   
    public function actionIndex()
    {
        Yii::$app->user->can('dashboard-patients-list');
        $searchModel = new PatientsSearches();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionCreate()
    {
        Yii::$app->user->can('dashboard-patients-create');
        $model = new Patients();
        if ($this->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate()) {
                    if ($model->save()) {
                        Yii::$app->session->setFlash('success', 'Patients created successfully');
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
        }
        return $this->render('create', [
            'model' => $model,
        ]);
        
    }
    public function actionUpdate($id)
    {
        Yii::$app->user->can('dashboard-patients-update');
        $model = $this->findModel($id);

        if ($this->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate()) {
                    if ($model->save()) {
                        Yii::$app->session->setFlash('success', 'Patients updated successfully');
                        return $this->redirect(['index']);
                    }
                }
            }
        }
      if ($this->request->isAjax) {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }
    public function actionTrash($id)
    {
        $model = $this->findModel($id);
        if ($model->is_deleted) {
            Yii::$app->user->can('dashboard-patients-restore');
            $model->restore();
            Yii::$app->session->setFlash('success', 'Patients has been restored');
        } else {
            Yii::$app->user->can('dashboard-patients-delete');
            $model->delete();
            Yii::$app->session->setFlash('success', 'Patients has been deleted');
        }
        return $this->redirect(['index']);
    }
    protected function findModel($id)
    {
        if (($model = Patients::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
