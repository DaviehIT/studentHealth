<?php

namespace dashboard\models;

use Yii;

/**
 * This is the model class for table "pharmacy_inventory".
 *
 * @property int $id
 * @property string $medicine_name
 * @property string $batch_number
 * @property int $quantity
 * @property string $expiry_date
 * @property float $unit_price
 * @property string|null $manufacturer
 * @property int|null $is_deleted
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class PharmacyInventory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pharmacy_inventory';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['medicine_name', 'batch_number', 'quantity', 'expiry_date', 'unit_price'], 'required'],
            [['quantity', 'is_deleted', 'created_at', 'updated_at'], 'integer'],
            [['expiry_date'], 'safe'],
            [['unit_price'], 'number'],
            [['medicine_name', 'manufacturer'], 'string', 'max' => 255],
            [['batch_number'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'medicine_name' => 'Medicine Name',
            'batch_number' => 'Batch Number',
            'quantity' => 'Quantity',
            'expiry_date' => 'Expiry Date',
            'unit_price' => 'Unit Price',
            'manufacturer' => 'Manufacturer',
            'is_deleted' => 'Is Deleted',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
