<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Blogroll Model
 *
 * @package		Blogroll
 * @author		mikevanwinkle
 * @copyright	Copyright (c) 2012, Parse19
 * @license		http://www.mikevanwinkle.com/pyrocms/modules/blogroll/license
 * @link		http://www.mikevanwinkle.com/pyrocms/modules/blogroll
 */

class Links_m extends MY_Model {
	
	function __construct() {
		parent::__construct();
		
	}
	
	function get_all() {
		$orderby = $this->uri->segment(4);
		$order = $this->uri->segment(5);
		$orderby = $orderby?'link_'.$orderby:'id';
		$order = $order?$order:'desc';
		$this->db->order_by($orderby,$order);
		$links = $this->db->get('links');
		return $this->prepare($links->result_array());
	}

	function get_by_id($id) {
		if(!isset($id)) { exit; }
		
		$links = $this->db->get_where('links',array('id'=>$id));
		return $links->result_array();
	}
	
	function get_alpha($groups = '') {
		$this->db->order_by('link_name','ASC');
		if(!empty($groups)) {
			$links = $this->db->get_where('links',array('link_group'=>$groups));
		} else {
			$links = $this->db->get('links');
		}
		
		return $links->result_array();
	}
	
	function prepare($links) {
		for($i = 0; $i < count($links); $i++ )
		{
			$owner = $this->pyrocache->model('links_m','get_owner',$links[$i]['link_owner']);
			$links[$i]['link_owner'] = $owner[0]->username;
		}
		return $links;		
	}
	
	function get_owner($id) {
		$this->db->select('username');
		$query = $this->db->get_where('users',array('id'=>$id));
		return $query->result(); 
		$query->free_result();
	}

}?>