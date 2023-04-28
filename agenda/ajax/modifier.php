<?php
$ajax = 1;
require '../../include/initialisation.php';
require RACINE . '/include/controleacces.php';

$table = new Agenda();
$table->setValue('modifierPar', $_SESSION['membre']['nomPrenom']);
echo  $table->modifier(true);
