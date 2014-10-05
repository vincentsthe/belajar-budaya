<?php
	use Yii;
	use yii\widgets\ActiveForm;
?>

<div class="container">
	<div class="col-md-6 col-md-offset-3">
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

			<?= $form->field($model, 'deskripsi')->textArea(['rows' => 2, 'style'=>'border-radius:0px;']); ?>
			
			<?= $form->field($model, 'gambar')->fileInput(['id'=>'gambar', 'class'=>'form-control']); ?>

			<?= $form->field($model, 'kategori')->dropDownList($categories, ['prompt' => 'Pilih Kategori', 'style'=>'border-radius:0px;']); ?>
			
			<div class="form-group">
				<center><button class="btn btn-success">Simpan!</button></center>
			</div>
			</div>

		<?php ActiveForm::end();?>
	</div>
</div>