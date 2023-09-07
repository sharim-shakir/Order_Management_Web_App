<?php

namespace app\controllers;
namespace backend\controllers;

use Yii;    
use app\models\Item;
use app\models\ItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Category;

/**
 * ItemController implements the CRUD actions for Item model.
 */
class ItemController extends Controller
{

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
     * Lists all Item models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Item model.
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
     * Creates a new Item model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Item();

    if ($model->load(Yii::$app->request->post())) {
     
  $model->category_id = implode(',', (array)$model->selectedCategory);
        // Convert the selected tags array to a comma-separated strin

    $model->tags = implode(',', Yii::$app->request->post('Item')['tags']);


        if ($model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
    }

    return $this->render('create', [
        'model' => $model,
        'categoryList' => Category::getCategoryList(),
    ]);
    }

    /**
     * Updates an existing Item model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

    if ($this->request->isPost && $model->load($this->request->post())) {

    $model->category_id = implode(',', (array)$model->selectedCategory);


    $model->tags = implode(',', Yii::$app->request->post('Item')['tags']);

        if ($model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
    }

    // Convert item_id to array of integers
    $model->selectedCategory = explode(',', $model->category_id);

    return $this->render('update', [
        'model' => $model,
        'categoryList' => Category::getCategoryList(),
    ]);

}
    /**
     * Deletes an existing Item model.
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
     * Finds the Item model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Item the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Item::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
