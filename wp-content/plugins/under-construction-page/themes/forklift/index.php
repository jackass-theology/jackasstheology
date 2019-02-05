<?php
/*
 * UnderConstructionPage
 * Forklift theme
 * (c) WebFactory Ltd, 2015 - 2019
 */


// this is an include only WP file
if (!defined('ABSPATH')) {
  die;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>[title]</title>
    <meta name="description" content="[description]" />
    <meta name="generator" content="[generator]">
    <link rel="stylesheet" href="[theme-url-common]css/bootstrap.min.css?v=[version]" type="text/css">
    <link rel="stylesheet" href="[theme-url]style.css?v=[version]" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,900">
    [head]
  </head>

  <body>
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
          <h1>[heading1]</h1>
        </div>
      </div>
    </div>

    <div id="hero-image">
      <img src="[theme-url]forklift.png" alt="Forklift at Work" title="Forklift at Work">
    </div>
    <div class="container">

      <div class="row">
        <div class="col-xs-12 col-md-8 col-md-offset-2 col-lg-offset-2 col-lg-8">
          <p class="content">[content]</p>
        </div>
      </div>

      <div class="row" id="social">
        <div class="col-xs-12 col-md-12 col-lg-12">
          [social-icons]
        </div>
      </div>

    </div>
    [footer]
  </body>
</html>
