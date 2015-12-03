<?php
if (!defined('BASEPATH')) exit('No direct script allowed! ');

class Registration extends Controller
{
    public function __construct()
    {
        parent::Controller();
    }

    public function index(){
        $this->load->view('conditions_view');
    }

    public function preparing(){
        $this->load->view('reg_form_view');
    }

    public function checking(){
        $this->load->model('register_model');
        $this->dcs_lib->isPost();
        $nickname = $this->input->post('nickname');
        $check_nick = $this->register_model->find_nickname($nickname);
        if(empty($check_nick)){
            echo 0;
        }else{
            $this->load->view('register_form');
        }
    }
}
