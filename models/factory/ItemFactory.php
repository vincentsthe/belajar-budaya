<?php

namespace app\models\factory;

use app\models\db\Item;
use app\models\form\ItemForm;

class ItemFactory {


    /**
     * Return Item from $itemForm instance
     * @return \app\models\db\Item
     */
    public static function createItemFromItemForm($itemForm) {
        $item = new Item;
        $item->name = $itemForm->nama;
        $item->description = $itemForm->deskripsi;
        $item->item_category_id = $itemForm->kategori;
        $item->image_url = $itemForm->gambar->baseName . '.' . $itemForm->gambar->extension;

        return $item;
    }
	
}