@extends('layouts.admin-layout')

@section('content')
<!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <a href="#menu-toggle" class="btn btn-success" id="menu-toggle">Menu</a>
                <a href="/admin-message-hist" class="btn btn-default"><i class="glyphicon glyphicon-backward"></i>  戻る</a>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th>FROM</th>
                                <th>TO</th>
                                <th>期間</th>
                            </tr>
                            <tr>
                                <td>user{{$client_data[0]['id']}}</td>
                                <td>company{{$company_data[0]['id']}}</td>
                                <td><select id="chat-period" onchange="getMessages(this.value)">
                                    <option value="1">1ヶ月以内</option>
                                    <option value="2">6ヶ月以内</option>
                                    <option value="3">12ヶ月以内</option>
                                    <option value="4">12ヶ月以上</option>
                                </select>
                                </td>
                            </tr>
                        </table>
                        </div>
                        <div class="message-text">
                            <div class="contact-message" id="contact-message">
                              @foreach($message_data as $message)
                                <article><div class="date">{{$message['created_at']}}</div><p> {{$message['message']}}</p></article>
                              @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
        <script>
        function getMessages(duration){
           $.get("/chat-messages-duration",
              {
                chat_users_id:{{$message['chat_users_id']}},
                chat_messages_duration:duration
              },
              function(data,status){
                var messages=JSON.stringify(data);
                var messages_obj=JSON.parse(messages);
                $('#contact-message').html('');
                for(count=0;count<messages_obj.length;count++)
                {
                  var list_item="<article><div class='date'>"+messages_obj[count].created_at+"</date><p>"+messages_obj[count].message+"</p></article>";
                  $('#contact-message').append(list_item);
                }
            });
        }
        </script>
@endsection
