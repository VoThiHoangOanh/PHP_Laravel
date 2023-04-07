<?php

namespace App\View\Components;
use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CategoryList extends Component
{
    public function __construct()
    {
        //
    }
    public function render(): View|Closure|string
    {
        $list_category= Category::where([['parent_id','=',0],['status','=','1']])->get();
        return view('components.category-list',compact('list_category'));
    }
}
