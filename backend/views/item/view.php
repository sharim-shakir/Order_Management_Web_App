<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var app\models\Item $model
 */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$randomTags = ['Tag1', 'Tag2', 'Tag3', 'Tag4', 'Tag5']; // Define your tags here

?>
<div class="item-view">
    <div class="card">
        <div class="card-header">
            <?php echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?php echo Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>
        <div class="card-body">
<?php echo DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'title',
                    'price',
[
                'attribute' => 'category',
                'value' => function ($model) {
                    return $model->getCategoryTitles();
                },
],
                    'details:ntext',
                    [
    'attribute' => 'status',
    'value' => function ($model) {
        $statusOptions = [
            0 => 'Inactive',
            1 => 'Active',
            2 => 'Unknown',
            3 => 'Unspecified',
        ];
        return isset($statusOptions[$model->status]) ? $statusOptions[$model->status] : 'Unknown';
    },
],

                    [
                        'attribute' => 'in_stock',
                        'value' => $model->in_stock === 1 ? 'Yes' : 'No', // Display in_stock text
                    ],
                    // [
                    //     'attribute' => 'tags',
                    //     'value' => function ($model) {
                    //         $tagIds = explode(',', $model->tags);
                    //         $tagNames = [];
                    //         foreach ($tagIds as $tagId) {
                    //             $tagNames[] = $randomTags[$tagId - 1]; // Assuming tags start from 1
                    //         }
                    //         return implode(', ', $tagNames);
                    //     },
                    // ],

                    // 'created_at',
                    // 'created_by',
                    
                ],
            ]) ?>
        </div>
    </div>
</div>
