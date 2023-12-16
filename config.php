<?php
ob_start();
ini_set('date.timezone','America/Sao_Paulo');
date_default_timezone_set('America/Sao_Paulo');
session_start();

require_once('initialize.php');
require_once('classes/DBConnection.php');
require_once('classes/SystemSettings.php');

$db = new DBConnection;
$conn = $db->conn;

if(!defined('APP_NAME')) define('APP_NAME', 'DROPE');
if(!defined('APP_VERSION')) define('APP_VERSION', '1.3.1');
if(!defined('DEV_NAME')) define('DEV_NAME', 'Drope');
if(!defined('DEV_URL')) define('DEV_URL', 'https://dropestore.com');
if(!defined('SUPPORT_URL')) define('SUPPORT_URL', 'https://dropestore.com/suporte');

function exibir_cabecalho($conn) {
    global $_settings;
    $titulo_site = $_settings->info('name');
    $description = "";
    $image_path = '';
    // Verifique se estamos na página do produto (supondo que você tenha o ID do produto disponível na variável $_GET['id'])
    if (isset($_GET['id'])) {
        $id_produto = $_GET['id'];               
        // Obtenha os dados do produto com base no ID
        $qry = $conn->query("SELECT * from `product_list` where slug = '$id_produto'");

        // Verifique se a consulta retornou resultados
        if ($qry && $qry->num_rows > 0) {
            $row = $qry->fetch_assoc();
            $nome_produto = $row['name'];
            $image_path = validate_image($row['image_path']);
            $description = $row['description'];
            // Atualize o título da página com o nome do produto
            $titulo_pagina = "$nome_produto - $titulo_site";
        } else {
            $url = $_SERVER['REQUEST_URI'];
            if (strpos($url, '/compra/') !== false) {
                $titulo_pagina = "Checkout - $titulo_site";
            }else{
               $titulo_pagina = $titulo_site;

           } 
       }
   } else {
        // Obtenha o caminho da URL
    $url = $_SERVER['REQUEST_URI'];
    $titulo_pagina = $titulo_site;

    if (strpos($url, '/user/compras') !== false) {
        $titulo_pagina = "Compras - $titulo_site";
    } 

    if (strpos($url, '/cadastrar') !== false) {
        $titulo_pagina = "Faça seu cadastro - $titulo_site";
    } 

    if (strpos($url, '/user/atualizar-cadastro') !== false) {
        $titulo_pagina = "Atualizar cadastro - $titulo_site";
    } 

    if (strpos($url, '/meus-numeros') !== false) {
        $titulo_pagina = "Meus números - $titulo_site";
    } 
    if (strpos($url, '/campanhas') !== false) {
        $titulo_pagina = "Campanhas - $titulo_site";
    } 

    if (strpos($url, '/concluidas') !== false) {
        $titulo_pagina = "Concluídas - $titulo_site";
    } 

    if (strpos($url, '/em-breve') !== false) {
        $titulo_pagina = "Em breve - $titulo_site";
    } 

    if (strpos($url, '/ganhadores') !== false) {
        $titulo_pagina = "Ganhadores - $titulo_site";
    } 

    if (strpos($url, '/termos-de-uso') !== false) {
        $titulo_pagina = "Termos de utilização - $titulo_site";
    } 

    if (strpos($url, '/contato') !== false) {
        $titulo_pagina = "Contato - $titulo_site";
    } 

    if (strpos($url, '/alterar-senha') !== false) {
        $titulo_pagina = "Alterar senha - $titulo_site";
    } 

    if (strpos($url, '/recuperar-senha') !== false) {
        $titulo_pagina = "Recuperação de senha - $titulo_site";
    } 

}

    // Define a descrição da página


    // Define as metatags OpenGraph
$metatags = array(
    'og:title' => $titulo_pagina,
    'og:description' => $description,
    'og:image' => $image_path,
    'og:image:type' => 'image/jpeg',
    'og:image:width' => '',
    'og:image:height' => '',
        // Adicione outras metatags OpenGraph aqui, se necessário
);

    // Exibe as tags do cabeçalho
echo "<title>$titulo_pagina</title>\n";
echo "<meta name='description' content='$description'>\n";

    // Exibe as metatags OpenGraph
foreach ($metatags as $key => $value) {
    echo "<meta property='$key' content='$value'>\n";
}
}

function formatPhoneNumber($phoneNumber) {
    // Remover todos os caracteres que não sejam dígitos
    $phoneNumber =  $phoneNumber ? preg_replace("/[^0-9]/", "", $phoneNumber) : "";

    // Formatar o número de telefone no formato desejado
    $formattedPhoneNumber = "(" . substr($phoneNumber, 0, 2) . ") " . substr($phoneNumber, 2, 5) . "-" . substr($phoneNumber, 7);

    return $formattedPhoneNumber;
}

function redirect($url=''){
	if(!empty($url))
     echo '<script>location.href="'.BASE_URL .$url.'"</script>';
}

function drope_format_luck_numbers_dashboard($client_lucky_numbers, $raffle_total_numbers, $class, $opt, $type_of_draw) {
    $bichos = array();
    if($type_of_draw == 3){
        $bichos = array(
            "00" => "Avestruz",
            "01" => "Águia",
            "02" => "Burro",
            "03" => "Borboleta",
            "04" => "Cachorro",
            "05" => "Cabra",
            "06" => "Carneiro",
            "07" => "Camelo",
            "08" => "Cobra",
            "09" => "Coelho",
            "10" => "Cavalo",
            "11" => "Elefante",
            "12" => "Galo",
            "13" => "Gato",
            "14" => "Jacaré",
            "15" => "Leão",
            "16" => "Macaco",
            "17" => "Porco",
            "18" => "Pavão",
            "19" => "Peru",
            "20" => "Touro",
            "21" => "Tigre",
            "22" => "Urso",
            "23" => "Veado",
            "24" => "Vaca"
        );
    } 
    if($type_of_draw == 4){
        $bichos = array(
            "00" => "Avestruz M1",
            "01" => "Avestruz M2",
            "02" => "Águia M1",
            "03" => "Águia M2",
            "04" => "Burro M1",
            "05" => "Burro M2",
            "06" => "Borboleta M1",
            "07" => "Borboleta M2",
            "08" => "Cachorro M1",
            "09" => "Cachorro M2",
            "10" => "Cabra M1",
            "11" => "Cabra M2",
            "12" => "Carneiro M1",
            "13" => "Carneiro M2",
            "14" => "Camelo M1",
            "15" => "Camelo M2",
            "16" => "Cobra M1",
            "17" => "Cobra M2",
            "18" => "Coelho M1",
            "19" => "Coelho M2",
            "20" => "Cavalo M1",
            "21" => "Cavalo M2",
            "22" => "Elefante M1",
            "23" => "Elefante M2",
            "24" => "Galo M1",
            "25" => "Galo M2",
            "26" => "Gato M1",
            "27" => "Gato M2",
            "28" => "Jacaré M1",
            "29" => "Jacaré M2",
            "30" => "Leão M1",
            "31" => "Leão M2",
            "32" => "Macaco M1",
            "33" => "Macaco M2",
            "34" => "Porco M1",
            "35" => "Porco M2",
            "36" => "Pavão M1",
            "37" => "Pavão M2",
            "38" => "Peru M1",
            "39" => "Peru M2",
            "40" => "Touro M1",
            "41" => "Touro M2",
            "42" => "Tigre M1",
            "43" => "Tigre M2",
            "44" => "Urso M1",
            "45" => "Urso M2",
            "46" => "Veado M1",
            "47" => "Veado M2",
            "48" => "Vaca M1",
            "49" => "Vaca M2"
        );  
    }

    if ($client_lucky_numbers) {      
        $client_lucky_numbers = explode(',', $client_lucky_numbers);
        $result = '';
        sort($client_lucky_numbers);
        foreach ($client_lucky_numbers as $client_lucky_number) {
            if (!empty($client_lucky_number)) {
                if ($type_of_draw == 3 || $type_of_draw == 4) {
                    $bicho_name = $bichos[$client_lucky_number];
                    if($class === false){
                    $result .= ''.$bicho_name.', ';
                    }else{
                    $result .= ''.$bicho_name.'<span class="comma-hide">, </span>';
                    }   
                } else {
                    $output = ($type_of_draw == 3 || $type_of_draw == 4) ? $bichos[$client_lucky_number] : $client_lucky_number;
                    if ($opt == true) {
                        $result .= '<a class="alert-success" style="border-radius: 5px !important; display: inline-block; padding: 5px; border-radius:2px; margin: 4px;">'.$output.'</a>'; 
                    } else {
                        $result .= ''.$output.',';   
                    }
                }
            }
        }
    } else {
        $result =  '...';
    }

    return $result;
}

function validate_image($file){
    global $_settings;
    if(!empty($file)){
			// exit;
        $ex = explode("?",$file);
        $file = $ex[0];
        $ts = isset($ex[1]) ? "?".$ex[1] : '';
        if(is_file(BASE_APP.$file)){
           return BASE_URL.$file.$ts;
       }else{
            return BASE_URL . "assets/img/no_image.jpg";
       }
   }else{
      return BASE_URL . "assets/img/no_image.jpg";
  }
}

function format_num($number = '', $decimal = '', $decimalSeparator = ',', $thousandsSeparator = '.'){
    if(is_numeric($number)){
        $ex = explode(".", $number);
        $decLen = isset($ex[1]) ? strlen($ex[1]) : 0;
        
        if(is_numeric($decimal)){
            return number_format($number, $decimal, $decimalSeparator, $thousandsSeparator);
        } else {
            return number_format($number, $decLen, $decimalSeparator, $thousandsSeparator);
        }
    } else {
        return "Invalid Input";
    }
}

function blockHTML($replStr){
    return html_entity_decode($replStr);
}

function uniqidReal($lenght = 13) {
    if (function_exists("random_bytes")) {
        $bytes = random_bytes(ceil($lenght / 2));
    } elseif (function_exists("openssl_random_pseudo_bytes")) {
        $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
    } else {
        throw new Exception("no cryptographically secure random function available");
    }
    return substr(bin2hex($bytes), 0, $lenght);
}

ob_end_flush();
?>