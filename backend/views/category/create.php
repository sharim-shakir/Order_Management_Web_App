<?php

/**
 * @var yii\web\View $this
 * @var app\models\Category $model
 */

$this->title = 'Create Category';
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
