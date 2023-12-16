<?php require_once('config.php'); ?>
<?php require_once('pages/inc/header.php') ?>
<?php if($_settings->chk_flashdata('success')): ?>
<script>
  $(function(){
    alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
  })
</script>
<?php endif;?>

<?php $page = isset($_GET['p']) ? $_GET['p'] : 'pages/home';  ?>
<?php 
    if(!file_exists($page.".php") && !is_dir($page)){
        include '404.php';
    }else{
    if(is_dir($page))
        include $page.'/index.php';
    else
        include $page.'.php';

    }
?>
<?php require_once('pages/inc/footer.php') ?>