<?php

namespace dashboard\controllers;

use Yii;
use dashboard\models\Staff;
use dashboard\models\searches\StaffSearches;
use helpers\DashboardController;
use yii\web\NotFoundHttpException;

/**
 * StaffController implements the CRUD actions for Staff model.
 */
class StaffController extends DashboardController
{
    public $permissions = [
        'dashboard-staff-list'=>'View Staff List',
        'dashboard-staff-create'=>'Add Staff',
        'dashboard-staff-update'=>'Edit Staff',
        'dashboard-staff-delete'=>'Delete Staff',
        'dashboard-staff-restore'=>'Restore Staff',
        ];
    public function getViewPath()
    {
        return Yii::getAlias('@ui/views/hms/staff');
    }    
    public function actionIndex()
    {
        Yii::$app->user->can('dashboard-staff-list');
        $searchModel = new StaffSearches();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionCreate()
    {
        Yii::$app->user->can('dashboard-staff-create');
        $model = new Staff();
        if ($this->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate()) {
                    if ($model->save()) {
                        Yii::$app->session->setFlash('success', 'Staff created successfully');
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
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    public function actionUpdate($id)
    {
        Yii::$app->user->can('dashboard-staff-update');
        $model = $this->findModel($id);

        if ($this->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate()) {
                    if ($model->save()) {
                        Yii::$app->session->setFlash('success', 'Staff updated successfully');
                        return $this->redirect(['index']);
                    }
                }
            }
        }
        if ($this->request->isAjax) {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    public function actionTrash($id)
    {
        $model = $this->findModel($id);
        if ($model->is_deleted) {
            Yii::$app->user->can('dashboard-staff-restore');
            $model->restore();
            Yii::$app->session->setFlash('success', 'Staff has been restored');
        } else {
            Yii::$app->user->can('dashboard-staff-delete');
            $model->delete();
            Yii::$app->session->setFlash('success', 'Staff has been deleted');
        }
        return $this->redirect(['index']);
    }
    protected function findModel($id)
    {
        if (($model = Staff::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
