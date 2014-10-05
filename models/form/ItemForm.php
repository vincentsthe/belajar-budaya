<?php

namespace app\models\form;

use Yii;
use yii\base\Model;
use app\models\db\Item;

class ItemForm extends Model {

	public $nama;
	public $deskripsi;
	public $gambar;
	public $kategori;

	public function rules() {
		return [
			[['nama', 'deskripsi', 'gambar', 'kategori'], 'required'],
			[['nama'], 'string', 'max' => 100],
			[['gambar'], 'file', 'extensions' => 'png, jpg, jpeg', 'mimeTypes' => 'image/jpeg, image/png'],
		];
	}

}