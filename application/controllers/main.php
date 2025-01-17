<?php

Class main extends CI_Controller {

	function __construct() {

		parent::__construct();

		$this->load->library('table');
		$this->load->library('upload');
		$this->load->library('image_lib');
		$this->load->library('javascript');
		$this->load->helper(array('form', 'url', 'html'));
		$this->load->library('form_validation');
		$this->load->model('fullcalendar_model');

	}
	function index() {
		$this->load->view('login');
	}
	function login() {

		$username = $_POST['Username'];
		$password = $_POST['Password'];

		$queryLogin = $this->db->query("SELECT * FROM users where username= '{$username}' and password='{$password}'");

		if ($queryLogin->num_rows() > 0) {

			$row = $queryLogin->row();
			$userdata = array('userID' => $row->userID, 'Fname' => $row->Fname, 'Mi' => $row->Mi, 'Lname' => $row->Lname, 'user_type' => $row->user_type, 'logged_in' => TRUE);
			$this->session->set_userdata($userdata);

			if (($row->user_type) == "ADMIN") {
				redirect("main/dashboard");
			} else if (($row->user_type) == "USER") {
				if (($row->status) == "DISABLE") {
					$_SESSION['wrongLogIn'] = "Account Disabled. Contact Adminisitrator.";
					$this->load->view('login');
				} else {
					redirect("main/user_page");
				}
			}
		}else {
			$attempt = $this->session->userdata('attempt');
            $attempt++;
            $this->session->set_userdata('attempt', $attempt);
			if($attempt == 5){
				$disable= "DISABLE";
				$status =array("status"=>$disable);
				$this->db->Where('username', $username);
				$this->db->update('users',$status);
				$attempt = $attempt-5;
				$_SESSION['wrongLogIn'] = "You have reached 5 maximum attempts. Your Account is Disabled";
				$this->load->view('login');
			}else if($attempt <5){
				$_SESSION['wrongLogIn'] = "Invalid Username Or Password!! You have used: $attempt attempt/s";
				$this->load->view('login');
			}else{
				$_SESSION['wrongLogIn'] = "Invalid Username Or Password!!";
				$this->load->view('login');
			}
			
		}
	}
	function dashboard() {
		$this->load->view('dashboard');
	}

	function logout() {
		$this->session->sess_destroy();
		redirect("main/index");
	}

	function register() {
		$this->load->view('sign_up');
	}
	function saveRegister() {
		$verifyu = $_POST['Username'];
		$verifyp = $_POST['Password'];
		$verifyquerylogin = $this->db->query("SELECT * FROM users where username='{$verifyu}'and password='{$verifyp}'");

		if ($verifyquerylogin->num_rows() > 0) {
			$srow = $verifyquerylogin->row();
			if (($srow->username) == $verifyu && ($srow->password) == $verifyp) {
				$_SESSION['wrongLogIn'] = "Username and Password has been taken";
				$this->load->view('login');
			}

		} else {
			$this->db->insert('users', $_POST);
			$_SESSION['message'] = "Successfully Registered!";
			$this->load->view('sign_up');

		}
	}
	function user_page() {
		$this->load->view('user_page');
	}
	function updateUser() {
		$userID = $this->uri->segment(3);
		$this->db->Where('userID', $userID);
		$this->db->update('users', $_POST);
		redirect("main/profile");

	}
	function deleteUser() {
		$userID = $this->uri->segment(3);
		$this->db->Where('username', $userID);
		$this->db->delete('users');
		$this->db->Where('username', $userID);
		$this->db->delete('activation');
		$this->db->Where('username', $userID);
		$this->db->delete('stories');
		redirect("main/dashboard");
	}
	function searchUsers() {
		$this->load->view("dashboard");
	}

	function activation() {
		$this->load->view("activation");
	}
	function activationReq() {
		$verifyUN = $_POST['username'];
		$verifyPW = $_POST['password'];
		$verifyfn = $_POST['Fname'];
		$verifyln = $_POST['Lname'];
		$verifyCredentials = $this->db->query("SELECT * FROM users where username='{$verifyUN}'and password='{$verifyPW}'");
		if ($verifyCredentials->num_rows() > 0) {
			$vrow = $verifyCredentials->row();
			if (($vrow->username) == $verifyUN && ($vrow->password) == $verifyPW) {
				if (($vrow->status) == "DISABLE") {
					if (($vrow->Fname) == $verifyfn && ($vrow->Lname) == $verifyln) {
						$antispam = $this->db->query("SELECT * FROM activation where username='{$verifyUN}'and password='{$verifyPW}'");
						if ($antispam->num_rows() > 0) {
							$arow = $antispam->row();
							if (($arow->username) == $verifyUN && ($arow->password) == $verifyPW) {
								$_SESSION['message'] = "You have a pending request....";
								$this->load->view("activation");

							}
						}else {
							$this->db->insert('activation', $_POST);
							$_SESSION['wrongLogIn'] = "Account Verified. Please Wait...";
							$this->load->view('login');
						}
					}else {
						$_SESSION['message'] = "Why you wont register instead? The credentials has been registered but your name dosen't matched at anyone in the database..";
						$this->load->view('sign_up');
					}

				} elseif (($vrow->status) == "ACTIVE" && ($vrow->Lname) != $verifyln && ($vrow->Fname) != $verifyfn) {
					$_SESSION['message'] = "Why you wont register instead? The credentials has been registered but your name dosen't matched at anyone in the database..";
					$this->load->view('sign_up');
				} else {
					$_SESSION['wrongLogIn'] = "Account has been activated Already. Enter your account";
					$this->load->view('login');
				}
			}
		}else {
			$_SESSION['message'] = "Why you wont register instead? You have no account here..";
			$this->load->view('sign_up');

		}

	}

	function activation_page() {
		$this->load->view('activation_request');
	}
	function deleteRequest() {
		$activationID = $this->uri->segment(3);
		$this->db->Where('activationID', $activationID);
		$this->db->delete('activation');
		redirect("main/activation_page");
	}
	function activateaccount() {
		$un = $this->uri->segment(3);
		$this->db->Where('username', $un);
		$this->db->update('users', $_POST);
		$this->db->Where('username', $un);
		$this->db->delete('activation');
		redirect("main/dashboard");
	}

	function searchRequest() {
		$this->load->view("activation_request");
	}
	function createStory() {
		$this->db->insert('stories', $_POST);
		$_SESSION['posted'] = "Successfully Posted!";
		redirect("main/user_page");
	}
	function updateStory(){
		$sid=$this->uri->segment(3);
		$this->db->Where('storyID',$sid);
		$this->db->update('stories', $_POST);
		redirect("main/user_page");


	}
	function deleteStory(){
		$sid=$this->uri->segment(3);
		$this->db->Where('storyID',$sid);
		$this->db->delete('stories');
		redirect("main/user_page");

	}
	function stories(){
		$this->load->view('stories');
	}
	function searchUser(){
		if(isset($_POST['key'])){
		$_SESSION['key']=$_POST['key'];
		$this->load->view('search_user');
		}
		else{
			redirect('main/user_page');
		}
	}
	function storylikes(){
		$userID=$this->uri->segment(3);
		$storyID=$this->uri->segment(4);
		$this->db->query("INSERT INTO likes (storyID,userID) VALUES('{$storyID}','{$userID}')");
		redirect('main/stories');
	}

	function storyunlikes(){
		$unlikeSID=$this->uri->segment(3);
		$this->db->where('userID', $unlikeSID);
		$this->db->delete('likes');
		redirect('main/stories');
	}
	function requestConnection(){
		$_POST['acceptor'] = $this->uri->segment(3);
		$_POST['requestor'] = $this->session->userdata('userID');
		$_POST['is_confirm'] = 0;
		$this->db->insert("connection",$_POST);
		$_SESSION['message'] = "Connection is already sent!";
		$this->load->view("user_page");
	}
	function abortRequest(){
		$acceptor=$this->uri->segment(3);
		$requestor= $this->session->userdata('userID');
		$this->db->query("DELETE FROM connection where acceptor = '{$acceptor}' and requestor = '{$requestor}'");
		$_SESSION['message'] = "Connection is already ignored!";
		$this->load->view("user_page");
	}
	function ignoreRequest(){
		$requestor=$this->uri->segment(3);
		$acceptor = $this->session->userdata('userID');
		$this->db->query("DELETE FROM connection where acceptor = '{$acceptor}' and requestor = '{$requestor}'");
		$_SESSION['message'] = "Connection is already ignored!";
		$this->load->view("user_page");
	}
	function view_request(){
		$this->load->view('connections');
	}
	function request_confirm(){
		$requestor=$this->uri->segment(3);
		$acceptor = $this->session->userdata('userID');
		$this->db->query("UPDATE connection SET is_confirm = 1 where acceptor = '{$acceptor}' and requestor = '{$requestor}'");
		$_SESSION['message'] = "Accepted!";
		$acceptfname = $this->session->userdata('Fname');
		$acceptlname = $this->session->userdata('Lname');
		$subject = "NOTIFICATION";
		$body_message = "{$acceptfname} {$acceptlname} has already accepted your request";
		$this->db->query("INSERT INTO messages (sender, reciever, subject, body_message, is_read) VALUES (1,'{$requestor}','{$subject}','{$body_message}',0)");
		$this->load->view("connections");


	}
	function messages(){
		$this->load->view('messages');

	}
	function profile(){
		$this->load->view('profile');
	}
	function comments(){
		$_SESSION['storyID'] = $this->uri->segment(3);
		$this->load->view('comments');

	}
	function post_comment(){
		$sID = $_POST['storyID'];
		$this->db->insert('comments', $_POST);
		$_SESSION['storyID'] = $sID;
		$this->load->view('comments');
	}
	function delete_comment(){
		$cID = $this->uri->segment(3);
		$this->db->where('commentID', $cID);
		$this->db->delete('comments');
		redirect('main/stories');

	}
	function update_comment(){
		$sID = $_POST['storyID'];
		$cID = $this->uri->segment(3);
		$this->db->where('commentID', $cID);
		$this->db->update('comments', $_POST);
		$_SESSION['storyID'] = $sID;
		$this->load->view('comments');
	}
	function sent(){
		$this->load->view('sent');
	}
	function send_message(){
		$this->db->insert('messages', $_POST);
		redirect('main/messages','refresh');

	}
	function delete_message(){
		$delID = $this->uri->segment(3);
		$this->db->where('msgID', $delID);
		$this->db->delete('messages');
		redirect('main/messages');
	}
	function create_message(){
		$ndate = $_POST['time_read'];
		$nread = $_POST['is_read'];
		$sender = $_POST['sender'];
		$fname = $_POST['Fname'];
		$lname = $_POST['Lname'];
		$sub = $_POST['subject'];
		$bm = $_POST['body_message'];

		$verifyreciever = $this->db->query("SELECT * FROM users where Fname='{$fname}'and Lname ='{$lname}'");
		if ($verifyreciever->num_rows() > 0) {
			$rowr = $verifyreciever->row();
			$createMessage = array('sender' => $sender, 'reciever' =>$rowr->userID,'subject' => $sub, 'body_message' => $bm, 'is_read' => $nread, 'time_read' => $ndate);
			$this->db->insert('messages', $createMessage);
			$this->load->view('messages');

		}else {
			$_SESSION['message'] = "There is no account on that name";
			$this->load->view('messages');

		}
	}
	function statistics(){
		$this->load->view('statistics');
	}
	function events(){
		$this->load->view('events');
	}
	function load_events(){
		
	}
	function insert_events(){
		
	}
	function update_events(){
		 
	}
	function delete_event(){
		
	}

}

?>