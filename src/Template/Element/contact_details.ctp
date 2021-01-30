<?php ?>

                            <div class="form-group custom_add">
                                <h2>Need help contact us?</h2>
                                <div class="mainTx">
                                    <ul>
                                        <li><i class="fa fa-whatsapp" target="_blank"></i><h5>Call or WhatsApp us</h5></li>
                                        <li><a target="_blank" href="https://api.whatsapp.com/send?phone=<?= \Cake\Core\Configure::read('Store.supportWhatsapp')?>"><?= \Cake\Core\Configure::read('Store.supportWhatsapp')?></a></li>
                                        <li><p>Mon - Sat | 10 AM to 7 PM (IST)</p></li>
                                    </ul>
                                </div>
                                <div class="mainTx">
                                    <ul>
                                        <li><i class="fa fa-envelope" aria-hidden="true"></i><h5>Write to us</h5></li>
                                        <li><a href="mailto:<?= \Cake\Core\Configure::read('Store.email')?>"><?= \Cake\Core\Configure::read('Store.email')?></a></li>
                                        <li><p>We’ll get back to you within 24 hours</p></li>
                                    </ul>
                                </div>
                            </div>