<?php

namespace dashboard\models;

use Yii;

/**
 * This is the model class for table "appointments".
 *
 * @property int $id
 * @property int $patient_id
 * @property int $staff_id
 * @property string $appointment_date
 * @property string $appointment_time
 * @property int $status_id
 * @property string|null $remarks
 * @property int|null $is_deleted
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Patients $patient
 * @property Staff $staff
 * @property AppointmentStatus $status
 */
class Appointments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appointments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['patient_id', 'staff_id', 'appointment_date', 'appointment_time', 'status_id'], 'required'],
            [['patient_id', 'staff_id', 'status_id', 'is_deleted', 'created_at', 'updated_at'], 'integer'],
            [['appointment_date', 'appointment_time'], 'safe'],
            [['remarks'], 'string'],
            [['patient_id'], 'exist', 'skipOnError' => true, 'targetClass' => Patients::class, 'targetAttribute' => ['patient_id' => 'id']],
            [['staff_id'], 'exist', 'skipOnError' => true, 'targetClass' => Staff::class, 'targetAttribute' => ['staff_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => AppointmentStatus::class, 'targetAttribute' => ['status_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'patient_id' => 'Patient Name',
            'staff_id' => 'Staff Name',
            'appointment_date' => 'Appointment Date',
            'appointment_time' => 'Appointment Time',
            'status_id' => 'Status',
            'remarks' => 'Remarks',
            'is_deleted' => 'Is Deleted',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Patient]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPatient()
    {
        return $this->hasOne(Patients::class, ['id' => 'patient_id']);
    }

    /**
     * Gets query for [[Staff]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStaff()
    {
        return $this->hasOne(Staff::class, ['id' => 'staff_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(AppointmentStatus::class, ['id' => 'status_id']);
    }
}
