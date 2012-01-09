<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends Admin_Controller {
	
	protected $section = 'links';
	
	public $validation_rules = array(	
		'link_name' => array(
				'field' => 'link_name',
				'label' => 'lang:links_admin.name_label',
				'rules' => 'trim|htmlspecialchars|required|max_length[100]'
			),
	);

	function __construct() {
		parent::__construct();
		$this->lang->load('blogroll');
		$this->load->model('links_m');
		$this->load->library(array('keywords/keywords', 'form_validation'));
		$this->load->model('links_groups_m');
	}
	
	/**
	 * Show all links
	 * @access public
	 * @return void
	 */
	function index() {
		$order = $this->uri->segment(5);
		$links = $this->links_m->get_all();
		$this->data['links'] = $links;
		$this->data['order'] = ( $order == 'asc')?'desc':'asc';
		
		for($i = 0;$i < count($this->data['links']); $i++)
		{
			$this->data['links'][$i]['link_group'] = $this->links_groups_m->get_name($this->data['links'][$i]['link_group']);
		}
		
		$this->template->title($this->module_details['name'])->build('admin/index',$this->data );
	}
	
	/**
	 * Edit a link
	 * @access public
	 * @param int $id the id of the link to edit
	 * @return void
	 */	
	function edit($id = 0) {
	

		$this->method = 'edit';
		
		if(!empty($_POST)) {
			$this->form_validation->set_rules($this->validation_rules);	
			if($this->form_validation->run()) 
			{	
				//setup post data
				$linkdata = array(
					'link_name' 				=> $this->input->post('link_name'),
					'link_url'					=> $this->input->post('link_url'),
					'link_description' 			=> $this->input->post('link_description'),
					'link_target'				=> $this->input->post('link_target'),
					'link_created' 				=> $this->input->post('link_created'),
					'link_owner'				=> $this->input->post('link_owner'),
					'link_group'				=> $this->input->post('link_group')
				);
				//insert
				$update_id = $this->links_m->update($id,$linkdata);
				
				if($update_id) 
				{
					//send success message
					$this->session->set_flashdata('success', sprintf($this->lang->line('links_admin.edit_success'), $this->input->post('link_name')));
				}
			}
			
			if(isset($update_id)) 
			{
				if( $this->input->post('btnAction') == 'save_exit') 
				{
					redirect('admin/blogroll');
				} else { 
					redirect('admin/blogroll/edit/' . $id);
				}
			}
		}
		
		$this->data['link_groups'] = $this->pyrocache->model('links_groups_m','get_option_list','', 60 * 60 * 7 );
		$link = $this->links_m->get_by_id($id);
		$this->data['link'] = $link[0];
		$this->template->title($this->module_details['name'])
			->build('admin/form',$this->data);
	}
	
	/**
	 * Create a new link
	 * @access public
	 * @return void
	 */
	function create() {
		$this->method = 'create';
		$this->form_validation->set_rules($this->validation_rules);	
		if($this->form_validation->run()) 
		{	
			//setup post data
			$linkdata = array(
				'link_name' 				=> $this->input->post('link_name'),
				'link_url'					=> $this->input->post('link_url'),
				'link_description' 	=> $this->input->post('link_description'),
				'link_target'				=> $this->input->post('link_target'),
				'link_created' 			=> $this->input->post('link_created'),
				'link_owner'				=> $this->input->post('link_owner'),
				'link_group'				=> $this->input->post('link_group')
			);
			//insert
			$insert_id = $this->links_m->insert($linkdata);
			
			if($insert_id) 
			{
				//send success message
				$this->session->set_flashdata('success', sprintf($this->lang->line('links_admin.add_success'), $this->input->post('link_name')));
			}
		}
		
		if(isset($insert_id)) 
		{
			$this->input->post('btnAction') == 'save_exit' ? redirect('admin/blogroll') : redirect('admin/blogroll/edit/' . $insert_id);
		}
		
		$this->link = array();
		$this->template->title($this->module_details['name'])
			->build('admin/form',$this->data);
	}	
}