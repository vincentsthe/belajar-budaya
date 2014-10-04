<?php
use yii\helpers\Html;
use app\assets\AppAsset;
use app\assets\GameAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
GameAsset::register($this);
?>

<!DOCTYPE HTML>
<html ng-app="gemastikApp">
	<head>
		<title>Belajar Budaya</title>
		<?= Html::csrfMetaTags() ?>
    	<title><?= Html::encode($this->title) ?></title>
    	<?php $this->head() ?>
	</head>
	<body ng-controller="GameController">

		<?php $this->beginBody() ?>

		<div class="navbar navbar-default navbar-static-top header" id="header">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand">
					<img src="<?= Yii::$app->request->baseUrl ?>/img/header.png" height="30px" /></a>
				</div>
				<div class="navbar-collapse collapse">
					<ul class="nav nav-pills navbar-right" style="padding: 5px 0px 5px 0px">
						<li><a href="#/menu"><i class="fa fa-home"></i> Home</a></li>
						<li><a href="#/additem"><i class="fa fa-plus"></i>Add Item</a></li>
						<!--li><a href=""><i class="fa fa-trophy"></i> Achievement</a></li>
						<li><a href=""><i class="fa fa-list-ol"></i>Rank</a></li-->
						<li><a href="#/login"><i class="fa fa-sign-out"></i>Logout</a></li>
					</ul>
				</div>
			</div>
		</div>
		<link href='http://fonts.googleapis.com/css?family=Kameron:700' rel='stylesheet' type='text/css'>
		<div class="main-content">
			<div class="container">
				<div class="row">
					<div class="col-md-3 question">
						<h1 class="text-center guess">
							<img width="150px" height="160px" src="<?= Yii::$app->request->baseUrl ?>/img/items/{{nama}}.jpg"/>
							<!--i class="fa fa-building"></i-->
						</h1>
						<h2><p class="text-center" style="font-family: 'Kameron', serif;">{{ nama }}</p></h2>
						<div class="count">
							{{ timeLeft }}
						</div>
						<br>
						<!--div class="row">
							<div class="col-md-6 score right">
								<p>Skor game ini</p>
								<span>0</span>
							</div>
							<div class="col-md-6 score">
								<p>{{ score }}</p>
								<span>{{ score }}</span>
							</div>
						</div-->
					</div>
					<div class="col-md-4 info" id="question">
						<div ng-repeat="question in questions">
							<div class="col-md-12" style="padding:20px 0px 20px 0px">
							<div class="col-md-4">
								<img src="<?= Yii::$app->request->baseUrl ?>/img/icons/{{question.category}}.png" width="75px" />
							</div>
							<div class="col-md-8" style="padding:0px; margin:10px 0px 10px 0px;">
								<p ng-class="{green: question.answered}" style="margin-bottom:0px;">
									{{ question.category }} 
								</p>
								<p ng-class="{green: question.answered}" style="padding:0px; margin:0px;">
									<b ng-if="question.answered" style="font-size:1.2em; text-transform:uppercase;">{{ question.answer }}</b>
								</p>
							</div>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="col-md-5 text-table" id="chatDiv">
						<table class="table" id="table">
							<tr>
								<td>
									Vincent masuk ke ruangan.
								</td>
							</tr>
							<tr>
								<td>
									Yafi masuk ke ruangan.
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="footer" id="footer">
			<div class="container">
			<div class="col-md-4">
				Skor anda<br>
				<h1 style="margin:0px;">{{score}}</h1>
			</div>
			<div class="col-md-5 col-md-offset-3">
				<form ng-submit="submitAnswer()">
					<input ng-model="answer" type="text" class="form-control" style="min-height:50px; border-radius:5px; font-size:1.5em;"placeholder=". . . . .">
				</form>
			</div>
			</div>
		</div>
		<?php $this->endBody() ?>
	</body>
</html>