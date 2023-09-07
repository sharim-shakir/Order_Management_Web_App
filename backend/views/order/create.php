<?php

/**
 * @var yii\web\View $this
 * @var app\models\Order $model
 */

$this->title = 'Create Order';
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-create">

    <?php echo $this->render('_form', [
              'orderModel' => $orderModel,
        'orderItemModel' => $orderItemModel, 
    ]) ?>

</div>
