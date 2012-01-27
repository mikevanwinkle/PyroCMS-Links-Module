<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Blogroll Link Groups Model
 *
 * @package		Blogroll
 * @author		mikevanwinkle
 * @copyright	Copyright (c) 2012, Parse19
 * @license		http://www.mikevanwinkle.com/pyrocms/modules/blogroll/license
 * @link		http://www.mikevanwinkle.com/pyrocms/modules/blogroll
 */

class Links_Groups_m extends MY_Model {
	
	function __construct() {
		parent::__construct();
	}
	
	function get_option_list() {
		$this->db->select('id, name');
		$this->db->order_by('name','asc');
		$result = $this->db->get('links_groups');
		$groups = array(); 
		$groups[0] = '--none--';
		foreach($result->result_array() as $group) {
			$groups[$group['id']] = $group['name'];
		}
		return $groups;
	}
	
	function get_name($id) {
		$groups = $this->pyrocache->model('links_groups_m','get_option_list','',60 * 60 *7);
		return $groups[$id];
	}
	
	function get_all() {
		$groups = parent::get_all(); 
		for($i = 0; $i < count($groups); $i++) 
		{
			$groups[$i]->count = $this->pyrocache->model('links_groups_m','get_count',$groups[$i]->id,60 * 60 *5); 
		}
		return $groups;
	}
	
	function get_count($group_id) {
		$this->db->select("COUNT(*) as count");
		$result = $this->db->get_where('links',array('link_group' => $group_id));
		$result = $result->result();	
		return $result[0]->count;
	}
	
}