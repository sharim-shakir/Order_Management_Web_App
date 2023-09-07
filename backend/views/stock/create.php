<?php

/**
 * @var yii\web\View $this
 * @var app\models\Stock $model
 */

$this->title = 'Create Stock';
$this->params['breadcrumbs'][] = ['label' => 'Stocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
