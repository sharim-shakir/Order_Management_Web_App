<?php

/**
 * @var yii\web\View $this
 * @var app\models\Order $orderModel
 */

$this->title = 'Update Order: ' . ' ' . $orderModel->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $orderModel->id, 'url' => ['view', 'id' => $orderModel->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="order-update">

    <?php echo $this->render('_form', [
        'orderModel' => $orderModel,
        'orderItemModel' => $orderItemModel,
    ]) ?>

</div>
