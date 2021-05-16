<!DOCTYPE html>
<html>

<head>
  <meta charset='utf-8' />
  <title><?= isset($title) ? $title : 'Gymlog'; ?></title>
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="Tim Bengtsson">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

  <!-- CSS only -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

  <link rel="stylesheet" href='/css/font-awesome-4.7.0/css/font-awesome.min.css' />
  <link href='/css/styles.css' rel='stylesheet' type='text/css' />

  <?php if (isset($extras['css'])) {
    foreach ($extras['css'] as $css) { ?>
      <link href='<?= $css ?>' rel='stylesheet' type='text/css' />
    <?php } ?>
  <?php } ?>
  
</head>

<body>
 
  <div class="page_wrapper">
 
    <div class="header_wrapper">
      <header>
        <a href='<?= SITE_URL ?>' class="site-logo">Gymlog</a>

        <div>
          <div class="nav_wrapper main_navigation_wrapper">

            <div class='close_mobile_nav_row'>
              <a href='<?= SITE_URL ?>' class="site-logo">Gymlog</a>

              <div></div>
              <div class='show_user'>
                <a href='/<?= isset($_COOKIE['user_id']) ? 'profile' : 'login'; ?>'>
                  <span class='computer'> </span><i class="fa fa-user" aria-hidden="true"></i>
                </a>
              </div>

              <div class='close_mobile_nav navigation_bars bars' data-nav-class='main_navigation_wrapper'>
                <a href='' class=''><i class="fa fa-times" aria-hidden="true"></i> </a>
              </div>
            </div>
 
          </div>
        </div>

        <div class='show_user'>
          <a href='/<?= isset($_COOKIE['user_id']) ? 'profile' : 'login'; ?>'>
            <span class='computer'> </span><i class="fa fa-user" aria-hidden="true"></i>
          </a>
        </div>

        <div class='show_nav '>
          <a href='' class='navigation_bars bars' data-nav-class='main_navigation_wrapper'>
            <i class="fa fa-bars" aria-hidden="true"></i>
          </a>
        </div>
      </header>
    </div>
 
 
    <?php if (isset($flash['message']) && count($flash['message']) > 0) { ?>

      <div class='flash_message'>
        <?php foreach ($flash['message'] as $messages) { ?>
          <?php foreach ($messages as $message) { ?>
            <?= $message; ?>
          <?php } ?>
        <?php } ?>
      </div>

    <?php } ?>

