<?php
class Login_model extends CI_Model
{
 public function can_login($email, $password)
 {
  $this->db->where('email', $email);
  $query = $this->db->get('codeigniter_register');
  if($query->num_rows() > 0)
  {
   foreach($query->result() as $row)
   {
    if($row->is_email_verified == 'yes')
    {
     //$store_password = $this->encrypt->decode($row->password);
     if($password == $row->password)
     {
      $this->session->set_userdata('id', $row->id);
     }
     else
     {
      return 'Wrong Password';
     }
    }
    else
    {
     return 'First verify your email';
    }
   }
  }
  else
  {
   return 'Wrong Email Address';
  }
 }

 

}

?>
