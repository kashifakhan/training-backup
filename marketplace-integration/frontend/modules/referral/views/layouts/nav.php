<?php 
use frontend\modules\referral\components\Helper;
?>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"></a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?= Helper::getUrl('account/dashboard'); ?>">Dashboard</a></li>
                <!-- <li>
                    <a href="<?php //echo Helper::getUrl('stats/history'); ?>">Referral History</a>
                </li> -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Referrals<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                        	<a href="<?= Helper::getUrl('stats/index') ?>">History</a>
                        </li>
                        <li>
                            <a href="<?= Helper::getUrl('payment/index') ?>">Transaction</a>
						</li>
						<li>
                            <a href="<?= Helper::getUrl('redeem/choose-payment') ?>">Redeem</a>
						</li>
                    </ul>
                </li>
                <!-- <li>
                    <a href="<?php //echo Helper::getUrl('redeem/index'); ?>">Redeem</a>
                </li> -->
                <li>
                    <a href="<?= Helper::getUrl('account/logout'); ?>">Logout</a>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right navbar-2">
                <li><a href="<?= Helper::getUrl('account/dashboard'); ?>">Dashboard</a></li>
                <!-- <li>
                    <a href="<?php //echo Helper::getUrl('stats/history'); ?>">Referral History</a>
                </li> -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Referrals<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                        	<a href="<?= Helper::getUrl('stats/index') ?>">History</a>
                        </li>
                        <li>
                            <a href="<?= Helper::getUrl('payment/index') ?>">Transaction</a>
						</li>
						<li>
                            <a href="<?= Helper::getUrl('redeem/choose-payment') ?>">Redeem</a>
						</li>
                    </ul>
                </li>
                <!-- <li>
                    <a href="<?php //echo Helper::getUrl('redeem/index'); ?>">Redeem</a>
                </li> -->
                <li>
                    <a href="<?= Helper::getUrl('account/logout'); ?>">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>