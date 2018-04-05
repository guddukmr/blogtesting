{{Session::get('name')}}


@if(Session::has('cart'))
    @foreach(Session::get('cart') as $item)
        {{$item['id']}}
        {{$item['name']}}
        {{$item['quantity']}}
    @endforeach
@endif