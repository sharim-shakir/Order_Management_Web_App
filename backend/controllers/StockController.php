<?php

namespace app\controllers;
namespace backend\controllers;

use Yii;
use app\models\Stock;
use app\models\StockSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Item;

/**
 * StockController implements the CRUD actions for Stock model.
 */
class StockController extends Controller
{

public function actionGetItemPrice($item_id)
{
    $item = Item::findOne($item_id);

    if ($item) {
        // Log item information for debugging
        Yii::info('Item found: ID=' . $item->id . ', Price=' . $item->price, 'debug');

        // Return the item's price as JSON
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return ['price' => $item->price];
    } else {
        // Log item not found for debugging
        Yii::error('Item not found for ID=' . $item_id, 'debug');
        // Handle the case where the item is not found or other errors
        return ['error' => 'Item not found or other error'];
    }
}
        
    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Stock models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StockSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Stock model.
     * @param int $id ID
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Stock model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
public function actionCreate()
{
    $model = new Stock();

    if ($model->load(Yii::$app->request->post())) {
        // Fetch the selected item's actual price based on item_id
        $selectedItem = Item::findOne($model->item_id);

        if ($selectedItem !== null) {
            // Set the unit_price to the actual price of the item
            $model->unit_price = $selectedItem->price;
        }

        if ($model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
    }

    return $this->render('create', [
        'model' => $model,
    ]);
}

public function actionUpdate($id)
{
    $model = $this->findModel($id);

    if ($model->load(Yii::$app->request->post())) {
        // Fetch the selected item's actual price based on item_id
        $selectedItem = Item::findOne($model->item_id);

        if ($selectedItem !== null) {
            // Set the unit_price to the actual price of the item
            $model->unit_price = $selectedItem->price;
        }

        if ($model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
    }

    return $this->render('update', [
        'model' => $model,
    ]);
}


    /**
     * Deletes an existing Stock model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Stock model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Stock the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Stock::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
