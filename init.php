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

/**
 * Description of init
 *
 * @author Jeroen De Meerleer <me@jeroened.be>
 */
class init {
    public $working_dir;
	public $controller = "pageController";
	public $method = "index";
	public $id = "0";
        
        public function __construct() {
		$this->working_dir = $this->get_working_directory();
		$this->controller = $this->get_controller();
		$this->method = $this->get_method();
		$this->id = $this->get_id();
                
                echo "Working Dir: " . $this->working_dir . '<br>'; 
                echo "Controller: " . $this->controller . '<br>'; 
                echo "Method: " . $this->method . '<br>'; 
                echo "id: " . $this->id . '<br>'; 
		// Hit that monster
		/*$monster = new $this->controller();
		$monster->controller = $this->controller;
		$monster->method = $this->method;
		$monster->id = $this->id;
		$monster->{$this->method}();*/
	}
        
        public function get_controller() {
		$query_array = $_GET['ctrl'];
		$controller = (!empty($query_array)) ? $query_array : "page";
		$r_value = $controller . "Controller";
		return $r_value;
	}
	
        public function get_method() {
		$query = $_GET['func'];
		$r_value = (!empty($query)) ? $query : "index";
		return $r_value;
	}
	
        public function get_id() {
		$query = $_GET['id'];
		$r_value = (!empty($query)) ? $query : -1;
		return $r_value;
	}
	
        public function get_working_directory() {
		$value_r = explode('/', $_SERVER['REQUEST_URI']);
		unset($value_r[count($value_r)-1]);
		$r_value = implode('/', $value_r);
		return $r_value . '/';
	}
}
