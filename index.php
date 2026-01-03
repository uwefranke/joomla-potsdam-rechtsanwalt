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

// Bootstrap 5 aus Joomla laden (CSS + JS)
HTMLHelper::_('bootstrap.framework');
HTMLHelper::_('bootstrap.collapse');

// Bootstrap Icons und Template CSS/JS laden
$wa->registerAndUseStyle('bootstrap.icons', 'templates/' . $this->template . '/css/bootstrap-icons.min.css', ['version' => 'auto']);
$wa->registerAndUseStyle('template.main', 'templates/' . $this->template . '/css/template.css', ['version' => 'auto']);
$wa->registerAndUseScript('template.main', 'templates/' . $this->template . '/js/template.js', ['version' => 'auto'], ['defer' => true]);

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

    <div class="page-wrapper">
        <!-- Header -->
        <header class="site-header bg-white shadow-sm">
            <!-- Top Bar -->
            <?php if ($phone || $email): ?>
        <div class="header-top bg-light py-2">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-12 d-flex justify-content-end gap-3">
                        <?php if ($phone): ?>
                            <a href="tel:<?php echo preg_replace('/[^0-9+]/', '', $phone); ?>" class="text-decoration-none text-dark">
                                <i class="bi bi-telephone-fill text-primary me-2"></i><?php echo htmlspecialchars($phone); ?>
                            </a>
                        <?php endif; ?>
                        <?php if ($email): ?>
                            <a href="mailto:<?php echo htmlspecialchars($email); ?>" class="text-decoration-none text-dark">
                                <i class="bi bi-envelope-fill text-primary me-2"></i><?php echo htmlspecialchars($email); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Main Header -->
        <div class="header-main py-3">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-6 col-md-4">
                        <div class="logo">
                            <?php if ($logo): ?>
                                <a href="<?php echo Uri::base(); ?>">
                                    <img src="<?php echo Uri::root() . $logo; ?>" alt="<?php echo $app->get('sitename'); ?>" class="img-fluid" style="max-height: 80px;">
                                </a>
                            <?php else: ?>
                                <a href="<?php echo Uri::base(); ?>" class="text-decoration-none">
                                    <h1 class="h4 mb-0 text-primary fw-bold"><?php echo $app->get('sitename'); ?></h1>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="col-6 col-md-8 d-flex align-items-center justify-content-end">
                        <?php if ($this->countModules('header')): ?>
                        <div class="header-modules d-none d-md-block">
                            <jdoc:include type="modules" name="header" style="none" />
                        </div>
                        <?php endif; ?>
                        
                        <!-- Mobile Menu Toggle -->
                        <button class="navbar-toggler d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavigation" aria-controls="mainNavigation" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="bi bi-list fs-1"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Navigation -->
    <?php if ($this->countModules('navigation')): ?>
    <nav class="site-navigation bg-primary" role="navigation">
        <div class="container">
            <div class="collapse navbar-collapse show" id="mainNavigation">
                <jdoc:include type="modules" name="navigation" style="none" />
            </div>
        </div>
    </nav>
    <?php endif; ?>

    <!-- Banner -->
    <?php if ($this->countModules('banner')): ?>
    <section class="site-banner py-5 bg-light">
        <div class="container">
            <jdoc:include type="modules" name="banner" style="none" />
        </div>
    </section>
    <?php endif; ?>

    <!-- Breadcrumbs -->
    <?php if ($showBreadcrumbs && $app->input->getCmd('view') !== 'featured'): ?>
    <div class="breadcrumbs py-2 bg-light">
        <div class="container">
            <jdoc:include type="modules" name="breadcrumbs" style="none" />
        </div>
    </div>
    <?php endif; ?>

    <!-- Main Content -->
    <!-- Main Content -->
    <main class="site-main py-5">
        <div class="container">
            <div class="row g-4">
                <!-- Sidebar Left -->
                <?php if ($this->countModules('sidebar-left')): ?>
                <aside class="col-lg-3 sidebar sidebar-left">
                    <jdoc:include type="modules" name="sidebar-left" style="card" />
                </aside>
                <?php endif; ?>

                <!-- Content -->
                <?php 
                $contentWidth = 'col-lg-12';
                if ($this->countModules('sidebar-left') && $this->countModules('sidebar-right')) {
                    $contentWidth = 'col-lg-6';
                } elseif ($this->countModules('sidebar-left') || $this->countModules('sidebar-right')) {
                    $contentWidth = 'col-lg-9';
                }
                ?>
                <div class="<?php echo $contentWidth; ?> content">
                    <!-- System Messages -->
                    <jdoc:include type="message" />
                    
                    <!-- Component Content -->
                    <jdoc:include type="component" />
                </div>

                <!-- Sidebar Right -->
                <?php if ($this->countModules('sidebar-right')): ?>
                <aside class="col-lg-3 sidebar sidebar-right">
                    <jdoc:include type="modules" name="sidebar-right" style="card" />
                </aside>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <!-- Footer Top -->
    <?php if ($this->countModules('footer-top')): ?>
    <section class="footer-top bg-light py-5">
        <div class="container">
            <div class="row g-4">
                <jdoc:include type="modules" name="footer-top" style="card" />
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Footer -->
    <footer class="site-footer bg-dark text-white py-4">
        <div class="container">
            <div class="row g-4">
                <?php if ($address || $openingHours || $this->countModules('contact-info')): ?>
                <div class="col-md-4">
                    <?php if ($address): ?>
                    <div class="mb-4">
                        <h5 class="text-white mb-3"><i class="bi bi-geo-alt-fill text-primary me-2"></i>Anschrift</h5>
                        <p class="mb-0"><?php echo nl2br(htmlspecialchars($address)); ?></p>
                    </div>
                    <?php endif; ?>
                </div>
                
                <div class="col-md-4">
                    <?php if ($phone || $email): ?>
                    <div class="mb-4">
                        <h5 class="text-white mb-3"><i class="bi bi-envelope-fill text-primary me-2"></i>Kontakt</h5>
                        <?php if ($phone): ?>
                        <p class="mb-2">
                            <i class="bi bi-telephone me-2"></i>
                            <a href="tel:<?php echo preg_replace('/[^0-9+]/', '', $phone); ?>" class="text-white text-decoration-none"><?php echo htmlspecialchars($phone); ?></a>
                        </p>
                        <?php endif; ?>
                        <?php if ($email): ?>
                        <p class="mb-0">
                            <i class="bi bi-envelope me-2"></i>
                            <a href="mailto:<?php echo htmlspecialchars($email); ?>" class="text-white text-decoration-none"><?php echo htmlspecialchars($email); ?></a>
                        </p>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
                
                <div class="col-md-4">
                    <?php if ($openingHours): ?>
                    <div class="mb-4">
                        <h5 class="text-white mb-3"><i class="bi bi-clock-fill text-primary me-2"></i>Öffnungszeiten</h5>
                        <p class="mb-0"><?php echo nl2br(htmlspecialchars($openingHours)); ?></p>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($this->countModules('contact-info')): ?>
                    <jdoc:include type="modules" name="contact-info" style="none" />
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
            
            <?php if ($this->countModules('footer')): ?>
            <div class="row mt-4">
                <div class="col-12">
                    <jdoc:include type="modules" name="footer" style="none" />
                </div>
            </div>
            <?php endif; ?>
            
            <hr class="my-4 border-secondary">
            
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0">&copy; <?php echo date('Y'); ?> <?php echo $app->get('sitename'); ?>. Alle Rechte vorbehalten.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="<?php echo Uri::base(); ?>impressum" class="text-white text-decoration-none me-3">Impressum</a>
                    <a href="<?php echo Uri::base(); ?>datenschutz" class="text-white text-decoration-none">Datenschutz</a>
                </div>
            </div>
        </div>
    </footer>

    </div><!-- /.page-wrapper -->

    <!-- Back to Top Button -->
    <button id="backToTop" class="btn btn-primary position-fixed bottom-0 end-0 m-3 rounded-circle" style="display: none; width: 50px; height: 50px; z-index: 1000;" aria-label="Nach oben">
        <i class="bi bi-arrow-up fs-4"></i>
    </button>

    <jdoc:include type="modules" name="debug" style="none" />
</body>
</html>
