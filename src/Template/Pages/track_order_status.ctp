<?php 

/* Template Name: Contact Page */
	$this->assign('bodyClass', 'contact_page');
    $this->assign('title', 'Track Order');
    $this->assign('meta', $this->Html->meta('description', 'Track Order') . $this->Html->meta('keywords', 'Track Order'));
?>
<?= $this->Element('header')?>
<div class="mobile_hidden_vissible">
    
    <section class="enquiry contact-form">
        <div class="container">
            <div class="row about_us">
                <h2>Tracking Status<span></span></h2>
                <table border="1px solid black">
				<th>Carrier Name</th>
				<th>DateTime</th>
				<th>Location</th>
				<th>Action</th>
				<th>Status Description</th>
				<?php foreach($resultData as $res){ ?>
					<tr>
					<td><?php echo $res->carrier_name;?></td>
					<td><?php echo date("Y-m-d",strtotime($res->date_time));?></td>
					<td><?php echo $res->location;?></td>
					<td><?php echo $res->action;?></td>
					<td><?php echo $res->status_description;?></td>
					</tr>
				<?php }?>
				
				</table>
				
				
				</div>
        </div>
    </section>
<!-- footer area start -->
 <?= $this->Element('footer') ?>
<!-- footer area end -->
</div>