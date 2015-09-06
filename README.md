# Plates Assets Cache Extension

Caching and compression for Plates template assets (JavaScript and CSS).

# Installation

```
composer install odan/plates-asset-cache
```

# Configuration

```php
$view = new \League\Plates\Engine('/path/with/html/templates', null);

// Add folder shortcut (assets::file.js)
$view->addFolder('assets', '/public/assets');

// Asset extention options
$options = array(
	// View base path
	'cachepath' => $this->get('path.view_cache'),
	// Create different hash for each language
	'cachekey' => 'en_US',
	// Base Url for public cache directory
	'baseurl' => 'http://localhost',
	// Enable JavaScript and CSS compression
	'minify' => 1
);

// Register Asset extension
$view->loadExtension(new \Molengo\Plates\Extension\AssetCacheExtension($options));
```
# Usage

In your controller

```php
$assets = array();

// Default assets from public assets folder
$assets[] = 'assets::css/bootstrap.css';
$assets[] = 'assets::js/jquery.js';

// Non public assets from your bundle
$assets[] = 'Index/css/index.css';
$assets[] = 'Index/js/index.js';

// Add assets
$view->addData(['assets' => $assets]);

// Render and output layout template
echo $view->render('Index/html/layout.html.php');
```

# Layout template (layout.html.php)

Output  cached and minified CSS content:

```php
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <base href="<?= $baseurl; ?>" />
        <title>Demo</title>
        <link type="text/css" href="assets/css/bootstrap.min.css" rel="stylesheet" />
        <?= $this->assetCss($assets, ['inline' => false]); ?>
    </head>
```

Output cached and minified JavaScript content:

```php
<!-- JavaScript -->
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/ie10-viewport-bug-workaround.js"></script>
<?= $this->assetJs($assets, ['inline' => false]); ?>
```
