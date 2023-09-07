<?php

namespace frontend\controllers;

use common\models\ItemFrontend; // Use the frontend model
use yii\web\Controller;

class ShopController extends Controller
{
    public function actionIndex()
    {
        // Fetch items from the backend using the frontend model
        $items = ItemFrontend::find()->all();

        return $this->render('index', [
            'items' => $items,
        ]);
    }
}
