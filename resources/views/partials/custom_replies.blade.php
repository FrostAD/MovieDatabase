@foreach($comments as $comment)
<div id="comment-{{$comment->id}}" class="d-flex flex-column comment-section">
    <div class="p-2">
      <div class="d-flex"><img src="./img/unknown-user.png" width="50">
        <div class="d-flex flex-column ml-2">
          <span class="d-block font-weight-bold name">{{ $comment->user->name }}</span>
        <span class="date text-black-50">Last modified: {{$comment->updated_at}}</span>
        </div>
      </div>
      <div class="mt-2">
        <p class="comment-text">{{ $comment->comment }}</p>
      </div>
    </div>
    </div>
  @endforeach
{!! $comments->links() !!}
