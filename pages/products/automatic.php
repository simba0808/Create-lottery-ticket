<div id="overlay">
 <div class="cv-spinner">
  <div class="card" style="border:none; padding:10px;background: transparent;color: #fff !important;font-weight: 800;">
  <span class="spinner mb-2" style="align-self:center;"></span>
   <div class="text-center font-xs">
      Estamos gerando seu pedido, aguarde...
   </div>
</div>
</div>
</div>
<?php
$paid_and_pending = $pending_numbers + $paid_numbers;
$available = intval($qty_numbers) - $paid_and_pending;
$percent = ($paid_and_pending * 100 / $qty_numbers);
$enable_share = $_settings->info('enable_share');
$enable_groups = $_settings->info('enable_groups');
$telegram_group_url = $_settings->info('telegram_group_url');
$whatsapp_group_url = $_settings->info('whatsapp_group_url');
$support_number = $_settings->info('phone');
$max_discount = 0;
if($min_purchase > $available){
   $min_purchase = $available;
}
$enable_cpf = $_settings->info('enable_cpf');
if ($enable_cpf == 1){
   $search_type = 'search_orders_by_cpf';
} else {
   $search_type = 'search_orders_by_phone';
}
?>
<style>
.carousel,.carousel-inner,.carousel-item{position:relative}#overlay,.carousel-item{width:100%;display:none}@media (min-width:1200px){h3{font-size:1.75rem}}p{margin-top:0;margin-bottom:1rem}img{vertical-align:middle}button{border-radius:0;margin:0;font-family:inherit;font-size:inherit;line-height:inherit;text-transform:none}button:focus:not(:focus-visible){outline:0}[type=button],button{-webkit-appearance:button}.form-control-color:not(:disabled):not([readonly]),.form-control[type=file]:not(:disabled):not([readonly]),[type=button]:not(:disabled),[type=reset]:not(:disabled),[type=submit]:not(:disabled),button:not(:disabled){cursor:pointer}::-moz-focus-inner{padding:0;border-style:none}::-webkit-datetime-edit-day-field,::-webkit-datetime-edit-fields-wrapper,::-webkit-datetime-edit-hour-field,::-webkit-datetime-edit-minute,::-webkit-datetime-edit-month-field,::-webkit-datetime-edit-text,::-webkit-datetime-edit-year-field{padding:0}::-webkit-inner-spin-button{height:auto}::-webkit-search-decoration{-webkit-appearance:none}::-webkit-color-swatch-wrapper{padding:0}::-webkit-file-upload-button{font:inherit;-webkit-appearance:button}::file-selector-button{font:inherit;-webkit-appearance:button}.container-fluid{--bs-gutter-x:1.5rem;--bs-gutter-y:0;width:100%;padding-right:calc(var(--bs-gutter-x) * .5);padding-left:calc(var(--bs-gutter-x) * .5);margin-right:auto;margin-left:auto}.form-control::file-selector-button{padding:.375rem .75rem;margin:-.375rem -.75rem;-webkit-margin-end:.75rem;margin-inline-end:.75rem;color:#212529;background-color:#e9ecef;pointer-events:none;border:0 solid;border-inline-end-width:1px;border-radius:0;transition:color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;border-color:inherit}.form-control:hover:not(:disabled):not([readonly])::-webkit-file-upload-button{background-color:#dde0e3}.form-control:hover:not(:disabled):not([readonly])::file-selector-button{background-color:#dde0e3}.form-control-sm::file-selector-button{padding:.25rem .5rem;margin:-.25rem -.5rem;-webkit-margin-end:.5rem;margin-inline-end:.5rem}.form-control-lg::file-selector-button{padding:.5rem 1rem;margin:-.5rem -1rem;-webkit-margin-end:1rem;margin-inline-end:1rem}.form-floating>.form-control-plaintext:not(:-moz-placeholder-shown),.form-floating>.form-control:not(:-moz-placeholder-shown){padding-top:1.625rem;padding-bottom:.625rem}.form-floating>.form-control:not(:-moz-placeholder-shown)~label{opacity:.65;transform:scale(.85) translateY(-.5rem) translateX(.15rem)}.input-group>.form-control:not(:focus).is-valid,.input-group>.form-floating:not(:focus-within).is-valid,.input-group>.form-select:not(:focus).is-valid,.was-validated .input-group>.form-control:not(:focus):valid,.was-validated .input-group>.form-floating:not(:focus-within):valid,.was-validated .input-group>.form-select:not(:focus):valid{z-index:3}.input-group>.form-control:not(:focus).is-invalid,.input-group>.form-floating:not(:focus-within).is-invalid,.input-group>.form-select:not(:focus).is-invalid,.was-validated .input-group>.form-control:not(:focus):invalid,.was-validated .input-group>.form-floating:not(:focus-within):invalid,.was-validated .input-group>.form-select:not(:focus):invalid{z-index:4}.btn:focus-visible{color:var(--bs-btn-hover-color);background-color:var(--bs-btn-hover-bg);border-color:var(--bs-btn-hover-border-color);outline:0;box-shadow:var(--bs-btn-focus-box-shadow)}.btn-check:focus-visible+.btn{border-color:var(--bs-btn-hover-border-color);outline:0;box-shadow:var(--bs-btn-focus-box-shadow)}.btn-check:checked+.btn:focus-visible,.btn.active:focus-visible,.btn.show:focus-visible,.btn:first-child:active:focus-visible,:not(.btn-check)+.btn:active:focus-visible{box-shadow:var(--bs-btn-focus-box-shadow)}.btn-link:focus-visible{color:var(--bs-btn-color)}.carousel-inner{width:100%;overflow:hidden}.carousel-inner::after{display:block;clear:both;content:""}.carousel-item{float:left;margin-right:-100%;-webkit-backface-visibility:hidden;backface-visibility:hidden;transition:transform .6s ease-in-out}.carousel-item.active{display:block}.carousel-control-next,.carousel-control-prev{position:absolute;top:0;bottom:0;z-index:1;display:flex;align-items:center;justify-content:center;width:15%;padding:0;color:#fff;text-align:center;background:0 0;border:0;opacity:.5;transition:opacity .15s}.carousel-control-next:focus,.carousel-control-next:hover,.carousel-control-prev:focus,.carousel-control-prev:hover{color:#fff;text-decoration:none;outline:0;opacity:.9}.carousel-control-prev{left:0}.carousel-control-next{right:0}.carousel-control-next-icon,.carousel-control-prev-icon{display:inline-block;width:2rem;height:2rem;background-repeat:no-repeat;background-position:50%;background-size:100% 100%}.carousel-control-prev-icon{background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23fff'%3e%3cpath d='M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z'/%3e%3c/svg%3e")}.carousel-control-next-icon{background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23fff'%3e%3cpath d='M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e")}.carousel-indicators{position:absolute;right:0;bottom:0;left:0;z-index:2;display:flex;justify-content:center;padding:0;margin-right:15%;margin-bottom:1rem;margin-left:15%;list-style:none}.carousel-indicators [data-bs-target]{box-sizing:content-box;flex:0 1 auto;width:30px;height:3px;padding:0;margin-right:3px;margin-left:3px;text-indent:-999px;cursor:pointer;background-color:#fff;background-clip:padding-box;border:0;border-top:10px solid transparent;border-bottom:10px solid transparent;opacity:.5;transition:opacity .6s}@media (prefers-reduced-motion:reduce){.form-control::file-selector-button{transition:none}.carousel-control-next,.carousel-control-prev,.carousel-indicators [data-bs-target],.carousel-item{transition:none}}.carousel-indicators .active{opacity:1}.visually-hidden-focusable:not(:focus):not(:focus-within){position:absolute!important;width:1px!important;height:1px!important;padding:0!important;margin:-1px!important;overflow:hidden!important;clip:rect(0,0,0,0)!important;white-space:nowrap!important;border:0!important}.d-block{display:block!important}.mt-3{margin-top:1rem!important}.sorteio_sorteioShare__247_t{position:fixed;bottom:120px;right:12px;display:-moz-box;display:flex;-moz-box-orient:vertical;-moz-box-direction:normal;flex-direction:column}.top-compradores{display:flex;flex-wrap:wrap;margin-bottom:20px;margin-top:20px}.comprador{margin-right:3px;margin-bottom:8px;border:1px solid #198754;padding:22px;text-align:center;margin-left:10px;background:#fff;border-radius:6px;min-width:160px}.ranking{margin-bottom:5px;font-weight:700;font-size:18px}.customer-details{text-transform:uppercase;font-weight:700;font-size:14px}#overlay{position:fixed;top:0;height:100%;background:rgba(0,0,0,.8);z-index:99999999}.cv-spinner{height:100%;display:flex;justify-content:center;align-items:center}.spinner{width:40px;height:40px;border:4px solid #ddd;border-top:4px solid #2e93e6;border-radius:50%;animation:.8s linear infinite sp-anime}@keyframes sp-anime{100%{transform:rotate(360deg)}}.is-hide{display:none}
</style>
<div class="container app-main">
   <div class="campanha-header mb-2">
      <div class="SorteioTpl_sorteioTpl__2s2Wu SorteioTpl_destaque__3vnWR  pointer">
         <div class="SorteioTpl_imagemContainer__2-pl4">
            <div id="carouselSorteio640d0a84b1fef407920230311" class="carousel slide carousel-dark carousel-fade"
               data-bs-ride="carousel">
               <div class="carousel-inner">
                  <?php
                  $image_gallery = isset($image_gallery) ? $image_gallery : '';

                  if ($image_gallery != '[]' && !empty($image_gallery)) {
                     $image_gallery = json_decode($image_gallery, true);
                     array_unshift($image_gallery, $image_path);
                     ?>
                     <?php $slide = 0;
                     foreach ($image_gallery as $image) {
                        $slide++; ?>
                        <div class="carousel-item <?php if ($slide == 1) { echo 'active';} ?>" style="width:100%;height:310px">
                           <img alt="<?= isset($name) ? $name : "" ?>" src="<?php echo BASE_URL ?><?= $image; ?>" decoding="async" data-nimg="fill" class="SorteioTpl_imagem__2GXxI">
                        </div>
                     <?php } ?>
                  <?php } else { ?>
                     <div class="carousel-item active" style="height:310px;">
                        <img src="<?= validate_image(isset($image_path) ? $image_path : '') ?>" alt="<?= isset($name) ? $name : '' ?>" class="SorteioTpl_imagem__2GXxI" style="width:100%">
                     </div>
                  <?php } ?>
               </div>
            </div>
            <?php if ($image_gallery != '[]' && !empty($image_gallery)) { ?>
               <button class="carousel-control-prev" type="button"
                  data-bs-target="#carouselSorteio640d0a84b1fef407920230311" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon"></span>
               </button>
               <button class="carousel-control-next" type="button"
                  data-bs-target="#carouselSorteio640d0a84b1fef407920230311" data-bs-slide="next">
                  <span class="carousel-control-next-icon"></span>
               </button>
            <?php } ?>
         </div>
         <div class="SorteioTpl_info__t1BZr">
            <?php if ($status_display == 1) { ?>
               <span class="badge bg-success blink bg-opacity-75">Adquira já!</span>
            <?php } ?>
            <?php if ($status_display == 2) { ?>
               <span class="badge bg-dark blink mobile badge-status-1">Corre que está acabando!</span>
            <?php } ?>
            <?php if ($status_display == 3) { ?>
               <span class="badge bg-dark mobile badge-status-3">Aguarde a campanha!</span>
            <?php } ?>
            <?php if ($status_display == 4) { ?>
               <span class="badge bg-dark">Concluído</span>
            <?php } ?>
            <?php if ($status_display == 5) { ?>
               <span class="badge bg-dark">Em breve!</span>
            <?php } ?>
            <?php if($status_display == 6){ ?>
               <span class="badge bg-dark">Aguarde o sorteio!</span>
            <?php } ?>
            <h1 class="SorteioTpl_title__3RLtu">
               <?= isset($name) ? $name : "" ?>
            </h1>
            <p class="SorteioTpl_descricao__1b7iL" style="margin-bottom: 1px;">
               <?php echo isset($subtitle) ? $subtitle : ''; ?>
            </p>
         </div>
      </div>
   </div>

<div class="campanha-buscas">
   <div class="row row-gutter-sm">
      <div class="col">
         <?php if($status_display != '4' && $status_display != '5'){ ?>
            <div class="btn btn-sm btn-success box-shadow-08 w-100" data-bs-toggle="modal" data-bs-target="#modal-consultaCompras">
               <i class="bi bi-cart"></i> Ver meus números
            </div>
         <?php } ?>
         <div>
           <?php if($percent > 0 && $enable_progress_bar == 1){ ?>
            <div class="progress mt-2">
               <div class="progress-bar bg-info progress-bar-striped fw-bold progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
               <div class="progress-bar bg-success progress-bar-striped fw-bold progress-bar-animated" role="progressbar" aria-valuenow="<?= number_format($percent, 2, '.', ''); ?>" aria-valuemin="0" aria-valuemax="<?= $qty_numbers; ?>" style="width: <?= number_format($percent, 2, '.', ''); ?>%;"><?= number_format($percent, 2, '.', ''); ?>%</div>
            </div>
         <?php } ?>
      </div>
   </div>
</div>
</div>

<?php if($status == '1'){ ?>
<div class="campanha-preco porApenas font-xs d-flex align-items-center justify-content-center mt-2 mb-2 font-weight-500">
   <div class="item d-flex align-items-center font-xs me-2">
      <?php if (!empty($date_of_draw)){ ?>
         <span class="ms-2 me-1">Campanha</span>
         <div class="tag btn btn-sm bg-white bg-opacity-50 font-xss box-shadow-08">
            <?php
               $dataFormatada = date('d/m/y', strtotime($date_of_draw));
               $horaFormatada = date('H\hi', strtotime($date_of_draw));
               $date_of_draw = $dataFormatada . ' às ' . $horaFormatada;
               echo $date_of_draw;
            ?> 
         </div>
      <?php } ?>
   </div>
   <div class="item d-flex align-items-center font-xs">
      <div class="me-1">por apenas</div>
      <div class="tag btn btn-sm bg-cor-primaria text-cor-primaria-link box-shadow-08">R$ <?= isset($price) ? format_num($price,2) : "" ?></div>
   </div>
</div>
<?php } ?>

<?php if($status == '1'){ ?>
<div class="app-card card mb-2">
   <div class="card-body text-center">
   <p class="text-muted font-xs">Quanto mais comprar, maiores são as suas chances de ganhar!</p>
   </div>
</div>
<?php } ?>

<?php if($status_display == '6'){ ?>
<div class="alert alert-warning font-xss mb-2 mt-2">Todos os números já foram reservados ou pagos</div>
<?php } ?>

<?php 
      $discount_qty = isset($discount_qty) ? $discount_qty : ''; 
      $discount_amount = isset($discount_amount) ? $discount_amount : ''; 

      if($discount_qty && $discount_amount && $enable_discount == 1){ 
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
 if(isset($discounts)){
   $max_discount = count($discounts);
}else{
   $max_discount = 0;
}

?>

<?php if($status == '1'){ ?>
<div class="app-promocao-numeros mb-2">
   <div class="app-title mb-2">
      <h1>📣 Promoção</h1>
      <div class="app-title-desc">Compre mais barato!</div>
   </div>
   <div class="app-card card">
      <div class="card-body pb-1">
         <div class="row px-2">
          <?php $count = 0; foreach($discounts as $discount){ ?>
            <div class="col-auto px-1 mb-2">
               <button onclick="qtyExpress('<?= $discount['qty']; ?>', true);" class="btn btn-success w-100 btn-sm py-0 px-2 text-nowrap font-xss"><span class="font-weight-500">
                  <b class="font-weight-600"><span id="discount_qty_<?= $count; ?>"><?= $discount['qty']; ?></span></b> <small>por R$</small> <span class="font-weight-600"><span id="discount_amount_<?= $count; ?>" style="display:none"><?= $discount['amount']; ?></span>
                  <?php 
                  $discount_price = $price * $discount['qty'] - $discount['amount']; 
                  echo number_format($discount_price, 2, ',', '.'); 
               ?></span></span></button>
            </div>
            <?php $count++; } ?>
         </div>
      </div>
   </div>
</div>
<?php } ?>
<?php } ?>

<?php if($enable_sale == 1 && $enable_discount == 0 && $status == '1'){ ?>
 <div class="app-promocao-numeros mb-2">
   <div class="app-title mb-2">
      <h1>📣 Promoção</h1>
      <div class="app-title-desc">Compre mais barato!</div>
   </div>
   <div class="app-card card">
      <div class="card-body pb-1">
         <div class="row px-2">
            <div class="col-auto px-1 mb-2">
               <button onclick="qtyExpress('<?= $sale_qty; ?>', false);" class="btn btn-success w-100 btn-sm py-0 px-2 text-nowrap font-xss"><span class="font-weight-500">Comprando
                  <b class="font-weight-600"><span><?= $sale_qty; ?> cotas</span></b> sai por apenas<small> R$</small> <span class="font-weight-600">
                     <?php 
                     echo number_format($sale_price, 2, ',', '.'); 
                  ?></span> cada</span></button>
               </div>
            </div>
         </div>
      </div>
   </div>
<?php } ?> 

<?php if (($paid_and_pending < $qty_numbers) && ($status == '1')){ ?>
   <div class="app-vendas-express mb-2">
      
   <div class="numeros-select d-flex align-items-center justify-content-center flex-column">
    <div class="vendasExpressNumsSelect v2">
         <div onclick="qtyExpress(10, false);" class="item mb-2">
            <div class="item-content flex-column p-2">
                <h3 class="mb-0"><small class="item-content-plus font-xsss">+</small>10</h3>
                <p class="item-content-txt font-xss text-uppercase mb-0">Selecionar</p>
            </div>
        </div>
        <div onclick="qtyExpress(20, false);" class="item mb-2">
            <div class="item-content flex-column p-2">
                <h3 class="mb-0"><small class="item-content-plus font-xsss">+</small>20</h3>
                <p class="item-content-txt font-xss text-uppercase mb-0">Selecionar</p>
            </div>
        </div>
        <div onclick="qtyExpress(50, false);" class="item mb-2 mais-popular">
            <div class="item-content flex-column p-2">
                <h3 class="mb-0"><small class="item-content-plus font-xsss">+</small>50</h3>
                <p class="item-content-txt font-xss text-uppercase mb-0" style="color:#fff;">Selecionar</p>
            </div>
        </div>
        <div onclick="qtyExpress(100, false);" class="item mb-2">
            <div class="item-content flex-column p-2">
                <h3 class="mb-0"><small class="item-content-plus font-xsss">+</small>100</h3>
                <p class="item-content-txt font-xss text-uppercase mb-0">Selecionar</p>
            </div>
        </div>
        <div onclick="qtyExpress(200, false);" class="item mb-2">
            <div class="item-content flex-column p-2">
                <h3 class="mb-0"><small class="item-content-plus font-xsss">+</small>200</h3>
                <p class="item-content-txt font-xss text-uppercase mb-0">Selecionar</p>
            </div>
        </div>
        <div onclick="qtyExpress(300, false);" class="item mb-2">
            <div class="item-content flex-column p-2">
                <h3 class="mb-0"><small class="item-content-plus font-xsss">+</small>300</h3>
                <p class="item-content-txt font-xss text-uppercase mb-0">Selecionar</p>
            </div>
        </div>
    </div>

    <div class="vendasExpressNums app-card card mb-2 w-100 font-xs">
        <div class="card-body d-flex align-items-center justify-content-center font-xss p-1">
            <div class="left pointer">
               <div class="removeNumero numeroChange text-muted"><i class="bi bi-dash-circle"></i></div>
            </div>
            <div class="center">
               <input class="form-control text-center qty" readonly value="<?= isset($min_purchase) ? $min_purchase : "" ?>" aria-label="Quantidade de números" placeholder="<?= isset($min_purchase) ? $min_purchase : "" ?>">
            </div>
            <div class="right pointer">
               <div class="addNumero numeroChange text-muted"><i class="bi bi-plus-circle"></i></div>
            </div>
        </div>
    </div>
</div>

      <?php if($user_id){ ?>
         <button id="add_to_cart" data-bs-toggle="modal" data-bs-target="#modal-checkout" class="btn btn-success w-100 py-3">
         <?php }else{ ?>
            <span id="add_to_cart"></span>
            <button data-bs-toggle="modal" data-bs-target="#loginModal" class="btn btn-success w-100 py-3">
            <?php } ?>
            <div class="row align-items-center" style="line-height: 85%;">
               <div class="col pe-0 text-nowrap"><i class="bi bi-check2-circle me-1"></i><span>Quero participar</span></div>
               <div class="col-auto ps-0">
                  <div class="pe-3">
                     <div><span id="total">R$ 
                        <?php if(isset($price)){                        
                         $price_total = $price * $min_purchase;                 
                         echo format_num($price_total,2);
                      } ?>                     
                   </span></div>
                </div>
             </div>
          </div>
       </button>

    </div>
<?php } ?>

<?php if(!empty($draw_number)){ ?>
   <?php 
   $winners_qty = 5; 
   $draw_number = isset($draw_number) ? $draw_number : ''; 

   if($winners_qty && $draw_number){ 
      $draw_winner = json_decode($draw_winner, true);
      $draw_number = json_decode($draw_number, true);
      $winners = [];
      foreach ($draw_winner as $qty_index => $name) {
         foreach ($draw_number as $amount_index => $number) {
            if ($qty_index === $amount_index) {
               $winners[$qty_index] = [
                  'name' => $name,
                  'number' => $number
               ];
            }
         }
      }
     }
      ?>
     $orders = $conn->query($find_orders_query)->num_rows;
             if ($orders == 1){
               ?>
                  <div class="col-auto px-1 mb-2 text-center">
                     <button title="Indisponível" class="btn btn-danger w-100 btn-sm py-0 px-2 text-nowrap font-xss"><span class="font-weight-500">
                        <?php 
                        echo ($cotas_premiadas);
                     ?></span></span></button>
                  </div>
               <?php
             } else {
               ?>
                  <div class="col-auto px-1 mb-2 text-center">
                     <button title="Disponív- XZpel" class="btn btn-success w-100 btn-sm py-0 px-2 text-nowrap font-xss"><span class="font-weight-500">
                        <?php 
                        echo ($cotas_premiadas);
                     ?></span></span></button>
                  </div>
               <?php
             }
             $orders = $conn->query($find_orders_query)->num_rows;
             if ($orders == 1){
               ?>
                  <div class="col-auto px-1 mb-2 text-center">
                     <button title="Indisponível" class="btn btn-danger w-100 btn-sm py-0 px-2 text-nowrap font-xss"><span class="font-weight-500">
                        <?php 
                        echo ($cotas_premiadas);
                     ?></span></span></button>
                  </div>
               <?php
             } else {
               ?>
                  <div class="col-auto px-1 mb-2 text-center">
                     <button title="Disponív- XZpel" class="btn btn-success w-100 btn-sm py-0 px-2 text-nowrap font-xss"><span class="font-weight-500">
                        <?php 
                        echo ($cotas_premiadas);
                     ?></span></span></button>
                  </div>
               <?php
             }
             $orders = $conn->query($find_orders_query)->num_rows;
             if ($orders == 1){
               ?>
                  <div class="col-auto px-1 mb-2 text-center">
                     <button title="Indisponível" class="btn btn-danger w-100 btn-sm py-0 px-2 text-nowrap font-xss"><span class="font-weight-500">
                        <?php 
                        echo ($cotas_premiadas);
                     ?></span></span></button>
                  </div>
               <?php
             } else {
               ?>
                  <div class="col-auto px-1 mb-2 text-center">
                     <button title="Disponív- XZpel" class="btn btn-success w-100 btn-sm py-0 px-2 text-nowrap font-xss"><span class="font-weight-500">
                        <?php 
                        echo ($cotas_premiadas);
                     ?></span></span></button>
                  </div>
               <?php
             }
<?php } ?>

<div class="app-card card font-xs mb-2 sorteio_sorteioDesc__TBYaL">
   <div class="card-body sorteio_sorteioDescBody__3n4ko">
      <?= isset($description) ? blockHTML($description) : '' ?>
   </div>
</div>
   

<?php if($status == '1'){ ?>
<?php if (($cotas_premiadas)){
   $cotas_premiada = explode(",", $cotas_premiadas);
   ?>
   <div class="app-promocao-numeros flex-column mb-2">
   <div class="app-title mb-2">
      <h1>🔥 Cotas premiadas</h1>
      <div class="app-title-desc">Achou ganhou!</div>
   </div>
   <div class="app-card card">
      <div class="card-body pb-1">

         <div class="row px-2">
          <?php $count = 0; foreach($cotas_premiada as $cotas_premiadas){ ?>
            <?php
             //$find_orders_query = "SELECT id FROM order_list  WHERE product_id={$id} AND order_numbers REGEXP '" . $cotas_premiadas. "'";
             $find_orders_query = "SELECT id
             FROM order_list USE INDEX (order_list_index)
             WHERE product_id = {$id} AND CONCAT(',', order_numbers, ',') LIKE '%,{$cotas_premiadas},%';";

             $orders = $conn->query($find_orders_query)->num_rows;
             if ($orders == 1){
               ?>
                  <div class="col-auto px-1 mb-2 text-center">
                     <button title="Indisponível" class="btn btn-danger w-100 btn-sm py-0 px-2 text-nowrap font-xss"><span class="font-weight-500">
                        <?php 
                        echo ($cotas_premiadas);
                     ?></span></span></button>
                  </div>
               <?php
             } else {
               ?>
                  <div class="col-auto px-1 mb-2 text-center">
                     <button title="Disponív- XZpel" class="btn btn-success w-100 btn-sm py-0 px-2 text-nowrap font-xss"><span class="font-weight-500">
                        <?php 
                        echo ($cotas_premiadas);
                     ?></span></span></button>
                  </div>
               <?php
             }
            ?>
            <?php $count++; } ?>
            <hr style="margin-bottom:5px;">
            <span style="font-size: 0.75rem;"><?= $cotas_premiadas_descricao;?></span>
         </div>
      </div>
   </div>
</div>
<?php }} ?>

<?php if($enable_ranking > 0){ ?>
   <div class="app-title mb-2">
      <h1>🏆 Ranking</h1>
      <?php if($ranking_message){ ?>
      <br><div class="app-title-desc"><?= $ranking_message; ?></div>
   <?php } ?>
   </div>
   
   <div class="top-compradores" style="background:#fff;padding: 20 0 10 10;border-radius:10px;margin-top:0px;margin-bottom:10px;">
      <?php
      $requests = $conn->query("
        SELECT c.firstname, SUM(o.quantity) AS total_quantity
        FROM order_list o
        INNER JOIN customer_list c ON o.customer_id = c.id
        WHERE o.product_id = {$id} AND o.status = 2
        GROUP BY o.customer_id
        ORDER BY total_quantity DESC
        LIMIT {$ranking_qty}
        ");



      $count = 0; while ($row = $requests->fetch_assoc()) {
       $count++;
       if ($count == 1){
         $medal = '🥇';
       } elseif ($count == 2) {
         $medal = '🥈';
       } elseif ($count == 3){
         $medal = '🥉';
       } else {
         $medal = '👤';
       }
       ?>
      
      <div class="item-content flex-column" style="max-width:32.7%;min-width:32.7%;">
         <div class="text-center customer-details" style="border:1px solid;padding:10px;border-radius:5px;margin:5px;">
            <span style="font-size:20px;"><?= $medal ?></span><br>
            <span class="ganhador-name"><?= $row['firstname'] ?></span>
            <?php if($enable_ranking_show == 1){ ?>
               <p class="font-xss mb-0"><?= $row['total_quantity'] ?> COTAS</p>
            <?php } ?>
         </div>
      </div>
   <?php } ?>
      
   </div>

<?php } ?>


<div class="modal fade" id="modal-consultaCompras">
   <div class="modal-dialog modal-md">
      <div class="modal-content">
         <form id="consultMyNumbers">
            <div class="modal-header">
               <h6 class="modal-title">Consulta de compras</h6>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <div class="form-group">
               <?php if ($enable_cpf != 1){ ?>
                  <label class="form-label">Informe seu telefone</label>
                  <div class="input-group mb-2">
                     <input onkeyup="formatarTEL(this);" maxlength="15" class="form-control" aria-label="Número de telefone" maxlength="15" id="phone" name="phone" required="" value="">
                     <button class="btn btn-secondary" type="submit" id="button-addon2">
                        <div class=""><i class="bi bi-check-circle"></i></div>
                     </button>
                  </div>
               <?php } else { ?>
                  <label class="form-label">Informe seu CPF</label>
                  <div class="input-group mb-2">
                     <input name="cpf" class="form-control" id="cpf" value="" maxlength="14" minlength="14" placeholder="000.000.000-00" oninput="formatarCPF(this.value)" required>
                     <button class="btn btn-secondary" type="submit" id="button-addon2">
                        <div class=""><i class="bi bi-check-circle"></i></div>
                     </button>
                  </div>
               <?php } ?>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
<!-- Modal checkout -->
<div class="modal fade" id="modal-checkout">
   <div class="modal-dialog modal-fullscreen-sm-down modal-dialog-centered">
      <div class="modal-content rounded-0">
         <span class="d-none">Usuário não autenticado</span>
         <div class="modal-header">
            <h5 class="modal-title">Checkout</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body checkout">
            <div class="alert alert-info p-2 mb-2 font-xs"><i class="bi bi-check-circle"></i> Você está adquirindo<span class="font-weight-500">&nbsp;<span id="qty_cotas"></span> cotas</span><span>&nbsp;da ação entre amigos</span><span class="font-weight-500">&nbsp;<?= isset($name) ? $name : "" ?></span>,<span>&nbsp;seus números serão gerados</span><span>&nbsp;assim que concluir a compra.</span></div>
            <div class="mb-3">
               <div class="card app-card">
                  <div class="card-body">
                     <div class="row align-items-center">
                        <div class="col-auto">
                           <div class="rounded-pill p-1 bg-white box-shadow-08" style="width: 56px; height: 56px; position: relative; overflow: hidden;">
                              <div style="display: block; overflow: hidden; position: absolute; inset: 0px; box-sizing: border-box; margin: 0px;">
                                 <img src="<?php echo validate_image($_settings->userdata('avatar')) ?>" decoding="async" data-nimg="fill" style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;">
                                 <noscript></noscript>
                              </div>
                           </div>
                        </div>
                        <div class="col">
                           <h5 class="mb-1"><?= $_settings->userdata('firstname'); ?> <?= $_settings->userdata('lastname'); ?></h5>
                           <div class="text-muted"><small><?php echo formatPhoneNumber($_settings->userdata('phone')); ?></small></div>
                        </div>
                        <div class="col-auto"><i class="bi bi-chevron-compact-right"></i></div>
                     </div>
                  </div>
               </div>
            </div>
            <button id="place_order" class="btn btn-success w-100 mb-2">Concluir reserva <i class="bi bi-arrow-right-circle"></i></button>
            <button type="button" class="btn btn-link btn-sm text-secondary text-decoration-none w-100 my-2"><a href="<?php echo BASE_URL.'logout?'.$_SERVER['REQUEST_URI']; ?>">Utilizar outra conta</a></button>




         </div>
      </div>
   </div>
</div>
<!-- Modal checkout -->


<!-- Modal Aviso -->
<button id="aviso_sorteio" data-bs-toggle="modal" data-bs-target="#modal-aviso" class="btn btn-success w-100 py-2" style="display:none"></button>
<div class="modal fade" id="modal-aviso">
   <div class="modal-dialog modal-fullscreen-sm-down modal-dialog-centered">
      <div class="modal-content rounded-0">
         <div class="modal-header">
            <h5 class="modal-title">Aviso</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body checkout">
            <div class="alert alert-danger p-2 mb-2 font-xs aviso-content">


            </div>
         </div>
      </div>
   </div>
</div>
<!-- Modal Aviso -->


<div class="modal fade" id="modal-indique">
   <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Indique e ganhe!</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body text-center">Faça login para ter seu link de indicao, e ganhe at 0,00% de créditos nas compras aprovadas!</div>
      </div>
   </div>
</div>
<?php if($enable_groups == 1){ ?>
   <div class="sorteio_sorteioShare__247_t" style="z-index:10;">
      <div class="campanha-share d-flex mb-1 justify-content-between align-items-center">
            <?php if($enable_share == 1){ ?>
               <div class="item d-flex align-items-center">
                  <a href="https://www.facebook.com/sharer/sharer.php?u=<?= BASE_URL; ?>campanha/<?= $slug; ?>" target="_blank">
                     <div alt="Compartilhe no Facebook" class="sorteio_sorteioShareLinkFacebook__2McKU" style="margin-right:5px;">
                        <i class="bi bi-facebook"></i>
                     </div>
                  </a>

                  <a href="https://t.me/share/url?url=<?= BASE_URL; ?>campanha/<?= $slug; ?>text=<?= $name; ?>" target="_blank">
                     <div alt="Compartilhe no Telegram" class="sorteio_sorteioShareLinkTelegram__3a2_s" style="margin-right:5px;">
                        <i class="bi bi-telegram"></i>
                     </div>
                  </a>

                  <a href="https://www.twitter.com/share?url=<?= BASE_URL; ?>campanha/<?= $slug; ?>" target="_blank">
                     <div alt="Compartilhe no Twitter" class="sorteio_sorteioShareLinkTwitter__1E4XC" style="margin-right:5px;">
                        <i class="bi bi-twitter"></i>
                     </div>
                  </a>

                  <a href="https://api.whatsapp.com/send/?text=<?= $name; ?>%21%21%3A+<?= BASE_URL; ?>campanha/<?= $slug; ?>&type=custom_url&app_absent=0" target="_blank"><div alt="Compartilhe no WhatsApp" class="sorteio_sorteioShareLinkWhatsApp__2Vqhy"><i class="bi bi-whatsapp"></i></div></a>
               </div>
            <?php } ?>
         </div>
      <?php if($whatsapp_group_url){ ?>
         <a href="<?= $whatsapp_group_url; ?>" target="_blank">   
            <div class="whatsapp-grupo">
               <div class="btn btn-sm btn-success mb-1 w-100"><i class="bi bi-whatsapp"></i> Grupo</div>
            </div>
         </a>
      <?php } ?>
      <?php if($telegram_group_url){ ?>
         <a href="<?= $telegram_group_url; ?>" target="_blank">
            <div class="telegram-grupo">
               <div class="btn btn-sm btn-info btn-block text-white mb-1 w-100"><i class="bi bi-telegram"></i> Telegram</div>
            </div>
         </a>
      <?php } ?>
      <?php if ($support_number) { ?>
         <a href="https://api.whatsapp.com/send?phone=55<?= $support_number; ?>" target="_blank">   
            <div class="suporte">
               <div class="btn btn-sm btn-warning mb-1 w-100"><i class="bi bi-headset"></i></i> Suporte</div>
            </div>
         </a>
      <?php } ?>
   </div>
<?php } ?>
</div>


<script>
  $(function(){
    $('#add_to_cart').click(function(){
      add_cart();
   })
    $('#place_order').click(function(){
      place_order();
   })

    $(".addNumero").click(function() {
       let value = parseInt($(".qty").val());
       value++;
       $(".qty").val(value);

       calculatePrice(value);

    })

    $(".removeNumero").click(function() {
       let value = parseInt($(".qty").val());
       if (value <= 1) {
         value = 1;
      } else {
         value--;
      }
      $(".qty").val(value);
      calculatePrice(value);
   })

    function place_order(){
      $('#overlay').fadeIn(300);
      $.ajax({
        url:_base_url_+'classes/Master.php?f=place_order',
        method:'POST',
        data:{product_id: parseInt("<?= isset($id) ? $id :'' ?>")},
        dataType:'json',
        error:err=>{
          console.log(err)          
       },
       success:function(resp){
          if(resp.status == 'success'){ 
           location.replace(resp.redirect)
        } else{
            alert(resp.error);
            location.reload();
         }
      } 
      })
   }

})
  function formatCurrency(total) {
    var decimalSeparator = ',';
    var thousandsSeparator = '.';

  var formattedTotal = total.toFixed(2); // Define 2 casas decimais
  
  // Substitui o ponto pelo separador decimal desejado
  formattedTotal = formattedTotal.replace('.', decimalSeparator);
  
  // Formata o separador de milhar
  var parts = formattedTotal.split(decimalSeparator);
  parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousandsSeparator);
  
  // Retorna o valor formatado
  return parts.join(decimalSeparator);
}



function calculatePrice(qty){   
 let price = '<?= $price; ?>'; 
 let enable_sale = parseInt('<?= $enable_sale; ?>');
 let sale_qty = parseInt('<?= $sale_qty; ?>');
 let sale_price = '<?= $sale_price; ?>';

 let available = parseInt('<?= $available; ?>');
 let total = price * qty;  
 var max = parseInt('<?= isset($max_purchase) ? $max_purchase : "" ?>');
 var min = parseInt('<?= isset($min_purchase) ? $min_purchase : "" ?>');

 if (qty > available) {
    //calculatePrice(available);   
    //alert('Há apenas : ' + available + ' cotas disponíveis no momento.');
    $('.aviso-content').html('Há apenas : ' + available + ' cotas disponíveis no momento.');
    $('#aviso_sorteio').click();
    $(".qty").val(available);
     //total = price * available;
     //$('#total').html('R$ '+formatCurrency(total)+'');
    calculatePrice(available); 
    return; 
 } 

 if (qty < min) {
   // calculatePrice(min);   
    //alert('A quantidade mínima de cotas é de: ' + min + '');
    $('.aviso-content').html('A quantidade mínima de cotas é de: ' + min + '');
    $('#aviso_sorteio').click();
    $(".qty").val(min);
    total = price * min; 
    calculatePrice(min);
     //$('#total').html('R$ '+formatCurrency(total)+'');
    return; 
 } 

 if(qty > max){
    //alert('A quantidade máxima de cotas é de: ' + max + '');
   $('.aviso-content').html('A quantidade máxima de cotas é de: ' + max + '');
   $('#aviso_sorteio').click();
   $(".qty").val(max); 
   total = price * max;
   calculatePrice(max);
   //$('#total').html('R$ '+formatCurrency(total)+'');
   return;
}
// Desconto acumulativo
var qtd_desconto = parseInt('<?= $max_discount; ?>');

let dropeDescontos = [];
for (i = 0; i < qtd_desconto; i++) {
 dropeDescontos[i] = {
  qtd: parseInt($(`#discount_qty_${i}`).text()),
  vlr: parseFloat($(`#discount_amount_${i}`).text())
};
}
console.log(dropeDescontos);

var drope_desconto_qty = null;
var drope_desconto = null;

for (i = 0; i < dropeDescontos.length; i++) {
 if (qty >= dropeDescontos[i].qtd) {
  drope_desconto_qty = dropeDescontos[i].qtd;
  drope_desconto = dropeDescontos[i].vlr;
}
}

var drope_desconto_aplicado = total;
var desconto_acumulativo = false;
var quantidade_de_numeros = drope_desconto_qty;
var valor_do_desconto = drope_desconto;

<?php if ($enable_cumulative_discount == 1) { ?>
 desconto_acumulativo = true;
<?php } ?>

if (desconto_acumulativo && qty >= quantidade_de_numeros) {
 var multiplicador_do_desconto = Math.floor(qty / quantidade_de_numeros);
 drope_desconto_aplicado = total - (valor_do_desconto * multiplicador_do_desconto);
}

// Aplicar desconto normal quando desconto acumulativo estiver desativado
if (!desconto_acumulativo && qty >= drope_desconto_qty) {
 drope_desconto_aplicado = total - valor_do_desconto;
}

if (parseInt(qty) >= parseInt(drope_desconto_qty)) {
 $('#total').html('De <strike>R$ ' + formatCurrency(total) + '</strike> por R$ ' + formatCurrency(drope_desconto_aplicado));
} else {
   if(enable_sale == 1 && qty >= sale_qty){
    total_sale = qty * sale_price;

    $('#total').html('De <strike>R$ ' + formatCurrency(total) + '</strike> por R$ ' + formatCurrency(total_sale));
 }else{
  $('#total').html('R$ ' + formatCurrency(total));  
}

}
//Fim desconto acumulativo

}

function qtyExpress(qty, opt) {
 qty = parseInt(qty);
 let value = parseInt($(".qty").val());  
 let qtyTotal = (value + qty);
 if(opt === true){
   qtyTotal = (qtyTotal - value);
}

$(".qty").val(qtyTotal);
calculatePrice(qtyTotal);  

}
function add_cart(){
   let qty = $('.qty').val();
   $('#qty_cotas').text(qty);
   $.ajax({
      url:_base_url_+"classes/Master.php?f=add_to_card",
      method:"POST",
      data:{product_id: "<?= isset($id) ? $id : '' ?>", qty: qty},
      dataType:"json",
      error:err=>{
      console.log(err)
      alert("[PP01] - An 111error occured.",'error');
   },
   success:function(resp){
      if(typeof resp== 'object' && resp.status == 'success'){
                  //location.reload();
      }else if(!!resp.msg){
         alert(resp.msg,'error');
      }else{
         alert("[PP02] - An 112error occured.",'error');
      }
   }
   })
}

$(document).ready(function() {
 $('.qty').on('keyup', function() {
  var value = parseInt($(this).val());
  var min = parseInt('<?= isset($min_purchase) ? $min_purchase : "" ?>');
  var max = parseInt('<?= isset($max_purchase) ? $max_purchase : "" ?>');
  if (value < min) {
    calculatePrice(min);   
      //alert('A quantidade mínima de cotas é de: ' + min + '');
    $('.aviso-content').html('A quantidade mínima de cotas é de: ' + min + '');
    $('#aviso_sorteio').click();
    $(".qty").val(min);

 } 
 if(value > max){
   calculatePrice(max);
      //alert('A quantidade máxima de cotas é de: ' + max + '');
   $('.aviso-content').html('A quantidade máxima de cotas é de: ' + max + '');
   $('#aviso_sorteio').click();
   $(".qty").val(max);	

}
});
});   

$(document).ready(function(){
 $('#consultMyNumbers').submit(function(e){
  e.preventDefault()
  var tipo = "<?php echo $search_type; ?>";
  $.ajax({
   url:_base_url_+"classes/Master.php?f=" + tipo,
   method:'POST',
   type:'POST',
   data:new FormData($(this)[0]),
   dataType:'json',
   cache:false,
   processData:false,
   contentType: false,
   error:err=>{
    console.log(err)
    alert('An 113error occurred')

 },
 success:function(resp){
    if(resp.status == 'success'){
      location.href = (resp.redirect)                                    
   }else{
     alert('Nenhum registro de compra foi encontrado')
     console.log(resp)
  }
}
})
})
})
</script>