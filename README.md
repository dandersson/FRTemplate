FRTemplate — a small web site templating framework
==================================================
After maintaining two sites built on a quite similar foundation, I began to merge the common functionality into a framework. This is the result.

Structured as a PHP-based templating system, it provides some utility functions for keeping multi-lingual versions of a web site in sync, with an emphasis on keeping the templating system close to the HTML end result, using PHP in two separate ways:

* as a back-end system using a class structure accessed by an [auto-loading mechanism](http://php.net/manual/en/language.oop5.autoload.php)
* as a light-weight templating system within the HTML templates.

I find that the way to PHP madness is usually avoided by clearly separating its applications in this way. When more advanced functionality spreads to be interspersed with HTML layout, soon everything is lost as per code clarity and maintainability.

* [FRTemplate project page at Github](https://github,com/dandersson/FRTemplate)
* [FRTemplate-sample at Github](https://github.com/dandersson/FRTemplate-sample) — a minimal demonstration of a site structured to use FRTemplate

Generality
----------
The system is not written with general application in mind, but rather tailor-made for a couple of real-life sites. The code is presented here mostly for the very few who might have any interest in this specific collaboration.

Performance
-----------
Performance has never been a problem even with a vanilla Apache configuration for the scale at which the target sites are used. I currently run the sites behind a [Varnish](https://www.varnish-cache.org/) instance anyway, which makes performance an absolute non-issue.

Documentation
-------------
It is tiny enough to be readable in its own. I would not recommend it to anyone who do not want to read any code — that is not its purpose. Rather it is meant to be a framwork that provides some utility functions for tedious tasts, keeping the language constructs available at all moments for anything it natively handles well.

Looking at the code behind the [sample FRTemplate site](https://github.com/dandersson/FRTemplate-sample) should be a nice guide. Some more advanced functionality such as e-mail form functionality with [reCaptcha](https://www.google.com/recaptcha) are not showcased very well at the moment. The standard `mod_rewrite` format used (if this setting is enabled) is described in `FRTemplate/site.php`.
