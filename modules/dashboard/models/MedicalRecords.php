<?php

namespace dashboard\models;

use Yii;

/**
 * This is the model class for table "medical_records".
 *
 * @property int $id
 * @property int $patient_id
 * @property int $staff_id
 * @property string $diagnosis
 * @property string $treatment
 * @property string|null $prescription
 * @property int|null $is_deleted
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Patients $patient
 * @property Staff $staff
 */
class MedicalRecords extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medical_records';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['patient_id', 'staff_id', 'diagnosis', 'treatment'], 'required'],
            [['patient_id', 'staff_id', 'is_deleted', 'created_at', 'updated_at'], 'integer'],
            [['diagnosis', 'treatment', 'prescription'], 'string'],
            [['patient_id'], 'exist', 'skipOnError' => true, 'targetClass' => Patients::class, 'targetAttribute' => ['patient_id' => 'id']],
            [['staff_id'], 'exist', 'skipOnError' => true, 'targetClass' => Staff::class, 'targetAttribute' => ['staff_id' => 'id']],
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
            'diagnosis' => 'Diagnosis',
            'treatment' => 'Treatment',
            'prescription' => 'Prescription',
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
}
