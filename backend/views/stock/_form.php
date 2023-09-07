        <?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Item;
        use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var app\models\Stock $model
 * @var yii\bootstrap4\ActiveForm $form
 */
$this->registerAssetBundle(yii\web\JqueryAsset::class);

$items = Item::find()->all();
?>

<div class="stock-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="card">
        <div class="card-body">
            <?= $form->errorSummary($model); ?>

<?= $form->field($model, 'item_id')->dropDownList(
    ArrayHelper::map($items, 'id', function ($item) {
        return "{$item->title}";
    }),
    [
        'prompt' => 'Select Item',
        'id' => 'stock-item_id', // Add an ID to the dropdown for JavaScript reference
        'data-url' => Url::to(['stock/get-item-price']), // Use the correct action URL
    ]
)->label('Item') ?>

<!-- Display selected item price -->
<?= $form->field($model, 'unit_price')->textInput(['readonly' => true, 'id' => 'unit_price'])->label('Unit Price') ?>

<!-- Other fields for Stock model -->
<?= $form->field($model, 'item_count')->textInput(['label' => 'Item Count']) ?>


        </div>
        <div class="card-footer">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<?php
$script = <<< JS
$(document).ready(function() {
    // Get references to the dropdown and unit_price field
    var itemDropdown = $('#stock-item_id');
var unitPriceField = $('#unit_price'); // Match the ID here to the actual ID of the field

    // Listen for change event on the dropdown
    itemDropdown.on('change', function() {
        // Get the selected item's ID
        var selectedItemID = $(this).val();
        console.log('Selected Item ID:', selectedItemID); // Debug statement

        // Fetch the selected item's price via AJAX
        var priceFetchUrl = $(this).data('url'); // Get the URL from data attribute
        console.log('Price Fetch URL:', priceFetchUrl); // Debug statement

        $.ajax({
            url: priceFetchUrl, // Use the URL from data attribute
            data: {item_id: selectedItemID},
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                // Update the unit_price field with the fetched price
                unitPriceField.val(data.price);
                console.log('Fetched Price:', data.price); // Debug statement
            },
            error: function() {
                console.error('AJAX Error'); // Debug statement
                // Handle errors if necessary
            }
        });
    });
});



JS;

$this->registerJs($script);
?>
