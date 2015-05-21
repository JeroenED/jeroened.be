<?php

/*
 * The MIT License
 *
 * Copyright 2015 Jeroen De Meerleer <me@jeroened.be>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace JeroenED\CmsEDBundle\Initialize;

/**
 * Description of Initialize
 *
 * @author Jeroen De Meerleer <me@jeroened.be>
 */
class Initializer {
    private $websiteParts = array(
        array('label' => 'Home', 'link' => '/admin', 'parts' => array()),
        array('label' => 'Portfolio', 'link' => '/admin/portfolio', 'parts' => array(array('label' => 'List', 'link' => '/admin/portfolio'), array('label' => 'Create new', 'link' => '/admin/portfolio/create'))),
        array('label' => 'Pages', 'link' => '/admin/pages', 'parts' => array(array('label' => 'List', 'link' => '/admin/pages'), array('label' => 'Create new', 'link' => '/admin/pages/create'))),
        array('label' => 'Menu', 'link' => '/admin/menus', 'parts' => array(array('label' => 'List', 'link' => '/admin/menu'), array('label' => 'Create new', 'link' => '/admin/menu/create'))),
        array('label' => 'Users', 'link' => '/admin/users', 'parts' => array(array('label' => 'List', 'link' => '/admin/users'), array('label' => 'Create new', 'link' => '/admin/users/create'))),
    );
    
    public function getWebsiteParts() {
        return $this->websiteParts;
    }
}
