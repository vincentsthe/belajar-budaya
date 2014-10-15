<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use app\assets\GameAsset;

GameAsset::register($this);
/* @var $this \yii\web\View */
/* @var $content string */
date_default_timezone_set ("Asia/Jakarta");
?>
<?php Pjax::begin(['timeout' => 10000]);?>

<div class="wrap" ng-controller="SiteController" ng-init="init()">
        <?php
            NavBar::begin([
                'brandLabel' => Html::img("@web/img/header.png"),
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-default navbar-static-top-header',
                    'id' => 'header'
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right','style' => 'padding: 5px 0px 5px 0px;'],
                'items' => [
                    ['label' => '<i class="fa fa-home"></i> Home', 'url' => ['/site/home']],
                    ['label' => '<i class="fa fa-plus"></i> Add Item', 'url' => ['/site/additem']],
                    Yii::$app->user->isGuest ?
                        ['label' => 'Login', 'url' => ['/site/login']] :
                        ['label' => 'Logout ({{activeUser.name}})',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                ],
                'encodeLabels' => false,
            ]);
            NavBar::end();
        ?>

        <div>

<div>
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
								<br>
		</div>
		<div class="col-md-4 info" id="question">
			<?php foreach($questions as $question): ?>
					<div class="col-md-12" style="padding:20px 0px 20px 0px">
					<div class="col-md-4">
						<img src="<?= Yii::$app->request->baseUrl."/".$question->questionCategory->image_url;?>" width="75px" />
					</div>
					<div class="col-md-8" style="padding:0px; margin:10px 0px 10px 0px;">
						<p style="margin-bottom:0px;">
							<?= $question->questionCategory->name; ?>
						</p>
						<p style="padding:0px; margin:0px;">
							<b>TBD Jawaban</b>
						</p>
					</div>
					</div>
			<?php endforeach; ?>
			<div class="clearfix"></div>
		</div>
		<div class="col-md-5 text-table" id="chatDiv" style="max-height:500px;">
		
			<table class="table" id="table">
				<?= 
					ListView::widget([
					       'dataProvider' => $dataProvider,
					       'itemOptions' => ['class' => 'item'],
					       'itemView' => function ($model, $key, $index, $widget) {
					           return "<tr><td>".Yii::$app->user->identity->id."</td><td>".Html::encode($model->answer)."</td><td>".Html::encode($model->result)."</td></tr>";
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



        </div>
    </div>


<div class="footer" id="footer" style="height:100px;margin-top:-100px">
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
</div>

<?php //$this->registerJs('window.setTimeout(function(){$("#refresh").click();},1000);'); ?>
