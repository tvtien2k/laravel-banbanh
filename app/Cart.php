<?php

namespace App;

class Cart
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item, $id)
    {
        if ($item->promotion_price == 0) {
            $giohang = ['qty' => 0, 'price' => $item->unit_price, 'item' => $item];
        } else {
            $giohang = ['qty' => 0, 'price' => $item->promotion_price, 'item' => $item];
        }
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $giohang = $this->items[$id];
            }
        }
        $giohang['qty']++;
        if ($item->promotion_price == 0) {
            $giohang['price'] = $item->unit_price * $giohang['qty'];
        } else {
            $giohang['price'] = $item->promotion_price * $giohang['qty'];
        }
        $this->items[$id] = $giohang;
        $this->totalQty++;
        if ($item->promotion_price == 0) {
            $this->totalPrice += $item->unit_price;
        } else {
            $this->totalPrice += $item->promotion_price;
        }

    }

    //thêm sản phẩm với số lượng
    public function AddWithQty($item, $id, $qty)
    {
        $giohang = null;
        $totalQ = 0;
        $totalP = 0;

        // items
        if ($this->checkItem($id)) {
            $giohang = $this->items[$id];
            $giohang['qty'] = $giohang['qty'] + $qty;
        } else {
            if ($item->promotion_price == 0) {
                $giohang = ['item' => $item, 'price' => $item->unit_price, 'qty' => $qty];
            } else {
                $giohang = ['item' => $item, 'price' => $item->promotion_price, 'qty' => $qty];
            }
        }
        // totalQ
        $totalQ = $this->totalQty + $qty;
        // totalP
        if ($item->promotion_price == 0) {
            $totalP = $this->totalPrice + $item->unit_price * $qty;
        } else {
            $totalP = $this->totalPrice + $item->promotion_price * $qty;
        }

        $this->items[$id] = $giohang;
        $this->totalQty = $totalQ;
        $this->totalPrice = $totalP;
    }

    //xóa 1
    public function reduceByOne($id)
    {
        $this->items[$id]['qty']--;
        $this->items[$id]['price'] -= $this->items[$id]['item']['price'];
        $this->totalQty--;
        $this->totalPrice -= $this->items[$id]['item']['price'];
        if ($this->items[$id]['qty'] <= 0) {
            unset($this->items[$id]);
        }
    }

    //xóa nhiều
    public function removeItem($id)
    {
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['price'];
        unset($this->items[$id]);
    }

    public function checkItem($id)
    {
        if ($this->items != null) {
            foreach ($this->items as $value) {
                if ($value['item']['id'] == $id) {
                    return true;
                }
            }
        }
        return false;
    }
}
