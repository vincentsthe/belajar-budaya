<?php
	use yii\helpers\Html;
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-4">
				<h3 class="title">Penghargaan</h3>
				<span style="padding:10px;">
					<img src="<?= Yii::$app->request->baseUrl ?>/img/achievements/monitor.png"/>
				</span>
				<span style="padding:10px;">
					<img src="<?= Yii::$app->request->baseUrl ?>/img/achievements/trophy.png"/>
				</span>
			</div>
			<div class="col-md-4">
				<h3 class="title">Wiki</h3>
				<div>
					<?php 
					foreach($items as $item): ?>
						<div class="menu-box" style="background-color: #A8FFA4">
						<?= Html::img(Yii::$app->request->baseUrl."/img/items/$item->image_url",['style' => 'height:70px;float:left;border-radius:10px;']); ?>
							<?= Html::a("<h3 style='float:left' style='font-family: 'Kameron', serif;'>&nbsp; $item->name </h3>",['wiki/view','id' => $item->id]); ?>
						</div>
					<?php endforeach;
					?>
				</div>
				<center>
					<a href="<?= \Yii::$app->urlManager->createUrl(['site/game']); ?>" id="play-link">
					<div style="padding:30px 0px;">
					<img src="<?= Yii::$app->request->baseUrl ?>/img/play.png" width="100px;" id="play-button"/><br>
					<h2 class="title" style="color: #038D64;" >Play!</h2>
					</div>
				</a>
				</center>
			</div>
			<div class="col-md-3 col-md-offset-1" style="background-color: #f0ad4e; border-radius:10px;">
				<h3 class="title">Top Skor</h3>
				<?php foreach($ranks as $rank):?>
				<div class="col-md-12 top-scorer">
					<div class="top-scorer-p"><img src="<?= Yii::$app->request->baseUrl ?>/img/vincent.jpg" class="player-img" width="40px"/></div>
					<b><div class="top-scorer-n"><?=$rank->fb_id; ?></div>
					<div class="top-scorer-s"><?=$rank->score; ?></div></b>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>