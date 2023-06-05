<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function login()
	{
		check_already_login();
		$this->load->view('vlogin');
	}

	public function process()
	{
		$post = $this->input->post(null, TRUE);
		
		if(isset($post['login']))
		{
			$this->load->model('m_user');
			$query = $this->m_user->login($post);

			if($query->num_rows() > 0){
				$row = $query->row();
				$params = array(
					'userid' 	=> $row->user_id,					
					'name' 		=> $row->name,
					'address' 	=> $row->address,
					'level' 	=> $row->level
				);

				$this->session->set_userdata($params);
				echo "<script>
						alert('Selamat, Login Berhasil');
						window.location='".site_url('dashboard')."';
					</script>";
			}else{
				echo "<script>
					alert('Maaf Login Gagal, periksa kembali username dan password Anda.');
					window.location='".site_url('auth/login')."';
				</script>";
				
			}

		}else{
			echo 'Tidak ada Post';
		}
	}

	public function logout()
	{
		$params = array('userid', 'name', 'address', 'level');
		$this->session->unset_userdata($params);
		redirect('auth/login');
	}
}
