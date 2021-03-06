# JeroenED.be
Copyright (c) 2015-2017 Jeroen De Meerleer <me@jeroened.be>

This is the source code of my own website that can be found on http://www.jeroened.be 

## Installation

Clone the GIT-repository and run `composer install`.

Oh, I forgot. You need to feed the kittens.

## Get it running

### Create assets

After you installed the website you will have to create the assets. You can easily do this with following command
    
    php app/console assetic:dump

### Admin panel user

First create a new user by running following command:

    php app/console CmsED:Users:Create

Afterwards you can login into the admin panel by pointing your browser to `{{ websiteaddress }}/admin`

Here you can create even more users or create even more pages or even more whatever.

## *Black as the night* set-up (system.sh)
If you don't feel like entering all commands yourself you can opt for the *Black as the night* setup. This command automates a lot of commands and giving you time to get another programmer's fuel.

### Install
You can easily install the website by running `bash system.sh install` This will install all dependencies needed (eg. git-submodules, composer, ...).

If it's the first time you're running the installation you need to add parameter `--firsttime`. This will setup the database and users as well.

### Update
Updates composer dependecies and submodules

## Server
Start or stop php's built in webserver. This is just a port the symfony server:start and and symfony server:stop commands.

## Licence

    Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in
    all copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
    THE SOFTWARE.