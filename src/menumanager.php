<?php

namespace morningtrain\menumanager;

use Illuminate\Support\Facades\Facade;

class menumanager extends Facade {

    protected static function getFacadeAccessor() 
	{ 
		return 'menumanager';
	}

	public static $menuStore = array();
	
	public static function addMenuItem($context, $item)
	{
		if(!isset(self::$menuStore[$context]))
		{
			self::$menuStore[$context] = array();
		}
		self::$menuStore[$context][] = $item;
		
	}
	
	public static function getMenu($context)
	{
		if(isset(self::$menuStore[$context]))
		{
			return self::$menuStore[$context];
		}
		return array();
	}
	
	public static function generateMenu($context)
	{
		$menu = self::getMenu($context);
		$output = '';
		$output .= '<div id="menuh-container" >';
		$output .= '<div id="menuh" >';
		if(!empty($menu))
		{
			$output .= self::generateMenuItems($menu);
		}
		$output .= '</div>';
		$output .= '</div>';
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