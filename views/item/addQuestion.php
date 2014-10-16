<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\db\Item */
/* @var $questions app\models\db\Question[] */
/* @var $newQuestion app\models\db\Question */
/* @var $$questionCategory app\models\db\QuestionCategory */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-3">
    <br><br>
    <a href="<?= \Yii::$app->urlManager->createUrl(['wiki/view', 'id' => $model->id]); ?>" class="btn btn-warning"><span class="glyphicon glyphicon-chevron-left"></span> Kembali</a>
</div>
<div class="col-md-9">
    <?php if(Yii::$app->session->hasFlash('success')): ?>
        <br>
        <div class="alert alert-success">
            <?= Yii::$app->session->getFlash('success'); ?>
        </div>
    <?php endif; ?>
    <?php if(Yii::$app->session->hasFlash('error')): ?>
        <br>
        <div class="alert alert-success">
            <?= Yii::$app->session->getFlash('error'); ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <h1><?= Html::encode($model->name) ?></h1>
        <div class="col-md-3">
            <img src='<?=Yii::$app->request->baseUrl."/".$model->image_url;?>' width='150px' height='150px' style="margin: 10px;">
        </div>
        <div class="col-md-9">
            <?= $model->description; ?>
        </div>
    </div>

    <hr>
    <h2>Pertanyaan</h2>
    <table class="table">
        <tr>
            <th>Pertanyaan</th>
            <th>Jawaban</th>
        </tr>
        <?php foreach($questions as $question): ?>
            <tr>
                <td><?= $question->questionCategory->name; ?></td>
                <td><?= $question->value ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <div class="row">
        <?php $form = ActiveForm::begin([
            'fieldConfig' => [
                'template' => '<div class="form-group">{label}<br>{input}<br>{error}</div>',
            ],
        ]); ?>
        <div class="col-md-6">
            <?= $form->field($newQuestion, 'question_category_id')->dropDownList(ArrayHelper::map($questionCategory,'id','name'), ['prompt' => 'Pilih Kategori', 'style'=>'border-radius:0px;']); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($newQuestion, 'value')->textInput(); ?>
        </div>

        <div class="form-group">
            <center><button class="btn btn-success">Simpan!</button></center>
        </div>

        <?php ActiveForm::end();?>
    </div>
</div>
