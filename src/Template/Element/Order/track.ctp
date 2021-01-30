<?php ?>

<?php if($order_details->status === 'cancelled' || $order_details->status === 'failed' || $order_details->status === 'refunded'):?>
<div class="status-track">
    <div class="complete"> <i class="fa fa-check-circle-o"></i>
        <label>Ordered</label>
    </div>
    <div class="complete"><i class="fa fa-check-circle-o"></i>
        <label><?= $order_details->status?></label>
    </div>
</div>
<?php endif;?>

<?php if($order_details->status === 'processing'):?>
<div class="status-track">
    <div class="complete"> <i class="fa fa-check-circle-o"></i>
        <label>Ordered</label>
    </div>
    <div class="current"><i class="fa fa-check-circle-o"></i>
        <label>Processing</label>
    </div>
    <div class="future"><i class="fa fa-check-circle-o"></i>
        <label>Shipped</label>
    </div>
    <div class="future"><i class="fa fa-check-circle-o"></i>
        <label>Delivered</label>
    </div>
</div>
<?php endif;?>

<?php if($order_details->status === 'shipped'):?>
<div class="status-track">
    <div class="complete"> <i class="fa fa-check-circle-o"></i>
        <label>Ordered</label>
    </div>
    <div class="complete"><i class="fa fa-check-circle-o"></i>
        <label>Processing</label>
    </div>
    <div class="complete"><i class="fa fa-check-circle-o"></i>
        <label>Shipped</label>
    </div>
    <div class="future"><i class="fa fa-check-circle-o"></i>
        <label>Delivered</label>
    </div>
</div>
<?php endif;?>

<?php if($order_details->status === 'completed'):?>
<div class="status-track">
    <div class="complete"> <i class="fa fa-check-circle-o"></i>
        <label>Ordered</label>
    </div>
    <div class="complete"><i class="fa fa-check-circle-o"></i>
        <label>Processing</label>
    </div>
    <div class="complete"><i class="fa fa-check-circle-o"></i>
        <label>Shipped</label>
    </div>
    <div class="complete"><i class="fa fa-check-circle-o"></i>
        <label>Delivered</label>
    </div>
</div>
<?php endif;?>