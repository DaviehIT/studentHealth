<?php

namespace dashboard\controllers;
use Mpdf\Mpdf;
use Yii;
use dashboard\models\MedicalRecords;
use dashboard\models\searches\MedicalRecordsSearches;
use helpers\DashboardController;
use yii\web\NotFoundHttpException;

/**
 * MedicalRecordsController implements the CRUD actions for MedicalRecords model.
 */
class MedicalRecordsController extends DashboardController
{
    public $permissions = [
        'dashboard-medical-records-list'=>'View MedicalRecords List',
        'dashboard-medical-records-create'=>'Add MedicalRecords',
        'dashboard-medical-records-update'=>'Edit MedicalRecords',
        'dashboard-medical-records-delete'=>'Delete MedicalRecords',
        'dashboard-medical-records-restore'=>'Restore MedicalRecords',
        ];
    public function getViewPath()
    {
        return Yii::getAlias('@ui/views/hms/medicalRecords');
    } 
    public function actionIndex()
    {
        Yii::$app->user->can('dashboard-medical-records-list');
        $searchModel = new MedicalRecordsSearches();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionCreate()
    {
        Yii::$app->user->can('dashboard-medical-records-create');
        $model = new MedicalRecords();
        if ($this->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate()) {
                    if ($model->save()) {
                        Yii::$app->session->setFlash('success', 'MedicalRecords created successfully');
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
        Yii::$app->user->can('dashboard-medical-records-update');
        $model = $this->findModel($id);

        if ($this->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate()) {
                    if ($model->save()) {
                        Yii::$app->session->setFlash('success', 'MedicalRecords updated successfully');
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
            Yii::$app->user->can('dashboard-medical-records-restore');
            $model->restore();
            Yii::$app->session->setFlash('success', 'MedicalRecords has been restored');
        } else {
            Yii::$app->user->can('dashboard-medical-records-delete');
            $model->delete();
            Yii::$app->session->setFlash('success', 'MedicalRecords has been deleted');
        }
        return $this->redirect(['index']);
    }
    protected function findModel($id)
    {
        if (($model = MedicalRecords::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionDownloadReport()
{
    // Yii::$app->user->can('dashboard-medical-report');
    $medicalRecords = MedicalRecords::find()->all();

    $mpdf = new Mpdf();

    // Set Header
    $mpdf->SetHeader('TUM Wellness Centre Medical Records||Generated on: {DATE j-m-Y}');

    // Set Footer
    $mpdf->SetFooter('Page {PAGENO} of {nb}');

    // Content
    $html = $this->renderPartial('_medical-records-pdf', [
        'medicalRecords' => $medicalRecords,
    ]);

    $mpdf->WriteHTML($html);
    $mpdf->Output('medical-records-report.pdf', 'I');
}

}
