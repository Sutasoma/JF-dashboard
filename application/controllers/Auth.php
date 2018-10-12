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
}
