@if ($breadcrumbs)
    {{-- <ul class="breadcrumb"> --}}
    <div class="breadcrumbs">
    	@foreach ($breadcrumbs as $breadcrumb)

            @if (!$breadcrumb->last)
                <li>
                	<a href="{{ $breadcrumb->url }}">
                		@if($breadcrumb->title == 'Trang chủ')
                			<i class="fa fa-home" aria-hidden="true"></i>
                		@endif
                		{{ $breadcrumb->title }}
                	</a>
                </li> /
            @else
                <li class="active">
					@if($breadcrumb->title == 'Trang chủ')
                		<i class="fa fa-home" aria-hidden="true"></i>
                	@endif
                	{{ $breadcrumb->title }}
                </li>
            @endif
        @endforeach
    </div>
    {{-- </ul> --}}
@endif