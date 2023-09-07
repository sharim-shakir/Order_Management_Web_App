<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var app\models\Orderitem $model
 */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orderitems', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orderitem-view">
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
                    'order_id',
                    'item_id',
                    'unit_price',
                    'item_count',
                    'status',
                    
                ],
            ]) ?>
        </div>
    </div>
</div>
