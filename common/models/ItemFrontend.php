<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "item".
 *
 * @property int $id
 * @property string|null $title
 * @property int|null $price
 * @property int|null $category_id
 * @property string|null $details
 * @property int|null $status
 * @property int|null $in_stock
 * @property string|null $tags
 * @property int|null $created_at
 * @property int|null $created_by
 */
class ItemFrontend extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item';
    }

    public $selectedCategory;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price', 'category_id', 'status', 'in_stock', 'created_at', 'created_by'], 'integer'],
            [['details'], 'string'],
            [['tags'], 'string', 'max' => 255],
            [['title'], 'string', 'max' => 22],
            [['selectedCategory'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'price' => 'Price',
            'category_id' => 'Category ID',
            'details' => 'Details',
            'status' => 'Status',
            'in_stock' => 'In Stock',
            'tags' => 'Tags',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }

    public function getCategoryTitles()
    {
        if (!empty($this->category_id)) {
            $categoryIds = explode(',', $this->category_id);
            $query = Category::find()->select('title')->where(['id' => $categoryIds]);
            $categoryTitles = $query->column();
            return implode(', ', $categoryTitles);
        }
        return ''; // Return an empty string if subject is null
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if ($this->selectedCategory !== null) {
            $categoryIds = $this->selectedCategory;
            // Process selected items and update associated data here
        }
    }

    public function getItem()
    {
        return $this->hasOne(Item::class, ['id' => 'item_id']);
    }
}
