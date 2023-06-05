<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

	public function login($post)
	{
		$this->db->select('*');
        $this->db->from('m_user');
        $this->db->where('username',$post['username']);
        $this->db->where('password',sha1($post['password']));

        $query = $this->db->get();

        return $query;
	}
}
