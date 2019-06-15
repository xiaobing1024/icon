@foreach (['danger', 'info', 'success', 'warning'] as $item)
    @if (session()->has($item))
    <div class="row">
        <div class="col-12">
            <div class="alert alert-{{$item}} text-center">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong class="text-center">{{ session($item) }}</strong>
            </div>
        </div>
    </div>
    @endif
@endforeach