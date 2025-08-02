<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $fillable = [
        'main_category_id',
        'sub_category',
    ];
    public function mainCategory()
    {

        return $this->belongsTo(MainCategory::class);
        // 1対多の関係(多側)
        // belongsTo(関連するモデルクラス, 外部キー)
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_sub_categories', 'sub_category_id', 'post_id'); // リレーションの定義

        // belongsToMany(関連するモデルクラス, 中間テーブル名, 現在のモデルの外部キー, 関連するモデルの外部キー)

    }
}
