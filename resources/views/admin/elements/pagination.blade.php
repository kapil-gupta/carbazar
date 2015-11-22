<?php 
	$paginator = $page->getBody()->getDataByKey('list');
	$queryStrParameters = \Input::all();
	if (array_key_exists('page', $queryStrParameters))
		unset($queryStrParameters['page']);
	
	foreach ($queryStrParameters as $key=>$value)
		$paginator->appends($key, $value);
	
	$presenter = new Illuminate\Pagination\BootstrapPresenter($paginator);
?>
@if ($paginator->count())
<div class="row-fluid">
	<div class="span6"><div class="dataTables_info" id="sample_1_info">Showing {{$paginator->getFrom()}} to {{$paginator->getTo()}} of {{$paginator->getTotal()}} entries</div></div>
	<div class="span6">
		<div class="dataTables_paginate paging_bootstrap pagination">
			<ul>
				<?php echo $presenter->render(); ?>
			</ul>
		</div>
	</div>
</div>
@endif