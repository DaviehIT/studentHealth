<?php

namespace dashboard\models;

use Yii;

/**
 * This is the model class for table "patients".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $date_of_birth
 * @property string $gender
 * @property string $phone
 * @property string|null $email
 * @property string $address
 * @property int|null $is_deleted
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Appointments[] $appointments
 * @property MedicalRecords[] $medicalRecords
 */
class Patients extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'patients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'date_of_birth', 'gender', 'phone', 'address'], 'required'],
            [['date_of_birth'], 'safe'],
            [['address'], 'string'],
            [['is_deleted', 'created_at', 'updated_at'], 'integer'],
            [['first_name', 'last_name', 'email'], 'string', 'max' => 100],
            [['gender'], 'string', 'max' => 10],
            [['phone'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'date_of_birth' => 'Date Of Birth',
            'gender' => 'Gender',
            'phone' => 'Phone',
            'email' => 'Email',
            'address' => 'Address',
            'is_deleted' => 'Is Deleted',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Appointments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAppointments()
    {
        return $this->hasMany(Appointments::class, ['patient_id' => 'id']);
    }

    /**
     * Gets query for [[MedicalRecords]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMedicalRecords()
    {
        return $this->hasMany(MedicalRecords::class, ['patient_id' => 'id']);
    }
}
