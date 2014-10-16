<?php
	use yii\widgets\ActiveForm;
	use app\assets\CkeditorAsset;
	use yii\helpers\ArrayHelper;

?>
<?php
	CkeditorAsset::register($this);
?>
<div class="container">
	<div class="col-md-10 col-md-offset-1">
		<?php if(Yii::$app->session->hasFlash('success')): ?>
			<br>
			<div class="alert alert-success">
				<?= Yii::$app->session->getFlash('success'); ?>
			</div>
		<?php endif; ?>
		<h1>Tambahkan data</h1>

		<?php $form = ActiveForm::begin([
			'options' => ['enctype' => 'multipart/form-data'],
			'fieldConfig' => [
				'template' => '<div class="form-group">{label}<br>{input}<br>{error}</div>',
			],
		]); ?>

			<?= $form->field($model, 'nama')->textInput(['maxLength' => 100]); ?>
			
			<?= $form->field($model, 'gambar')->fileInput(['id'=>'gambar', 'class'=>'form-control']); ?>

			<?= $form->field($model, 'kategori')->dropDownList(ArrayHelper::map($categories,'id','name'), ['prompt' => 'Pilih Kategori', 'style'=>'border-radius:0px;']); ?>

			<?= $form->field($model, 'deskripsi')->textArea(['rows' => 2, 'style'=>'border-radius:0px;']); ?>
			
			<div class="form-group">
				<center><button class="btn btn-success">Simpan!</button></center>
			</div>
			</div>

		<?php ActiveForm::end();?>
	</div>
</div>