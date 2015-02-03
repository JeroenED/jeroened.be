<?php

/*
 * Copyright (C) 2015 Jeroen De Meerleer <me@jeroened.be>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

// Autoload composer-libraries
require 'vendor/autoload.php';

// Autoload spoon library
// define location of your library
define('PATH_LIBRARY', 'vendor/spoon/library');

// add this to the include path
set_include_path(get_include_path() . PATH_SEPARATOR . PATH_LIBRARY);

// require spoon
require_once 'spoon/spoon.php';

// Add required shizzle
require_once "config.php";
require_once "controller.class.php";
require_once "controllers.php";
require_once "models.php";
require_once "dbcon.php";
require_once "init.php";


error_reporting(E_ALL);
ini_set('display_errors', '1');


// Let's hit the road
$site = new init();