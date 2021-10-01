<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Linkedin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->database();
        $this->load->library('session');
        // $this->load->library('stripe');
        /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');

        // CHECK CUSTOM SESSION DATA
        // $this->session_data();
    }

    public function index()
    {
        $page_data['page_name'] = "LinkedIn MasterClass";
        $page_data['page_title'] = site_phrase('LinkedIn MasterClass');
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/linkedin', $page_data);
    }
}
?>