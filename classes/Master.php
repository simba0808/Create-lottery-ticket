<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Shuchkin\SimpleXLSXGen;

require_once('../config.php');
ini_set('display_errors', 0);
//error_reporting(E_ALL);

Class Master extends DBConnection { 
	private $settings;

	protected static $cotas = [];

	public function __construct(){
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct(){
		parent::__destruct();
	}
	function capture_err(){
		if(!$this->conn->error)
			return false;
		else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			return json_encode($resp);
			exit;
		}
	}

	function add_to_card() {
		extract($_POST);
		$customer_id = $this->settings->userdata('id');

    // Limpar tabela cart_list para o cliente atual
		$delete = $this->conn->query("DELETE FROM `cart_list` WHERE customer_id = '{$customer_id}'");

		if ($delete) {
			$check = $this->conn->query("SELECT id FROM `cart_list` WHERE customer_id = '{$customer_id}' AND product_id = '{$product_id}'")->num_rows;

			if ($check > 0) {
				$update = $this->conn->query("UPDATE `cart_list` SET quantity = '{$qty}' WHERE customer_id = '{$customer_id}' AND product_id = '{$product_id}'");

				if ($update) {
					$resp['status'] = 'success';
				} else {
					$resp['status'] = 'failed';
					$resp['error'] = $this->conn->error;
				}
			} else {
				$insert = $this->conn->query("INSERT INTO `cart_list` (`customer_id`, `product_id`, `quantity`) VALUES ('{$customer_id}', '{$product_id}', '{$qty}')");

				if ($insert) {
					$resp['status'] = 'success';
				} else {
					$resp['status'] = 'failed';
					$resp['error'] = $this->conn->error;
				}
			}
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}

		if ($resp['status'] == 'success') {
        // #$this->settings->set_flashdata('success', 'Product has been added to cart.');
		}

		return json_encode($resp);
	}

	function place_order(){
		$customer_id = $this->settings->userdata('id');
		$customer_fname = $this->settings->userdata('firstname');
		$customer_lname = $this->settings->userdata('lastname');
		$customer_phone = $this->settings->userdata('phone');
		$customer_email = $this->settings->userdata('email');
		$customer_name = $customer_fname.' '.$customer_lname;
		$dateCreated = date('Y-m-d H:i:s');
		$product_id = $_POST['product_id'];
		$numbers = isset($_POST['numbers']) ? $_POST['numbers'] : '';
		$pref = date("Ymdhis.u");
		$code = uniqidReal();
		
		$order_token = md5($pref.$code);

		$cart_total = $this->conn->query("SELECT SUM(c.quantity * p.price) FROM `cart_list` c inner join product_list p on c.product_id = p.id where customer_id = '{$customer_id}' ")->fetch_array()[0];

		$stmt_plist = $this->conn->prepare("SELECT name, qty_numbers, limit_order_remove, type_of_draw FROM `product_list` WHERE id = ?");
		$stmt_plist->bind_param("i", $product_id);
		$stmt_plist->execute();
		$product_list = $stmt_plist->get_result();

		if ($product_list->num_rows > 0) {
			$product = $product_list->fetch_assoc();
			$product_name = $product["name"];
			$qty_numbers = $product["qty_numbers"];	
			$type_of_draw = $product["type_of_draw"]; 		
			$order_expiration = $product["limit_order_remove"];			
		}
        
     
		$quantity = $this->conn->query("SELECT SUM(c.quantity) FROM `cart_list` c inner join product_list p on c.product_id = p.id where customer_id = '{$customer_id}' ")->fetch_array()[0];		


		if(!$quantity){
			$resp['status'] = 'failed';
			$resp['error'] = 'Erro ao criar pedido.'; 
			return json_encode($resp);
			exit;
		}

		##VERIFICA SE A CAMPANHA TEM LIMITE DE PEDIDO
		$limitOrder = 0;
		$customerOrders = 0;

		//OBTER LIMITE DE PEDIDOS DA CAMPANHA
		$limitOrdersQuery = $this->conn->query("SELECT limit_orders FROM product_list WHERE id = '{$product_id}'");
		if ($limitOrdersQuery && $limitOrdersQuery->num_rows > 0) {
			$limitOrder = $limitOrdersQuery->fetch_assoc();
			$limitOrder = $limitOrder['limit_orders'];
		}

		//OBTER COMPRAS DO USUÁRIO
		$customerOrdersQuery = $this->conn->query("SELECT id FROM order_list WHERE customer_id = '{$customer_id}' AND product_id = '{$product_id}'");
		if ($customerOrdersQuery && $customerOrdersQuery->num_rows > 0) {
			$customerOrders = $customerOrdersQuery->num_rows;
		}

		if ($limitOrder != 0){
			if ($customerOrders >= $limitOrder){
				$resp['status'] = 'failed';
				$resp['error'] = 'Você atingiu o limite de pedido(s) para essa campanha.'; 
				return json_encode($resp);
				exit;
			}
		}

		#OBTEM A QUANTIDADE DE NÚMEROS PENDENTES DO SORTEIO E ATUALIZA A QUANTIDADE DE VENDAS PENDENTES: pending_numbers		
		$query = "SELECT pending_numbers, discount_qty, enable_discount, discount_amount, enable_cumulative_discount, enable_sale, sale_qty, sale_price, status, qty_numbers, pending_numbers, paid_numbers, date_of_draw FROM product_list WHERE id = '{$product_id}'";
		$result = $this->conn->query($query);
		if ($result && $result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$pending_numbers = $row['pending_numbers'];
			$discount_qty = $row['discount_qty'];
			$enable_discount = $row['enable_discount'];
			$enable_cumulative_discount = $row['enable_cumulative_discount'];
			$discount_amount = $row['discount_amount'];
			$enable_sale = $row['enable_sale'];
			$sale_qty = $row['sale_qty'];
			$sale_price = $row['sale_price'];
			$qt_numbers = $row['qty_numbers'];
			$status = $row['status'];
			$paid_n = $row['paid_numbers'];
			$pending_n = $row['pending_numbers'];
			$date_of_draw = $row['date_of_draw'];
		}

        $totalSales = $paid_n + $pending_n;

		if($status > 1){
			$resp['status'] = 'failed';
			$resp['error'] = 'Campanha pausada ou finalizada.';   
			return json_encode($resp);
			exit;
		}

		if($totalSales >= $qty_numbers){
			$this->conn->query("UPDATE product_list SET status = '2', status_display = '6' WHERE id = '{$product_id}'");
			$resp['status'] = 'failed';
			$resp['error'] = 'Camnpanha pausada ou finalizada.';   
			return json_encode($resp);
			exit;
		}
        
        if($date_of_draw){
			$expirationTime = date('Y-m-d H:i:s', strtotime($date_of_draw));

			$currentDateTime = date('Y-m-d H:i:s');

			if ($currentDateTime > $expirationTime) {
				$resp['status'] = 'failed';
				$resp['error'] = 'Compra não permitida. A campanha foi pausada ou finalizada.';   
				return json_encode($resp);
				exit; 
			}
        }
        
		$total_pending_numbers = ($pending_n + $quantity);
		$total_paid_numbers = ($paid_n + $quantity);

		$total_amount = $cart_total > 0 ? $cart_total : 0;
        
        $pay_status = 1;

		if($total_amount == 0){
			$pay_status = 2;
			$this->conn->query("UPDATE product_list SET paid_numbers = '{$total_paid_numbers}' WHERE id = '{$product_id}'");
		} else {
			$this->conn->query("UPDATE product_list SET pending_numbers = '{$total_pending_numbers}' WHERE id = '{$product_id}'");
		}
		
        #FIM OBTEM A QUANTIDADE DE NÚMEROS PENDENTES DO SORTEIO E ATUALIZA A QUANTIDADE DE VENDAS PENDENTES: pending_numbers	

		$order_discount_amount = '';
		if ($enable_discount && $discount_amount) {
			$discount_qty = json_decode($discount_qty, true);
			$discount_amount = json_decode($discount_amount, true);
			$discounts = [];

			foreach ($discount_qty as $qty_index => $qty) {
				foreach ($discount_amount as $amount_index => $amount) {
					if ($qty_index === $amount_index) {
						$discounts[$qty_index] = [
							'qty' => $qty,
							'amount' => $amount
						];
					}
				}
			}

			if ($enable_cumulative_discount == 1) {
                // Calcular o desconto acumulativo
				$accumulative_discount = 0;
				$remaining_quantity = $quantity;

                // Ordenar os descontos em ordem decrescente de quantidade
				usort($discounts, function($a, $b) {
					return $b['qty'] - $a['qty'];
				});

				foreach ($discounts as $discount) {
					if ($remaining_quantity >= $discount['qty']) {
						$multiples = floor($remaining_quantity / $discount['qty']);
						$discount_amount = $multiples * $discount['amount'];
						$accumulative_discount += $discount_amount;
						$remaining_quantity -= ($multiples * $discount['qty']);
					}
				}

               // Aplicar o desconto acumulativo ao valor total
				if ($accumulative_discount > 0) {
					$total_amount -= $accumulative_discount;
					$order_discount_amount = $accumulative_discount;
				}
			} else {
              // Aplicar apenas o desconto normal
				usort($discounts, function($a, $b) {
					return $b['qty'] - $a['qty'];
				});
				foreach ($discounts as $discount) {
					if ($quantity >= $discount['qty']) {
						$total_amount -= $discount['amount'];
						$order_discount_amount = $discount['amount'];
						break;
					}
				}
			}
		}

		#SALE
		if($enable_sale == 1 && $enable_discount == 0 && $quantity >= $sale_qty){
			$order_discount_amount = $total_amount - $quantity * $sale_price;	
			$total_amount = $quantity * $sale_price;

		}
		#SALE

		$order_numbers = '';

		$insert = $this->conn->query("INSERT INTO `order_list` (`code`, `customer_id`, `product_name`, `quantity`, `status`, `total_amount`, `order_token`, `order_numbers`, `product_id`, `order_expiration`, `discount_amount`, `date_created`) VALUES ('{$code}', '{$customer_id}', '{$product_name}', '{$quantity}', '{$pay_status}', '{$total_amount}', '{$order_token}', '{$order_numbers}', '{$product_id}', '{$order_expiration}', '{$order_discount_amount}', '{$dateCreated}') ");

		if($insert){
			$oid = $this->conn->insert_id;

			$data = "";
			$sql_cart = "SELECT c.*,
			p.name AS product,
			p.price,
			p.image_path
			FROM `cart_list` c
			INNER JOIN product_list p ON c.product_id = p.id
			WHERE customer_id = '{$customer_id}'";

			$cart = $this->conn->query($sql_cart);
			$qty_numbers = $qty_numbers - 1;

			$total_numbers_generated = $quantity;
			$use_manual_numbers = false; 
            if($type_of_draw > 1){
            	$use_manual_numbers = true; 
            }

            $orders = $this->conn->query("SELECT order_numbers FROM order_list WHERE product_id = '{$product_id}'");
			$cotas_vendidas = array();
			$all_lucky_numbers = [];
			while ($row = $orders->fetch_assoc()) {
	        	$cotas_vendidas[] = $row['order_numbers'];
            }

			$all_lucky_numbers = implode(',', $cotas_vendidas);
            $all_lucky_numbers = explode(',', $all_lucky_numbers);

			$cotas_vendidas = array_filter($cotas_vendidas);

            if ($use_manual_numbers) {

				##

			} else {
				echo "<script>alert('BBB');</script>";
				#Utilizar geração aleatória de números
				self::set_quotes($cotas_vendidas);

				$globos = strlen($qty_numbers);
				$list_numbers = range(1, $qty_numbers);
				
				shuffle($list_numbers);

				$free_numbers = array_slice(array_diff($list_numbers, self::$cotas), 0, $total_numbers_generated);

				$order_numbers = array_map(function ($item) use ($qty_numbers, $globos) {
									return str_pad($item, max((int)$globos, strlen($qty_numbers)), "0", STR_PAD_LEFT);
								}, $free_numbers);

				$qtd2 = count(self::$cotas); //quantidade de cotas já geradas

				if ((($total_numbers_generated + $qtd2) - 1) > $qty_numbers ){
					$resp['status'] = 'failed';
					$resp['error'] = '[DP01] - Erro ao criar pedido, selecione uma quantidade menor.';
					$this->conn->query("DELETE FROM `order_list` where code = '{$code}'");
					$this->conn->query("UPDATE `product_list` SET `pending_numbers` = `pending_numbers` - '{$total_numbers_generated}' WHERE `id` = '{$product_id}'");
					return json_encode($resp);
				}

				$order_numbers = implode(",", $order_numbers) . ',';

				$update = $this->conn->query("UPDATE `order_list` SET `order_numbers` = '{$order_numbers}' WHERE `code` = '{$code}'");
			}

			#FIM GERAR NÚMEROS ALEATÓRIOS


			while($row = $cart->fetch_assoc()):
				if(!empty($data)) $data .= ", ";
				$data .= "('{$oid}', '{$row['product_id']}', '{$row['quantity']}', '{$row['price']}')";
			endwhile;

			if(!empty($data)){
				$sql = "INSERT INTO order_items (`order_id`, `product_id`, `quantity`, `price`) VALUES {$data}";
				$save = $this->conn->query($sql);
				if($save){
								#$resp['redirect'] = '/compra/'.$order_token.'';
					$resp['status'] = 'success';
					$this->conn->query("DELETE FROM `cart_list` where customer_id = '{$customer_id}'");
				}else{
					$resp['status'] = 'failed';
					$resp['error'] = $this->conn->error;
					$this->conn->query("DELETE FROM `order_list` where id = '{$oid}'");
				}
			} else{
				$resp['status'] = 'success';
			}

			} else {
				$resp['status'] = 'failed';
				$resp['error'] = $this->conn->error;
			}

			if($resp['status'] == 'success'){
				$resp['redirect'] = '/compra/'.$order_token.'';
						//#$this->settings->set_flashdata('success', 'Order has been placed successfully.');
			}

			if ($status == 1){
				$query = $this->conn->query("SELECT SUM(quantity) as quantity FROM order_list WHERE product_id = '{$product_id}'");
				if ($query && $query->num_rows > 0) {
					$row = $query->fetch_assoc();
					$quantidade = $row['quantity'];
					if ($quantidade >= ($qty_numbers + 1)){
						$this->conn->query("UPDATE product_list SET status = '3', status_display = '6' WHERE id = '{$product_id}'");
					}
				}
			}
				
		return json_encode($resp);
		//$main_lock_released = gaia_release_lock($main_lock_data);
		//exit();
	}

	protected static function set_quotes($items = []){
		if ($items) {
            foreach ($items as $item) {
                $cota_formatada = explode(',', preg_replace('/\s+/', '', $item));
                $cota_formatada = array_map(function ($cota) {
                    return ltrim($cota, '0');
                }, $cota_formatada);

                self::$cotas = array_merge(self::$cotas, $cota_formatada);
            }
            
            self::$cotas = array_filter(self::$cotas);
        }
	}


}

$Master = new Master();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$sysset = new SystemSettings();
switch ($action) {

	case 'add_to_card':
	echo $Master->add_to_card();
	break;

	case 'place_order':
	echo $Master->place_order();
	break;

	default:
		// echo $sysset->index();
	break;
}