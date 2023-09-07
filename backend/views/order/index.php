<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var app\models\OrderSearch $searchModel
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">
    <div class="card">
        <div class="card-header">
            <?php echo Html::a('Create Order', ['create'], ['class' => 'btn btn-success']) ?>
        </div>

        <div class="card-body p-0">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
            <?php echo GridView::widget([
                'layout' => "{items}\n{pager}",
                'options' => [
                    'class' => ['gridview', 'table-responsive'],
                ],
                'tableOptions' => [
                    'class' => ['table', 'text-nowrap', 'table-striped', 'table-bordered', 'mb-0'],
                ],
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'date',
                    'total_price',
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
    'filter' => [
        0 => 'Inactive',
        1 => 'Active',
        2 => 'Unknown',
        3 => 'Unspecified',
    ],
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
        return isset($statuses[$model->delivery_status]) ? $statuses[$model->delivery_status] : 'Unknown';
    },
    'filter' => [
        0 => 'pending',
        1 => 'Delivered',
        2 => 'in_working',
        3 => 'un-specified',
    ],
],

                    ['class' => \common\widgets\ActionColumn::class],
                ],
            ]); ?>
    
        </div>
        <div class="card-footer">
            <?php echo getDataProviderSummary($dataProvider) ?>
        </div>
    </div>

</div>
