<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 15.08.2017
 * Time: 16:56
 */
AdminSection::registerModel(\App\Models\User::class, function (\SleepingOwl\Admin\Model\ModelConfiguration $model) {
    $model->setTitle('Users');
    $model->onDisplay(function () {
        return AdminDisplay::datatables()
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns([
                AdminColumn::text('id')->setLabel('ID'),
                AdminColumn::email('email')->setLabel('Email'),
                AdminColumn::text('phone')->setLabel('Phone'),
            ])
            ->paginate(10);
    });
});

