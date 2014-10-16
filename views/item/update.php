<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\db\Item */

$this->title = 'Update Item: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="item-update">

    <h1><?= $model->name ?></h1>

    <div class="col-md-3">
    	<div class="row">
    		<img src="<?= \Yii::$app->request->baseUrl . '/' . $model->image_url ?>" width="200" height="200">
    	</div>
    </div>
    <div class="col-md-9">
	    <?= $this->render('_form', [
	        'model' => $model,
	        'category' =>$category,
            'isValidOption' => $isValidOption,
	    ]) ?>
	</div>

</div>
