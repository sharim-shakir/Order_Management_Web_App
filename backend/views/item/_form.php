    <?php

    use yii\helpers\Html;
    use yii\bootstrap4\ActiveForm;
    use app\models\Category;


    /**
     * @var yii\web\View $this
     * @var app\models\Item $model
     * @var yii\bootstrap4\ActiveForm $form
     */

    $randomTags = ['Tag1', 'Tag2', 'Tag3', 'Tag4', 'Tag5']; // Add your desired tags here





    $categoryList = \yii\helpers\ArrayHelper::map(Category::find()->all(), 'id', 'title');

    if (!empty($model->category_id)) {
        $selectedCategory = explode(',', $model->category_id); // Convert comma-separated IDs to an array
    } else {
        $selectedCategory = [];
    }

    ?>

    <div class="item-form">
        <?php $form = ActiveForm::begin(); ?>
            <div class="card">
                <div class="card-body">
                    <?php echo $form->errorSummary($model); ?>

                    <?php echo $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                    <?php echo $form->field($model, 'price')->textInput() ?>
                    
                    <?= $form->field($model, 'selectedCategory')->dropDownList(
        $categoryList,
        ['prompt' => 'Select Category']
    ) ?>

                    <?php echo $form->field($model, 'details')->textarea(['rows' => 6]) ?>
      
          <?= $form->field($model, 'status')->dropDownList([
            0 => 'Inactive',
            1 => 'Active',
            2 => 'Unknown',
            3 => 'Unspecified'
        ], ['prompt' => 'Select Status'])  ?>

                        <?= $form->field($model, 'in_stock')->dropDownList([
            0 => 'No',
            1 => 'Yes',
        ], ['prompt' => 'Select'])  ?>

    <?= $form->field($model, 'tags')->checkboxList(
        $randomTags, // List of tags
        ['tag' => 'span'] // HTML options for the tags
    ) ?>


                    <?php 
                    //echo $form->field($model, 'created_at')->textInput() 
                    ?>
                    
                    <?php 
                    //echo $form->field($model, 'created_by')->textInput() 
                    ?>
                    
                </div>
                <div class="card-footer">
                    <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
