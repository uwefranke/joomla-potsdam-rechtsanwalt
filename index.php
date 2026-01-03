<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.potsdam-rechtsanwalt
 * @copyright   Copyright (C) 2026 - Alle Rechte vorbehalten
 * @license     GNU General Public License version 2 or later
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Uri\Uri;

/** @var Joomla\CMS\Document\HtmlDocument $this */

$app = Factory::getApplication();
$wa  = $this->getWebAssetManager();

// Template-Parameter abrufen
$params = $app->getTemplate(true)->params;
$logo = $params->get('logo', '');
$primaryColor = $params->get('primary_color', '#1a4d7a');
$secondaryColor = $params->get('secondary_color', '#b8860b');
$phone = $params->get('phone', '');
$email = $params->get('email', '');
$address = $params->get('address', '');
$openingHours = $params->get('opening_hours', '');
$showBreadcrumbs = $params->get('show_breadcrumbs', 1);

// CSS und JS laden
$wa->registerAndUseStyle('template.main', 'templates/' . $this->template . '/css/template.css', ['version' => 'auto']);
$wa->registerAndUseScript('template.main', 'templates/' . $this->template . '/js/template.js', ['version' => 'auto'], ['defer' => true]);

// Bootstrap 5 (optional - je nach Joomla-Version)
HTMLHelper::_('bootstrap.framework');

// Favicon
$this->addHeadLink(HTMLHelper::_('image', 'joomla-favicon.svg', '', [], true, 1), 'icon', 'rel', ['type' => 'image/svg+xml']);

?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <jdoc:include type="metas" />
    <jdoc:include type="styles" />
    <jdoc:include type="scripts" />
    <style>
        :root {
            --primary-color: <?php echo $primaryColor; ?>;
            --secondary-color: <?php echo $secondaryColor; ?>;
        }
    </style>
</head>
<body class="site <?php echo $this->direction === 'rtl' ? 'rtl' : 'ltr'; ?>">

    <!-- Header -->
    <header class="site-header">
        <div class="container">
            <div class="header-top">
                <?php if ($phone || $email): ?>
                <div class="contact-quick">
                    <?php if ($phone): ?>
                        <span class="phone"><i class="icon-phone"></i> <?php echo htmlspecialchars($phone); ?></span>
                    <?php endif; ?>
                    <?php if ($email): ?>
                        <span class="email"><i class="icon-mail"></i> <?php echo htmlspecialchars($email); ?></span>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="header-main">
                <div class="logo">
                    <?php if ($logo): ?>
                        <a href="<?php echo Uri::base(); ?>">
                            <img src="<?php echo Uri::root() . $logo; ?>" alt="<?php echo $app->get('sitename'); ?>">
                        </a>
                    <?php else: ?>
                        <a href="<?php echo Uri::base(); ?>" class="site-title">
                            <h1><?php echo $app->get('sitename'); ?></h1>
                        </a>
                    <?php endif; ?>
                </div>
                
                <?php if ($this->countModules('header')): ?>
                <div class="header-modules">
                    <jdoc:include type="modules" name="header" style="none" />
                </div>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <!-- Navigation -->
    <?php if ($this->countModules('navigation')): ?>
    <nav class="site-navigation" role="navigation">
        <div class="container">
            <jdoc:include type="modules" name="navigation" style="none" />
        </div>
    </nav>
    <?php endif; ?>

    <!-- Banner -->
    <?php if ($this->countModules('banner')): ?>
    <section class="site-banner">
        <div class="container">
            <jdoc:include type="modules" name="banner" style="none" />
        </div>
    </section>
    <?php endif; ?>

    <!-- Breadcrumbs -->
    <?php if ($showBreadcrumbs && $app->input->getCmd('view') !== 'featured'): ?>
    <div class="breadcrumbs">
        <div class="container">
            <jdoc:include type="modules" name="breadcrumbs" style="none" />
        </div>
    </div>
    <?php endif; ?>

    <!-- Main Content -->
    <main class="site-main">
        <div class="container">
            <div class="row">
                <!-- Sidebar Left -->
                <?php if ($this->countModules('sidebar-left')): ?>
                <aside class="col-md-3 sidebar sidebar-left">
                    <jdoc:include type="modules" name="sidebar-left" style="card" />
                </aside>
                <?php endif; ?>

                <!-- Content -->
                <div class="<?php echo $this->countModules('sidebar-left') || $this->countModules('sidebar-right') ? 'col-md-9' : 'col-md-12'; ?> content">
                    <!-- System Messages -->
                    <jdoc:include type="message" />
                    
                    <!-- Component Content -->
                    <jdoc:include type="component" />
                </div>

                <!-- Sidebar Right -->
                <?php if ($this->countModules('sidebar-right')): ?>
                <aside class="col-md-3 sidebar sidebar-right">
                    <jdoc:include type="modules" name="sidebar-right" style="card" />
                </aside>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <!-- Footer Top -->
    <?php if ($this->countModules('footer-top')): ?>
    <section class="footer-top">
        <div class="container">
            <jdoc:include type="modules" name="footer-top" style="none" />
        </div>
    </section>
    <?php endif; ?>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="footer-content">
                <?php if ($address || $openingHours || $this->countModules('contact-info')): ?>
                <div class="footer-info">
                    <?php if ($address): ?>
                    <div class="address">
                        <h3>Anschrift</h3>
                        <?php echo nl2br(htmlspecialchars($address)); ?>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($openingHours): ?>
                    <div class="opening-hours">
                        <h3>Öffnungszeiten</h3>
                        <?php echo nl2br(htmlspecialchars($openingHours)); ?>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($this->countModules('contact-info')): ?>
                    <jdoc:include type="modules" name="contact-info" style="none" />
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                
                <?php if ($this->countModules('footer')): ?>
                <div class="footer-modules">
                    <jdoc:include type="modules" name="footer" style="none" />
                </div>
                <?php endif; ?>
            </div>
            
            <div class="copyright">
                <p>&copy; <?php echo date('Y'); ?> <?php echo $app->get('sitename'); ?>. Alle Rechte vorbehalten.</p>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <a href="#top" class="back-to-top" aria-label="Nach oben">
        <i class="icon-arrow-up"></i>
    </a>

    <jdoc:include type="modules" name="debug" style="none" />
</body>
</html>
