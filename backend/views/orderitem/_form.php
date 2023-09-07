<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\Orderitem $model
 * @var yii\bootstrap4\ActiveForm $form
 */
?>

<div class="orderitem-form">
    <?php $form = ActiveForm::begin(); ?>
        <div class="card">
            <div class="card-body">
                <?php echo $form->errorSummary($model); ?>

                <?php echo $form->field($model, 'order_id')->textInput() ?>
                <?php echo $form->field($model, 'item_id')->textInput() ?>
                <?php echo $form->field($model, 'unit_price')->textInput() ?>
                <?php echo $form->field($model, 'item_count')->textInput() ?>
                <?php echo $form->field($model, 'status')->textInput() ?>
                
            </div>
            <div class="card-footer">
                <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>
