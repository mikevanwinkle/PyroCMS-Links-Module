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
		foreach($result->result_array() as $group) {
			$groups[$group['id']] = $group['name'];
		}
		$groups[0] = '--none--';
		return $groups;
	}
	
	function get_name($id) {
		$groups = $this->pyrocache->model('links_groups_m','get_option_list','',60 * 60 *7);
		return $groups[$id];
	}
	
}