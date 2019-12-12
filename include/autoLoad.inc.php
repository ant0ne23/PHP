<?php
spl_autoload_register(function ($className) {
	$repClasses='classes/';
	include $repClasses.$className.'.class.php';
}
);
