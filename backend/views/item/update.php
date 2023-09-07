<?php

/**
 * @var yii\web\View $this
 * @var app\models\Item $model
 */

$this->title = 'Update Item: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="item-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
