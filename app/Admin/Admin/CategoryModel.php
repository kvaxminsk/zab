<?php

use SleepingOwl\Admin\Model\ModelConfiguration;
use App\Models\CategoryModel;

AdminSection::registerModel(CategoryModel::class, function (ModelConfiguration $model) {
    $model->setTitle('Category');
    $model->onDisplay(function () {
        return AdminDisplay::table()
            ->with('parents')
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns([
                AdminColumn::text('id')->setLabel('ID'),
                AdminColumn::text('name')->setLabel('Name'),
                AdminColumn::text('description')->setLabel('Description'),
                AdminColumn::text('parents.name')->setLabel('Parent Category Name')
            ])
            ->paginate(20);
    });
    $model->onCreateAndEdit(function($id = null) {
        $form = AdminForm::panel()->addHeader(
            AdminFormElement::text('name', 'Name')->setDefaultValue('')->required(),
            AdminFormElement::text('description', 'Description')->setDefaultValue('')->addValidationRule('max:255'),
            AdminFormElement::select('parent_id', 'Parent Category')
                ->setModelForOptions(new \App\Models\CategoryModel())
                ->setDisplay('name')
        );
        return $form;
    });
});
