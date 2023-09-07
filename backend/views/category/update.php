<?php

/**
 * @var yii\web\View $this
 * @var app\models\Category $model
 */

$this->title = 'Update Category: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="category-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
