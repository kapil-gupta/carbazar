<?php $breadcrumbs = $page->getBody()->getBreadcrumbs(); ?>
@if ($breadcrumbs)
<ul class="page-breadcrumb breadcrumb">
    @foreach ($breadcrumbs as $key => $value)
    
    <li>
        @if($value['url'])
            <a href="{{$value['url'] }}">
        @endif
        {{$value['title']}}
        @if($value['url'])
            </a>	
        @endif
        @if($key != (count($breadcrumbs)-1))
        <i class="fa fa-circle"></i>
        @endif
    </li>
    @endforeach
    @yield('breadcrumb-content')
</ul>
@endif