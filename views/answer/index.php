<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $searchModel app\models\search\AnswerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Answers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="answer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= date("H:i:s"); ?>
        <?= Html::a('Create Answer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= $this->render('_chat',['dataProvider' => $dataProvider,'searchModel'=>$searchModel]); ?>
</div>
