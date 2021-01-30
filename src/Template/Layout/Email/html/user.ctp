<?php ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="x-apple-disable-message-reformatting">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?= $this->fetch('title')?></title>
        <style>

            .sub_logo{padding: 25px 0}    
            .user_dtl h2{color: #3A3A3A;font-size: 24px;font-weight: 400;margin: 0 0 30px}
            .user_dtl h4{color: #515151;font-size: 16px;font-weight: 400;margin: 0}
            .user_dtl p{margin: 0;font-size: 16px;color: #515151;font-weight: 400;} 
            .tank_T{margin-top:55px}
            .btn.btn-primary{border-radius:4px;background:#FFAE5F;color: #ffffff;font-size: 16.7px;}
            .product{color:#515151;font-size: 16px;padding:10px 1.6rem;margin: 0;font-weight: 400;}
            .product_ft{color:#fff;font-size: 14px;padding: 0 1.6rem;margin: 0;font-weight: 300;cursor: pointer}
            .btn{padding:8px 30px;}
            .social_icon p{font-size: 15.66px;color: #8E8E8E;margin: 0 0 5px;}
            .social_icon p img{margin: 0 0 55px}
            .track_oder_bttn{text-align: center;margin-bottom:28px;}  
            .track_oder_ft{text-align: center;margin-bottom:60px;margin-top: 87px}  
            .img_tx p{font-size: 13px;margin:0;padding: 10px 0;color:#353535;font-weight: 400;} 
            .user_dtl{padding:0 2.5rem 60px;background: #fff}
            .logo img{width: 185px;vertical-align: middle}
            table.top_table_br{border: 1px solid #FFAE5F;margin-bottom:30px;margin-top: 30px;border-radius:24px;}
            .bttm_br{border-bottom: 1px solid #E2E0E0;width: 100%}
            .bttm_TT{margin-top:106px;margin-bottom: 38px;}
            .ft_aria{margin-left: 0;text-align: center;border-right: 1px solid #fff}
            .bttm_mrg{margin-bottom:32px;}

            table {
                border-spacing: 0 !important;
                border-collapse: separate !important;   
                border-spacing: 0;
            }

            a {
                text-decoration: none;
            }

            .primary{
                background: #f3a333;
            }

            .bg_light{
                background: #fafafa;
            }
            .bg_black{
                background:#003B49;
            }
            .email-section{
                padding:1em;
            }




            body{
                font-family: 'Roboto', sans-serif;
                font-weight: 400;
                font-size: 14px;
                line-height: 24px

            }

            a{
                color: #f3a333;
            }
            .footer ul li{list-style: none;margin-bottom: 10px;font-size: 14px;}
            .footer ul li a{color: rgba(255,255,255,1);}


            @media only screen and (max-width: 414px) {
                .img_tx p {font-size: 18px;padding: 6px 0;}
                .icon{text-align: left;}
                .text-services{padding-left: 0;padding-right: 20px;text-align: left;}
                .user_dtl h4{font-size:22px}
                .user_dtl p{font-size:22px}
                .product{font-size: 22px; white-space: nowrap;}
                .btn.btn-primary{font-size: 20px}
                .product_ft{font-size: 22px; white-space: nowrap;}
                .social_icon p {font-size: 22px;}
                .user_dtl h2 {font-weight: 500; font-size: 24px;}


            }

        </style>
    </head>
    <body width="100%" style="margin: 0; padding: 0 !important;">
        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" style="margin:4rem auto 0;">
            <tr>
                <td>
                    <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                        <tr>
                            <td class="bg_white logo" style="padding:.7em 0;">
                                <?= $this->Html->image('logo.svg', ['fullBase' => true])?>
                            </td>
                        </tr><!-- end tr -->

                        <table align="center" width="600" class="top_table_br">
                            <tr>
                                <td align="center">
                            <tr>
                                <?= $this->fetch('content')?>
                            </tr>

                        </table>

                        <table align="center" width="600" style="margin: 30px auto 0">                         

                            <tr>
                                <td align="center" class="social_icon"><br/>
                                    <p>Follow us on </p>
                                    <p>
                                        <a href="https://www.instagram.com/hpsinghfabrics/" style="padding: 4px"><?= $this->Html->image('email/insta.png', ['fullBase' => true])?></a>
                                        <a href="https://www.facebook.com/hpfabrics" style="padding: 4px"><?= $this->Html->image('email/facebook.png', ['fullBase' => true])?></a>
                                    </p>
                                </td>
                            </tr><!-- end tr -->

                            <tr>
                                <td>
                                    <table class="bttm_mrg" align="center" style="background:#FFAE5F;width: 100%">
                                        <tr>
                                            <td width="33%">
                                                <div class="product_ft ft_aria">
                                                    <p>
                                                        <a style="color:#fff" href="https://www.hpsingh.com/stories">Our Stores</a>
                                                    </p>
                                                </div>
                                            </td>
                                            <td width="33%">
                                                <div class="product_ft ft_aria">
                                                    <p>
                                                        <a style="color:#fff" href="https://www.hpsingh.com/contact-us">Contact Us</a>
                                                    </p>
                                                </div>
                                            </td>
                                            <td width="33%">
                                                <div class="product_ft">
                                                    <p>
                                                        <a style="color:#fff" href="https://www.hpsingh.com">Continue Shopping</a></p>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>

