<?php
defined('_JEXEC') or die;

/**
 * Template for Joomla! CMS, created with Artisteer.
 * See readme.txt for more details on how to use the template.
 */



require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'functions.php';

// Create alias for $this object reference:
$document = & $this;

// Shortcut for template base url:
$templateUrl = $document->baseurl . '/templates/' . $document->template;

// Initialize $view:
$view = $this->artx = new ArtxPage($this);

// Decorate component with Artisteer style:
$view->componentWrapper();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
	xml:lang="<?php echo $document->language; ?>"
	lang="<?php echo $document->language; ?>" dir="ltr">
<head>
<link rel="icon" type="image/png" href="<?php echo $templateUrl; ?>/images/faviconnobil.png" />
<jdoc:include type="head" />
<link rel="stylesheet"
	href="<?php echo $document->baseurl; ?>/templates/system/css/system.css"
	type="text/css" />
<link rel="stylesheet"
	href="<?php echo $document->baseurl; ?>/templates/system/css/general.css"
	type="text/css" />
<link rel="stylesheet" type="text/css"
	href="<?php echo $templateUrl; ?>/css/template.css"
	media="screen" />
<link rel="stylesheet" type="text/css"
	href="<?php echo $templateUrl; ?>/css/custom.css" media="screen" />
<!--[if IE 6]><link rel="stylesheet" href="<?php echo $templateUrl; ?>/css/template.ie6.css" type="text/css" media="screen" /><![endif]-->
<!--[if IE 7]><link rel="stylesheet" href="<?php echo $templateUrl; ?>/css/template.ie7.css" type="text/css" media="screen" /><![endif]-->
<script type="text/javascript">if ('undefined' != typeof jQuery) document._artxJQueryBackup = jQuery;</script>
<script type="text/javascript"
	src="<?php echo $templateUrl; ?>/jquery.js"></script>
<script type="text/javascript">jQuery.noConflict();</script>
<script type="text/javascript"
	src="<?php echo $templateUrl; ?>/script.js"></script>
<script type="text/javascript">if (document._artxJQueryBackup) jQuery = document._artxJQueryBackup;</script>
<script type="text/javascript" src="<?php echo $templateUrl; ?>/date.format.js"></script>
</head>
<body>
	<div id="art-main">

		<div class="cleared reset-box"></div>

		<?php if ($view->containsModules('user3', 'extra1', 'extra2')) : ?>
		<div class="art-bar art-nav">
			<div class="art-nav-outer">
				<div class="art-nav-wrapper">
					<div class="art-nav-inner">
						<?php if ($view->containsModules('extra1')) : ?>
						<div class="art-hmenu-extra1">
							<?php echo $view->position('extra1'); ?>
						</div>
						<?php endif; ?>
						<?php if ($view->containsModules('extra2')) : ?>
						<div class="art-hmenu-extra2">
							<?php echo $view->position('extra2'); ?>
						</div>
						<?php endif; ?>
						<?php echo $view->position('user3'); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="cleared reset-box"></div>

		<?php endif; ?>
		<div id="meny">
			<?php echo $view->position('hornav'); ?>
		</div>

		<div class="art-header">



			<div class="art-header-position">
				<div class="art-header-wrapper">
					<div class="cleared reset-box"></div>
					<div class="art-header-inner">
						<div class="art-textblock">
							<div id="bannerspot">
								<?php echo $view->position('banner3'); ?>
								<?php echo $view->position('banner2'); ?>
								<?php echo $view->position('banner1'); ?>
								<br />
								<?php echo $view->position('banner6'); ?>
								<?php echo $view->position('banner5'); ?>
								<?php echo $view->position('banner4'); ?>
							</div>
							<div style="float: right; position: absolute; top: 45px;right: 0.6em;"><a href="http://transnova.no" title="Gå til Transnova.no"><img src="<?php echo $templateUrl; ?>/../../images/banners/banner_samarbeidmellom.jpg" alt="Transnova - samarbeidspartner" width="328px" height="109px"/></a></div>
						</div>
						<div class="art-logo"><a href="/" title="Hjem"><img src="<?php echo $templateUrl; ?>/images/Nobiltranstest_logo.png" alt="Logo" width="261px" height="138px"/></a></div>
					</div>
				</div>
			</div>


		</div>
		<div class="cleared reset-box"></div>
		<div class="art-box art-sheet">
			<div class="art-box-body art-sheet-body">
				
				<div class="art-layout-wrapper">
				<?php echo "<div class='float-left mr20' style='max-width:24%'>"/*$view->position('left') </div>*/ ?> <jdoc:include type="modules" name="left" style="xhtml" /> </div>
				<?php //echo "<div class='float-right' style='width:23%'>" . $view->position('right') . "</div>"; ?>
					<div class="art-content-layout">
						<div class="art-content-layout-row">
							<div class="art-layout-cell art-content">

								<?php
  
  if ($view->containsModules('breadcrumb'))
    echo artxPost($view->position('breadcrumb'));
//echo $view->positions(array('user1' => 50, 'user2' => 50), 'art-article');
  
  if ($view->hasMessages())
    echo "<div class='float-left' style='width:50%'>" . artxPost('<jdoc:include type="message" />') . "</div>";
  
  echo $view->position('applikasjon');
  
  //echo $view->positions(array('top1' => 33, 'top2' => 33, 'top3' => 33, 'top4' => 25), 'art-block');
  echo $view->positions(array('top1' => 33, 'top2' => 33, 'top3' => 33), 'art-block');
  
  echo '<jdoc:include type="component" />';
  
  //echo $view->positions(array('user4' => 50, 'user5' => 50), 'art-article');
  
?>

								<div class="cleared"></div>
														
							</div>

						</div>
						
					</div>
				</div>
				<div class="cleared"></div>
				

				<?php echo $view->positions(array('bottom1' => 33, 'bottom2' => 33, 'bottom3' => 34), 'art-block'); ?>

				<div class="art-footer">
					<div class="art-footer-body">
						<div class="art-footer-text">
							<?php if ($view->containsModules('copyright')): ?>
							<?php echo $view->position('copyright', 'art-nostyle'); ?>
							<?php else: ?>
							<?php ob_start(); ?>
							<div style="border-top: 1px dashed #cccccc; margin-left: 10px">
								<br />
							</div>

							<ul style="margin: 0px 10px">
								<li style="display: block; float: left; width: 150px;">
									<p style="font-size: 18px;">INFO</p>
									<br />

									<ul>
										<li><a href="#">Welcome</a></li>

										<li><a href="#">People</a></li>

										<li><a href="#">Management</a></li>
									</ul>
								</li>

								<li style="display: block; float: left; width: 150px;">
									<p style="font-size: 18px;">LOCATION</p>
									<br />

									<ul>
										<li><a href="#">Map</a></li>

										<li><a href="#">Address</a></li>

										<li><a href="#">Contact Us</a></li>
									</ul>
								</li>

								<li style="display: block; float: left; width: 150px;">
									<p style="font-size: 18px;">ABOUT</p>
									<br />

									<ul>
										<li><a href="#">Company</a></li>

										<li><a href="#">Terms</a></li>
									</ul>
								</li>
							</ul>

							<p style="text-align: right; padding-right: 20px">
								<img width="32" height="32" alt=""
									src="<?php echo $templateUrl; ?>/images/rss_32-2.png"
									style="margin: 5px;" /><img width="32" height="32" alt=""
									src="<?php echo $templateUrl; ?>/images/picasa_32-2.png"
									style="margin: 5px;" /><img width="32" height="32" alt=""
									src="<?php echo $templateUrl; ?>/images/facebook_32-2.png"
									style="margin: 5px;" /><img width="32" height="32" alt=""
									src="<?php echo $templateUrl; ?>/images/flickr_32-2.png"
									style="margin: 5px;" /><br /> Copyright © 2011. All Rights
								Reserved.<br /> Icons by <a href="http://artdesigner.lv">Artdesigner.lv</a>
							</p>
							<br /> <br />

							<?php echo str_replace('%YEAR%', date('Y'), ob_get_clean()); ?>
							<?php endif; ?>
						</div>
						<div class="cleared"></div>
					</div>
				</div>

				<div class="cleared"></div>
			</div>
		</div>
		<div class="cleared"></div>
		<p class="art-page-footer">
		<div class="cleared"></div>
	</div>
	<!-- id="art-main" -->

	<?php echo $view->position('debug'); ?>
	<script type="text/javascript">
	var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
	document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
	</script>
	<script type="text/javascript">
	try{
	var pageTracker = _gat._getTracker("UA-9394656-1");
	pageTracker._trackPageview();
	} catch(err) {}</script>
</body>
</html>
