<?php

use helpers\Html;
use helpers\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use dashboard\models\Patients;
use dashboard\models\Staff;

/** @var yii\web\View $this */
/** @var dashboard\models\MedicalRecords $model */
/** @var helpers\widgets\ActiveForm $form */
?>

<div class="medical-records-form">
    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]);?>
    <div class="row">
        <div class="col-md-12">
          <?= $form->field($model, 'patient_id')->dropDownList(
            ArrayHelper::map(Patients::find()->all(), 'id', 'first_name'),
            ['prompt' => 'Select Patient']
          ) ?>
        </div>
        <div class="col-md-12">
          <?= $form->field($model, 'staff_id')->dropDownList(
            ArrayHelper::map(Staff::find()->all(),'id', 'first_name'),
            ['prompt' => 'Select Doctor']
          ) ?>
        </div>
        <div class="col-md-12">
          <?= $form->field($model, 'diagnosis')->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-md-12">
          <?= $form->field($model, 'treatment')->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-md-12">
          <?= $form->field($model, 'prescription')->textarea(['rows' => 6]) ?>
        </div>
     
    </div>
    <div class="block-content block-content-full text-center">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
