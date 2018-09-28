<?php $__env->startSection('content'); ?>
<ol>
    <li><a href="/client_order_view">client_order_view</a></li>
    <li><a href="/company_order_view">company_order_view</a></li>
    <li><a href="/company_order_view_all">company_order_view_all</a></li>
    <li><a href="/new_order_check">new_order_check</a></li>
    <li><a href="/new_order">new_order</a></li>
    <li><a href="/register_confirmation">register_confirmation</a></li>
    <li><a href="/registering">register</a></li>
</ol>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.hire', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>