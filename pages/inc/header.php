<?php
$user_id = $_settings->userdata('id');
$user_type = $_settings->userdata('type');
$logo = validate_image($_settings->info('logo'));
$favicon = validate_image($_settings->info('favicon'));
$enable_password = $_settings->info('enable_password');
$enable_pixel = $_settings->info('enable_pixel');
$enable_ga4 = $_settings->info('enable_ga4');
$google_ga4_id = $_settings->info('google_ga4_id');
$facebook_access_token = $_settings->info('facebook_access_token');
$facebook_pixel_id = $_settings->info('facebook_pixel_id');
?>
<html translate="no">
<html lang="pt-br">
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
   <?php echo exibir_cabecalho($conn); ?>
   <?php if($favicon){ ?>
   <link rel="shortcut icon" href="<?= $favicon; ?>" />
   <link rel="apple-touch-icon" sizes="180x180" href="<?= validate_image($_settings->info('favicon')); ?>"> 
   <link rel="icon" type="image/png" sizes="32x32" href="<?= validate_image($_settings->info('favicon')); ?>">
   <link rel="icon" type="image/png" sizes="16x16" href="<?= validate_image($_settings->info('favicon')); ?>">
   <?php } ?>
   <meta name="theme-color" content="#000000">
   <link rel="stylesheet" href="<?php echo BASE_URL ?>assets/css/style.css">
   <script src="<?php echo BASE_URL ?>libs/jquery/jquery.min.js"></script>   
   <script> var _base_url_ = '<?php echo BASE_URL ?>'; </script>
   <?php if($enable_pixel == 1 && !empty($facebook_pixel_id)){ ?>
   <script>
      !function (f, b, e, v, n, t, s) {
         if (f.fbq) return; n = f.fbq = function () {
               n.callMethod ?
               n.callMethod.apply(n, arguments) : n.queue.push(arguments)
         };
         if (!f._fbq) f._fbq = n; n.push = n; n.loaded = !0; n.version = '2.0';
         n.queue = []; t = b.createElement(e); t.async = !0;
         t.src = v; s = b.getElementsByTagName(e)[0];
         s.parentNode.insertBefore(t, s)
      }(window, document, 'script',
         'https://connect.facebook.net/en_US/fbevents.js');
      fbq('init', '<?= $facebook_pixel_id ?>');
      fbq('track', 'PageView');
   </script>
   <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=<?= $facebook_pixel_id ?>&ev=PageView&noscript=1" /></noscript>
   <?php } ?>
   <?php if($enable_ga4 == 1 && !empty($google_ga4_id)){ ?>
   <script async src="https://www.googletagmanager.com/gtag/js?id=<?= $google_ga4_id ?>"></script>
   <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', '<?= $google_ga4_id ?>');
   </script>
   <?php } ?>
</head>
<body>
<div id="__next">
   <header class="header-app-header">
      <div class="header-app-header-container">
         <div class="container container-600 font-mdd">
            <div class="header-app-header-wrap">
               <a class="flex-grow-1" href="/">
                  <?php if($logo){ ?>
                     <img src="<?= $logo; ?>" class="header-app-brand"></a>
                  <?php }else{ ?>
                     <img src="<?php echo BASE_URL ?>assets/img/logo.png" class="header-app-brand"></a>
                  <?php } ?>
                     <a class="btn btn-link text-white font-lg opacity-50 pe-0" href="/meus-numeros"><i class="bi bi-bag-check-fill"></i></a>
                     <button type="button" aria-label="Menu" class="btn btn-link text-white font-lgg pe-0" data-bs-toggle="modal" data-bs-target="#mobileMenu" style="margin-top:5px"><i class="bi bi-list"></i></button>
                  </div>
               </div>
            </header>
            <div class="black-bar fuse"></div>
            <menu id="mobileMenu" class="modal fade modal-fluid" tabindex="-1" aria-labelledby="mobileMenuLabel" aria-hidden="true">
               <div class="modal-dialog modal-fullscreen">
                  <div class="modal-content bg-cor-primaria">
                     <header class="app-header app-header-mobile--show">
                        <div class="container container-600 h-100 d-flex align-items-center justify-content-between">

                         <?php if($logo){ ?>
                           <a href="/">
                              <img src="<?= $logo; ?>" class="app-brand img-fluid">
                           </a>
                        <?php }else{ ?>
                           <a href="/">
                              <img src="<?php echo BASE_URL ?>assets/img/logo.png" class="app-brand img-fluid">
                           </a>
                        <?php } ?>
                        <?php if($logo){ ?>
                           <a href="/">
                              <img src="<?= $logo; ?>" class="app-brand img-fluid">
                           </a>
                        <?php }else{ ?>
                           <a href="/">
                              <img src="<?php echo BASE_URL ?>assets/img/logo.png" class="app-brand img-fluid">
                           </a>
                        <?php } ?>
                        <div class="app-header-mobile"><button type="button" class="btn btn-link text-white menu-mobile--button pe-0 font-lgg" data-bs-dismiss="modal" aria-label="Fechar"><i class="bi bi-x-circle"></i></button></div>
                     </div>
                  </header>
                  <div class="modal-body">
                     <div class="container container-600">
                        <?php if($user_id){ ?>
                           <div class="card-usuario mb-2">
                              <div class="card-usuario--informacoes">
                                 <h3>Olá, <?php 
                                    $firstname = ucwords($_settings->userdata('firstname')); 
                                    $lastname = ucwords($_settings->userdata('lastname')); 
                                    echo $firstname.' '.$lastname.'';
                                    ?>
                                 </h3>
                            <div class="email font-xss saldo-value"></div>
                            <div class="email font-xss saldo-value"></div>
                         </div>
                         <div class="card-usuario--sair">
                            <a href="<?php echo BASE_URL.'logout?'.$_SERVER['REQUEST_URI']; ?>"> 
                              <button type="button" class="btn btn-link text-center text-white-50 ps-1 pe-0 pt-0 pb-0 font-lg">
                                 <i class="bi bi-box-arrow-left"></i>
                              </button>
                           </a>
                        </div>
                     </div>
                  <?php } ?>

                  <div class="modal-body">
                     <div class="container container-600">
                        <?php if($user_id){ ?>
                           <div class="card-usuario mb-2">
                              <div class="card-usuario--informacoes">
                                 <h3>Olá, <?php 
                                    $firstname = ucwords($_settings->userdata('firstname')); 
                                    $lastname = ucwords($_settings->userdata('lastname')); 
                                    echo $firstname.' '.$lastname.'';
                                    ?>
                                 </h3>
                            <div class="email font-xss saldo-value"></div>
                            <div class="email font-xss saldo-value"></div>
                         </div>
                         <div class="card-usuario--sair">
                            <a href="<?php echo BASE_URL.'logout?'.$_SERVER['REQUEST_URI']; ?>"> 
                              <button type="button" class="btn btn-link text-center text-white-50 ps-1 pe-0 pt-0 pb-0 font-lg">
                                 <i class="bi bi-box-arrow-left"></i>
                              </button>
                           </a>
                        </div>
                     </div>
                  <?php } ?>

                  <nav class="nav-vertical nav-submenu font-xs mb-2">
                     <ul>

                        <li>
                           <a class="text-white" alt="Página Principal" href="/"><i class="icone bi bi-house"></i><span>Início</span></a>
                        </li>

                        <li>
                           <a class="text-white" alt="Campanhas" href="/campanhas"><i class="icone bi bi-megaphone"></i><span>Campanhas</span></a>
                        </li>

                        <li>
                           <a class="text-white" alt="Meus Números" href="/meus-numeros"><i class="icone bi bi-card-list"></i><span>Meus números</span>
                           </a>
                        </li>
                        <?php if($user_id){ ?>   
                          <li>
                             <a alt="Atualizar cadastro" class="text-white" href="/user/atualizar-cadastro"><i class="icone bi bi-person-circle"></i><span>Atualizar cadastro</span>
                             </a>
                          </li>

                          <li>
                           <a alt="Minhas compras" class="text-white" href="/user/compras"><i class="icone bi bi-cart-check"></i><span>Minhas compras</span>
                           </a>
                        </li>
                         <?php if($enable_password == 1){ ?>
                        <li><a alt="Alterar senha" class="text-white" href="/user/alterar-senha"><i class="icone bi bi-key-fill"></i><span>Alterar senha</span></a></li>
                         <?php } ?>
                     <?php }else{ ?>
                       <li>
                        <a alt="Cadastre-se" class="text-white" href="/cadastrar"><i class="icone bi bi-box-arrow-in-right"></i><span>Cadastro</span>
                        </a>
                     </li>

                  <?php } ?>

                  <li>
                     <a alt="Ganhadores" class="text-white" href="/ganhadores"><i class="icone bi bi-trophy"></i><span>Ganhadores</span>
                     </a>
                  </li>
                  
                  <?php if (!empty($_settings->info('terms'))) { ?>
                     <li>
                        <a alt="Ganhadores" class="text-white" href="/termos-de-uso"><i class="icone bi bi-blockquote-right"></i><span>Termos de uso</span>
                        </a>
                     </li>
                  <?php } ?>

                  <li class="col-contato-display">
                     <a alt="Entre em contato conosco" class="text-white" href="/contato"><i class="icone bi bi-envelope"></i><span>Entrar em contato</span>
                     </a>
                  </li>


               </ul>
            </nav>
            <?php if(!$user_id){ ?>
               <div class="text-center">
                  <button type="button" data-bs-toggle="modal" data-bs-target="#loginModal" class="btn btn-primary w-100 rounded-pill"><i class="icone bi bi-box-arrow-in-right"></i> Entrar</button>
               <?php }else{ ?>
                  <a href="<?php echo BASE_URL.'logout?'.$_SERVER['REQUEST_URI']; ?>">
                     <button type="button" class="btn btn-primary w-100 rounded-pill"><i class="icone bi bi-box-arrow-in-right"></i> Sair</button>
                  </a>

               <?php } ?>
            </div>

         </div>
      </div>
      <?php $disabled = true; if(!$user_id && $disabled == false){ ?>
         <div class="modal-footer text-white"><small class="text-uppercase">Compartilhe</small><ul class="lista-horizontal"><li><a href="" alt="Acompanhe nosso Facebook" class="rede-social-item"><i class="bi bi-facebook"></i></a></li><li><a href="" alt="Acompanhe nosso Instagram" class="rede-social-item"><i class="bi bi-instagram"></i></a></li><li><a href="" alt="Fale conosco no whatsapp" class="rede-social-item"><i class="bi bi-whatsapp"></i></a></li></ul></div>
      <?php } ?>
   </div>
</div>
</menu>
<div class="modal fade" id="modal-contas-bancarias">
   <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Contas bancárias</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
         </div>
         <div class="modal-body pb-1">
            <p>Faça sua transferência e anexe o comprovante.</p>
            <div id="contas-group-collapse"></div>
         </div>
      </div>
   </div>
</div>