@extends(theme_view('layout'))

@section('title')
  Archives
@stop

@section('content')
  <section>
    <h2 class="title">Example of All Tags</h2>

    @foreach (Lazychef::posts() as $item)
      {{ $item['title']}}
    @endforeach

    @foreach (Lazychef::tags() as $item)
      @if ($item['tag'] != "")
        <li><a href="{{ lazychef_url('/tag/'.$item['tag']) }}">{{ $item['tag'] }}</a></li>
      @endif
    @endforeach

  </section>
@stop
