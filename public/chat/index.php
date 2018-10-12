<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="styl.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <title>Excia Chat Robot</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="main.js"></script>
  </head>
  <body>
    <div id="chatBot" class="chatbox-holder">
      <div class="chatbox group-chat">
        <div class="chatbox-top minimize">
          <div class="chatbox-avatar">
            <a href="javascript:void(0);"><img src="logo.png" /></a>
          </div>

          <div class="chat-group-name">
            <span class="status online"></span>
            Excia Chat bot
          </div>
          <div class="chatbox-icons">
            <!--<label for="chkSettings"><i class="fa fa-gear"></i></label><input type="checkbox" id="chkSettings" />
            <div class="settings-popup">
              <ul>
                <li><a href="#">Group members</a></li>
                <li><a href="#">Add members</a></li>
                <li><a href="#">Delete members</a></li>
                <li><a href="#">Leave group</a></li>
              </ul>
            </div>-->
            <a class="minimize" href="javascript:void(0);"><i class="fa fa-minus minimize"></i></a>
            <a href="javascript:void(0);"><i class="fa fa-times"></i></a>
          </div>
        </div>

        <div  class="chat-messages">
           <!--<div class="message-box-holder">
            <div class="message-box">
              What are you people doing?
            </div>
          </div>-->

          <div class="message-box-holder">
            <div class="message-sender">
              <a href="#">Excia</a>
             </div>
            <div class="message-box message-partner">
              ご訪問ありがとうございます。ご不明な点がございましたら、こちらからチャットにてご質問いただけます。
              <p><input type="radio" value="1" name="question" onchange="flow(this.value)"/> カーリースとローンについて</p>
              <p><input type="radio" value="2" name="question" onchange="flow(this.value)"/> リースパートナー について</p>
              <p><input type="radio" value="3" name="question" onchange="flow(this.value)"/> 電話相談</p>
              <p><input type="radio" value="4" name="question" onchange="flow(this.value)"/> お申し込みについて</p>
              <p><input type="radio" value="5" name="question" onchange="flow(this.value)"/> 下取りについて</p>
              <p><input type="radio" value="6" name="question" onchange="flow(this.value)"/> その他について</p>
            </div>
          </div>

          <div id="chat-messages-container"></div>
          <!--<div class="message-box-holder">
            <div class="message-box">
              who else is online?
            </div>
          </div>

          <div class="message-box-holder">
            <div class="message-sender">
              <a href="#">Chris Jerrico</a>
             </div>
            <div class="message-box message-partner">
              I'm also online. How are you people?
            </div>
          </div>

          <div class="message-box-holder">
            <div class="message-box">
              I am fine.
            </div>
          </div>

          <div class="message-box-holder">
            <div class="message-sender">
              <a href="#">Rockey</a>
             </div>
            <div class="message-box message-partner">
              I'm also online. How are you people?
            </div>
          </div>

          <div class="message-box-holder">
            <div class="message-sender">
              <a href="#">Christina Farzana</a>
             </div>
            <div class="message-box message-partner">
              We are doing fine. I am in.
            </div>
          </div>-->
        </div>

        <div class="chat-input-holder">
          <textarea class="chat-input"></textarea>
          <input type="submit" value="Send" class="message-send" />
        </div>

        <!--<div class="attachment-panel">
          <a href="#" class="fa fa-thumbs-up"></a>
          <a href="#" class="fa fa-camera"></a>
          <a href="#" class="fa fa-video-camera"></a>
          <a href="#" class="fa fa-image"></a>
          <a href="#" class="fa fa-paperclip"></a>
          <a href="#" class="fa fa-link"></a>
          <a href="#" class="fa fa-trash-o"></a>
          <a href="#" class="fa fa-search"></a>
        </div>-->
      </div>
    </div>
    <input type="hidden" id="customer-name" />
    <input type="hidden" id="customer-email" />
    <input type="hidden" id="customer-phone" />
    <input type="hidden" id="customer-date" />
    <input type="hidden" id="customer-request" />
    <script>
    function send_mail(){
      $.post("mail.php",
            {
              customer_name:$('#customer-name').val(),
              customer_email:$('#customer-email').val(),
              customer_email:$('#customer-phone').val(),
              customer_email:$('#customer-request').val(),
              customer_date:$('#customer-date').val(),

            },
            function(data,status){
                //alert(data)
          });
        }
    </script>
  </body>
</html>
