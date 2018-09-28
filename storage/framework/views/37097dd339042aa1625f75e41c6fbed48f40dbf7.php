<?php $__env->startSection('content'); ?>
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
                                <td>user<?php echo e($client_data[0]['id']); ?></td>
                                <td>company<?php echo e($company_data[0]['id']); ?></td>
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
                              <?php $__currentLoopData = $message_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <article><div class="date"><?php echo e($message['created_at']); ?></div><p> <?php echo e($message['message']); ?></p></article>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                chat_users_id:<?php echo e($message['chat_users_id']); ?>,
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>