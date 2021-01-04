<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ActorRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

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
        CRUD::column('name');
        // CRUD::column('born_date')->format('DD/MM/YYYY');
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
            'suffix' => ' movies', // to show "123 tags" instead of "123 items"
        ]);
        //TODO display image
        // $this->crud->addColumn([
        //     'name'      => 'image', // The db column name
        //     'label'     => 'Actor Image', // Table column heading
        //     'type'      => 'image',
        //     // 'prefix' => 'public/',
        //     // image from a different disk (like s3 bucket)
        //     // 'disk'   => 'disk-name',
        //     // optional width/height if 25px is not ok with you
        //     'height' => '30px',
        //     'width'  => '30px',
        // ]);
        // CRUD::column('image');
        // CRUD::column('created_at');
        // CRUD::column('updated_at');
        //TODO archived visible only to admin not uploader NO
        CRUD::column('archived');

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
//            'disk'      => 'uploads', // if you store files in the /public folder, please omit this; if you store them in /storage or S3, please specify it;
            // optional:
            // 'temporary' => 10 // if using a service, such as S3, that requires you to make temporary URLs this will make a URL that is valid for the number of minutes specified
        ]);

        // CRUD::field('image');
        // CRUD::field('archived');

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
        // by default the Show operation will try to show all columns in the db table,
        // but we can easily take over, and have full control of what columns are shown,
        // by changing this config for the Show operation
        $this->crud->set('show.setFromDb', false);

        CRUD::column('name');
        // CRUD::column('born_date')->format('DD/MM/YYYY');
        $this->crud->addColumn([
            'name'  => 'born_date', // The db column name
            'label' => 'Born date', // Table column heading
            'type'  => 'date',
            'format' => 'DD/MM/YYYY', // use something else than the base.default_date_format config value
        ]);
        CRUD::column('born_place');
        CRUD::column('description');
        //TODO display image
        // $this->crud->addColumn([
        //     'name'      => 'image', // The db column name
        //     'label'     => 'Actor Image', // Table column heading
        //     'type'      => 'image',
        //     // 'prefix' => 'public/',
        //     // image from a different disk (like s3 bucket)
        //     // 'disk'   => 'disk-name',
        //     // optional width/height if 25px is not ok with you
        //     'height' => '30px',
        //     'width'  => '30px',
        // ]);
        // CRUD::column('image');
        // CRUD::column('created_at');
        // CRUD::column('updated_at');
        //TODO archived visible only to admin not uploader
        // CRUD::column('archived');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }
}
