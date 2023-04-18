<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shoe extends Model
{
    use HasFactory;

    protected $fillable = ["model", "type", "number", "color", "quantity", "image"];
    public function getAbstract($max = 40)
    {
        return substr($this->text, 0, $max) . "...";
    }

    public function getImageAttribute($value)
    {
        return $value ? asset('storage/' . $value) : 'https://t4.ftcdn.net/jpg/00/18/81/67/360_F_18816750_EhUEXmXzE3YMyegWLTBi68jtCCqjZl2e.jpg';
    }
}
