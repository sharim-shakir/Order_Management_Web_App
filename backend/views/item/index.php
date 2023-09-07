    <?php

    use yii\helpers\Html;
    use yii\grid\GridView;
    use app\models\Category;


    /**
     * @var yii\web\View $this
     * @var app\models\ItemSearch $searchModel
     * @var yii\data\ActiveDataProvider $dataProvider
     */

    $this->title = 'Items';
    $this->params['breadcrumbs'][] = $this->title;
    ?>
    <div class="item-index">
        <div class="card">
            <div class="card-header">
                <?php echo Html::a('Create Item', ['create'], ['class' => 'btn btn-success']) ?>
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
                        'price',
     [
            'attribute' => 'categoryTitle',
            'value' => function ($model) {
                return $model->getCategoryTitles();
            },
            'headerOptions' => ['class' => 'text-blue'], // Header appearance
            'contentOptions' => ['class' => 'text-black'],  // Content appearance
            'filterInputOptions' => ['class' => 'form-control'], // Filter input appearance

        ],
[
    'attribute' => 'details',
    'format' => 'ntext',
    'value' => function ($model) {
        $truncatedDetails = Yii::$app->formatter->asNtext(mb_substr($model->details, 0, 200));
        $fullDetails = Yii::$app->formatter->asNtext($model->details);

        // Check if the details need truncation
// ...
if (strlen($model->details) > 200) {
    $encodedFullDetails = htmlentities($fullDetails);
    return $truncatedDetails . ' <a href="#" class="read-more" data-full-details="' . $encodedFullDetails . '">Read More</a>';
}
// ...


        return $fullDetails;
    },
    'contentOptions' => ['class' => 'details-column'],
],

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
                            'attribute' => 'in_stock',
                            'value' => function ($data) {
                                return $data->in_stock === 1 ? 'Yes' : 'No';
                            },
                        ],
                        
                        // 'tags',
                        // 'created_at',
                        // 'created_by',
                        
                        ['class' => \common\widgets\ActionColumn::class],
                    ],
                ]); ?>
        
            </div>
            <div class="card-footer">
                <?php echo getDataProviderSummary($dataProvider) ?>
            </div>
        </div>

    </div>

    <!-- JavaScript for handling "Read More" links -->
<!-- JavaScript for handling "Read More" links -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const readMoreLinks = document.querySelectorAll('.read-more');

    readMoreLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const fullDetails = link.getAttribute('data-full-details');
            // Find the nearest .card-body and update its content
            const cardBody = link.closest('.card-body');
            const detailsColumn = cardBody.querySelector('.details-column');
            if (detailsColumn) {
                detailsColumn.innerHTML = fullDetails;
            }
        });
    });
});
    
</script>

    <!-- CSS for styling -->
    <style>
    .details-column {
        max-width: 300px; /* Adjust as needed */
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        cursor: pointer;
    }

    .read-more {
        color: blue;
        text-decoration: underline;
        cursor: pointer;
    }
    </style>
