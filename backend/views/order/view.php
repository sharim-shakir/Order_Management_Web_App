<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var app\models\Order $model
 */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">
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
                    'date',
                    'total_price',
                    [
                        'attribute' => 'status',
                        'value' => $model->status === 1 ? 'Active' : 'Inactive', // Display status text
                    ],

 [
                'attribute' => 'delivery_status',
                'value' => function ($model) {
                    $statuses = [
                        0 => 'pending',
                        1 => 'Delivered',
                        2 => 'in_working',
                        3 => 'un-specified',
                    ];

                    return $statuses[$model->delivery_status];
                },
            ],
                    
                ],
            ]) ?>
        </div>
    </div>
</div>
