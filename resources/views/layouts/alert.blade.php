@foreach (['danger', 'info', 'success', 'warning'] as $item)
    @if (session()->has($item))
        <div class="alert alert-{{$item}} col-sm-10 col-sm-offset-1 text-center">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong class="text-center">{{ session($item) }}</strong>
        </div>
    @endif
@endforeach