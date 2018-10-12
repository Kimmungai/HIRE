<?php
if(isset($_POST['customer_name'])){
  echo $_POST['customer_name'].'<br/>';
  echo $_POST['customer_email'].'<br/>';
  echo $_POST['customer_phone'].'<br/>';
  echo $_POST['customer_request'].'<br/>';
  echo $_POST['customer_date'].'<br/>';

    mail('hamano@excia.jp','chatBot','Customer Name: '.$_POST['customer_name']);
}
