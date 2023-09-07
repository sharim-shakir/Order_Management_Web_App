<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class OrderItem extends ActiveRecord
{
    public static function tableName()
    {
        return 'orderitem';
    }

    public $selected_item_price; // Define the property to hold the selected item's price
    public $total_price;



    public function rules()
    {
        return [
            [['order_id', 'item_id', 'unit_price', 'item_count', 'status'], 'required'],
            [['order_id', 'item_id', 'unit_price', 'item_count', 'status'], 'integer'],
            [['selected_item_price'], 'number'],
            [['total_price'], 'number'], // Make sure to include 'total_price' in the list of safe attributes.

        
             // Or any other validation rule you prefer

        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'item_id' => 'Item ID',
            'unit_price' => 'Unit Price',
            'item_count' => 'Item Count',
            'status' => 'Status',
        ];
    }

    public function attributes()
{
    return array_merge(parent::attributes(), ['selected_item_price']);
}
public function getItem()
{
    return $this->hasOne(Item::class, ['id' => 'item_id']);
}

}
