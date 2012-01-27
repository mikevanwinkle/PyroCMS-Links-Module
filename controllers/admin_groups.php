<?php
class Admin_groups extends Admin_Controller {
	
	public $section = 'links_groups';
	
	function __construct() {
		parent::__construct();
		$this->load->model('links_groups_m');
		$this->load->library('form_validation');
		$this->lang->load('blogroll');
		$this->validation_rules = array(
		 array(
            'field' => 'name',
            'label' => lang('links_groups_admin.name_label'),
            'rules' => 'trim|max_length[250]|required'
         ));
		$this->template
					->set_partial('shortcuts', 'admin/partials/shortcuts')
					->append_metadata( $this->load->view('fragments/wysiwyg', $this->data, TRUE) );
	}
	
	function index() {
		$data['groups'] = $this->links_groups_m->get_all();
		$this->template->build('admin/groups/index',$data);
	}
	
	function edit($id) {
		//redirect if no ID is set
		if(!isset($id)) { redirect('/admin/links/groups'); }
		
		//setup validation
    $this->form_validation->set_rules($this->validation_rules);
		
		//validate and save 
		if($this->form_validation->run()) 
		{
			$data = array(
				'name'=> $this->input->post('name'),
				'description'=>$this->input->post('description'),
				'slug'=>$this->input->post('slug')
			);
			
			$edit_id = $this->links_groups_m->update($id,$data);
			$this->pyrocache->delete_all('links_groups_m');
			if($edit_id) 
			{
				$message = lang('links_groups_admin.update_success');
				$status = 'success';	
			} else {
				$message = lang('links_groups_admin.update_failure');
				$status = 'error';	
			}
			
			//what kind of request?
			if($this->_is_ajax())
			{
				$json = array('message' => $message,
								'status' => $status
								);
				echo json_encode($json);
				return TRUE;
			}
			else
			{
				$this->session->set_flashdata($status, $message);
				if(isset($edit_id)) 
					{
						if( $this->input->post('btnAction') == 'save_exit') 
						{
							redirect('admin/links/groups');
						} else { 
							redirect('admin/links/groups/edit/' . $id);
						}
					}
			}
		} else {
			$this->data['group'] = $this->links_groups_m->get($id);
		}
		
		//load the template
		$this->template->title($this->module_details['name'])
			->append_metadata(js('links.js', 'links'))
			->build('admin/groups/form',$this->data);
		
		}
		
		function create() {

			//setup validation
	    $this->form_validation->set_rules($this->validation_rules);
			
			//validate and save 
			if($this->form_validation->run()) 
			{
				$data = array(
					'name'=> $this->input->post('name'),
					'description'=>$this->input->post('description'),
					'slug'=>$this->input->post('slug')
				);
				
				$edit_id = $this->links_groups_m->insert($data);
				$this->pyrocache->delete_all('links_groups_m');
				if($edit_id) 
				{
					$message = lang('links_groups_admin.update_success');
					$status = 'success';	
				} else {
					$message = lang('links_groups_admin.update_failure');
					$status = 'error';	
				}
				
				//what kind of request?
				if($this->_is_ajax())
				{
					$json = array('message' => $message,
									'status' => $status
									);
					echo json_encode($json);
					return TRUE;
				}
				else
				{
					$this->session->set_flashdata($status, $message);
						if(isset($edit_id)) 
						{
							if( $this->input->post('btnAction') == 'save_exit') 
							{
								redirect('admin/links/groups');
							} else { 
								redirect('admin/links/groups/edit/' . $edit_id);
							}
						}

				}
			}
			
			//load the template
			$this->template->title($this->module_details['name'])
				->append_metadata(js('links.js', 'links'))
				->build('admin/groups/form',$this->data);
		}
		
		
		function delete($id) {
			$success = $this->links_groups_m->delete($id);
			
			if($success) {
				$this->pyrocache->delete_all('links_groups_m');
				$status = 'success';
				$message = lang('links_groups_admin.delete_success');
				$this->session->set_flashdata($status, $message);
				redirect('admin/links/groups/');
			}
			
		}
		
		protected function _is_ajax() {
        return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') ? TRUE : FALSE;
    }	
}
?>