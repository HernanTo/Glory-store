<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'barcode',
        'num_repuesto',
        'name',
        'price',
        'slug',
        'cost',
        'description',
        'stock',
        'min_stock',
        'available',
        'is_active'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true,
            ]
        ];
    }

    public function images(){
        return $this->hasMany('App\Models\ImageProduct');
    }

    public function categories(){
        return $this->belongsToMany('App\Models\Category', 'product_has_categories');
    }
    public function bills(){
        return $this->belongsToMany('App\Models\Bill', 'bills_has_products', 'id_product', 'id_bill')
            ->withPivot('price', 'stock', 'discount', 'total_prices');
    }

    public function budgets(){
        return $this->belongsToMany('App\Models\Budget', 'budgets_has_products', 'id_product', 'id_budget')
            ->withPivot('price', 'stock', 'discount', 'total_prices');
    }

    public function shoppingCarts(){
        return $this->belongsToMany('App\Models\ShoppingCart', 'shopping_carts_has_products', 'id_product', 'id_cart')
            ->withPivot('price', 'stock', 'total_prices');
    }

    public function getImagesMainAttribute(){
        if(($this->images->first() == null)){
            return 'default.png';
        }else{
            return $this->images->first()->photo;
        }
    }
    public function getNameForAttribute(){
        if(strlen($this->name) >= 40){
            return substr($this->name, 0, 40) . '...';
        }else{
            return $this->name;
        }
    }
    public function getPriceDiscountAttribute(){
        if($this->pivot->discount == 0){
            return 0;
        }else{
            return ($this->pivot->price * ($this->pivot->discount / 100));
        }
    }

}
