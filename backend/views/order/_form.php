<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Item;
use yii\helpers\Url;

$items = Item::find()->all();
?>

<div class="order-create">
    <h1>Create Order</h1>

    <?php $form = ActiveForm::begin(); ?>

    <!-- Fields for Order model -->
    <?= $form->field($orderModel, 'date')->textInput(['type' => 'date']) ?>

    <!-- Fields for OrderItem model -->
    <?= $form->field($orderItemModel, 'item_id')->dropDownList(
        ArrayHelper::map($items, 'id', function ($item) {
            return "{$item->title} ";
        }),
        [
            'prompt' => 'Select Item',
            'id' => 'orderitem-item_id', // Add an ID to the dropdown for JavaScript reference
            'data-url' => Url::to(['order/get-item-price']), // Use the correct action URL
        ]
    ) ?>

    <!-- Display selected item price -->
    <?= $form->field($orderItemModel, 'unit_price')->textInput(['readonly' => true, 'id' => 'unit_price']) ?>

    <?= $form->field($orderItemModel, 'item_count')->textInput() ?>
    <?= $form->field($orderModel, 'total_price')->textInput(['readonly' => true]) ?>

    <?= $form->field($orderModel, 'status')->dropDownList([
        0 => 'Inactive',
        1 => 'Active',
        2 => 'Unknown',
        3 => 'Unspecified'
    ], ['prompt' => 'Select Status']) ?>

    <?= $form->field($orderModel, 'delivery_status')->dropDownList([
        0 => 'Pending',
        1 => 'Delivered',
        2 => 'In Working',
        3 => 'Unspecified'
    ], ['prompt' => 'Select Delivery Status']) ?>



    <div class="form-group">
        <?= Html::submitButton('Create', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<?php
// Inside your JavaScript code
$script = <<< JS
$(document).ready(function() {
    // Get references to the dropdown and unit_price field
    var itemDropdown = $('#orderitem-item_id');
    var unitPriceField = $('#unit_price');
    var itemCountField = $('#orderitem-item_count'); // Added for item count
    var totalPriceField = $('#order-total_price'); // Added for total price calculation

    // Listen for change event on the dropdown
    itemDropdown.on('change', function() {
        // Get the selected item's ID
        var selectedItemID = $(this).val();

        // Fetch the selected item's price via AJAX
        var priceFetchUrl = $(this).data('url'); // Get the URL from data attribute

        $.ajax({
            url: priceFetchUrl, // Use the URL from data attribute
            data: {item_id: selectedItemID},
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                // Update the unit_price field with the fetched price
                unitPriceField.val(data.price);

                // Calculate and update the total price based on item count and unit price
                updateTotalPrice();
            },
            error: function() {
                // Handle errors if necessary
            }
        });
    });

    // Listen for change event on item_count field
    itemCountField.on('input', function() {
        updateTotalPrice();
    });

    // Function to update the total price
    function updateTotalPrice() {
        var itemCount = parseInt(itemCountField.val());
        var unitPrice = parseFloat(unitPriceField.val());

        if (!isNaN(itemCount) && !isNaN(unitPrice)) {
            var total = itemCount * unitPrice;
            totalPriceField.val(total.toFixed(2)); // Format total with two decimal places
        }
    }
});
JS;

$this->registerJs($script);
?>
