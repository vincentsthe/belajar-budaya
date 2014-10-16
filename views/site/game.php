<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use app\assets\GameAsset;
use app\models\db\Answer;

/* @var $this \yii\web\View */
/* @var $content string */
date_default_timezone_set ("Asia/Jakarta");
?>
<?php Pjax::begin(['timeout' => 10000]);?>
<div id="pjax-container">
	<div class="container">
		<div class="col-md-3 question" >
								<h1 class="text-center guess">
									<img width="150px" height="160px" src="<?= Yii::$app->request->baseUrl."/".$item->image_url; ?>"/>
									<!--i class="fa fa-building"></i-->
								</h1>
								<h2><p class="text-center" style="font-family: 'Kameron', serif;"><?=$item->name;?></p></h2>
								<div class="count">
									<?= 10 - ($timeleft); ?>

								</div>

		</div>
		<div class="col-md-4 info" id="question">
			<?php foreach($questions as $question): ?>
					<div class="col-md-12" style="padding:20px 0px 20px 0px">
					<div class="col-md-4">
						<img src="<?= Yii::$app->request->baseUrl."/".$question->questionCategory->image_url;?>" width="75px" />
					</div>
					<div class="col-md-8" style="padding:0px; margin:10px 0px 10px 0px; ">
						<p style="margin-bottom:0px; color:black;">
							<?= $question->questionCategory->name; ?>
						</p>
						<p style="padding:0px; margin:0px;">
							<?php if ($question->hasAnswered($room_id)): ?>
								<b style="color:green"><?=$question->value; ?></b>
							<?php else: ?>
								<b style="color:red">?</b>
							<?php endif; ?>
						</p>
					</div>
					</div>
			<?php endforeach; ?>
			<div class="clearfix"></div>
		</div>
		<div class="col-md-5 text-table" id="chatDiv" style="max-height:500px;">
		
			<table class="table" id="table">
				<?php $chat = array_reverse($chat); ?>
				<?php foreach ($chat as $model):
						$style = '';
			       		switch ($model->result) {
			       			case Answer::VALUE_IF_CORRECT:
			       				$style = 'font-weight:bold; color:green';
			       				break;
			       			case Answer::VALUE_IF_WRONG:
			       				$style = 'color:red';
			       				break;
			       			default:
			       				$style = 'color:black';
			       				break;
			       		}
			           	echo "<tr style='$style'><td>".$model->user->nick_name." : ".Html::encode($model->answer)."</td><td>".Html::encode($model->result)."</td></tr>";
						endforeach; 
				?>
				<?php /*
					ListView::widget([
					       'dataProvider' => $dataProvider,
					       'itemOptions' => ['class' => 'item'],
					       'itemView' => function ($model, $key, $index, $widget) {
					       		$style = '';
					       		switch ($model->result) {
					       			case Answer::VALUE_IF_CORRECT:
					       				$style = 'font-weight:bold; color:green';
					       				break;
					       			case Answer::VALUE_IF_WRONG:
					       				$style = 'color:red';
					       				break;
					       			default:
					       				$style = 'color:black';
					       				break;
					       		}
					           	return "<tr style='$style'><td>".$model->user->nick_name." : ".Html::encode($model->answer)."</td><td>".Html::encode($model->result)."</td></tr>";
					       },
					       'summary'=>'',
					       'layout'=>'{items}',
					]);*/
				?>
			</table>
		</div>
		<?php $this->registerJs('document.getElementById("chatDiv").scrollTop = 999999;'); ?>
	</div>
</div>
<?= Html::a('woi','',['id' => 'refresh','style'=>'display:none']); ?>
<?php 
	$form = ActiveForm::begin([
		'method' => 'post',
		'options' =>[
		'data-pjax' => '#pjax-container'],
	]); 
	?>
	<?= Html::activeHiddenInput($answer,'room_id'); ?>
	<?= Html::activeHiddenInput($answer,'user_id'); ?>
	<?= Html::activeHiddenInput($answer,'answer',['id'=>'h-answer','class'=>"form-control", 'style'=>'min-height:50px; border-radius:5px; font-size:1.5em;','placeholder'=>". . . . ."]); ?>
	<?php ActiveForm::end(); ?>

	<script type="text/javascript">document.getElementById("answer").focus();</script>
<?php Pjax::end(); ?>
<div class="clearfix"></div>
<div class="footer" id="footer" style="min-height:100px;bottom:10px;position:absolute;">
<div class="container">

			<div class="col-md-4" style="margin-top:0;">
			<p style="">Total skor</p>
				<h2 style="margin-top:0;"><?="".$score;?></h2>
			</div>

			<div class="col-md-5 col-md-offset-3">
				<input id="answer" type="text" class="form-control" style='cursor:default; min-height:50px; border-radius:5px; font-size:1.5em;' placeholder=". . . . ." onkeydown="if(event.keyCode == 13) {$('#h-answer').val(this.value); $('#h-answer').submit(); this.value=''; return false; }"/>
				
			</div>
			
			
			
			<script type="text/javascript">setInterval(function(){document.getElementById("refresh").click()},1000);</script>

        </div>
    </div>


<?php //$this->registerJs('setTimeout(function(){$("#refresh").dblclick();},300);'); ?>
