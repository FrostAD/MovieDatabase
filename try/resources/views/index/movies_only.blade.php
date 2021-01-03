<ol id="all-movies-list" class="list-group">
    @csrf
    @foreach ($movies as $movie)
        @if($loop->index ==0 || $loop->index == 3)
            <div class="row">
            @endif
            <!-- One Movie -->
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="image-flip">
                        <div class="mainflip flip-0">
                            <div class="frontside">
                                <div class="card">
                                    <div class="card-body d-flex flex-column align-items-center">
                                        <h4 class="card-title">{{$movie->title . '(' . $movie->published . ')'}}</h4>
                                        <img src="{{asset('storage/' . $movie->poster)}}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="backside scrollbar-hidden">
                                <div class="card ">
                                    <div class="card-body text-center mt-4">
                                        <h4 class="card-title">{{$movie->title}} <a href="/movie/{{$movie->id}}"><i
                                                    class="fa fa-file"></i></a></h4>
                                        <p>{{$movie->description}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if($loop->index == 2 || $loop->index == 5)
            </div>
        @endif
    @endforeach
</ol>
{!! $movies->links() !!}
