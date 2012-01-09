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
		return $links->result_array();
	}

	function get_by_id($id) {
		if(!isset($id)) { exit; }
		
		$links = $this->db->get_where('links',array('id'=>$id));
		return $links->result_array();
	}
	
}?>