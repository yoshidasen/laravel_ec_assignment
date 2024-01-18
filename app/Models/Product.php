<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // グローバルスコープの定義
    protected static function boot() {
        parent::boot();
    }

    protected $table = "product_details";

    // 削除されていない項目を検索するスコープ
    public function scopeDeleteFlag($query) {
        return $query->where('delete_flag', '=', 0);
    }

    // 公開されている項目を検索するスコープ
    public function scopeReleaseFlag($query) {
        return $query->where('release_flag', '=', 1);
    }

    public function category() {
        return $this->belongsTo('App\Models\Category');
    }
}