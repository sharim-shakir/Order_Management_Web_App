<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\Item $model
 * @var yii\bootstrap4\ActiveForm $form
 */
?>

<div class="item-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'id') ?>
    <?php echo $form->field($model, 'title') ?>
    <?php echo $form->field($model, 'price') ?>
   <?php echo $form->field($model, 'categoryTitle')
 ?>

    <?php echo $form->field($model, 'details') ?>
    <?php // echo $form->field($model, 'status') ?>
    <?php // echo $form->field($model, 'in_stock') ?>
    <?php // echo $form->field($model, 'tags') ?>
    <?php // echo $form->field($model, 'created_at') ?>
    <?php // echo $form->field($model, 'created_by') ?>

    <div class="form-group">
        <?php echo Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton('Reset', ['class' => 'btn btn-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
