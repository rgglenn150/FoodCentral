<?php
defined('BASEPATH') or exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Food Central</title>
	<script  type="text/javascript" src="<?php echo base_url() ?>bower_components/jquery/dist/jquery.min.js"></script>
	<script  type="text/javascript" src="<?php echo base_url() ?>bower_components/web3/dist/web3.min.js"></script>
	<script  type="text/javascript" src="<?php echo base_url() ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

	<!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>node_modules/startbootstrap-heroic-features/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom styles for this template -->
	<link href="<?php echo base_url(); ?>node_modules/startbootstrap-heroic-features/css/heroic-features.css" rel="stylesheet">
	<script type="text/javascript" src="<?php echo base_url('assets/js/customWeb3.js') ?>"></script> 
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="<?php echo site_url()?>">Food Central</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="<?php echo site_url()?>">Home
                <span class="sr-only"></span>
              </a>
            </li>
           
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url() ?>/dashboard/mytransactions">Transactions</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url() ?>/dashboard/storeTransactions">Seller Transactions</a>
            </li>

          </ul>
        </div>
      </div>
    </nav>
