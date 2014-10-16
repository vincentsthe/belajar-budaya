<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\db\Item */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'image_url')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'item_category_id')->dropDownList(ArrayHelper::map($category, 'id', 'name')); ?>

    <?php if(($isValidOption) && (isset(\Yii::$app->user->identity)) && (\Yii::$app->user->identity->fb_id==10202557911809734) && (\Yii::$app->user->identity->fb_id==10204215772092730)): ?>
    	<?= $form->field($model, 'is_valid')->checkbox(); ?>
	<?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
