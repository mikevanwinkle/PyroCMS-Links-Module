<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Blogroll Module
 *
 * @package		Blogroll Module
 * @author		Mike Van Winkle
 * @copyright	Copyright (c) 2011, Mike Van Winkle
 * @license		http://www.mikevanwinkle.com
 * @link		http://www.mikevanwinkle.com
 */
class Module_Blogroll extends Module {

	public $version = '0.5';
	
	function __construct()
	{

//$ci =& get_instance();
//print_r($ci->router);
	}

	// --------------------------------------------------------------------------

	public function info()
	{
		$info = array(
			'name' => array(
				'en' => 'Blogroll',
			),
			'description' => array(
				'en' => 'A simple links manager for your pyrocms blog',
			),
			'frontend' => TRUE,
			'backend' => TRUE,
			'author' => 'Mike Van Winkle',
			'menu' => 'content',
			'roles' => array('admin_links'),
				'sections' => array(
			   	'links' => array(
				    'name' => 	'links_admin.title',
				    'uri' => 	'admin/blogroll',
				    'shortcuts' => array(
							array(
						 	   'name' => 'links_admin.create_button',
							    'uri' => 'admin/blogroll/create',
							    'class' => 'add'
							)
						)	
					),
				'link_groups'=>array(
						'name'=> 'links_admin.groups',
						'uri'	=> 'admin/blogroll/groups',
						'shortcuts' => array(
							array(
								'name'=>'links_admin.create_button',
								'uri'	=>'admin/blogroll/groups',
								'class'=>'add'
							)
						)
					)
				)
		);
		

		return $info;
	}
	
	public function install() {
		
		$fields = array(
			'id' => array(
				'type' 					=> 'INT',
				'constraint' 		=> '11',
				'unsigned'			=> true,
				'auto_increment'=> true
			),
			'link_name' => array(
				'type' 					=> 'VARCHAR',
				'constraint' 		=> '255',
				'null'					=> TRUE
				
			),
			'link_url' => array(
				'type' 					=> 'VARCHAR',
				'constraint' 		=> '255',
				'null'					=> TRUE
				
			),
			'link_description'=> array(
				'type' 					=> 'TEXT',
				'null'					=> TRUE
			),
			'link_target' => array(
				'type' 					=> 'VARCHAR',
				'constraint' 		=> '255',
				'null'					=> TRUE
				
			),
			'link_created'		=> array(
				'type'					=> 'datetime',
			),
			'link_owner'			=> array(
				'type'					=> 'INT',
				'unsigned'			=> TRUE,
				'constraint'		=> 11
			),
			'link_group' => array(
				'type'		=>'INT',
				'unsigned'	=>TRUE,
				'constraint'=> 11
			)	
		);
		
		$groups_fields = array(
			'id' => array(
				'type' 	=> 'INT',
				'constraint' => 11,
				'unsigned'	=> TRUE,
				'auto_increment'=>TRUE
			),
			'name'	=> array(
				'type'=>'text',
				'constraint'=>'100'
			),
			'description'=> array(
				'type' 	=> 'TEXT',
				'null'	=> TRUE
			),
			'slug'	=> array(
				'type'=>'text',
				'constraint'=>'100'			
			)
		);
		
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id',TRUE);
		$this->dbforge->create_table('links',TRUE);
		
		$this->dbforge->add_field($groups_fields);
		$this->dbforge->add_key('id',TRUE);
		$this->dbforge->create_table('links_groups',TRUE);
		
		return TRUE;
	}
	
	public function uninstall() {
		return TRUE;
	}
	
	public function upgrade($old_version) {
		$update_fields = array(
			'link_group' => array(
			'type'		=>'INT',
			'unsigned'	=>TRUE,
			'constraint'=> 11
			)	
		);

		$this->dbforge->add_column('links',$update_fields);

		return TRUE;
	}
	
}

/* End of file details.php */