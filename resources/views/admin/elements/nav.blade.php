<?php $nav = $page->getBody()->getDataByKey('nav'); ?>
@if($nav)
	<ul class="nav nav-tabs">
	@foreach($nav as $n)
		<li{{ ($page->getActivePage() === $n['key']) ? ' class="active"' : '' }}><a href="{{($page->getActivePage() != $n['key']) ? URL::to($n['url']) : '#'}}">{{$n['name']}}</a></li>
	@endforeach
	</ul>
@endif