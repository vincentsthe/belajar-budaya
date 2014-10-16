<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\grid\GridView;
use yii\widgets\Pjax;


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
    <?= 
        ListView::widget([
           'dataProvider' => $dataProvider,
           'itemView' => function ($model, $key, $index, $widget) {
                return "
                <a href=\"" . \Yii::$app->UrlManager->createUrl(['wiki/view', 'id'=>$model->id]) . "\">
                    <div class=\"row\">
                        <div class=\"col-md-12\">
                            <h2>$model->name</h2>
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col-md-3\">
                            <img src=\"" . \Yii::$app->request->baseUrl . "/" . $model->image_url . "\" width=\"150\">
                        </div>
                        <div class=\"col-md-9\">
                            <div>$model->description</div>
                        </div>
                    </div>
                </a>
                ";
           },
           'summary'=>'',
           'layout'=>'{items}',
        ]);
    ?>
    <br><br>
    </div>
<div class="col-md-4"></div>

</div>
    

    

</div>
