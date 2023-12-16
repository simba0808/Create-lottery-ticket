<?php 
$enable_hide_numbers = $_settings->info('enable_hide_numbers');
if(isset($_GET['id']) && $_GET['id'] > 0){
  $qry = $conn->query("SELECT *  from `order_list` where order_token = '{$_GET['id']}'");
  if($qry->num_rows > 0){
    foreach($qry->fetch_assoc() as $k => $v){
      $$k=$v;
   }
   $customer_id = $customer_id;

   }else{
      echo "<script>alert('Você não tem permissão para acessar essa página.'); 
      location.replace('/');</script>";
      exit;	
   }
}else{
	echo "<script>alert('Você não tem permissão para acessar essa página.'); 
   location.replace('/');</script>";
   exit;
}
?>
<div class="app-main container">
   <div class="compra-status">
      <?php if($status == '1'){ ?>
         <div class="app-alerta-msg mb-2">
            <i class="app-alerta-msg--icone bi bi-check-circle text-warning"></i>
            <div class="app-alerta-msg--txt">
               <h3 class="app-alerta-msg--titulo">Aguardando pagamento!</h3>
               <p>Finalize o pagamento via PIX</p>
            </div>
         </div>
      <?php } ?>

      <?php if($status == '2'){ ?>
         <div class="app-alerta-msg mb-2">
            <i class="app-alerta-msg--icone bi bi-check-circle text-success"></i>
            <div class="app-alerta-msg--txt">
               <h3 class="app-alerta-msg--titulo">Compra aprovada!</h3>
               <p>Agora é só torcer!</p>
            </div>
         </div>
      <?php } ?>

      <?php if($status == '3'){ ?>
         <div class="app-alerta-msg mb-2">
            <i class="app-alerta-msg--icone bi bi-x-circle" style="color: red;"></i>
            <div class="app-alerta-msg--txt">
               <h3 class="app-alerta-msg--titulo">Pedido cancelado!</h3>
               <p>O prazo para pagamento do seu pedido expirou.</p>
            </div>
         </div>
      <?php } ?>

      <hr class="my-2">
   </div>
   <?php if($status == '1'){ ?>
      <div class="compra-pagamento">
         <div class="pagamentoQrCode text-center">
            <div class="pagamento-rapido">
               <div class="app-card card rounded-top rounded-0 shadow-none border-bottom">
                  <div class="card-body">
                     <div class="pagamento-rapido--progress">
                      <div class="d-flex justify-content-center align-items-center mb-1 font-md">
                       <div><small>Você tem</small></div>
                       <div class="mx-1"><b class="font-md" id="tempo-restante"></b></div>
                       <div><small>para pagar</small></div>
                    </div>
                    <div class="progress bg-dark bg-opacity-50">
                       <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="barra-progresso"></div>
                    </div>
                 </div>                  

              </div>
           </div>
        </div>
        <div class="app-card card rounded-bottom rounded-0 rounded-bottom b-1 border-dark mb-2">
         <div class="card-body">
            <div class="row justify-content-center mb-2">
               <div class="col-12 text-start">
                  <div class="mb-1"><span class="badge bg-success badge-xs">1</span><span class="font-xs"> Copie o código PIX abaixo.</span></div>
                  <div class="input-group mb-2">
                     <input id="pixCopiaCola" type="text" class="form-control" value="<?= $pix_code; ?>">
                     <div class="input-group-append">
                        <button onclick="copyPix()" class="app-btn btn btn-success rounded-0 rounded-end">Copiar</button>
                     </div>
                  </div>
                  <div class="mb-2"><span class="badge bg-success">2</span> <span class="font-xs">Abra o app do seu banco e escolha a opção PIX, como se fosse fazer uma transferência.</span></div>
                  <p><span class="badge bg-success">3</span> <span class="font-xs">Selecione a opção PIX cópia e cola, cole a chave copiada e confirme o pagamento.</span></p>
               </div>
               <div class="col-12 my-2">
                  <p class="alert alert-warning p-2 font-xss" style="text-align: justify;">Este pagamento só pode ser realizado dentro do tempo, após este período, caso o pagamento não for confirmado os números voltam a ficar disponíveis.</p>
               </div>
               <!--
               <div class="col-12">
                  <a href="">
                     <button class="app-btn btn btn-success btn-sm" disabled=""><i class="bi bi-check-all"></i> Já fiz o pagamento</button>
                  </a>
               </div>
               -->
            </div>

            <div style="background-image: url('../assets/img/bg-btn-qr.png'); text-align: center;"><input id="btmqr" class="btn-qr"
               type="button" value="Mostrar QR Code" onclick="mostraqr()"></div>
            <div id="exibeqr" class="hidden" style="display: none;">
               <div class="input-group-append">
                  <table style="width:100%">
                        <tbody>
                           <tr>
                              <td style="width:50%; vertical-align: middle;"><b>QR Code</b>
                                 <spam class="font-xs m-0"><br>Acesse ao app do seu banco e escolha a opção <b>Pagar com QR Code</b>, scaneie o código ao lado e confirme o pagamento.</spam>
                              </td>
                              <td>
                                 <div id="img-qrcode" class="d-inline-block bg-white rounded">
                                    <img src="https://chart.googleapis.com/chart?chs=290x290&amp;cht=qr&amp;chl=<?= $pix_code; ?>&amp;chld=H%7C1" class="img-fluid">
                                 </div>
                              </td>
                           </tr>
                        </tbody>
                  </table>
               </div>
            </div>
            <!--
            <style>
               .help:hover {
                  background: var(--incrivel-primariaDarken);
               }
            </style>
            <div style="text-align-last: justify;">
               <a class="btn-qr mt-3 help" href="javascript:window.location.href=window.location.href">Já realizei o pagamento</a>
               <a class="btn-qr mt-3 help" href="/contato">Estou com problemas</a>
            </div>
            -->
         </div>
      </div>
      <!--
      <div class="alert alert-info p-2 font-xss mb-2"><i class="bi bi-info-circle"></i> Após o pagamento aguarde até 5 minutos para a confirmação, caso já tenha efetuado o pagamento, clique no botão <b>Já fiz o pagamento</b>.</div>
      -->
   </div>
</div>
<?php } ?>
</div>

<script>
  function copyPix() {
    var copyText = document.getElementById("pixCopiaCola");

    copyText.select();
    copyText.setSelectionRange(0, 99999); 

    document.execCommand("copy");
    navigator.clipboard.writeText(copyText.value);

    alert("Chave pix 'Copia e Cola' copiada com sucesso!");
 }   

 function mostraqr() {
if (document.getElementById('exibeqr').style.display == 'block'){
document.getElementById('exibeqr').style.display = 'none';
document.getElementById('btmqr').value="Mostrar QR Code";
}
else { document.getElementById('exibeqr').style.display = "block";
document.getElementById('btmqr').value="Ocultar QR Code";
}
}

 $(document).ready(function() {
  var tempoInicial = parseInt('<?= $order_expiration; ?>'); 
  var token = '<?= isset($order_token) ? $order_token : '' ?>';
  var progressoMaximo = 100;
  var tempoRestante;

  if (localStorage.getItem(token)) {
    tempoRestante = parseInt(localStorage.getItem(token));
 } else {
    tempoRestante = tempoInicial * 60;
    localStorage.setItem(token, tempoRestante);
 }

 var intervalo = setInterval(function() {
    var minutos = Math.floor(tempoRestante / 60);
    var segundos = tempoRestante % 60;
    var tempoFormatado = minutos.toString().padStart(2, '0') + ':' + segundos.toString().padStart(2, '0');    
    $('#tempo-restante').text(tempoFormatado);
    var progresso = ((tempoInicial * 60 - tempoRestante) / (tempoInicial * 60)) * progressoMaximo;
    $('#barra-progresso').css('width', progresso + '%').attr('aria-valuenow', progresso);
    tempoRestante--;
    localStorage.setItem(token, tempoRestante);
    if (tempoRestante < 0) {
      clearInterval(intervalo);
      localStorage.removeItem(token);
   }
}, 1000);

<?php if($status == 1){ ?>
 setInterval(function() {
  var check = {
   order_token: '<?= $order_token ?>',         
};
$.ajax({
   type: 'POST',
   url:_base_url_+"classes/Master.php?f=check_order_status",
   //dataType: 'json',
   data: check,

   success:function(resp){
      var returnedData = JSON.parse(resp);
      if(returnedData.status == '2'){         
         location.reload();
      } else if(returnedData.status == '3'){         
         location.reload();
      }
   },
});
}, 3000);
<?php } ?>  
     
});

</script>