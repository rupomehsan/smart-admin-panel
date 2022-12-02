<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SmartFormValidation extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    protected $dates = ['deleted_at'];
    protected $casts = [
        "single_item" => "array",
        "multi_item" => "array",
        "multi_category_selector" => "array",
        "chips" => "array",
        "multi_chips_select" => "array",
        "days" => "array",
    ];
}