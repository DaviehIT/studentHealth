<?php

namespace dashboard\models;
use auth\models\User;
use Yii;

/**
 * This is the model class for table "students".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $registration_number
 * @property string $first_name
 * @property string $last_name
 * @property string|null $gender
 * @property string|null $phone
 * @property string|null $faculty
 * @property string|null $course
 * @property int|null $is_deleted
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property User $user
 */
class Students extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'students';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'gender', 'phone', 'faculty', 'course', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['is_deleted'], 'default', 'value' => 0],
            [['user_id', 'is_deleted', 'created_at', 'updated_at'], 'integer'],
            [['registration_number', 'first_name', 'last_name'], 'required'],
            [['registration_number'], 'string', 'max' => 50],
            [['first_name', 'last_name', 'faculty', 'course'], 'string', 'max' => 100],
            [['gender'], 'string', 'max' => 10],
            [['dob'], 'date', 'format' => 'php:Y-m-d'],
            [['phone'], 'string', 'max' => 20],
            [['registration_number'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'registration_number' => 'Registration Number',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
           'dob' => 'Date of Birth',    
            'gender' => 'Gender',
            'phone' => 'Phone',
            'faculty' => 'Faculty',
            'course' => 'Course',
            'is_deleted' => 'Is Deleted',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['user_id' => 'user_id']);
    }

}
