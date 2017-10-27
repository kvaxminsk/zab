<?php

namespace App\Composers;

use App\Models\CategoryModel;

class CategoryComposer
{
    protected $categories_menu;

    public function compose($view)
    {
        $view->with('categories_menu', CategoryModel::whereNotNull('parent_id')->get());
    }
}