<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-index">
<div class="col-md-12">
<div class="col-md-3"><h1></h1><?= $this->render("_search",['searchModel' => $searchModel]); ?></div>
<div class="col-md-9">
<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'description:ntext',
            'image_url:url',
            'item_category_id',
            // 'is_valid',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?></div>
<div class="col-md-4"></div>

</div>
    

    

</div>
