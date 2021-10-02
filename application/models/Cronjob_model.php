<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (file_exists("application/aws-module/aws-autoloader.php")) {
    include APPPATH . 'aws-module/aws-autoloader.php';
}

class Cronjob_model extends CI_Model {

    function __construct() {
        parent::__construct();
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }   
    public function get_pending_video_list() {
        return $this->db->get_where('lesson', array('vidoCipher_status' => 1,'video_type' => 'system'))->result_array();
    }
    public function update_video_status($video_id,$video_url) {        
        $data['vidoCipher_status']=2;
        $this->db->where('vidoCipher_id', $video_id);
        $res=$this->db->update('lesson', $data);
        echo $res;
        if($res==1){
            echo 'yes';
            $video_url=str_replace(base_url(),"",$video_url);
            $res=unlink($video_url); 
            print_r($res);die;
            echo 'no';
        }
    }
}
