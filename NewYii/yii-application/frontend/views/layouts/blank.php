<?php
use \yii\helpers\Url;
use frontend\modules\jet\assets\AppAsset;
use frontend\widgets\Alert;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\widgets\Menu;

$valuecheck="";
$valuecheck=Yii::$app->request->get('shop');
AppAsset::register($this);
?>
<?php $this->beginPage() ?>

<html lang="<?= Yii::$app->language ?>">
<head>
	<link rel="icon" href="<?php echo Yii::$app->request->baseUrl?>/images/favicon.ico">
	<meta charset="<?= Yii::$app->charset ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta content="NOINDEX, NOFOLLOW" name="robots">
	<meta name="google-site-verification" content="vJ8BS5PRRVFvpk5dCrUMgTZdDVIuWKMbvmCo2QTIEag"/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode("Shopify Jet Integration | CedCommerce");?></title>
    <script type="text/javascript" src="<?= Yii::$app->getUrlManager()->getBaseUrl();?>/js/jquery.js"></script>
    <?php $this->head() ?>
	<script type="text/javascript">
	    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	    ga('create', 'UA-63841461-1', 'auto');
	    ga('send', 'pageview');
	</script>
	<script type="text/javascript">
	var CURRENT_STEP_ID = 1;
	</script>
</head>
<body class="iframe-body">
<?php $this->beginBody() ?>
    	 	<div class="wrap ced-jet-navigation-mbl">
		        <div class="fixed-container-body-class">
		        	<?= Alert::widget() ?>
		            <?= $content ?>
		        </div>
		        <div id="helpSection" style="display:none"></div>
			</div>

			<div class="copyright-section copyright-new">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<span>Copyright © 2017 CEDCOMMERCE | All Rights Reserved.</span>
					</div>
				</div>
				<div class="overlay" style="display: none;" id="LoadingMSG">
					<!-- <img src="<?php //echo Yii::$app->getUrlManager()->getBaseUrl();?>/images/loading-large.gif"> -->
					<div id="fountainG">
						<div id="fountainG_1" class="fountainG"></div>
						<div id="fountainG_2" class="fountainG"></div>
						<div id="fountainG_3" class="fountainG"></div>
						<div id="fountainG_4" class="fountainG"></div>
						<div id="fountainG_5" class="fountainG"></div>
						<div id="fountainG_6" class="fountainG"></div>
						<div id="fountainG_7" class="fountainG"></div>
						<div id="fountainG_8" class="fountainG"></div>
					</div>
				</div>
			</div>

		
<?php $this->endBody() ?>
	<script src="https://cdn.shopify.com/s/assets/external/app.js"></script>
	<?php 
		if(!Yii::$app->user->isGuest)
		{
		    if($valuecheck)
		  	{
	?>
				<script type="text/javascript">
					//add css for embedded app
					$(document).ready(function(){
						var head1=$(document).find('head');
						var url = '<?= Yii::$app->getUrlManager()->getBaseUrl();?>/css/embapp.css';
						head1.append($("<link/>", { rel: "stylesheet", href: url, type: "text/css" } ));
						$('.logout_merchant').css('display','none');
						//$('nav.navbar-fixed-top').css('display','none');
						$('.wrap > .container').css('padding',0);
					});

					//initialise embedded iframe 
					ShopifyApp.init({
						apiKey: "<?php echo PUBLIC_KEY;?>",
						shopOrigin: "<?php echo "https://".\Yii::$app->user->identity->username;?>"
					});
				</script>
	<?php 
			}
		} 
	?> 
		<!-- Hotjar Tracking Code for https://shopify.cedcommerce.com/integration -->
		<script type="text/javascript">
		    (function (h, o, t, j, a, r) {
		        h.hj = h.hj || function () {
		                (h.hj.q = h.hj.q || []).push(arguments)
		            };
		        h._hjSettings = {hjid: 305411, hjsv: 5};
		        a = o.getElementsByTagName('head')[0];
		        r = o.createElement('script');
		        r.async = 1;
		        r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
		        a.appendChild(r);
		    })(window, document, '//static.hotjar.com/c/hotjar-', '.js?sv=');
	    </script>
		<!--Start of Zopim Live Chat Script-->
		<script type="text/javascript">
		window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
		d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
		_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
		$.src="//v2.zopim.com/?322cfxiaxE0fIlpUlCwrBT7hUvfrtmuw";z.t=+new Date;$.
		type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
		
		$zopim(function(){
		window.setTimeout(function() {
		//$zopim.livechat.window.show();
		}, 2000); //time in milliseconds
		});
		</script>
		<!--End of Zopim Live Chat Script-->

		<!-- menu -->
		<script type="text/javascript">
			jQuery(document).ready(function(){
				$('.dropdown').addClass('dropdown1').removeClass('dropdown');
			});
			$(".dropdown1").click(function(e){
		    });
		</script>
		<!-- end menu -->
	</body>
</html>
<?php $this->endPage() ?>
