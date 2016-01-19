<?php

namespace morningtrain\menumanager;

use Illuminate\Support\Facades\Facade;

class menumanager extends Facade {

    protected static function getFacadeAccessor() 
	{ 
		return 'menumanager';
	}

	public static $menuStore = array();
	
	public static function addItem($context, $item)
	{
		if(!isset(self::$menuStore[$context]))
		{
			self::$menuStore[$context] = array();
		}
		$href = 'javascript:void()';
		if(isset($item['routealias'])) 
		{
			$href = \URL::route($item['routealias']);
		}
		else if(isset($item['url']))
		{
			$href = $item['url'];
		}
		$item['href'] = $href;
		if(!isset($item['class']))
		{
			$item['class'] = '';
		}
		$item['class'] .= (isset($item['children']) && is_array($item['children']) && !empty($item['children']))?' parent ':'';
		if(isset($item['as']))
		{
			if(!empty(self::$menuStore[$context]))
			{
				foreach(self::$menuStore[$context] as $key => $entry)
				{
					if(isset($entry['as']) && $item['as'] == $entry['as'])
					{
						$entry = array_merge($entry, $item);
						if(!isset($entry['children']))
						{
							$entry['children'] = array();
						}
						if(!isset($item['children']))
						{
							$item['children'] = array();
						}
						$entry['children'] = array_merge($item['children'], $entry['children']);
						self::$menuStore[$context][$key] = $entry;
						unset($item);
					}
				}
			}
		}
		if(isset($item))
		{
			self::$menuStore[$context][] = $item;
		}
	}
	
	public static function getMenuStructure($context)
	{
		if(isset(self::$menuStore[$context]))
		{
			return self::$menuStore[$context];
		}
		return array();
	}
	
	public static function get($context, $view = null)
	{
		$menu = self::getMenuStructure($context);
		$output = '';
		if($view != null)
		{
			$output = view($view)->with('menuitems', $menu)->render();
		}
		else
		{
			$output .= '<div id="menuh-container" >';
			$output .= '<div id="menuh" >';
			if(!empty($menu))
			{
				$output .= self::generateMenuItems($menu);
			}
			$output .= '</div>';
			$output .= '</div>';
		}
		return $output;
	}
	
	public static function generateMenuItems($menuItems)
	{
		$output = '';
		$output .= '<ul>';
		foreach($menuItems as $menuItem)
		{
			$output .= '<li>';
			if(( isset($menuItem['routealias']) || isset($menuItem['void'])  || isset($menuItem['url']) ) && isset($menuItem['title']))
			{
				$output .= '<a ';
				if(isset($menuItem['target'])) 
				{
					$output .= ' target="'.$menuItem['target'].'" ';
				}
                if(isset($menuItem['routealias'])) 
				{
					$output .= ' href="'.\URL::route($menuItem['routealias']).'" ';
				} 
				else if(isset($menuItem['void'])) 
				{
					$output .= ' href="javascript:void();" ';
				} 
				else if(isset($menuItem['url']))
				{
				    $output .= ' href="'.$menuItem['url'].'" ';
				}
				if(isset($menuItem['children']) && is_array($menuItem['children']) && !empty($menuItem['children']))
				{
					$output .= ' class="parent" ';
				}
				$output .= ' >';
				$output .= $menuItem['title'];
				$output .= '</a>';
			}
			if(isset($menuItem['children']) && is_array($menuItem['children']) && !empty($menuItem['children']))
			{
				$output .= self::generateMenuItems($menuItem['children']);
			}	
			$output .= '</li>';
		}
		$output .= '</ul>';
		return $output;
	}
	
}