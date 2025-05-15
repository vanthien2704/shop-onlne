<?php

namespace App\Helper;

use App\Models\Product;
use App\Models\ProductGroup;
use App\Models\Role;

class AppHelper
{

    public static function products10()
    {
        $products = Product::limit(10)->where('enable', 1)->get();
        return $products;
    }

    public static function newproducts()
    {
        // Lấy 6 sản phẩm mới nhất theo created_at
        $newproducts = Product::orderBy('created_at', 'desc')->where('enable', 1)->limit(6)->get();
        return $newproducts;
    }

    public static function discountedProducts()
    {
        // Lấy các sản phẩm có giá bán nhỏ hơn giá cũ (discounted products)
        $discountproducts = Product::whereColumn('unit_price', '<', 'old_unit_price')->where('enable', 1)->limit(5)->get();
        return $discountproducts;
    }

    public static function product_groups()
    {
        // Lấy tất cả các nhóm sản phẩm
        $groups = ProductGroup::all()->where('enable', 1);
        return $groups;
    }
    public static function role()
    {
        $roleall = Role::all();
        return $roleall;
    }
}
