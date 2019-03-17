=== Plugin Name ===
Contributors: yingling017
Donate link: https://jasonyingling.me/donations/buy-me-a-coffee/
Tags: twitter, tweet, twitter plugin, pull quote, share, social media, quotes, quotation
Requires at least: 3.0.1
Tested up to: 5.0
Stable tag: 1.2.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Easily add tweetable pull quotes to your posts.

== Description ==

This plugin allows you to easily create pull quotes in your posts by adding a button to the post editor. As an added bonus, pull quotes can be easily shared to Twitter by the end user by clicking the Twitter icon.

You've got 3 options for pull quotes, full-width, right-aligned, or left-aligned. Easy Pull Quotes will take on the styles and font sizes from your theme. Plus be on the lookout for customizer options coming soon!

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload `easy-pull-quotes.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Place `<?php do_action('plugin_name_hook'); ?>` in your templates

== Frequently Asked Questions ==

= How do I add a pull quote? =

Just select the Easy Pull Quotes button on the post editor. Insert some text. Select your alignment. Press ok.

= But what if I want to be difficult and not do that? =

Well you could manually enter the shortcode. It takes 1 attribute 'align' which can take 1 of 3 arguments 'align-left', 'align-right', and, you guessed it, 'align-center'.

`[epq-quote align="align-right"]Bleep bloop blorp[/epq-quote]`

= Can I edit the styles of the pull quote? =

Sure! You'll just have to use CSS. Right now the class `.epq-pull-quote-default` contains the styling for the pull quote. If you want to edit the Twitter icon that can be done with `.epq-twitter`. But be warned the icon is using the proper Twitter brand standard colors.

= Anything else I need to know? =

Not really. The plugin is pretty simple.

== Screenshots ==

1. The Easy Pull Quotes button is added to the Post Editor upon installation.
2. After clicking the Easy Pull Quotes button you'll get a nice popup to enter your quote.
3. The various layouts of Easy Pull Quotes.

== Changelog ==

= 1.2.2 =
* Fixing a bug with urlencoding caused by WordPress encoding HTML entities
  in the editor. Example, & would be encoded as &amp; in the editor then encoded
  as %26amp%3B in the Twitter url insteald of just %26.

= 1.2.1 =
* Better encoding for characters used in Twitter urls

= 1.1 =
* Switching twitter.com/widgets.js to only load when Easy Pull Quotes is used in a post

= 1.0 =
* The initial plugin

== Upgrade Notice ==

= 1.1 =
Switching twitter.com/widgets.js to only load when Easy Pull Quotes is used in a post

= 1.0 =
Initial release. Welcome to Easy Pull Quotes.
