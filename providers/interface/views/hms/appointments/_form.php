<?php

use helpers\Html;
use helpers\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use dashboard\models\Patients;
use dashboard\models\Staff;
use dashboard\models\AppointmentStatus;
use yii\jui\DatePicker;

/** @var yii\web\View $this */
/** @var dashboard\models\Appointments $model */
/** @var helpers\widgets\ActiveForm $form */
?>

<div class="appointments-form">
    <?php $form = ActiveForm::begin([
        'options' => ['data-pjax' => true],
        'enableAjaxValidation' => true,
        'enableClientValidation' => true,
    ]); ?>
    
    <div class="row">
        <div class="col-md-12">
        <?= $form->field($model, 'patient_id')->dropDownList(
            ArrayHelper::map(Patients::find()->all(), 'id', 'first_name'),
            ['prompt' => 'Select Patient']
        ) ?>
        </div>
        
        <div class="col-md-12">
        <?= $form->field($model, 'staff_id')->dropDownList(
            ArrayHelper::map(Staff::find()->all(), 'id', 'first_name'),
            ['prompt' => 'Select Doctor']
        ) ?>
        </div>
        
        <div class="col-md-12">
        <?= $form->field($model, 'appointment_date')->widget(DatePicker::class, [
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
        <?= $form->field($model, 'appointment_time')->input('time', [
            'class' => 'form-control',
            'value' => '09:00'
        ]) ?>
        </div>
        
        <div class="col-md-12">
        <?= $form->field($model, 'status_id')->dropDownList(
            ArrayHelper::map(AppointmentStatus::find()->all(), 'id', 'name'),
            ['prompt' => 'Select Status']
        ) ?>
        </div>
        
        <div class="col-md-12">
        <?= $form->field($model, 'remarks')->textarea(['rows' => 6]) ?>
        </div>
    </div>
    
    <div class="block-content block-content-full text-center">
        <?= Html::submitButton('Save', [
            'class' => 'btn btn-success',
            'data-loading-text' => 'Saving...'
        ]) ?>
    </div>
    
    <?php ActiveForm::end(); ?>
</div>

<?php
$js = <<<JS
    $('form').on('beforeSubmit', function(e) {
        e.preventDefault();
        var form = $(this);
        var submitBtn = form.find(':submit');
        
        submitBtn.prop('disabled', true).text('Saving...');
        
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                if (response.success) {
                    $.pjax.reload({container:'#appointments-pjax'});
                } else {
                    alert('Error saving appointment: ' + (response.message || 'Unknown error'));
                    console.log('Server response:', response);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                console.log('Server response:', xhr.responseText);
                alert('Error saving appointment: ' + error);
            },
            complete: function() {
                submitBtn.prop('disabled', false).text('Save');
            }
        });
        return false;
    });
JS;
$this->registerJs($js);
?>