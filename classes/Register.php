<?php
require_once '../config.php';

class Login extends DBConnection {
	private $settings;
	public function __construct(){
		global $_settings;
		$this->settings = $_settings;

		parent::__construct();
		//alterado drope
		ini_set('display_error', 0);
	}
	public function __destruct(){
		parent::__destruct();
	}
	public function index(){
		echo "<h1>Access Denied</h1> <a href='".BASE_URL."'>Go Back.</a>";
	}
	public function regsiter(){
		extract($_POST);

		$stmt = $this->conn->prepare("SELECT * from users where username = ? and password = ? ");
		$password = md5($password);
		$stmt->bind_param('ss',$username,$password);
		$stmt->execute();
		$result = $stmt->get_result();
		if($result->num_rows > 0){
			foreach($result->fetch_array() as $k => $v){
				if(!is_numeric($k) && $k != 'password'){
					$this->settings->set_userdata($k,$v);
				}

			}
			$this->settings->set_userdata('login_type',1);
		return json_encode(array('status'=>'success'));
		}else{
		return json_encode(array('status'=>'incorrect','last_qry'=>"SELECT * from users where username = '$username' and password = md5('$password') "));
		}
	}
	public function logout(){
		if($this->settings->sess_des()){
			redirect('admin/login.php');
		}
	}
   
    if ($this->conn->error) {
        $resp['status'] = 'failed';
        $resp['_error'] = $this->conn->error;
    }
    
    return json_encode($resp);
}


public function logout_customer(){
	if($this->settings->sess_des()){
					$currentPath = $_SERVER['REQUEST_URI'];
					$redirect_url = preg_replace("/.*\?\/([^\/]+)/", "$1", $currentPath);            
					if($currentPath == '/logout?/'){
					header('Location: /');
					exit;
					}else{
					redirect($redirect_url);
					exit;	
					}
		
	}
	$enable_password = $_settings->info('enable_password');	
	$_POST['phone'] = preg_replace("/[^0-9]/", "", $_POST['phone']);
	extract($_POST);
	$phone = preg_replace("/[^0-9]/", "", $phone);
	$stmt = $this->conn->prepare("SELECT * from customer_list where phone = ?");

	$stmt->bind_param('s', $phone);
	$stmt->execute();
	$result = $stmt->get_result();
	
	if ($result->num_rows > 0) {
			$res = $result->fetch_array();
			
			if ($enable_password == 1) {
					if ($res['password'] !== md5($password)) {
							$resp['status'] = 'failed';
							$resp['msg'] = 'Incorrect Password';
					} else {
							foreach ($res as $k => $v) {
									$this->settings->set_userdata($k, $v);
							}
							$this->settings->set_userdata('login_type', 2);
							$resp['status'] = 'success';
					}
			} elseif ($enable_password == 2) {
					foreach ($res as $k => $v) {
							$this->settings->set_userdata($k, $v);
					}
					$this->settings->set_userdata('login_type', 2);
					$resp['status'] = 'success';
			} else {
					$resp['status'] = 'failed';
					$resp['msg'] = 'Invalid Login Configuration';
			}
	} else {
			$resp['status'] = 'failed';
			$resp['msg'] = 'Incorrect Phone Number';
	}
	
	if ($this->conn->error) {
			$resp['status'] = 'failed';
			$resp['_error'] = $this->conn->error;
	}
}

	public function logout_customer(){
		if($this->settings->sess_des()){
            $currentPath = $_SERVER['REQUEST_URI'];
            $redirect_url = preg_replace("/.*\?\/([^\/]+)/", "$1", $currentPath);            
            if($currentPath == '/logout?/'){
            header('Location: /');
            exit;
            }else{
            redirect($redirect_url);
            exit;	
            }
			
		}
		$enable_password = $_settings->info('enable_password');	
    $_POST['phone'] = preg_replace("/[^0-9]/", "", $_POST['phone']);
    extract($_POST);
    $phone = preg_replace("/[^0-9]/", "", $phone);
    $stmt = $this->conn->prepare("SELECT * from customer_list where phone = ?");

    $stmt->bind_param('s', $phone);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $res = $result->fetch_array();
        
        if ($enable_password == 1) {
            if ($res['password'] !== md5($password)) {
                $resp['status'] = 'failed';
                $resp['msg'] = 'Incorrect Password';
            } else {
                foreach ($res as $k => $v) {
                    $this->settings->set_userdata($k, $v);
                }
                $this->settings->set_userdata('login_type', 2);
                $resp['status'] = 'success';
            }
        } elseif ($enable_password == 2) {
            foreach ($res as $k => $v) {
                $this->settings->set_userdata($k, $v);
            }
            $this->settings->set_userdata('login_type', 2);
            $resp['status'] = 'success';
        } else {
            $resp['status'] = 'failed';
            $resp['msg'] = 'Invalid Login Configuration';
        }
    } else {
        $resp['status'] = 'failed';
        $resp['msg'] = 'Incorrect Phone Number';
    }
    
    if ($this->conn->error) {
        $resp['status'] = 'failed';
        $resp['_error'] = $this->conn->error;
    }
	}

$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$auth = new Login();
switch ($action) {
	case 'login':
		echo $auth->login();
		break;
	case 'logout':
		echo $auth->logout();
		break;
	case 'login_customer':
		echo $auth->login_customer();
		break;
	case 'logout_customer':
		echo $auth->logout_customer();
		break;
		case 'login':
			echo $auth->login();
			break;
		case 'logout':
			echo $auth->logout();
			break;
		case 'login_customer':
			echo $auth->login_customer();
			break;
		case 'logout_customer':
			echo $auth->logout_customer();
			break;
	default:
		echo $auth->index();
		break;
}

