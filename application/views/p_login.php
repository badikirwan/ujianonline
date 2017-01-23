<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Login Page - Aplikasi Ujian Online</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Montserrat:400,700'>
  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/style-login.css">
</head>
<body>
<div class="container">
  <div class="info"></div>
</div>
<div class="form">
  <div class="thumbnail"><img src="<?php echo base_url()?>assets/images/hat.svg"/></div>
    <form class="register-form">
      <input type="text" placeholder="name"/>
      <input type="password" placeholder="password"/>
      <input type="text" placeholder="email address"/>
      <button>create</button>
      <p class="message">Already registered? <a href="#">Sign In</a></p>
    </form>
    <?php echo form_open('login/ceklogin'); ?>
    <?php
    if($this->session->flashdata('pesan') <> '') { ?>
      <div class="message">
      <?php echo $this->session->flashdata('pesan'); ?>
      </div>
      <br>
    <?php } ?>
      <input type="text" name="usr" placeholder="username"/>
      <input type="password" name="pwd" placeholder="password"/>
      <button name="masuk" type="submit"><i class="fa fa-lock"></i> login</button>
      <p class="message">Not registered? <a href="#">Create an account</a></p>
<?php echo form_close(); ?>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="<?php echo base_url()?>theme/assets/js/index.js"></script>
</body>
</html>
