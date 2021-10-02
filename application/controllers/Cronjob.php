<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cronjob extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->database();
        $this->load->library('session');
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    public function vido_cipher_upload_status() {
        echo 'hi';die;
        $resData=$this->Cronjob_model->get_pending_video_list();         
        if(!empty($resData)){
            foreach ($resData as $row){
                $res=update_vidocipher_status($row['vidoCipher_id']);
                if(!empty($res)){
                    if($res->status=="ready"){
                        $this->Cronjob_model->update_video_status($row['vidoCipher_id'],$row['video_url']);
                    }
                }
            }
        }        
    }
}
