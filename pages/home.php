         <div class="container app-main">
            <div class="row">
               <div class="col-12">
                  <div class="app-title">
                     <h1>⚡ Campanhas</h1>
                     <div class="app-title-desc">Escolha sua sorte</div>
                  </div>
               </div>
               <?php 
               $qry = $conn->query("SELECT * FROM `product_list` WHERE featured_draw = '0' AND private_draw = '0' ORDER BY id DESC LIMIT 10");
               if($qry->num_rows > 0){
                  while($row = $qry->fetch_assoc()):
                     ?>
                     <div class="col-12 mb-2">
                      <a href="/campanha/<?= $row['slug'] ?>"> 
                         <div class="SorteioTpl_sorteioTpl__2s2Wu   pointer">
                           <div class="SorteioTpl_imagemContainer__2-pl4 col-auto ">
                              <div style="display:block;overflow:hidden;position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;margin:0">
                                 <img alt="1.500,00 com apenas 0,03 centavos" src="<?= validate_image($row['image_path']) ?>" decoding="async" data-nimg="fill" class="SorteioTpl_imagem__2GXxI" style="position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;padding:0;border:none;margin:auto;display:block;width:0;height:0;min-width:100%;max-width:100%;min-height:100%;max-height:100%">
                                 <noscript><img alt="1.500,00 com apenas 0,03 centavos" src="<?= validate_image($row['image_path']) ?>" decoding="async" data-nimg="fill" style="position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;padding:0;border:none;margin:auto;display:block;width:0;height:0;min-width:100%;max-width:100%;min-height:100%;max-height:100%" class="SorteioTpl_imagem__2GXxI" loading="lazy"/></noscript>
                              </div>
                           </div>
                           <div class="SorteioTpl_info__t1BZr">
                              <h1 class="SorteioTpl_title__3RLtu"><?= $row['name'] ?></h1>
                              <p class="SorteioTpl_descricao__1b7iL" style="margin-bottom:1px"><?php echo isset($row['subtitle']) ? $row['subtitle'] : ''; ?></p>
                              <?php if($row['status_display'] == 1){ ?>
                                 <span class="badge bg-success blink bg-opacity-75 font-xsss">Adquira já!</span>
                              <?php } ?>
                              <?php if($row['status_display'] == 2){ ?>
                                 <span class="badge bg-dark blink font-xsss mobile badge-status-1">Corre que está acabando!</span>
                              <?php } ?>
                              <?php if($row['status_display'] == 3){ ?>
                                 <span class="badge bg-dark font-xsss mobile badge-status-3">Aguarde a campanha!</span>
                              <?php } ?>
                              <?php if($row['status_display'] == 4){ ?>
                                 <span class="badge bg-dark font-xsss">Concluído</span>
                                 <?php
                                 $date_of_draw = strtotime($row['date_of_draw']);
                                 $date_of_draw = date('d/m', $date_of_draw);
                                 ?>
                                 <div class="SorteioTpl_dtSorteio__2mfSc"><i class="bi bi-calendar2-check"></i> <?= $date_of_draw; ?></div>
                              <?php } ?>
                              <?php if($row['status_display'] == 5){ ?>
                                 <span class="badge bg-dark font-xsss">Em breve!</span>
                              <?php } ?>
                              <?php if($row['status_display'] == 6){ ?>
                                 <span class="badge bg-dark font-xsss">Aguarde o sorteio!</span>
                              <?php } ?>
                           </div>
                        </div>
                     </a>
                  </div>
               <?php endwhile; ?>
            <?php } ?>
               <?php 
               $qry = $conn->query("SELECT * FROM `product_list` WHERE status_display <> '4' AND featured_draw = '1' ORDER BY RAND() LIMIT 1");
               while($row = $qry->fetch_assoc()):
               ?>
                  <div class="col-12 mb-2">
                     <div class="SorteioTpl_sorteioTpl__2s2Wu SorteioTpl_destaque__3vnWR  pointer">
                        <a href="/campanha/<?= $row['slug'] ?>"><div class="SorteioTpl_imagemContainer__2-pl4 col-auto ">
                           <h2>Home</h2>
                        </a>
                        </div>
                     </div>
                  </div>
               <?php endwhile; ?>

               
            <div class="SorteioTpl_info__t1BZr">
                           <h1 class="SorteioTpl_title__3RLtu"><a href="/campanha/<?= $row['slug'] ?>"><?= $row['name'] ?></a></h1>
                           <p class="SorteioTpl_descricao__1b7iL" style="margin-bottom:1px"><?php echo isset($row['subtitle']) ? $row['subtitle'] : ''; ?></p>
                           <?php if($row['status_display'] == 1){ ?>
                              <span class="badge bg-success blink bg-opacity-75 font-xsss">Adquira já!</span>
                           <?php } ?>
                           <?php if($row['status_display'] == 2){ ?>
                              <span class="badge bg-dark blink font-xsss mobile badge-status-1">Corre que está acabando!</span>
                           <?php } ?>
                           <?php if($row['status_display'] == 3){ ?>
                              <span class="badge bg-dark font-xsss mobile badge-status-3">Aguarde a campanha!</span>
                           <?php } ?>
                           <?php if($row['status_display'] == 4){ ?>
                              <span class="badge bg-dark font-xsss">Concluído</span>
                              <?php
                              $date_of_draw = strtotime($row['date_of_draw']);
                              $date_of_draw = date('d/m', $date_of_draw);
                              ?>
                              <div class="SorteioTpl_dtSorteio__2mfSc"><i class="bi bi-calendar2-check"></i> <?= $date_of_draw; ?></div>
                           <?php } ?>
                           <?php if($row['status_display'] == 5){ ?>
                              <span class="badge bg-dark font-xsss">Em breve!</span>
                           <?php } ?>
                           <?php if($row['status_display'] == 6){ ?>
                              <span class="badge bg-dark font-xsss">Aguarde o sorteio!</span>
                           <?php } ?>
                        </div>
      </div>
   </div>
</div>