<?php
    use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
?>
<?= date('H-i-s'); ?>
<?php 
Pjax::begin([]); ?>
    <?= GridView::widget([
        'id'=>'chat',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'answer',
            'user_id',
            'room_id',
            'created_at',
            // 'result',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
     <?php Pjax::end(); ?>
     <?php $this->registerJs('$.pjax.reload({container:"#chat",timeout:10000});'); ?>