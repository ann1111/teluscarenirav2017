<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {

public function check_credencial($username,$password)
{
	//$this->db->where(array('username'=>$username,'password'=>$password));
	//$data=$this->db->get('user');
	$this->db->where(array('user_name'=>$username,'password'=>$password));
	$data=$this->db->get('wl_customers');
	if($data->num_rows()>0)
	{
		return $data->result();
	}
	else
	{
		return 'none';
	}
}

public function insertproduct($data)
	{
		$this->db->insert('product',$data);
	}
	public function product_list()
	{
		$this->db->select('*');
		$this->db->from('product');
		$this->db->join('category','product.category=category.cid');
		$sql=$this->db->get();
		return $sql->result();
	}
	public function update($id)
	{
	$this->db->where('id',$id);
	$sql=$this->db->get('login');
		return $sql->result();
	}
	
	public function login_ud($uname,$pword,$hid)
	{
	$this->db->where('id',$hid);
		$this->db->update('login',array('name'=>$uname,'pw'=>$pword));
	}
	public function delete($hid)
	{
	$this->db->where('id',$hid);
		$this->db->delete('login');
	}
	public function category()
	{
		$query=$this->db->get('category');
		return $query->result();
	}
	public function deleteproduct($id)
	{
		$this->db->where('pid',$id);
		$this->db->delete('product');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */