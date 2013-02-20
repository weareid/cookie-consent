cookie-consent
==============

WordPress plugin to show a cookie message &amp; to provide a cookie control panel for users.

Installation
============

Download and activate the WordPress plugin as normal.

In your theme header file, add the following line right after the opening <body> tag:

```php
<body>
<?php cookie_consent_display(); ?>
...
```

Content
=======

To restrict content based on cookie settings, you could do the following in your theme files:

```php
<?php if( !isset($_COOKIE['google_cookies']) || $_COOKIE['google_cookies'] == 'enabled' ) { ?>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-XXXXXXXX-X']);
  _gaq.push(['_trackPageview']);)

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<?php } ?>
```
