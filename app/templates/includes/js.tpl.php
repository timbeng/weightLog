<script src='/js/jquery3.3.1.js'></script>
<!-- <script src='/js/lightbox.js'></script> -->

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
   
<?php if (isset($extras['js'])) {
  foreach ($extras['js'] as $js) { ?>
    <script src='<?= $js ?>'></script>
  <?php } ?>
<?php } ?> 

<script>

// Show hide moilde desctop class
if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
  // true for mobile device
  $('.mobile').show();
  $('.desktop').hide(); 
}else{
  // false for not mobile device
  $('.mobile').hide();
  $('.desktop').show(); 
}

</script>