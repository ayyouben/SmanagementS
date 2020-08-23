<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');






    class Parents extends CI_Controller{


        function __construct()
        {
            parent::__construct();
            $this->load->database();
            $this->load->library('session');
            
           /*cache control*/
            $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
            $this->output->set_header('Pragma: no-cache');
            
        }

        public function index()
        {
            if ($this->session->userdata('parent_login') != 1)
                redirect(base_url() . 'index.php?login', 'refresh');
            if ($this->session->userdata('parent_login') == 1)
                redirect(base_url() . 'index.php?parents/dashboard', 'refresh');
        }
        public function dashboard()
        {
            if ($this->session->userdata('parent_login') != 1)
                redirect(base_url(), 'refresh');
            $page_data['page_name']  = 'dashboard';
            $page_data['page_title'] = get_phrase('parent_dashboard');
            $this->load->view('backend/index', $page_data);
        }
    

    }




?>