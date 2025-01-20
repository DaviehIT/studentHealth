<?php

namespace dashboard\controllers;

use Yii;
use dashboard\models\Department;
use dashboard\models\searches\DepartmentSearches;
use helpers\DashboardController;
use yii\web\NotFoundHttpException;

/**
 * DepartmentController implements the CRUD actions for Department model.
 */
class DepartmentController extends DashboardController
{
    public $permissions = [
        'dashboard-department-list'=>'View Department List',
        'dashboard-department-create'=>'Add Department',
        'dashboard-department-update'=>'Edit Department',
        'dashboard-department-delete'=>'Delete Department',
        'dashboard-department-restore'=>'Restore Department',
        ];


    public function getViewPath()
    {
        return Yii::getAlias('@ui/views/hms/department');
    }    
    public function actionIndex()
    {
        Yii::$app->user->can('dashboard-department-list');
        $searchModel = new DepartmentSearches();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionCreate()
    {
        Yii::$app->user->can('dashboard-department-create');
        $model = new Department();
        if ($this->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate()) {
                    if ($model->save()) {
                        Yii::$app->session->setFlash('success', 'Department created successfully');
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
        Yii::$app->user->can('dashboard-department-update');
        $model = $this->findModel($id);

        if ($this->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate()) {
                    if ($model->save()) {
                        Yii::$app->session->setFlash('success', 'Department updated successfully');
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
            Yii::$app->user->can('dashboard-department-restore');
            $model->restore();
            Yii::$app->session->setFlash('success', 'Department has been restored');
        } else {
            Yii::$app->user->can('dashboard-department-delete');
            $model->delete();
            Yii::$app->session->setFlash('success', 'Department has been deleted');
        }
        return $this->redirect(['index']);
    }
    protected function findModel($id)
    {
        if (($model = Department::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
