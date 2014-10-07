<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\db\Item */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-inline">

    <?php $form = ActiveForm::begin([
    	'action' => ['index'],
        'method' => 'get',
    ]); ?>
	
	<div class="form-group">
	<?=Html::activeTextInput($searchModel,'keyword',['class'=>'form-control','placeholder'=>'Search...']); ?>
	<?=Html::submitButton("<span class='glyphicon glyphicon-search'></span>",['class'=>'btn','style'=>'background-color:#f0ad4e']); ?>

	</div>
    <?php ActiveForm::end(); ?>

</div>
