<?php

use helpers\Html;
use helpers\widgets\ActiveForm;
use yii\jui\DatePicker;
/** @var yii\web\View $this */
/** @var dashboard\models\PharmacyInventory $model */
/** @var helpers\widgets\ActiveForm $form */
?>

<div class="pharmacy-inventory-form">
    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]);?>
    <div class="row">
        <div class="col-md-12">
          <?= $form->field($model, 'medicine_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-12">
          <?= $form->field($model, 'batch_number')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-12">
          <?= $form->field($model, 'quantity')->textInput() ?>
        </div>
        <div class="col-md-12">
        <?= $form->field($model, 'expiry_date')->widget(DatePicker::class, [
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
          <?= $form->field($model, 'unit_price')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-12">
          <?= $form->field($model, 'manufacturer')->textInput(['maxlength' => true]) ?>
        </div>
     
    </div>
    <div class="block-content block-content-full text-center">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
