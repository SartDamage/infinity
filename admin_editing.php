<?php
include $_SERVER['DOCUMENT_ROOT'].'/include/conection.php';
include $_SERVER['DOCUMENT_ROOT'].'/session.php';
include $_SERVER['DOCUMENT_ROOT'].'/include/global_variable.php';
$userDetails=$userClass->userDetails($session_id);
$UID = $userDetails->roleid;
$ID = $userDetails->ID;
$staffid = $userDetails->StaffID;
?>
<?php include $_SERVER['DOCUMENT_ROOT'].'/include/header.php';?>

<style>
a {  -webkit-transition: .25s all;transition: .25s all;}
.table td, .table th{vertical-align:middle!important;padding: 0.25rem!important;}
.table .center{text-align:  center;}
.card {overflow: hidden;box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);-webkit-transition: .25s box-shadow;transition: .25s box-shadow;}
.card:focus,.card:hover {box-shadow: 0 5px 11px 0 rgba(0, 0, 0, 0.18), 0 4px 15px 0 rgba(0, 0, 0, 0.15);}
.card-inverse .card-img-overlay {background-color: rgba(51, 51, 51, 0.85);border-color: rgba(51, 51, 51, 0.85);}
.accord{width: -webkit-fill-available;width:100%;border-radius: 0px;}
#accordion .panel{padding:5 0 5 0;}
#accordion .panel-body{padding:5px;border-style: none ridge none ridge;margin: 0 8 0 8;}
#accordion .panel-body-last{padding:5px;border-style: none ridge ridge ridge;margin: 0 8 0 8;}
.panel-default>.panel-heading a:after {content: "";position: relative;top: 1px;display: inline-block;font-family: 'Glyphicons Halflings';font-style: normal;font-weight: 400;line-height: 1;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;float: right;transition: transform .25s linear;-webkit-transition: -webkit-transform .25s linear;}
.panel-default>.panel-heading a[aria-expanded="true"] {/*background-color: #eee;*/}
.panel-default>.panel-heading a[aria-expanded="true"]:after {content: "\2212";-webkit-transform: rotate(180deg);transform: rotate(180deg);}
.panel-default>.panel-heading a[aria-expanded="false"]:after {content: "\002b";-webkit-transform: rotate(90deg);transform: rotate(90deg);}
#txt-search{border-radius:24px;}
.thead-teal{height:45px;}
input[type=search]::-webkit-search-cancel-button {-webkit-appearance: searchfield-cancel-button;}
.nav-pills .nav-link.active, .nav-pills .show>.nav-link{color: #fff!important;
    background-color: #8BC34A;}
	#exTab3 .nav-pills>li>a {
    border-radius: 5px 5px 0 0;
    padding: 15px;
}
.nav-item a {color: #8BC34A!important;}
table{
  margin: 0 auto;
  width: 100%;
  clear: both;
  border-collapse: collapse;
  table-layout: fixed; 
  word-wrap:break-word; 
}
table.dataTable.nowrap td {
    white-space: normal;
}
</style>
<?php/* include $_SERVER['DOCUMENT_ROOT'].'/nav_sidebar.php';*/?>
<?php include $_SERVER['DOCUMENT_ROOT'].'/include/navbar_framework/nav_sidebar_patho_home.php';?>

<body style="background-color:#E0F2F1;">
	<div id="main">
		<?php include  $_SERVER['DOCUMENT_ROOT'].'/nav_bartop.php';?>
		<div class="container">
			<a href="#" onclick="goBack()" class="float" title="Click, to go back">
				<i class="fa fa-times my-float"></i>
			</a>
		<br>
			<div class="card card-outline-info mb-3">
			  <div class="card-block heading_bar">
				<h5><!--title--> <br><small>general changes to be used in application</small><?php // echo $userDetails->username; ?> <!--(To be used in admin)--></h5>
			  </div>
			</div>
			<div class="card card-outline-info mb-3">
				<div class="card-block">
					<div class="row justify-content-md-beginning">
					</div>
				</div>
			</div>		
			<div class="card card-outline-info mb-3 margin_bot_8">
			  <div class="card-block">
					
							<table id="myTable" class="table table-striped table-hover dt-responsive nowrap" >
							</table>
						
						<!--<div class="tab-pane border border-teal" id="4b">
							<h3>will contain all reports irrespective of time,payment.</h3>
						</div>-->				
					
			  </div>
		</div>
	</div>
<script>
</script>
<?php
$pageTitle = "General Changes"; // Call this in your pages' files to define the page title
$pageContents = ob_get_contents (); // Get all the page's HTML into a string
ob_end_clean (); // Wipe the buffer

// Replace <!--TITLE--> with $pageTitle variable contents, and print the HTML
echo str_replace ('<!--title-->', $pageTitle, $pageContents);
?>	

<?php include  $_SERVER['DOCUMENT_ROOT'].'/include/footer.php';?>
