<?php

namespace app\models;
use app\models\Category;


use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $detail
 * @property int|null $status
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['detail'], 'string'],
            [['status'], 'integer'],
            [['title'], 'string', 'max' => 22],
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
            'detail' => 'Detail',
            'status' => 'Status',
        ];
    }

      public static function getCategoryList()
    {
        return static::find()->select(['id', 'title'])->all();
    }
}
