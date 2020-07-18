<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Login extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('login_model');
	}

	public function index()
	{
		$this->load->view('login');
	}

	public function validation()
	{
		$this->form_validation->set_rules('user_email','Email Address','required|trim|valid_email');
		$this->form_validation->set_rules('user_password','Password','required');
		if($this->form_validation->run())
		{
			$result = $this->login_model->can_login($this->input->post('user_email'), $this->input->post('user_password'));
			if ($result == '') {
				redirect('private_area');
			}
			else
			{
				$this->session->set_flashdata('message',$result);
				redirect('login');
			}
		}	
		else
		{
			$this->index();
		}	

	}

	public function forgot_password()
	{
		$this->load->view('forgot_password_form');
	}

	public function forgot_validation()
	{
		$email = $this->input->post('email');

			$result = $this->db->query("SELECT * FROM codeigniter_register WHERE email='".$email."'")->result_array();
			if(count($result)>0)
			{ 
				$token = rand(10000000,99999999);

$this->db->query("UPDATE codeigniter_register SET password='".$token."'WHERE email='".$email."'");



				$subject = "Reset Password";
				$message = "Please click on the password reset link <br> <a href='<?php echo base_url(); ?>reset?token'".$token."'>Register</a>";
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
    $this->email->to($this->input->post('email'));
    $this->email->subject($subject);
    $this->email->message($message);
    if($this->email->send())
    {
     $this->session->set_flashdata('message', 'Check in your email for email verification mail');
     return redirect('login/forgot_password');
    }

			}
			else
			{
				$this->session->set_flashdata('message',"Email is not registered");
				redirect('login/forgot_password');
			}
		
	}

	public function reset()
	{
		$data['token'] = $this->input->get('token');
		$_SESSION['token'] = $data['token'];
		$this->load->view('resetpass_form');
	}

	public function updatepass()
	{
		$_SESSION['token'];
		$data = $this->input->post();
		if($data['user_password']==$data['user_cpassword'])
		{
			$this->db->query("UPDATE codeigniter_register SET password='".$data['password']."'WHERE password='".$_SESSION['token']."'");
			redirect('login');
		}
		else
		{
			$this->session->set_flashdata('message','Password doesnot match');
			redirect('login/reset');
		}
	}
}