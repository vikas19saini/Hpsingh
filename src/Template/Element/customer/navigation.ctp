<?php ?>
<h2>MY ACCOUNT</h2>
<h2><?= $Auth->name?></h2>

<ul class="my_account_menu nav nav-tabs">
    <li class="overview <?= $this->request->getParam('action') === 'myAccount' ? 'focus' : ''?>"><a href="<?= $this->Url->build(['action' => 'myAccount'])?>">OVERVIEW</a></li>
    <li class="profile <?= $this->request->getParam('action') === 'profile' ? 'focus' : ''?>"><a href="<?= $this->Url->build(['action' => 'profile'])?>">PROFILE</a></li>
    <li class="address <?= $this->request->getParam('action') === 'addresses' ? 'focus' : ''?>"><a href="<?= $this->Url->build(['action' => 'addresses'])?>">ADDRESSES</a></li>
    <li class="order <?= $this->request->getParam('action') === 'orders' ? 'focus' : ''?>"><a href="<?= $this->Url->build(['action' => 'orders'])?>">ORDERS</a></li>
    <li class="coupons <?= $this->request->getParam('action') === 'coupons' ? 'focus' : ''?>"><a href="<?= $this->Url->build(['action' => 'coupons'])?>">COUPONS</a></li>
</ul>

<select class="mob_select" onchange="window.location.href = this.value">
    <option value="<?= $this->Url->build(['action' => 'myAccount'], true)?>" <?= $this->request->getParam('action') === 'myAccount' ? 'selected' : ''?>>OVERVIEW</option>
    <option value="<?= $this->Url->build(['action' => 'profile'], true)?>" <?= $this->request->getParam('action') === 'profile' ? 'selected' : ''?>>PROFILE </option>
    <option value="<?= $this->Url->build(['action' => 'addresses'], true)?>" <?= $this->request->getParam('action') === 'addresses' ? 'selected' : ''?>>ADDRESSES</option>
    <option value="<?= $this->Url->build(['action' => 'orders'], true)?>" <?= $this->request->getParam('action') === 'orders' ? 'selected' : ''?>>ORDERS</option>
    <option value="<?= $this->Url->build(['action' => 'coupons'], true)?>" <?= $this->request->getParam('action') === 'coupons' ? 'selected' : ''?>>COUPONS</option>
</select>
