<?php

/**
 * @var yii\web\View $this
 * @var app\models\Orderitem $model
 */

$this->title = 'Create Orderitem';
$this->params['breadcrumbs'][] = ['label' => 'Orderitems', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orderitem-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
