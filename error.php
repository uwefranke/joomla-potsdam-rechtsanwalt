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

$app = Factory::getApplication();
$wa  = $this->getWebAssetManager();

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
<body class="error-page">
    <div class="error-container">
        <div class="error-content">
            <h1 class="error-code"><?php echo $this->error->getCode(); ?></h1>
            <h2 class="error-message"><?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8'); ?></h2>
            
            <?php if ($this->error->getCode() == 404): ?>
                <p>Die angeforderte Seite konnte nicht gefunden werden.</p>
            <?php elseif ($this->error->getCode() == 403): ?>
                <p>Sie haben keine Berechtigung, auf diese Seite zuzugreifen.</p>
            <?php else: ?>
                <p>Ein Fehler ist aufgetreten. Bitte versuchen Sie es später erneut.</p>
            <?php endif; ?>
            
            <a href="<?php echo Uri::base(); ?>" class="btn btn-primary">Zurück zur Startseite</a>
        </div>
    </div>
</body>
</html>
