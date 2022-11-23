<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmartFormValidation extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        "single_item" => "array",
        "multi_item" => "array",
        "multi_category_selector" => "array",
        "chips" => "array",
        "multi_chips_select" => "array",
        "days" => "array",
    ];
}
