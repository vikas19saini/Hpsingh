<?php

$this->assign('title', \Cake\Core\Configure::read('Store.name') . ' Enquiry');

?>
<h4>Hello Admin,</h4>
<p>You received new enquiry at <?= \Cake\Core\Configure::read('Store.name')?>, Please check the details below or login to website for more details.</p>
<?php if(!empty($entity->name)):?>
<p>
    Name: <?= $entity->name?>
</p>
<?php endif;?>

<?php if(!empty($entity->email)):?>
<p>
    Email Address: <?= $entity->email?>
</p>
<?php endif;?>
<?php if(!empty($entity->phone)):?>
<p>
    Contact Number: <?= $entity->phone?>
</p>
<?php endif;?>

<?php if(!empty($entity->tool)):?>
<p>
    Browsing Tool: <?= $entity->tool?>
</p>
<?php endif;?>
<?php if(!empty($entity->date)):?>
<p>
    Prefered Date: <?= $entity->date?>
</p>
<?php endif;?>
<?php if(!empty($entity->req_type)):?>
<p>
    Regarding/Quantity: <?= $entity->req_type?>
</p>
<?php endif;?>
<?php if(!empty($entity->message)):?>
<p>
    Message: <?= $entity->message?>
</p>
<?php endif;?>
<br/>
<?php if(!empty($entity->reference)):?>
<p>
    Please find the attached files.
</p>
<?php endif;?>