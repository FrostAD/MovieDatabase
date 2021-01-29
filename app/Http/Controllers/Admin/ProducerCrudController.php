<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProducerRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ProducerCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProducerCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Producer::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/producer');
        CRUD::setEntityNameStrings('producer', 'producers');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('name');
        $this->crud->addColumn([
            'name'  => 'born_date', // The db column name
            'label' => 'Born date', // Table column heading
            'type'  => 'date',
            'format' => 'DD/MM/YYYY', // use something else than the base.default_date_format config value
        ]);
        CRUD::column('born_place');
        CRUD::column('description');
        $this->crud->query->withCount('movies'); // this will add a tags_count column to the results
        $this->crud->addColumn([
            'name'      => 'movies_count', // name of relationship method in the model
            'type'      => 'text',
            'label'     => 'Participates in', // Table column heading
            'suffix'    => ' movies', // to show "123 tags" instead of "123"
        ]);
        $this->crud->addColumn([
            'name'  => 'archived',
            'label' => 'Status',
            'type'  => 'boolean',
            // optionally override the Yes/No texts
            'options' => [0 => 'Active', 1 => 'Inactive']
        ],);

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
        CRUD::setValidation(ProducerRequest::class);

        CRUD::field('name');
        CRUD::field('born_date');
        CRUD::field('born_place');
        CRUD::field('description');
        $this->crud->addField([   // Upload
            'name'      => 'image',
            'label'     => 'Upload image',
            'type'      => 'upload',
            'upload'    => true,
//            'disk'      => 'uploads', // if you store files in the /public folder, please omit this; if you store them in /storage or S3, please specify it;
            // optional:
            // 'temporary' => 10 // if using a service, such as S3, that requires you to make temporary URLs this will make a URL that is valid for the number of minutes specified
        ]);
        $this->crud->addField([
            'name' => 'archived',
            'type' => 'hidden',
            'value' => 0,
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
