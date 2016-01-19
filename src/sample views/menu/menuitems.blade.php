@if(isset($menuitems) && count($menuitems))
	<ul>
		@foreach($menuitems as $menuitem)
			@include('menu.menuitem', ['menuitem', $menuitem])
		@endforeach
	</ul>	
@endif