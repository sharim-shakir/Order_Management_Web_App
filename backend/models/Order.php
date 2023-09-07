<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Order extends ActiveRecord
{
    public static function tableName()
    {
        return 'order';
    }

    public function rules()
    {
        return [
            [['date', 'total_price', 'status', 'delivery_status'], 'required'],
            [['date'], 'date', 'format' => 'php:Y-m-d'],
            [['total_price'], 'number'],
            [['status', 'delivery_status'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'total_price' => 'Total Price',
            'status' => 'Status',
            'delivery_status' => 'Delivery Status',
        ];
    }
}
