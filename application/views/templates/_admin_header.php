<!DOCTYPE html>
<html>
<head lang="en">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notix | HCET Jabalpur</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>css/style.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- favicons -->
        <link rel="shortcut icon" href="<?= base_url(); ?>favicon.ico">
        <link rel="icon" href="<?= base_url(); ?>favicon.ico">
    <!-- favicons -->
</head>
<body>
    <div class="header">
        <div class="container">
            <span class="site-title" onclick="window.location='<?= base_url(); ?>admin/home'">
                <img class="notix-logo" src="<?= base_url(); ?>img/notix-logo.svg">
                <span>Notix</span>
            </span>
            <span class="navlinks">
                <ul>
                    <li><?php echo anchor('site/about', 'About'); ?></li>
                    <li><?= anchor('admin/logout', 'Logout'); ?></li>
                </ul>
            </span>
        </div>
    </div>