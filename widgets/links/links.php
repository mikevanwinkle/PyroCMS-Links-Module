<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package 		Links
 * @subpackage 		Links/Blogroll Widget
 * @author			Mike
 *
 * Show a list of links
 */

class Widget_Links extends Widgets
{
	public $title		= array(
		'en' => 'Links'
	);
	public $description	= array(
		'en' => 'Show a list links',
	);
	public $author		= 'Mike Van Winkle';
	public $website		= 'http://www.mikevanwinkle.com/';
	public $version		= '1.0';
	
	public $fields = array(
		array(
			'field' => 'groups',
			'label' => 'Links group',
		)
	);
	
	public function form()
	{
		$this->load->model('links/links_groups_m');

		$groups = array();
		foreach($this->links_groups_m->get_option_list() as $k => $v)
		{
			$groups[$k] = $v;
		}

		return array('groups' => $groups);
	}
	
	public function run($options)
	{
		$this->load->model('links/links_m');
		
		$links = $this->pyrocache->model('links_m','get_alpha',$options['groups']);
		
		return array('links' => $links);
	}	
}