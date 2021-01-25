<ol id="all-festivals-list" class="list-group">
    @csrf
    @foreach ($festivals as $festival)
        <li class="list-group-item">
            <a href='/festival/{{$festival->id}}' class="float-left">
                <img src="{{asset('storage/' . $festival->image)}}">
            </a>
            <span class="font-weight-bold ml-2 w-100">{{$festival->name}}</span>
            <span class="ml-2">{{$festival->founded}}
            </span>
            <p class="small mt-3 p-3" style="margin-left: 150px; background-color: #efefef; border-radius: 3px;">{{\Illuminate\Support\Str::words($festival->description,80,' ...')}}<a href='{{asset('/festival/'.$festival->id)}}' style="color: red;" ><br>Continue Reading <span>&#187;</span></a>
            </p>
        </li>
    @endforeach
</ol>
{!! $festivals->links() !!}
