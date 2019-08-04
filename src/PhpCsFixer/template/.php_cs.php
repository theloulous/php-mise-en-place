<?= '<?php' ?>

$currentYear = date('Y');

$header = <<<"HEADER"
NOTICE OF LICENSE

This source file is licensed exclusively to Beau de Loménie.

@copyright   Copyright © 2014-{$currentYear} Beau de Loménie
@license     All rights reserved
@author      Matters Studio (https://matters.tech)
HEADER;

return PHPCsFixer\Config::create()
     ->setRiskyAllowed(true)
     ->setRules([
     <?php foreach($configuration as $rule => $value) : ?>
          '<?= $rule ?>' => <?= $value ?>,
     <?php endforeach ?>
     ])
     ->setFinder(
          PhpCsFixer\Finder::create()
          ->in('src')
          ->in('tests')
     );
