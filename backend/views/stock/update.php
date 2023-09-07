<?php

/**
 * @var yii\web\View $this
 * @var app\models\Stock $model
 */

$this->title = 'Update Stock: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Stocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="stock-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
