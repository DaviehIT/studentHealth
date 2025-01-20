<?php

use helpers\Html;
use helpers\widgets\ActiveForm;
// use kartik\date\DatePicker;
use yii\jui\DatePicker;

/** @var yii\web\View $this */
/** @var dashboard\models\Patients $model */
/** @var helpers\widgets\ActiveForm $form */
?>

<div class="patients-form">
    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]);?>
    <div class="row">
        <div class="col-md-12">
          <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-12">
          <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-12">
          <?= $form->field($model, 'date_of_birth')->widget(DatePicker::class, [
              'options' => ['class' => 'form-control'],
              'dateFormat' => 'yyyy-MM-dd',
             
              'clientOptions' => [
                  'changeMonth' => true,
                  'changeYear' => true,
                  'yearRange' => '-100:+0',
              ],
          ]) ?>
        </div>
        <div class="col-md-12">
          <?= $form->field($model, 'gender')->dropDownList(
                ['Male' => 'Male', 'Female' => 'Female'], // Array of options
                ['prompt' => 'Select Gender', 'class' => 'form-control'] // Default prompt and styling
          ) ?>
        </div>
        <div class="col-md-12">
          <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-12">
          <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-12">
          <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>
        </div>
     
    </div>
    <div class="block-content block-content-full text-center">
        <?= Html::submitButton('register', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
