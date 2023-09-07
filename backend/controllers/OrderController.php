<?php

namespace app\controllers;
namespace backend\controllers;

use Yii;
use app\models\Order;
use app\models\OrderItem;
use app\models\OrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Item;



/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
{

public function actionGetItemPrice($item_id)
{
    $item = Item::findOne($item_id);

    if ($item) {
        // Return the item's price as JSON
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return ['price' => $item->price];
    }

    // Handle the case where the item is not found
    // You can return an error message or an appropriate response here
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
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
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
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

public function actionCreate()
{
    $orderModel = new Order();
    $orderItemModel = new OrderItem();

    if (Yii::$app->request->isPost) {
        $post = Yii::$app->request->post();

        if ($orderModel->load($post) && $orderModel->validate()) {
            // Save data to the "order" table
            $orderModel->save(false); // Use "false" to skip validation since you've already validated

            // Fetch the selected item's price and set it to the selected_item_price field
            $selectedItemID = $post['OrderItem']['item_id'];
            $selectedItem = Item::findOne($selectedItemID);
            if ($selectedItem) {
                $orderItemModel->selected_item_price = $selectedItem->price;
            }

            // Now, populate and save data to the "orderitem" table
            $orderItemModel->order_id = $orderModel->id; // Link the order item to the created order
            $orderItemModel->item_id = $post['OrderItem']['item_id'];
            $orderItemModel->unit_price = $orderItemModel->selected_item_price; // Set the unit_price
            $orderItemModel->item_count = $post['OrderItem']['item_count'];
            $orderItemModel->status = $orderModel->status; // You may need to adjust this based on your requirements
            $orderItemModel->total_price = $orderItemModel->unit_price * $orderItemModel->item_count; // Calculate total_price
            $orderItemModel->save(false);

            Yii::$app->session->setFlash('success', 'Order created successfully.');
            return $this->redirect(['view', 'id' => $orderModel->id]);
        }
    }

    // Fetch items for the dropdown
    $items = Item::find()->select(['id', 'title'])->indexBy('id')->column();

    return $this->render('create', [
        'orderModel' => $orderModel,
        'orderItemModel' => $orderItemModel,
    ]);
}






    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     */
public function actionUpdate($id)
{
    $orderModel = $this->findModel($id); // Retrieve the order model

    if (Yii::$app->request->isPost) {
        $post = Yii::$app->request->post();

        if ($orderModel->load($post) && $orderModel->validate()) {
            // Save data to the "order" table
            $orderModel->save(false); // Use "false" to skip validation since you've already validated

            // Update the associated order item
            $orderItemModel = OrderItem::findOne(['order_id' => $orderModel->id]);

            if ($orderItemModel) {
                // Update the selected item's price
                $selectedItemID = $post['OrderItem']['item_id'];
                $selectedItem = Item::findOne($selectedItemID);
                if ($selectedItem) {
                    $orderItemModel->selected_item_price = $selectedItem->price;
                }

                // Update unit price, item count, and total price
                $orderItemModel->item_id = $post['OrderItem']['item_id'];
                $orderItemModel->unit_price = $orderItemModel->selected_item_price;
                $orderItemModel->item_count = $post['OrderItem']['item_count'];
                $orderItemModel->total_price = $orderItemModel->unit_price * $orderItemModel->item_count;

                // Save the updated order item
                $orderItemModel->save(false);
            }

            Yii::$app->session->setFlash('success', 'Order updated successfully.');
            return $this->redirect(['view', 'id' => $orderModel->id]);
        }
    }

    // Retrieve the associated order item model
    $orderItemModel = OrderItem::findOne(['order_id' => $orderModel->id]);

    return $this->render('update', [
        'orderModel' => $orderModel,
        'orderItemModel' => $orderItemModel, // Pass the orderItemModel to the view
    ]);
}


    /**
     * Deletes an existing Order model.
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
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
