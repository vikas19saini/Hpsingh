<?php 
    if (count($tags) > 0):
        echo '<ul style="display: block">';
        foreach ($tags as $id => $name):
            echo '<li onclick="hpAdmin.addTagFromSearch(this,',$id,')">',$name,'</li>';
        endforeach;
        echo '</ul>';
    else:
        echo '<ul style="display: none"></ul>';
    endif;
?>