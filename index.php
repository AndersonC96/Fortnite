<?php
/**
 * Redirect to new MVC structure
 * 
 * This file redirects all requests to the new public/ directory.
 * The MVC application is now served from /Fortnite/public/
 */

header('Location: public/');
exit;
