<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	/**
	 * @author muhammadidrus919@gmail.com
	 */
	public function index()
	{
		$this->load->view('auth/login');
    }

    public function login()
    {
        $this->load->view('auth/login');
	}
	
	public function proses_login()
	{
		$url = 'localhost/JF-dashboard/v1/auth/login';

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => json_encode($_POST),
			CURLOPT_HTTPHEADER => array(
				"content-type: application/json",
			),
		));

		$response = curl_exec($curl);

		echo $response;
	}
}
