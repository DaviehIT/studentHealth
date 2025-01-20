<?php

namespace dashboard\models;

use Yii;

/**
 * This is the model class for table "staff".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $phone
 * @property string|null $email
 * @property string $address
 * @property int $department_id
 * @property string $role
 * @property int|null $is_deleted
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Appointments[] $appointments
 * @property Department $department
 * @property MedicalRecords[] $medicalRecords
 */
class Staff extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'staff';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'phone', 'address', 'department_id', 'role'], 'required'],
            [['address'], 'string'],
            [['department_id', 'is_deleted', 'created_at', 'updated_at'], 'integer'],
            [['first_name', 'last_name', 'email'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 15],
            [['role'], 'string', 'max' => 50],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::class, 'targetAttribute' => ['department_id' => 'id']],
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
            'phone' => 'Phone',
            'email' => 'Email',
            'address' => 'Address',
            'department_id' => 'Department ID',
            'role' => 'Role',
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
        return $this->hasMany(Appointments::class, ['staff_id' => 'id']);
    }

    /**
     * Gets query for [[Department]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::class, ['id' => 'department_id']);
    }

    /**
     * Gets query for [[MedicalRecords]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMedicalRecords()
    {
        return $this->hasMany(MedicalRecords::class, ['staff_id' => 'id']);
    }
}
