<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqCategoryController extends Controller
{
    public function show(Category $category)
    {
        $faqs = Faq::where('category_id', $category->id)->get();
        return $this->retrieve([
            'category' => $category->load('image'),
            'faqs' => $faqs,
        ]);
    }
}
