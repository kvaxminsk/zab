<?php

use App\Models\AdvertModel;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(AdvertModel::class, function (ModelConfiguration $model) {
    $model->setTitle('Advert');
    $model->onDisplay(function () {
        return AdminDisplay::table()
            ->with('user')
            ->with('category')
            ->with('status')
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns([
                AdminColumn::text('id')->setLabel('ID'),
                AdminColumn::text('title')->setLabel('Title'),
                AdminColumn::text('user.name')->setLabel('User'),
                AdminColumn::text('category.name')->setLabel('Category'),
                AdminColumn::text('status.title')->setLabel('Status'),

            ])
            ->paginate(20);
    });
    $model->onEdit(function ($id = null) {
        $form = AdminForm::panel()->addHeader(
            AdminFormElement::select('adverts_status_id', 'Status')
                ->setModelForOptions(new \App\Models\AdvertsStatusModel())
                ->setDisplay('title'),
            AdminFormElement::text('description', 'Description')->setDefaultValue(''),
            AdminFormElement::text('title', 'Description')->setDefaultValue('')->addValidationRule('max:500'),
            AdminFormElement::select('category_id', 'Category')
                ->setModelForOptions(new \App\Models\CategoryModel())
                ->setDisplay('name')
        );
        return $form;
    });
    $model->deleted(function($callback,  $cur_model) {
//        $cur_model->name= '111';
//        $cur_model->save();
        $cur_model->adverts_status_id = \App\Models\AdvertsStatusModel::getAdvertsStatusDeleted();
        $cur_model->save();
    });
});
