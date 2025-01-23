<?php

namespace dashboard\controllers;

use Yii;
use dashboard\models\PharmacyInventory;
use dashboard\models\searches\PharmacyInventorySearches;
use helpers\DashboardController;
use yii\web\NotFoundHttpException;

/**
 * PharmacyController implements the CRUD actions for PharmacyInventory model.
 */
class PharmacyController extends DashboardController
{
    public $permissions = [
        'dashboard-pharmacy-list'=>'View PharmacyInventory List',
        'dashboard-pharmacy-create'=>'Add PharmacyInventory',
        'dashboard-pharmacy-update'=>'Edit PharmacyInventory',
        'dashboard-pharmacy-delete'=>'Delete PharmacyInventory',
        'dashboard-pharmacy-restore'=>'Restore PharmacyInventory',
        'dashboard-pharmacy-view'=>'View PharmacyInventory',
        ];

    public function getViewPath()
    {
        return Yii::getAlias('@ui/views/hms/pharmacy');
    }    
    public function actionIndex()
    {
        Yii::$app->user->can('dashboard-pharmacy-list');
        $searchModel = new PharmacyInventorySearches();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionCreate()
    {
        Yii::$app->user->can('dashboard-pharmacy-create');
        $model = new PharmacyInventory();
        if ($this->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate()) {
                    if ($model->save()) {
                        Yii::$app->session->setFlash('success', 'PharmacyInventory created successfully');
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
        Yii::$app->user->can('dashboard-pharmacy-update');
        $model = $this->findModel($id);

        if ($this->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate()) {
                    if ($model->save()) {
                        Yii::$app->session->setFlash('success', 'PharmacyInventory updated successfully');
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
    public function actionView($id)
    {
        Yii::$app->user->can('dashboard-pharmacy-view');
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionTrash($id)
    {
        $model = $this->findModel($id);
        if ($model->is_deleted) {
            Yii::$app->user->can('dashboard-pharmacy-restore');
            $model->restore();
            Yii::$app->session->setFlash('success', 'PharmacyInventory has been restored');
        } else {
            Yii::$app->user->can('dashboard-pharmacy-delete');
            $model->delete();
            Yii::$app->session->setFlash('success', 'PharmacyInventory has been deleted');
        }
        return $this->redirect(['index']);
    }
    protected function findModel($id)
    {
        if (($model = PharmacyInventory::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
