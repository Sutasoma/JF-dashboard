<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/MY_REST_Controller.php';
require  'vendor/autoload.php';

use \Firebase\JWT\JWT;

class Auth extends MY_REST_Controller {

	public function __construct()
	{		
        parent::__construct();
        
        $this->load->model('User_model');
    }

    public function login_post()
    {
        $jwt = $this->gen_token();

        $this->form_validation->set_rules('username', 'username', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');

        $this->form_validation->set_data($this->post());

        if ($this->form_validation->run() == FALSE) {
			return $this->set_response(
				array(),
				$this->lang->line('text_invalid_params'),
				REST_Controller::HTTP_BAD_REQUEST
			);
        }

        $user_login = $this->form_validation->need_data_as($this->post(), array(
            'username'      => null,
            'password'     => null
        ));

        $log_in = $this->User_model->login($user_login);

        if(!$log_in){
			return $this->set_response(
				array(),
				$this->lang->line('text_server_error'),
				REST_Controller::HTTP_INTERNAL_SERVER_ERROR
			);
		}

        $return = [
            'nama' => $log_in->nama,
            'email' => $log_in->email,
            'hp' => $log_in->hp,
            'username' => $log_in->username,
            'status' => $log_in->status,
            'level' => $log_in->level
        ];
        
		return $this->set_response(
			$return,
			$this->lang->line('text_login_success'),
			REST_Controller::HTTP_OK
		);
    }

    public function register_post()
    {
        $this->input->request_headers();
        $this->validate_token($this->input->get_request_header('X_AUTH_TOKEN'));

        $this->form_validation->set_rules('nama', 'name', 'required');
		$this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('hp', 'name', 'required');
        $this->form_validation->set_rules('username', 'username', 'required');
        $this->form_validation->set_rules('password', 'password', 'required|min_length[5]|max_length[20]');
        $this->form_validation->set_rules('status', 'name', 'required');
        $this->form_validation->set_rules('level', 'name', 'required');

        $this->form_validation->set_data($this->post());

        if ($this->form_validation->run() == FALSE) {
			return $this->set_response(
				array(),
				$this->lang->line('text_invalid_params'),
				REST_Controller::HTTP_BAD_REQUEST
			);
        }

        $email_available = $this->User_model->check_email_availability($this->post('email'));

        if(!$email_available){
			return $this->set_response(
				array(), 
				$this->lang->line('text_duplicate_email'),
				REST_Controller::HTTP_CONFLICT
			);
        }
        
		$user_data = $this->form_validation->need_data_as($this->post(), array(
            'nama'      => null,
            'email'     => null,
            'hp'        => null,
            'username'  => null,
            'password'  => null,
            'status'    => null,
            'level'     => null
        ));
        
		$user_id = $this->User_model->add($user_data);

		if(!$user_id){
			return $this->set_response(
				array(),
				$this->lang->line('text_server_error'),
				REST_Controller::HTTP_INTERNAL_SERVER_ERROR
			);
		}
			
		return $this->set_response(
			array(),
			$this->lang->line('text_registration_success'),
			REST_Controller::HTTP_CREATED
		);
    }

    public function gen_token() {

        $timestamp = now();

        $token = array(
            "iss" => "http://jasindo.id",
            "aud" => "http://jasindo.id",
            "userdetail"=>array("fname"=>"Muhammad","lname"=>"Idrus"),
            "iat" => $timestamp
        );

        $jwt = JWT::encode($token, $this->config->item('jwt_key'));
        return $jwt;
    }
    
    public function token_get() {

        $jwt = $this->gen_token();
        $this->set_response(array("access_token" => $jwt), "Token", MY_REST_Controller::HTTP_OK);
	}
}