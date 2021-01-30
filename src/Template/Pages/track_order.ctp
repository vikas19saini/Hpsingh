<?php

/* Template Name: Contact Page */
$this->assign('bodyClass', 'contact_page');
$this->assign('title', 'Track Order');
$this->assign('meta', $this->Html->meta('description', 'Track Order') . $this->Html->meta('keywords', 'Track Order'));
?>

<?= $this->Element('header') ?>
<div class="mobile_hidden_vissible">
	<div class="track" style="padding-top: 50px;padding-bottom: 50px;">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<?= $this->Form->create(null, ["class" => "track_form", 'method' => "post"]) ?>
					<div class="form-group">
						<?= $this->Form->text('order_no', ['placeholder' => 'Order Number', 'autocomplete' => 'off']) ?>
					</div>
					<?= $this->Form->button(__('Search')) ?>
					<?= $this->Form->end() ?>
				</div>
			</div>
		</div>
		<?php if (isset($resultData) > 0) : ?>
			<div class="container">
				<div class="row">
					<div class="col-md-12" style="overflow-x: scroll;">
						<div class="track_m">
							<h4><strong>Carrier Name :</strong> <?= $resultData[0]['carrier_name'] ?></h4>
							<br />
						</div>
						<table class="table table-bordered">
							<thead class="thead-dark">
								<tr>
									<th>Date Time</th>
									<th>Location</th>
									<th>Action</th>
									<th>Status Description</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($resultData as $res) : ?>
									<tr>
										<td><?= isset($res['date_time']) ? date("Y-m-d", strtotime($res['date_time'])) : "--" ?></td>
										<td><?= isset($res['location']) ? $res['location'] : "--" ?></td>
										<td><?= isset($res['action']) ? $res['action'] : "--" ?></td>
										<td><?= isset($res['status_description']) ? $res['status_description'] : "--" ?></td>
									</tr>
								<?php endforeach; ?>

							</tbody>
						</table>

					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
	<!-- footer area start -->
	<?= $this->Element('footer') ?>
	<!-- footer area end -->
	<!--</div>-->
</div>