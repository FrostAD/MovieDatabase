<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MovieRequest;
use App\Models\Movie;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Auth;
use Illuminate\Support\Facades\DB;


/**
 * Class MovieCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class MovieCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {
        store as traitStore;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation{
        update as traitUpdate;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Movie::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/movie');
        CRUD::setEntityNameStrings('movie', 'movies');
    }
    public function store(MovieRequest $request)
    {
        $rating = MovieCrudController::findByTitle_imbd($request->request->all()['title']);

        $this->crud->getRequest()->request->remove('rating_imbd');
        $this->crud->getRequest()->request->add(['rating_imbd' => $rating]);

        $response = $this->traitStore();

        return $response;
    }
    public function update(MovieRequest $request)
    {
        // do something before validation, before save, before everything; for example:
        // $this->crud->addField(['type' => 'hidden', 'name' => 'author_id']);
        // $this->crud->removeField('password_confirmation');

        // Note: By default Backpack ONLY saves the inputs that were added on page using Backpack fields.
        // This is done by stripping the request of all inputs that do NOT match Backpack fields for this
        // particular operation. This is an added security layer, to protect your database from malicious
        // users who could theoretically add inputs using DeveloperTools or JavaScript. If you're not properly
        // using $guarded or $fillable on your model, malicious inputs could get you into trouble.

        // However, if you know you have proper $guarded or $fillable on your model, and you want to manipulate
        // the request directly to add or remove request parameters, you can also do that.
        // We have a config value you can set, either inside your operation in `config/backpack/crud.php` if
        // you want it to apply to all CRUDs, or inside a particular CrudController:
        // $this->crud->setOperationSetting('saveAllInputsExcept', ['_token', '_method', 'http_referrer', 'current_tab', 'save_action']);
        // The above will make Backpack store all inputs EXCEPT for the ones it uses for various features.
        // So you can manipulate the request and add any request variable you'd like.
        // $this->crud->getRequest()->request->add(['author_id'=> backpack_user()->id]);
        // $this->crud->getRequest()->request->remove('password_confirmation');
        // $this->crud->getRequest()->request->add(['author_id'=> backpack_user()->id]);
        // $this->crud->getRequest()->request->remove('password_confirmation');


        $rating = MovieCrudController::findByTitle_imbd($request->request->all()['title']);

        $this->crud->getRequest()->request->remove('rating_imbd');
        $this->crud->getRequest()->request->add(['rating_imbd' => $rating]);

        $response = $this->traitUpdate();
        // do something after save
        return $response;
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
        CRUD::column('title');
        CRUD::column('rating');
        CRUD::column('rating_imbd');
        $this->crud->addColumn([
            // any type of relationship
            'name'         => 'genres', // name of relationship method in the model
            'type'         => 'relationship',
            'label'        => 'Genres', // Table column heading
            // OPTIONAL
            // 'entity'    => 'tags', // the method that defines the relationship in your Model
            // 'attribute' => 'name', // foreign key attribute that is shown to user
            // 'model'     => App\Models\Category::class, // foreign key model
        ],);
        $this->crud->addColumn([
            // any type of relationship
            'name'         => 'actors', // name of relationship method in the model
            'type'         => 'relationship',
            'label'        => 'Actors', // Table column heading
            // OPTIONAL
            // 'entity'    => 'tags', // the method that defines the relationship in your Model
            // 'attribute' => 'name', // foreign key attribute that is shown to user
            // 'model'     => App\Models\Category::class, // foreign key model
        ],);
        $this->crud->addColumn([
            // any type of relationship
            'name'         => 'producers', // name of relationship method in the model
            'type'         => 'relationship',
            'label'        => 'Producers', // Table column heading
            // OPTIONAL
            // 'entity'    => 'tags', // the method that defines the relationship in your Model
            // 'attribute' => 'name', // foreign key attribute that is shown to user
            // 'model'     => App\Models\Category::class, // foreign key model
        ],);
        $this->crud->addColumn([
            // any type of relationship
            'name'         => 'musicians', // name of relationship method in the model
            'type'         => 'relationship',
            'label'        => 'Musicians', // Table column heading
            // OPTIONAL
            // 'entity'    => 'tags', // the method that defines the relationship in your Model
            // 'attribute' => 'name', // foreign key attribute that is shown to user
            // 'model'     => App\Models\Category::class, // foreign key model
        ],);
        $this->crud->addColumn([
            // any type of relationship
            'name'         => 'studios', // name of relationship method in the model
            'type'         => 'relationship',
            'label'        => 'Studios', // Table column heading
            // OPTIONAL
            // 'entity'    => 'tags', // the method that defines the relationship in your Model
            // 'attribute' => 'name', // foreign key attribute that is shown to user
            // 'model'     => App\Models\Category::class, // foreign key model
        ],);
        $this->crud->addColumn([
            // any type of relationship
            'name'         => 'screenwritters', // name of relationship method in the model
            'type'         => 'relationship',
            'label'        => 'Screenwritters', // Table column heading
            // OPTIONAL
            // 'entity'    => 'tags', // the method that defines the relationship in your Model
            // 'attribute' => 'name', // foreign key attribute that is shown to user
            // 'model'     => App\Models\Category::class, // foreign key model
        ],);
        CRUD::column('timespan');
        CRUD::column('description');
        CRUD::column('poster');
        CRUD::column('country_produced');
        CRUD::column('trailer');

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
        CRUD::setValidation(MovieRequest::class);

        $this->crud->addField([
            'name' => 'user_id',
            'type' => 'hidden',
            'value' => Auth::guard('web')->user()->id,
        ]);
        CRUD::field('title');
        CRUD::field('published');
        $this->crud->addField([   // Hidden
            'name'  => 'rating',
            'type'  => 'hidden',
            'value' => 0,
        ]);
        $this->crud->addField([   // Hidden
            'name'  => 'rating_imbd',
            'type'  => 'hidden',
            'value' => 0,
        ]);
        $this->crud->addField([    // Select2Multiple = n-n relationship (with pivot table)
            'label'     => "Genres",
            'type'      => 'select2_multiple',
            'name'      => 'genres', // the method that defines the relationship in your Model

            // optional
            // 'entity'    => 'genres', // the method that defines the relationship in your Model
            'model'     => "App\Models\Genre", // foreign key model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
            // 'select_all' => true, // show Select All and Clear buttons?

            // optional
            // 'options'   => (function ($query) {
            //     return $query->orderBy('name', 'ASC')->where('archived', 0)->get();
            // }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
        ],);
        $this->crud->addField([    // Select2Multiple = n-n relationship (with pivot table)
            'label'     => "Actors",
            'type'      => 'select2_multiple',
            'name'      => 'actors', // the method that defines the relationship in your Model

            // optional
            // 'entity'    => 'genres', // the method that defines the relationship in your Model
            'model'     => "App\Models\Actor", // foreign key model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
            // 'select_all' => true, // show Select All and Clear buttons?

            // optional
            // 'options'   => (function ($query) {
            //     return $query->orderBy('name', 'ASC')->where('archived', 0)->get();
            // }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
        ],);
        $this->crud->addField([    // Select2Multiple = n-n relationship (with pivot table)
            'label'     => "Producers",
            'type'      => 'select2_multiple',
            'name'      => 'producers', // the method that defines the relationship in your Model

            // optional
            // 'entity'    => 'genres', // the method that defines the relationship in your Model
            'model'     => "App\Models\Producer", // foreign key model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
            // 'select_all' => true, // show Select All and Clear buttons?

            // optional
            // 'options'   => (function ($query) {
            //     return $query->orderBy('name', 'ASC')->where('archived', 0)->get();
            // }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
        ],);
        $this->crud->addField([    // Select2Multiple = n-n relationship (with pivot table)
            'label'     => "Musicians",
            'type'      => 'select2_multiple',
            'name'      => 'musicians', // the method that defines the relationship in your Model

            // optional
            // 'entity'    => 'genres', // the method that defines the relationship in your Model
            'model'     => "App\Models\Musician", // foreign key model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
            // 'select_all' => true, // show Select All and Clear buttons?

            // optional
            // 'options'   => (function ($query) {
            //     return $query->orderBy('name', 'ASC')->where('archived', 0)->get();
            // }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
        ],);
        $this->crud->addField([    // Select2Multiple = n-n relationship (with pivot table)
            'label'     => "Studio",
            'type'      => 'select2_multiple',
            'name'      => 'studios', // the method that defines the relationship in your Model

            // optional
            // 'entity'    => 'genres', // the method that defines the relationship in your Model
            'model'     => "App\Models\Studio", // foreign key model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
            // 'select_all' => true, // show Select All and Clear buttons?

            // optional
            // 'options'   => (function ($query) {
            //     return $query->orderBy('name', 'ASC')->where('archived', 0)->get();
            // }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
        ],);
        $this->crud->addField([    // Select2Multiple = n-n relationship (with pivot table)
            'label'     => "Screenwritters",
            'type'      => 'select2_multiple',
            'name'      => 'screenwritters', // the method that defines the relationship in your Model

            // optional
            // 'entity'    => 'genres', // the method that defines the relationship in your Model
            'model'     => "App\Models\Screenwritter", // foreign key model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
            // 'select_all' => true, // show Select All and Clear buttons?

            // optional
            // 'options'   => (function ($query) {
            //     return $query->orderBy('name', 'ASC')->where('archived', 0)->get();
            // }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
        ],);
        CRUD::field('timespan');
        CRUD::field('description');
        $this->crud->addField([   // Upload
            'name'      => 'poster',
            'label'     => 'Image',
            'type'      => 'upload',
            'upload'    => true,
//            'disk'      => 'uploads', // if you store files in the /public folder, please omit this; if you store them in /storage or S3, please specify it;
            // optional:
            // 'temporary' => 10 // if using a service, such as S3, that requires you to make temporary URLs this will make a URL that is valid for the number of minutes specified
        ],);
        CRUD::field('country_produced');
        CRUD::field('trailer');

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

    public static function findByTitle_imbd($title)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://imdb-internet-movie-database-unofficial.p.rapidapi.com/film/" . rawurlencode($title),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: imdb-internet-movie-database-unofficial.p.rapidapi.com",
                "x-rapidapi-key: e1e35729f3msh632c29a6ed8fce5p120306jsn15147069dd8b"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {

            $res = explode(",", $response);
//            $cast = $res[8]; // get actors and their role
            $res = explode(":", $res[4]);
            $value = str_replace('"', "", $res[1]);

            if ($value == '')
                $value = 0;
            return $value;
        }
    }

    public function restore($id){
        $movie = Movie::withTrashed()->find($id);
        $movie->restore();
        return redirect()->back();
    }

    public function hard_delete($id){
        $movie = Movie::withTrashed()->find($id);
        $movie->forceDelete();
        return redirect()->back();
    }
}
