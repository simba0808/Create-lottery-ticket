<?php

if (isset($_GET['id']) && $_GET['id'] > 0) {
  $qry = $conn->query("SELECT * from `product_list` where slug = '{$_GET['id']}' ");
  if ($qry->num_rows > 0) {
    foreach ($qry->fetch_assoc() as $k => $v) {
      $$k = $v;
    }
  } else {
    echo "<script>
            alert('Você não tem permissão para acessar essa página.'); 
            location.replace('./');
          </script>";
    exit;
  }
} else {
  echo "<script>
          alert('Você não tem permissão para acessar essa página.');
          location.replace('./');
        </script>";
  exit;
}

$totalNumbers = $paid_numbers + $pending_numbers;
$percentage = (($totalNumbers / $qty_numbers) * 100);
if (($percentage >= 85) && $status == 1 && $status_display != 2){
  $updateStatusStatements = $conn->query("UPDATE product_list SET status_display = '2' WHERE id = '{$id}'");
}

if ($date_of_draw) {
  $expirationTime = date('Y-m-d H:i:s', strtotime($date_of_draw));
  $currentDateTime = date('Y-m-d H:i:s');

  if ($currentDateTime > $expirationTime) {
    $selectStatement = "SELECT * FROM product_list WHERE id = '{$id}'";
    $selectResult = $conn->query($selectStatement);
    if ($selectResult->num_rows > 0) {
      $updatePendingStatements = $conn->query("UPDATE product_list SET status = '3', status_display = '4' WHERE id = '{$id}'");
    }
  }
}

if ($type_of_draw == '1') { #Automático
  require_once('automatic.php');
}

if ($type_of_draw == '2') { #Normal
  require_once('numbers.php');
}

if ($type_of_draw == '3') { # Fazendinha Inteira
  require_once('farm.php');
}
if ($type_of_draw == '4') { # Fazendinha Metade
  require_once('half-farm.php');
}

?>