<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.potsdam-rechtsanwalt
 * @copyright   Copyright (C) 2026 - Alle Rechte vorbehalten
 * @license     GNU General Public License version 2 or later
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\HTML\HTMLHelper;

$app = Factory::getApplication();
$wa  = $this->getWebAssetManager();

// Bootstrap 5 aus Joomla laden
HTMLHelper::_('bootstrap.framework');

// Bootstrap Icons und Template CSS laden
$wa->registerAndUseStyle('bootstrap.icons', 'templates/' . $this->template . '/css/bootstrap-icons.min.css');
$wa->registerAndUseStyle('template.main', 'templates/' . $this->template . '/css/template.css');

?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $this->error->getCode(); ?> - <?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8'); ?></title>
    <jdoc:include type="styles" />
</head>
<body class="error-page d-flex align-items-center justify-content-center min-vh-100 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-5">
                        <div class="mb-4">
                            <?php if ($this->error->getCode() == 404): ?>
                                <i class="bi bi-exclamation-triangle-fill text-warning" style="font-size: 5rem;"></i>
                            <?php elseif ($this->error->getCode() == 403): ?>
                                <i class="bi bi-lock-fill text-danger" style="font-size: 5rem;"></i>
                            <?php else: ?>
                                <i class="bi bi-x-circle-fill text-danger" style="font-size: 5rem;"></i>
                            <?php endif; ?>
                        </div>
                        
                        <h1 class="display-1 fw-bold text-primary mb-3"><?php echo $this->error->getCode(); ?></h1>
                        <h2 class="h4 mb-4"><?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8'); ?></h2>
                        
                        <?php if ($this->error->getCode() == 404): ?>
                            <p class="text-muted mb-4">Die angeforderte Seite konnte nicht gefunden werden. Möglicherweise wurde sie verschoben oder gelöscht.</p>
                        <?php elseif ($this->error->getCode() == 403): ?>
                            <p class="text-muted mb-4">Sie haben keine Berechtigung, auf diese Seite zuzugreifen. Bitte kontaktieren Sie uns bei Fragen.</p>
                        <?php else: ?>
                            <p class="text-muted mb-4">Ein Fehler ist aufgetreten. Bitte versuchen Sie es später erneut oder kontaktieren Sie uns.</p>
                        <?php endif; ?>
                        
                        <a href="<?php echo Uri::base(); ?>" class="btn btn-primary btn-lg">
                            <i class="bi bi-house-fill me-2"></i>Zurück zur Startseite
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
