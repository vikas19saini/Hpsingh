<?php ?>
<div class="header">
    <div class="header-left">
        <ul>
            <li><i class="dashicons dashicons-admin-home"></i>HP Singh</li>
            <li><i class="dashicons dashicons-controls-repeat"></i>0</li>
            <li class="new-review">
                <a href="<?= $this->Url->build(['controller' => 'Reviews', 'action' => 'index', 'prefix' => 'hpadmin', 'plugin' => null])?>">
                    <i class="dashicons dashicons-admin-comments"></i>
                    <span><?= $newReviews?></span>
                </a>
            </li>
            <li>
                <a target="_blank" href="<?= $this->Url->build(['_name' => 'home'])?>">
                    <i class="dashicons dashicons-welcome-view-site"></i>Visit Store
                </a>
            </li>
        </ul>
    </div>
    <div class="header-right">
        <span>
            <p><?= $Auth['name']?> <i class="fa fa-user-circle"></i></p>
            <span class="tooltiptext">
                <ul>
                    <li><a href="javascript:void(0);">Profile</a></li>
                    <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout', 'prefix' => 'hpadmin', 'plugin' => null])?>">Logout</a></li>
                </ul>
            </span>
        </span>
    </div>
</div>
