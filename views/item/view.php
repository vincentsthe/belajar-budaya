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
    <h1><?= Html::encode($this->title) ?></h1>
    <p></p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description:ntext',
            'image_url:url',
            'item_category_id',
            'is_valid',
        ],
    ]) ?>
</div>
