    <?php
use yii\helpers\Html;

$this->title = 'Shop';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .item-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
}

.item {
    border: 1px solid #ddd;
    padding: 20px;
    text-align: center;
}
/*
.item-image {
    max-width: 100%;
    height: auto;
}

.item-price {
    font-weight: bold;
    color: #e44d26;
}

.btn {
    background-color: #007bff;
    color: #fff;
    border: none;
}*/

</style>

<div class="shop-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="item-grid">
        <?php foreach ($items as $item): ?>
            <div class="item">
                <h2><?= Html::encode($item->title) ?></h2>
                <p class="item-price">$<?= Html::encode($item->price) ?></p>
                <p><?= Html::encode($item->details) ?></p>
                <?= Html::a('Add to Cart', ['shop/add-to-cart', 'itemId' => $item->id], ['class' => 'btn btn-primary']) ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
        