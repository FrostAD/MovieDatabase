<ol id="all-events-list" class="list-group">
    @csrf
    @foreach ($events as $event)
        @if(!$event->movie == null)
        <li class="list-group-item">
            <a href='/event/{{$event->id}}' class="float-left">
                <img src="{{asset('storage/' . App\Models\Movie::find($event->movie_id)->poster)}}">
            </a>
            <span class="font-weight-bold ml-2 w-100">{{$event->name}}</span>
            <span class="ml-2">{{$event->current_cappacity}}/{{$event->capacity}}
            </span>
            <p class="small mt-3 p-3" style="margin-left: 150px; background-color: #efefef; border-radius: 3px;">{{\Illuminate\Support\Str::words($event->description,80,' ...')}}
            <a href='{{asset('/event/'.$event->id)}}' style="color: red;" ><br>Continue Reading <span>&#187;</span></a>
            </p>
        </li>
        @endif
    @endforeach
</ol>
{!! $events->links() !!}
