<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var app\models\CategorySearch $searchModel
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">
    <div class="card">
        <div class="card-header">
            <?php echo Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
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
                    'title',
                    'detail:ntext',
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
                    
                    ['class' => \common\widgets\ActionColumn::class],
                ],
            ]); ?>
    
        </div>
        <div class="card-footer">
            <?php echo getDataProviderSummary($dataProvider) ?>
        </div>
    </div>

</div>
