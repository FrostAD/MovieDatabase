<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use willvincent\Rateable\Rating;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;


    public function __construct()
    {
        $this->middleware(['role:Admin']);
    }
    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\User::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/user');
        CRUD::setEntityNameStrings('user', 'users');
        dd($this->request()->input()->all());
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
        CRUD::column('email');
        CRUD::column('email_verified_at');
        CRUD::column('password');
        CRUD::column('remember_token');
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
        CRUD::setValidation(UserRequest::class);

        CRUD::field('name');
        CRUD::field('email');
        CRUD::field('email_verified_at');
        CRUD::field('password');
        CRUD::field('remember_token');

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

    public function delete($id){
        //rating
//        $ratings = Rating::where('user_id',$id)->get();
//        dd($ratings);
        //
        $user = User::find($id);
        //movies-done
        $user->movies()->delete();
        //
        //comments-done
        //events
        $user->events_author()->delete();
        //
        $user->delete();
        return redirect()->back();
    }
    public function restore($id){
        $user = User::withTrashed()->find($id);
        $user->restore();
        $user->movies()->restore();
        $user->events_author()->restore();
        return redirect()->back();
    }

    public function hard_delete($id){
        $user = User::withTrashed()->find($id);
        $user->forceDelete();
        return redirect()->back();
    }
}
