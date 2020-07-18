<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Register extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		
		$this->load->model('register_model');
	}

	public function index()
	{
		$this->load->view('register');

	}

	public function validation()
	{
		$this->form_validation->set_rules('user_name', 'Name', 'required|trim');
		$this->form_validation->set_rules('user_email', 'Email Address', 'required|trim|valid_email|is_unique[codeigniter_register.email]');
		$this->form_validation->set_rules('user_password', 'Password', 'required');
		if ($this->form_validation->run()) {
			$verification_key = md5(rand());

			$data  = array(
				'name' => $this->input->post('user_name'),
				'email' => $this->input->post('user_email'),
				'password' => $this->input->post('user_password'),
				'verification_key' => $verification_key
			);

			$id = $this->register_model->insert($data);

			   if($id > 0)
   {
    $subject = "Please verify email for login";
    $message = "
    <p>Hi ".$this->input->post('user_name')."</p>
    <p>This is email verification mail from Codeigniter Login Register system. For complete registration process and login into system. First you want to verify you email by click this <a href='".base_url()."register/verify_email/".$verification_key."'>link</a>.</p>
    <p>Once you click this link your email will be verified and you can login into system.</p>
    <p>Thanks,</p>
    ";

    $config['protocol'] = 'smtp';
    $config['smtp_host'] = 'ssl://smtp.gmail.com';
    $config['smtp_port'] = '465';
    $config['smtp_timeout'] = '60';
    $config['smtp_user'] = 'Gmail ID';
    $config['smtp_pass'] = 'Gmail Password';
    $config['charset'] = 'utf-8';
    $config['newline'] = "\r\n";
    $config['mailtype'] = "html";
    $config['validation'] = TRUE;

    $this->load->library('email');
    $this->email->initialize($config);
    $this->email->set_newline("\r\n");
    $this->email->from('email@gmail.com','Identification');
    $this->email->to($this->input->post('user_email'));
    $this->email->subject($subject);
    $this->email->message($message);
    if($this->email->send())
    {
     $this->session->set_flashdata('message', 'Check in your email for email verification mail');
     return redirect('register');
    }
   }
  }
  else
  {
   $this->index();
  }
 }

 public function verify_email()
 {
 	if($this->uri->segment(3))
 	{
 		$verification_key = $this->uri->segment(3);
 		if($this->register_model->verify_email($verification_key))
 		{
 			$data['message'] = '<h1 align="center">Your Email has been successfully verified, now you can login from <a href="'.base_url().'login">here</a></h1>';
 		}
 		else
 		{
 			$data['message'] = '<h1 align="center">Invalid Link</h1>';
 		}
 		$this->load->view('email_verification',$data);
 	}
 }
}
?>