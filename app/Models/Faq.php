<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory,Filterable;
    protected $fillable=[
        'question',
        'answer',
        'content',
        'category_id',
    ];

    public function category(){
        
        return $this->belongsTo(Category::class,'category_id');
    }

}
