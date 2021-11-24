<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

    function __Construct() {
        parent::__Construct();

        $this->load->model('find');
    }

    public function index() {
        $this->load->view('search');
    }

    public function search() {

        $search_data = $_POST['search_data'];

        $query = $this->search->get_live_items($search_data);

        foreach ($query as $row):
            echo "<li><a href='#'>" . $row->p_username . "</a></li>";

        endforeach;
    }

}