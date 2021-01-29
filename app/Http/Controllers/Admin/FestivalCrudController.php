<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FestivalRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Auth;

/**
 * Class FestivalCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class FestivalCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Festival::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/festival');
        CRUD::setEntityNameStrings('festival', 'festivals');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addColumn([
            // any type of relationship
            'name'         => 'user', // name of relationship method in the model
            'type'         => 'relationship',
            'label'        => 'User', // Table column heading
            // OPTIONAL
            // 'entity'    => 'tags', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            // 'model'     => App\Models\Category::class, // foreign key model
        ],);
        CRUD::column('name');
        $this->crud->addColumn([
            'name'  => 'date', // The db column name
            'label' => 'Date', // Table column heading
            'type'  => 'date',
            'format' => 'DD/MM', // use something else than the base.default_date_format config value
        ]);
        CRUD::column('founded');

        CRUD::column('location');
        CRUD::column('description');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(FestivalRequest::class);

        $this->crud->addField([
            'name' => 'user_id',
            'type' => 'hidden',
            'value' => Auth::guard('web')->user()->id,
        ]);
        CRUD::field('name');
        CRUD::field('founded');

        $this->crud->addField([   // date_range
            'name'  => ['date', 'date_end'], // db columns for start_date & end_date
            'label' => 'Event Date Range',
            'type'  => 'date_range',

            // OPTIONALS
            // default values for start_date & end_date
            'default'            => ['2019-03-28 01:01', '2019-04-05 02:00'],
            // options sent to daterangepicker.js
            'date_range_options' => [
                'timePicker' => false,
                'locale' => ['format' => 'DD/MM/YYYY HH:mm']
            ]
        ],);
        CRUD::field('location');
        CRUD::field('description');
        $this->crud->addField([   // Upload
            'name'      => 'image',
            'label'     => 'Upload image',
            'type'      => 'upload',
            'upload'    => true,
            'disk'      => 'uploads',
            // 'default' => '0',
            // if you store files in the /public folder, please omit this; if you store them in /storage or S3, please specify it;
            // optional:
            // 'temporary' => 10 // if using a service, such as S3, that requires you to make temporary URLs this will make a URL that is valid for the number of minutes specified
        ]);
        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
