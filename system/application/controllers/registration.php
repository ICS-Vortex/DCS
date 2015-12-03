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
        $this->dcs_lib->isPost();
        $check_conditions = $this->input->post('check_conditions');
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
            $data = array();
            $data['pilot_id'] = $check_nick['id'];
            $this->load->view('register_form',$data);
        }
    }

    public function make_ticket(){
        $this->dcs_lib->isPost();
        $this->load->model('register_model');
        $pilot_id = (int)$this->input->post('pilot_id');
        $check_pilot_id = $this->register_model->check_pilot_id($pilot_id);
        if($check_pilot_id == 0){
            echo 0;
        }else{
            $email = trim($this->input->post('email'));
            $ticket = array();
            $ticket['pilot_id'] = $pilot_id;
            $ticket['deadline'] = date('Y-m-d H:i:s', (time()+(3600*24)));
            $make_ticket = $this->register_model->make_ticket($ticket);
            $update_pilots = $this->register_model->update_pilots_email($pilot_id,$email);
            echo 1;
        }
    }
}
