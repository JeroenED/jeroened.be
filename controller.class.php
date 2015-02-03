<?php
/*
 * Copyright (C) 2014 Jeroen De Meerleer <me@jeroened.be>
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
/*
 * Description of model
 *
 * @author Jeroen De Meerleer <me@jeroened.be>
 */
	class controller {
		public $id;
		public $controller;
		public $method;
		
		function create_template($template, $model) {
			$tpl = new SpoonTemplate();
			$tpl->setForceCompile(true);
			$tpl->setCompileDirectory('compiled_templates');
			// assign some variables
			foreach($model as $key => $value) {
				$tpl->assign($key, $value);
			}

			// show the output, using 'template.tpl'
			$tpl->display("views/" . $template);
		}

	}