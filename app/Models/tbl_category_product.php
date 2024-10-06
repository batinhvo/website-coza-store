<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_category_product extends Model
{
    use HasFactory;

    protected $fillable = ['cate_pro_name', 'cate_pro_show', 'cate_pro_status'];

    // Truy vấn danh mục
    public static function showCategoryProduct()
    {
        return self::where('cate_pro_show', true)->get();
    }

    public static function showAllCategoryProduct()
    {
        return self::orderby('cate_pro_id', 'ASC')->get();
    }
}
