<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class main extends CI_Controller {
	

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		echo"hello";
	}
	public function dashboard()
		{
			$this->load->view('dashboard');
		}
	public function view_user()
		{
	 		$this->load->view('viewstudents');
		}
	public function notification()
		{
	 		$this->load->view('notification');
		}
	public function view_complaints()
		{
	 		$this->load->view('view_complaints');
		}
	public function logout()
		{
	 		$this->load->view('');
		}


		 /***
    *@function name:Add user
    *@author : Mahima s
    *@date : 04/03/2021
    ***/
    public function user()
    {
        $this->load->view('add_user');
    }
    public function adduser()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules("firstname","firstname",'required');
        $this->form_validation->set_rules("username","username",'required');
        $this->form_validation->set_rules("email","email",'required');
        $this->form_validation->set_rules("password","password",'required');
        if($this->form_validation->run())
        {
        $this->load->model('mainmodel');
        $b=array("firstname"=>$this->input->post("firstname"),"email"=>$this->input->post("email"),"password"=>$this->input->post("password"),
                "usertype"=>'1');
        $this->mainmodel->inreg($b);    
        redirect(base_url().'main/login');
        }
}
/***
    *@function name:Add company
    *@author : Mahima s
    *@date : 04/03/2021
    ***/
public function company()
    {
        $this->load->view('add_company');
    }
    public function addcompany()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules("username","username",'required');
        $this->form_validation->set_rules("email","email",'required');
        $this->form_validation->set_rules("password","password",'required');
        if($this->form_validation->run())
        {
        $this->load->model('mainmodel');
        $a=array("username"=>$this->input->post("username"),"email"=>$this->input->post("email"),"password"=>$this->input->post("password"),
                "usertype"=>'2');
        $this->mainmodel->inregs($a);    
        redirect(base_url().'main/login');
        }
}
/***
    *@function name: Add interview details
    *@author : Mahima s
    *@date : 04/03/2021
    ***/
public function add_interview()
    {
        $this->load->view('addidetails');
    }
    public function addinterview()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules("cname","company",'required');
        $this->form_validation->set_rules("date","date",'required');
        $this->form_validation->set_rules("email","email",'required');
        $this->form_validation->set_rules("qlfctn","qualification",'required');
        $this->form_validation->set_rules("batch","batch",'required');
        $this->form_validation->set_rules("experience","experience",'required');
        $this->form_validation->set_rules("salary","salary",'required');
        $this->form_validation->set_rules("location","location",'required');
        $this->form_validation->set_rules("lastdate","lastdate",'required');
        $this->form_validation->set_rules("venue","venue",'required');
        if($this->form_validation->run())
        {
        $this->load->model('mainmodel');
        $b=array("company"=>$this->input->post("cname"),
            "date"=>$this->input->post("date"),
            "qualification"=>$this->input->post("qlfctn"),
            "batch"=>$this->input->post("batch"),
            "experience"=>$this->input->post("experience"),
            "salary"=>$this->input->post("salary"),
            "jlocation"=>$this->input->post("location"),
            "ldate"=>$this->input->post("lastdate"),
            "vlocation"=>$this->input->post("venue"), );
        $this->mainmodel->ireg($b);    
        redirect(base_url().'main/login');
        }
}
    /***
    *@function name:login
    *@author : Mahima s
    *@date : 04/03/2021
    ***/
    public function login()
    {
        $this->load->view('login');
    }
   
    public function logns()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules("email","email",'required');
        $this->form_validation->set_rules("password","password",'required');
        if($this->form_validation->run())
        {
            $this->load->model('mainmodel');
            $email=$this->input->post("email");
            $pass=$this->input->post("password");
            $rslt=$this->mainmodel->selectpass($email,$pass);
                if ($rslt)
                 {
                    $id=$this->mainmodel->getuserid($email);

                    $user=$this->mainmodel->getuser($id);
                    $this->load->library(array('session'));
                    $this->session->set_userdata(array
                        ('id'=>(int)$user->id,
                        'usertype'=>$user->usertype,'status'=>$user->status,'logged_in'=>(bool)true));
                    if($_SESSION['usertype']=='2' && $_SESSION['status']=='1')
                    {
                        redirect(base_url().'main/userhome');
                    }
                    elseif($_SESSION['usertype']=='0' )
                    {
                        redirect(base_url().'main/login');
                    }
                    else
                    {
                        echo "Waiting for approval";
                    }
                 }
                 else
                 {
                    echo "invalid user";
                 }
             }
             else
             {
                redirect('main/login','refresh');
             }
                 
}
    }

