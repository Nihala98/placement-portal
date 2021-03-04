<?php
class mainmodel sextends CI_model 
{
	/***
*@function name:insertion  of student
*@author : Mahima s
*@date : 04/03/2021
***/

public function inreg($b)
{
 
   $this->db->insert("login",$b);
}
/***
*@function name:insertion of company
*@author : Mahima s
*@date : 04/03/2021
***/
public function inregs($a)
{
 
   $this->db->insert("login",$a);
}
/***
*@function name:interview details
*@author : Mahima s
*@date : 04/03/2021
***/
public function ireg($b)
{
 
   $this->db->insert("interview",$b);
}
/***
*@function name:selecting password
*@author : Mahima s
*@date : 04/03/2021
***/
public function selectpass($email,$pass)
{
$this->db->select('password');
$this->db->from("login");
$this->db->where("email",$email);
$qry=$this->db->get()->row('password');
return $qry;
}

/***
*@function name:fetching id
*@author : Mahima s
*@date : 04/03/2021
***/
public function getuserid($email)
{
$this->db->select('id');
$this->db->from("login");
$this->db->where("email",$email);
return $this->db->get()->row('id');
}
/***
*@function name:fetching id
*@author : Mahima s
*@date : 04/03/2021
***/
public function getuser($id)
{
$this->db->select('*');
$this->db->from("login");
$this->db->where("id",$id);
return $this->db->get()->row();
}
}
	?>