<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EventRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Auth;

/**
 * Class EventCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class EventCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Event::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/event');
        CRUD::setEntityNameStrings('event', 'events');
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
            // 'attribute' => 'name', // foreign key attribute that is shown to user
            // 'model'     => App\Models\Category::class, // foreign key model
        ],);
        CRUD::column('name');
        $this->crud->addColumn([
            'name'  => 'date', // The db column name
            'label' => 'Date', // Table column heading
            'type'  => 'date',
            'format' => 'DD/MM/YYYY', // use something else than the base.default_date_format config value
        ]);
        CRUD::column('current_cappacity');
        CRUD::column('capacity');
        CRUD::column('location');
        CRUD::column('description');
        $this->crud->addColumn([
            'name'  => 'movie',
            'type' => 'relationship',
            'label' => 'Movie',
            'attribute' => 'title',
        ]);
        CRUD::column('created_at');
        CRUD::column('updated_at');

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
        CRUD::setValidation(EventRequest::class);
        $this->crud->addField([
            'name' => 'user_id',
            'type' => 'hidden',
            'value' => Auth::guard('web')->user()->id,
        ]);
        CRUD::field('name');
        CRUD::field('date');
        CRUD::field('capacity');
        $this->crud->addField([   // Hidden
            'name'  => 'current_cappacity',
            'type'  => 'hidden',
            'value' => 1,
        ]);
        CRUD::field('location');
        CRUD::field('description');
        CRUD::field('movie_id');

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

    protected function setupShowOperation()
    {
        $this->crud->addColumn([
            // any type of relationship
            'name'         => 'user', // name of relationship method in the model
            'type'         => 'relationship',
            'label'        => 'User', // Table column heading
            // OPTIONAL
            // 'entity'    => 'tags', // the method that defines the relationship in your Model
            // 'attribute' => 'name', // foreign key attribute that is shown to user
            // 'model'     => App\Models\Category::class, // foreign key model
        ],);
        CRUD::column('name');
        $this->crud->addColumn([
            'name'  => 'date', // The db column name
            'label' => 'Date', // Table column heading
            'type'  => 'date',
            'format' => 'DD/MM/YYYY', // use something else than the base.default_date_format config value
        ]);
        CRUD::column('current_cappacity');
        CRUD::column('capacity');
        CRUD::column('location');
        CRUD::column('description');
        $this->crud->addColumn([
            'name'  => 'movie',
            'type' => 'relationship',
            'label' => 'Movie',
            'attribute' => 'title',
        ]);
        CRUD::column('created_at');
        CRUD::column('updated_at');
    }
}
