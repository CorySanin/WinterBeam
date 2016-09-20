<!--Misc-->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="content-language" content="en" />
        <META NAME="MSSmartTagsPreventParsing" CONTENT="true"/>
        <meta name="google-site-verification" content="<?php echo $config->GWTver; ?>" />
        <meta name="msvalidate.01" content="<?php echo $config->BWTver; ?>" />
        <meta name="wot-verification" content="<?php echo $config->WOTver; ?>"/>
            
        <!--OpenGraph-->
        <meta property="og:title" content="<?php echo $page['title'] . $config->titleSuffix; ?>"/>
        <meta property="og:description" content="<?php echo $page['description']; ?>"/>
        <meta property="og:url" content="<?php echo $config->domainWiProtocol . $page['url']; ?>"/>
        <meta property="og:image" content="<?php echo $page['image']; ?>"/>
        <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="website" />
        <meta property="og:site_name" content="<?php echo $config->siteName; ?>" />

        <!--Icons and Images-->
        <!--
        <link rel="shortcut icon" href="<?php echo $config->domainWiProtocol; ?>/images/assets/favicon.ico">
        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo $config->domainWiProtocol; ?>/images/assets/apple-touch-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo $config->domainWiProtocol; ?>/images/assets/apple-touch-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo $config->domainWiProtocol; ?>/images/assets/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo $config->domainWiProtocol; ?>/images/assets/apple-touch-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo $config->domainWiProtocol; ?>/images/assets/apple-touch-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo $config->domainWiProtocol; ?>/images/assets/apple-touch-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo $config->domainWiProtocol; ?>/images/assets/apple-touch-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo $config->domainWiProtocol; ?>/images/assets/apple-touch-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $config->domainWiProtocol; ?>/images/assets/apple-touch-icon-180x180.png">
        <meta name="apple-mobile-web-app-title" content="The Zocial">
        <link rel="icon" type="image/png" href="<?php echo $config->domainWiProtocol; ?>/images/assets/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="<?php echo $config->domainWiProtocol; ?>/images/assets/favicon-194x194.png" sizes="194x194">
        <link rel="icon" type="image/png" href="<?php echo $config->domainWiProtocol; ?>/images/assets/favicon-96x96.png" sizes="96x96">
        <link rel="icon" type="image/png" href="<?php echo $config->domainWiProtocol; ?>/images/assets/android-chrome-192x192.png" sizes="192x192">
        <link rel="icon" type="image/png" href="<?php echo $config->domainWiProtocol; ?>/images/assets/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="<?php echo $config->domainWiProtocol; ?>/images/assets/manifest.json">
        
        <meta name="msapplication-TileColor" content="#156ab4">
        <meta name="msapplication-TileImage" content="<?php echo $config->domainWiProtocol; ?>/images/assets/mstile-144x144.png">
        <meta name="msapplication-config" content="<?php echo $config->domainWiProtocol; ?>/images/assets/browserconfig.xml">
        <meta name="theme-color" content="#156ab4">
        -->
        <link rel="icon" type="image/png" href="<?php echo $config->domainWiProtocol; ?>/assets/meta/favicon-16x16.png" sizes="16x16">

        <!--Standard meta tags-->
        <title><?php echo $page['title'] . $config->titleSuffix; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="<?php echo $page['description'] ?>" />
        <link rel="canonical" href="<?php echo $config->domainWiProtocol . $page['url']; ?>" />
        <link rel="image_src" href="<?php echo $page['image']; ?>"/>
        
        <!--CSS Links-->
        <link href="<?php echo $config->domainWiProtocol . '/css/reset.css' ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo $config->domainWiProtocol . '/css/styles.css.php' ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo $config->domainWiProtocol . '/css/forms.css.php' ?>" rel="stylesheet" type="text/css" />