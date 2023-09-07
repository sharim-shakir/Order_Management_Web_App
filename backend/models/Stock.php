<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stock".
 *
 * @property int $id
 * @property int|null $item_id
 * @property int|null $unit_price
 * @property int|null $item_count
 */
class Stock extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stock';
    }

        public $selected_item_price; // Define the property to hold the selected item's price
   

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_id', 'unit_price', 'item_count'], 'integer'],
               [['selected_item_price'], 'number'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item_id' => 'Item ID',
            'unit_price' => 'Unit Price',
            'item_count' => 'Item Count',
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
