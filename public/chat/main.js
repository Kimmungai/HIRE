$(function(){
  $('.minimize').click(function(){    $(this).closest('.chatbox').toggleClass('chatbox-min');
  });
  $('.fa-close').click(function(){
    $(this).closest('.chatbox').hide();
  });
});
function flow(question){
  $('#chat-messages-container').html('');
  switch(question){
    case '1':
      $('#chat-messages-container').append('<div class="message-box-holder"><div class="message-sender"><a href="#">Excia</a></div><div class="message-box message-partner"><p>リースとローンについては下記ページまたは動画にて紹介しております。その他不明点に関しては、お電話、お問い合わせフォームにてお気軽にご相談ください。</p><p><a href="http://lease-partners.jp/about_lease/" target="_blank">■リースとローンについて</a></p><p><a href="https://www.youtube.com/watch?v=QEaQcaBxZDs" target="_blank">■リースについて（動画)</a></p><p><a href="http://lease-partners.jp/contact/" target="_blank">■お問い合わせフォーム</a></p></div></div>');
      $('#chat-messages-container').append('<div class="message-box-holder"><div class="message-sender"><a href="#">Excia</a></div><div class="message-box message-partner"><p>悩みは解決しましたか？</p><p><input type="radio" value="1" name="problem-solved" onchange="flow_one(this.value)" /> はい　<input type="radio" value="0" name="problem-solved" onchange="flow_one(this.value)"/> いいえ</p></div></div>');
      chat_scroll();
    break;
    case '2':
      $('#chat-messages-container').append('<div class="message-box-holder"><div class="message-sender"><a href="#">Excia</a></div><div class="message-box message-partner"><p>リースパートナーでは大手含む全国５０社以上のカーリース会社に一括見積もりを行います。また現金販売、ローン、レンタカー、自動車保険に精通したカーライフプランナーの無料相談によりお客様のカーライフに合わせた最適料金を提案します。詳しくは動画にて</p><p><a href="https://www.youtube.com/watch?v=U0Xx9s2d68A" target="_blank">■リースパートナー について（動画）</a></p></div></div>');
      chat_scroll();
    break;
    case '3':
      $('#chat-messages-container').append('<div class="message-box-holder"><div class="message-sender"><a href="#">Excia</a></div><div class="message-box message-partner"><p>リースパートナー では車に関する様々な悩みをカーライフプランナーに無料相談が可能です。相談にあたりまずはじめにメールアドレスを教えてください</p><p><input type="text" placeholder="Eメール" onchange="flow_two_next(1)"/><input type="button" value="Ok"/></p></div></div>');
      chat_scroll();
    break;
    case '4':
      $('#chat-messages-container').append('<div class="message-box-holder"><div class="message-sender"><a href="#">Excia</a></div><div class="message-box message-partner"><p>リースパートナーでは、様々な商品を取り扱っており、全てをリース料に組み込むことが可能です。個人のお客様から法人のお客様まで、幅広く対応致します。また掲載のない商品でも取り寄せる事は可能ですのでお気軽にご相談ください。来店でのご相談も可能です。</p></div></div>');
      chat_scroll();
      $('#chat-messages-container').append('<div class="message-box-holder"><div class="message-sender"><a href="#">Excia</a></div><div class="message-box message-partner"><p><a href="http://lease-partners.jp/entry/" target="_blank">■お申し込み</a></p></div></div>');
      $('#chat-messages-container').append('<div class="message-box-holder"><div class="message-sender"><a href="#">Excia</a></div><div class="message-box message-partner"><p>■来店の場合</p><div id="map">map</div></div></div>');

    break;
    case '5':
      $('#chat-messages-container').append('<div class="message-box-holder"><div class="message-sender"><a href="#">Excia</a></div><div class="message-box message-partner"><p>リースパートナーの下取りプログラムは、多岐にわたる販売網から大手中古車買取会社に出すよりもお得になる場合が多いです。ぜひ買取会社に申込みをする前に、当社にお問い合わせ下さい。お客様の満足のいくプランを提案させて頂きます。詳しくは相談フォームにてご連絡ください。</p><p><a target="_blank" href="http://lease-partners.jp/contact/">■相談フォーム</a></p></div></div>');
      chat_scroll();
    break;
    case '6':
      $('#chat-messages-container').append('<div class="message-box-holder"><div class="message-sender"><a href="#">Excia</a></div><div class="message-box message-partner"><p>その他のお問い合わせはお問い合わせフォームよりお問い合わせください</p><p><a target="_blank" href="http://lease-partners.jp/contact/">■お問い合わせフォーム</a></p></div></div>');
      chat_scroll();
    break;
    default:
    break;
  }
}
function flow_one(problem_solved) {
  if(problem_solved === '1') {
    $('.minimize').closest('.chatbox').toggleClass('chatbox-min');
  }else if(problem_solved === '0') {
    $('#chat-messages-container').append('<div class="message-box-holder"><div class="message-sender"><a href="#">Excia</a></div><div class="message-box message-partner"><p>その他の説明は担当者より説明いたします相談にあたりまずはじめにメールアドレスを教えてください</p><p><input type="text" placeholder="Eメール" onchange="flow_one_next(1),hallo(1,this.value)"/><input type="button" value="Ok"/></div></div>');
    chat_scroll();
  }
}
function flow_one_next(field){
  if(field == 1){
    $('#chat-messages-container').append('<div class="message-box-holder"><div class="message-sender"><a href="#">Excia</a></div><div class="message-box message-partner"><p>次にお名前を教えてください</p><p><input  type="email" placeholder="名" onchange="flow_one_next(2),hallo(2,this.value)"/><input type="button" value="Ok"/></p></div></div>');
    chat_scroll();
  }else if(field == 2){
    $('#chat-messages-container').append('<div class="message-box-holder"><div class="message-sender"><a href="#">Excia</a></div><div class="message-box message-partner"><p>電話番号と連絡希望時間を教えてくださ</p><p><input type="number" placeholder="phone" onchange="hallo(3,this.value)"/></p><p><input type="text" id="dateTime" placeholder="call time" onchange="flow_one_next(3),hallo(4,this.value)"/><input type="button" value="Ok"/></p></div></div>');
    chat_scroll();
  }else if(field == 3){
    $('#chat-messages-container').append('<div class="message-box-holder"><div class="message-sender"><a href="#">Excia</a></div><div class="message-box message-partner"><p>最後に相談内容をご記載ください。</p><p><textarea rows="5" cols="35" onchange="flow_one_next(4),hallo(5,this.value)"></textarea></p><input type="button" value="Ok"/></div></div>');
    chat_scroll();
  }else if(field == 4){
    $('#chat-messages-container').append('<div class="message-box-holder"><div class="message-sender"><a href="#">Excia</a></div><div class="message-box message-partner"><p>お問い合わせありがとうございます。担当者より後ほどご連絡させていただきます。</p></div></div>');
    chat_scroll();
    send_details();
  }
}
function flow_two_next(field){
  if(field == 1){
    $('#chat-messages-container').append('<div class="message-box-holder"><div class="message-sender"><a href="#">Excia</a></div><div class="message-box message-partner"><p>次にお名前を教えてください</p><p><input type="text" placeholder="名" onchange="flow_two_next(2)"/><input type="button" value="Ok"/></p></div></div>');
    chat_scroll();
  }else if(field == 2){
    $('#chat-messages-container').append('<div class="message-box-holder"><div class="message-sender"><a href="#">Excia</a></div><div class="message-box message-partner"><p>電話番号と連絡希望時間を教えてくださ</p><p><input type="text" placeholder="phone" /></p><p><input type="text" placeholder="call time" onchange="flow_two_next(3)"/><input type="button" value="Ok"/></p></div></div>');
    chat_scroll();
  }else if(field == 3){
    $('#chat-messages-container').append('<div class="message-box-holder"><div class="message-sender"><a href="#">Excia</a></div><div class="message-box message-partner"><p>最後に相談内容をご記載ください。</p><p><textarea rows="5" cols="35" onchange="flow_two_next(4)"></textarea></p><input type="button" value="Ok"/></div></div>');
    chat_scroll();
  }else if(field == 4){
    $('#chat-messages-container').append('<div class="message-box-holder"><div class="message-sender"><a href="#">Excia</a></div><div class="message-box message-partner"><p>お問い合わせありがとうございます。担当者より後ほどご連絡させていただきます。</p></div></div>');
    chat_scroll();
  }
}
function chat_scroll(){
  $(".chat-messages").animate({scrollTop: $('.chat-messages').get(0).scrollHeight}, 2000);
}

function hallo(field, value){
  switch(field){
    case 1:
      $("#customer-name").val(value);
      send_mail();
    break;
    case 2:
      $("#customer-email").val(value);
      send_mail();
    break;
    case 3:
      $("#customer-phone").val(value);
      send_mail();
    break;
    case 4:
      $("#customer-date").val(value);
      send_mail();
    break;
    case 5:
      $("#customer-request").val(value);
      send_mail();
    break;
    default:
    break;
  }
}
