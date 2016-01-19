<div class="menu-container" >
	<div class="menu" >
		@if(isset($menuitems))
			@include('menu.menuitems', ['menuitems', $menuitems])		
		@endif
	</div>
</div>