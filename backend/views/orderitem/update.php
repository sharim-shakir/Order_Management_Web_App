<?php

/**
 * @var yii\web\View $this
 * @var app\models\Orderitem $model
 */

$this->title = 'Update Orderitem: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orderitems', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="orderitem-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
