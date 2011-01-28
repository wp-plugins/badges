=== Badges ===
Contributors: eroux
Tags: books, read, reading, admin, administration, jadb
Requires at least: 2.8
Tested up to: 3.0.4
Stable tag: 1.0.0

Display a set of badges based on files in a directory off the root of the blog.

== Description ==
Display "Badges" (which are really no more than HTML snippets) from a set of files in a specified directory off the root of the blog. The directory will default to "./badges" and the Zip file contains both that directory as well as a "Sample" badge.

Using the Widget you can choose whether to:

1. enable "Display Badge in a Box" (enabled by default, uses internal CSS)
1. enable "Display a Drop-Shadow" (probably best used with "Box Mode")

as well as

1. decide whether you would like to use a Title
1. define the directory of the badges.

== Installation ==
**Install**

1. Unzip the `badges.zip` file. 
1. Upload `badges.php` to the `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Use the "Badges" widget.

== Frequently Asked Questions ==

= Which naming convention is used for the badges =
All badges needs to be named `XXname.inc`, where "XX" is a number (used to determine ordering) and the ".inc" is required.

= What is the format of the "Badge" files? =
You could view the included "demo" file: `00testbadge.inc`, but here's another, slightly simpler, example:

    <!-- Support CC -->
    <div id="badge-supportcc-inner" onclick="location.href='http://creativecommons.org';" style="cursor: pointer;">
    <img width=88 height=31 border=0 alt="http://creativecommons.org" title="Support the Creative Commons!"
        src="http://creativecommons.org/images/support/2010/cc-support.png"<br />
        Support the Creative Commons!
    </div>
    <!-- /Support CC -->

== Screenshots ==
1. Configuring the widget to read badges from `damn-badges` and display them as "Badges".
2. The default configuration of the widget, displaying the default path (badges).
3. The first configuration as rendered by Chrome.

== Changelog ==

= 1.0 =
* Initial Public Release

