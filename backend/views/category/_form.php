<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\Category $model
 * @var yii\bootstrap4\ActiveForm $form
 */
?>

<div class="category-form">
    <?php $form = ActiveForm::begin(); ?>
        <div class="card">
            <div class="card-body">
                <?php echo $form->errorSummary($model); ?>

                <?php echo $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                <?php echo $form->field($model, 'detail')->textarea(['rows' => 6]) ?>
                  <?= $form->field($model, 'status')->dropDownList([
        0 => 'Inactive',
        1 => 'Active',
        2 => 'Unknown',
        3 => 'Unspecified'
    ], ['prompt' => 'Select Status'])  ?>
     
            </div>
            <div class="card-footer">
                <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>
