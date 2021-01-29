<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ActorRequest;
use App\Models\Actor;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Request;

/**
 * Class ActorCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ActorCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Actor::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/actor');
        CRUD::setEntityNameStrings('actor', 'actors');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addFilter([
            'type'  => 'simple',
            'name'  => 'trashed',
            'label' => 'Trashed'
        ],
            false,
            function($values) { // if the filter is active
                $this->crud->query = $this->crud->query->onlyTrashed();
                $this->crud->removeButton('delete');

                $this->crud->addButtonFromView('line', 'restore', 'restore', 'end');
                $this->crud->addButtonFromView('line', 'hard_delete', 'hard_delete', 'end');

            });

        CRUD::column('name');
        $this->crud->addColumn([
            'name'  => 'born_date', // The db column name
            'label' => 'Born date', // Table column heading
            'type'  => 'date',
            'format' => 'DD/MM/YYYY', // use something else than the base.default_date_format config value
        ]);
        CRUD::column('born_place');
        CRUD::column('description');
        $this->crud->addColumn([
            // relationship count
            'name'      => 'movies', // name of relationship method in the model
            'type'      => 'relationship_count',
            'label'     => 'Movies', // Table column heading
            // OPTIONAL
            'suffix' => ' movies', // to show "123 movies" instead of "123 items"
        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ActorRequest::class);

        CRUD::field('name');
        CRUD::field('born_date');
        CRUD::field('born_place');

        CRUD::field('description');
        $this->crud->addField([   // Upload
            'name'      => 'image',
            'label'     => 'Upload image',
            'type'      => 'upload',
            'upload'    => true,
        ]);
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
        // by default the Show operation will try to show all columns in the db table,
        // but we can easily take over, and have full control of what columns are shown,
        // by changing this config for the Show operation
        $this->crud->set('show.setFromDb', false);

        CRUD::column('name');
        $this->crud->addColumn([
            'name'  => 'born_date', // The db column name
            'label' => 'Born date', // Table column heading
            'type'  => 'date',
            'format' => 'DD/MM/YYYY', // use something else than the base.default_date_format config value
        ]);
        CRUD::column('born_place');
        CRUD::column('description');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    public function restore($id){
        $actor = Actor::withTrashed()->find($id);
        $actor->restore();
        return redirect()->back();
    }

    public function hard_delete($id){
        $actor = Actor::withTrashed()->find($id);
        $actor->forceDelete();
        return redirect()->back();
    }
}
