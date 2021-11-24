<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	function __construct()
    {
        parent::__construct();
		//load model
        $this->load->model('crud_model');
		$this->load->library('form_validation');
		// $this->load->library('pagination');
		// $this->load->model('test_model');
    }

	public function index()
	{
		$this->load->view('welcome_message');
	}

	// public function paging()
	// {
	// 		//konfigurasi pagination
	// 		$config['base_url'] = site_url('welcome/paging'); //site url
	// 		$config['total_rows'] = $this->db->count_all('phone_info'); //total row
	// 		$config['per_page'] = 10;  //show record per halaman
	// 		$config["uri_segment"] = 3;  // uri parameter
	// 		$choice = $config["total_rows"] / $config["per_page"];
	// 		$config["num_links"] = floor($choice);
	
	// 		// Membuat Style pagination untuk BootStrap v4
	// 		$config['first_link']       = 'First';
	// 		$config['last_link']        = 'Last';
	// 		$config['next_link']        = 'Next';
	// 		$config['prev_link']        = 'Prev';
	// 		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
	// 		$config['full_tag_close']   = '</ul></nav></div>';
	// 		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
	// 		$config['num_tag_close']    = '</span></li>';
	// 		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
	// 		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
	// 		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
	// 		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
	// 		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
	// 		$config['prev_tagl_close']  = '</span>Next</li>';
	// 		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
	// 		$config['first_tagl_close'] = '</span></li>';
	// 		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
	// 		$config['last_tagl_close']  = '</span></li>';
	
	// 		$this->pagination->initialize($config);
	// 		$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
	
	// 		$data['data'] = $this->test_model->get_phone_info($config["per_page"], $data['page']);           
	
	// 		$data['pagination'] = $this->pagination->create_links();
	
	// 		 $this->load->view('welcome.message',$data);
	// }

	public function insert()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('p_username', 'Username', 'required');
			$this->form_validation->set_rules('p_phonenum', 'Phone Number', 'required');

			if ($this->form_validation->run() == FALSE) {
				$data = array('response' => "error", 'message' => validation_errors());
			} else {
				$ajax_data = $this->input->post();

				if ($this->crud_model->insert_entry($ajax_data)) {
					$data = array('response' => "success", 'message' => "Data added successfully");
				} else {
					$data = array('response' => "error", 'message' => "failed");
				}
			}

			echo json_encode($data);
		} else {
			echo "'No direct script access allowed'";
		}
	}

	public function fetch()
	{
		// if ($this->input->is_ajax_request()) {
			$posts = $this->crud_model->get_entries();
			echo json_encode($posts);
		// } else {
		// 	echo "'No direct script access allowed'";
		// }
	}

	public function delete()
	{
		if ($this->input->is_ajax_request()) {

			$del_id = $this->input->post('del_id');

			if ($this->crud_model->delete_entry($del_id)) {
				$data = array('response' => "success",);
			} else {
				$data = array('response' => "error");
			}

			echo json_encode($data);
		}
	}

	public function edit()
	{
		if ($this->input->is_ajax_request()) {
			$this->input->post('edit_id');

			$edit_id = $this->input->post('edit_id');

			if ($post = $this->crud_model->single_entry($edit_id)) {
				$data = array('response' => "success", 'post' => $post);
			} else {
				$data = array('response' => "error", 'message' => "failed");
			}

			echo json_encode($data);
		}
	}

	public function update()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('edit_p_username', 'p_username', 'required');
			$this->form_validation->set_rules('edit_p_phonenum', 'p_phonenum', 'required');

			if ($this->form_validation->run() == FALSE) {
				$data = array('response' => "error", 'message' => validation_errors());
			} else {
				$data['p_id'] = $this->input->post('edit_id');
				$data['p_username'] = $this->input->post('edit_p_username');
				$data['p_phonenum'] = $this->input->post('edit_p_phonenum');

				if ($this->crud_model->update_entry($data)) {
					$data = array('response' => "success", 'message' => "Data update successfully");
				} else {
					$data = array('response' => "error", 'message' => "failed");
				}
			}

			echo json_encode($data);
		} else {
			echo "'No direct script access allowed'";
		}
	}

	// public function ajaxPro()
    // {
    //     $query = $this->input->get('query');
    //     $this->db->like('phone_info', $query);


    //     $data = $this->db->get("tags")->result();


    //     echo json_encode( $data);
    // }

	

}
