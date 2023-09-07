<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\Orderitem $model
 * @var yii\bootstrap4\ActiveForm $form
 */
?>

<div class="orderitem-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'id') ?>
    <?php echo $form->field($model, 'order_id') ?>
    <?php echo $form->field($model, 'item_id') ?>
    <?php echo $form->field($model, 'unit_price') ?>
    <?php echo $form->field($model, 'item_count') ?>
    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?php echo Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton('Reset', ['class' => 'btn btn-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
