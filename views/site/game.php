<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use app\assets\GameAsset;

GameAsset::register($this);
/* @var $this \yii\web\View */
/* @var $content string */
?>
<?php Pjax::begin(['timeout' => 10000]);?>
<div>
	<div class="container">
		<div class="col-md-3 question" >
								<h1 class="text-center guess">
									<img width="150px" height="160px" src="<?= Yii::$app->request->baseUrl ?>/img/items/{{nama}}.jpg"/>
									<!--i class="fa fa-building"></i-->
								</h1>
								<h2><p class="text-center" style="font-family: 'Kameron', serif;"></p></h2>
								<div class="count">
								</div>
								<br>
		</div>

		<div class="col-md-5 text-table" id="chatDiv" style="max-height:500px;">
		
			<table class="table" id="table">
				<?= 
					ListView::widget([
					       'dataProvider' => $dataProvider,
					       'itemOptions' => ['class' => 'item'],
					       'itemView' => function ($model, $key, $index, $widget) {
					           return "<tr><td>".Html::encode($model->answer)."</td></tr>";
					       },
					       'summary'=>'',
					       'layout'=>'{items}',
					]);
				?>
			</table>
		</div>
		<?php $this->registerJs('document.getElementById("chatDiv").scrollTop = 999999;'); ?>
	</div>
</div>
<div class="clearfix"></div>
<div class="footer" id="footer" style="min-height:100px;">
<div class="container">
			<div class="col-md-4">
				Skor anda<br>
				<h1 style="margin:0px;"><?=$score;?></h1>
			</div>

			<div class="col-md-5 col-md-offset-3">
			
				<?php 
					$form = ActiveForm::begin([
						'method' => 'post',
						'options' =>[
						'data-pjax' => true],
					]); 
				?>
				<?= Html::activeHiddenInput($answer,'room_id'); ?>
				<?= Html::activeHiddenInput($answer,'user_id'); ?>
				<?= Html::activeTextInput($answer,'answer',['class'=>"form-control", 'style'=>'min-height:50px; border-radius:5px; font-size:1.5em;','placeholder'=>". . . . ."]); ?>
				<?php ActiveForm::end(); ?>
			</div>
			<?php Pjax::end(); ?>

</div>



<?php //$this->registerJs('window.setTimeout(function(){$("#refresh").click();},1000);'); ?>
