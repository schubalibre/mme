<?php
/* 
 * Project: ODDS & ENDS
 * File: index.php
 * Purpose: landing page which handles all requests
 * Author: Robert Dziuba & Inga Schwarze
 *
 * MVC ist ein Muster zur Strukturierung von Software-Entwicklung in die drei Einheiten Datenmodell (engl. model),
 * Präsentation (engl. view) und Programmsteuerung (engl. controller). Ziel des Musters ist ein flexibler Programmentwurf,
 * der eine spätere Änderung oder Erweiterung erleichtert und eine Wiederverwendbarkeit der einzelnen Komponenten ermöglicht.
 *
 * Das URL Pattern sollte dieser Strucktur folgen: http://domain/controller/action/id,
 */

/*
 * PHP Erros werden angezeigt
 * Sollte nur Debug Modus sichtbar sein!
 */

ini_set("display_errors", true);

// ladet die benötigten Klassen für das MCV
require("classes/basecontroller.php");  
require("classes/basemodel.php");
require("classes/view.php");
require("classes/viewmodel.php");
require("classes/loader.php");

$loader = new Loader(); //erstellt ein Loder Objekt
$controller = $loader->createController(); //kreiert das angefragte Controller Objekt anhand des 'controller' URL Teils
$controller->executeAction(); //führt die angefragte Methode aus anhand der+s 'action' URL Teils. Die Controller Methoden laden dann die zugewiesenen Views.