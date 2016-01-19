@if(isset($menuitem) && is_array($menuitem))
	<li>
		@if(( isset($menuitem['routealias']) || isset($menuitem['void'])  || isset($menuitem['url']) ) && isset($menuitem['title']))
			<a href="{{ $menuitem['href'] or 'javascript:void(0);' }}" target="{{ $menuitem['target'] or '_self' }}" class="{{ $menuitem['class'] or '' }}" >{{ $menuitem['title'] or '' }}</a>
		@endif
		@if(isset($menuitem['children']) && is_array($menuitem['children']) && !empty($menuitem['children']))
			@include('menu.menuitems', ['menuitems' => $menuitem['children']])
		@endif
	</li>
@endif