<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\db\Item */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-3"><h1></h1><?=$this->render("_search",['searchModel'=>$searchModel]); ?></div>
<div class="col-md-9">
    <div class="row">
        <h1><?= Html::encode($model->name) ?></h1>
        <div class="col-md-3">
            <img src='<?=Yii::$app->request->baseUrl."/".$model->image_url;?>' width='150px' height='150px' style="margin: 10px;">
        </div>
        <div class="col-md-9">
            <?= $model->description; ?>
        </div>
    </div>
    
    <br><br>
    <center><a href="<?= \Yii::$app->urlManager->createUrl(['wiki/addquestion', 'itemId' => $model->id]); ?>" class="btn btn-warning">Buat Pertanyaan</a></center>
    <br><br>
</div>
