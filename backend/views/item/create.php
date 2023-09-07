<?php

/**
 * @var yii\web\View $this
 * @var app\models\Item $model
 */

$this->title = 'Create Item';
$this->params['breadcrumbs'][] = ['label' => 'Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
