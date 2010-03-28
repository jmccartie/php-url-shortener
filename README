# Overivew #

This script is simple, but works.  It creates short url's based on your own domain name. The create script is protected by a simple password and will return plain text or JSON.  Included is also a small bit of code for a bookmarklet (see instructions below).

# Install #
1. Run the setup.sql file in your MySQL database to setup the appropriate tables
1. Modify the "config.sample.php" file to match your database, short url hostname, and password (used to protect the creation script)
1. Rename "config.sample.php" to "config.php"

** Don't forget the .htaccess file! **

# Usage #
## Creating Links ##

http://mydomain.me/create.php?

Params:

* url - (required) - the long url to be shortened
* password - (required) - the password you created in the config file
* callback - (BOOL, optional) - returns the JSON in a callback function. Helpful for the bookmarklet
* text - (BOOL, optional) - for a plain text output

(defaults to JSON output)

## Bookmarklet ##
1. Replace "MYDOMAIN.ME" and "YOURPASSWORD" in the bookmarklet script file
1. Create a new bookmark in your favorite browser -- copy/paste the javascript into the url of the new bookmark
1. When you're on a page you want to create a short link for, click the new bookmark -- a javascript popup will show with your new link

## Viewing Links ##
Whenever someone follows your link, a view is recorded with the user's IP and User Agent info.  This info is not presently used by the view/stats script, but it may be in the future.

## Tracking ##
view.php will show you all of your current links, sorted by total views (descending)
