<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
        @if(isset($breadcrumbs))
            <ul class="breadcrumb">
                @foreach($breadcrumbs as $item)
                    <li><a href="{{route('home')}}/{{$item['slug']}}">{!! $item['name'] !!}</a></li>
                @endforeach
            </ul>
        @endif
    </div>
</div>