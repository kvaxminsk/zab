<?php

use SleepingOwl\Admin\Model\ModelConfiguration;
use App\Models\AdvertModel;

AdminSection::registerModel(AdvertModel::class, function (ModelConfiguration $model) {
    $model->setTitle('Advert');
    $model->onDisplay(function () {
        return AdminDisplay::table()
            ->with('user')
            ->with('category')
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns([
                AdminColumn::text('id')->setLabel('ID'),
                AdminColumn::text('title')->setLabel('Title'),
                AdminColumn::text('user.name')->setLabel('User'),
                AdminColumn::text('category.name')->setLabel('Category'),
                AdminColumn::text('status')->setLabel('Status'),

            ])
            ->paginate(20);
    });
    $model->onEdit(function($id = null) {
        $form = AdminForm::panel()->addHeader(
            AdminFormElement::text('status', 'Status')->required(),
            AdminFormElement::text('description', 'Description')->setDefaultValue('')->addValidationRule('max:255'),
            AdminFormElement::select('category_id', 'Category')
                ->setModelForOptions(new \App\Models\CategoryModel())
                ->setDisplay('name')
        );
        return $form;
    });
});
