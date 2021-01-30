<?php ?>

            <p>
                <?php if($status == ''):?>
                <b><?= $this->Html->link('All(' . $all . ')', ['action' => 'index'])?></b> | 
                <?php else:?>
                <?= $this->Html->link('All(' . $all . ')', ['action' => 'index'])?> | 
                <?php endif;?>
                
                <?php if($status == 'published'):?>
                <b><a href="<?= $this->Paginator->generateUrl(['status' => 'published'])?>">Published(<?= $published?>)</a></b> | 
                <?php else:?>
                <a href="<?= $this->Paginator->generateUrl(['status' => 'published'])?>">Published(<?= $published?>)</a> | 
                <?php endif;?>
                
                <?php if($status == 'drafts'):?>
                <b><a href="<?= $this->Paginator->generateUrl(['status' => 'drafts'])?>">Drafts(<?= $drafts ?>)</a></b> | 
                <?php else:?>
                <a href="<?= $this->Paginator->generateUrl(['status' => 'drafts'])?>">Drafts(<?= $drafts ?>)</a> | 
                <?php endif;?>
                
                <?php if($status == 'trash'):?>
                <b><a href="<?= $this->Paginator->generateUrl(['status' => 'trash'])?>">Trash(<?= $trash?>)</a></b>
                <?php else:?>
                <a href="<?= $this->Paginator->generateUrl(['status' => 'trash'])?>">Trash(<?= $trash?>)</a>
                <?php endif;?>
            </p>