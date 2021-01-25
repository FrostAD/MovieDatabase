
@if ($crud->hasAccess('update'))
    <a href="{{ url($crud->route.'/'.$entry->getKey().'/restore') }} " class="btn btn-sm btn-link"><i class="la la-fast-backward
"></i> Restore</a>
@endif
