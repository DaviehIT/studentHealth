<?php

namespace dashboard\models;

use Yii;

/**
 * This is the model class for table "appointment_status".
 *
 * @property int $id
 * @property string $name
 * @property int|null $is_deleted
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Appointments[] $appointments
 */
class AppointmentStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appointment_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['is_deleted', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
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
        return $this->hasMany(Appointments::class, ['status_id' => 'id']);
    }
}
