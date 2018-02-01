<?php
/*
 * Copyright 2017-2018 Sven Kaffille (sven.kaffille@gmx.de)
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
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */
namespace Skaffille\Flow\Tools\Service;

use Psy\Shell;
use Neos\Flow\Annotations as Flow;
use \Neos\Flow\ObjectManagement\ObjectManagerInterface as ObjectManager;

/**
 * Class ConsoleService
 *
 * @FLow\Scope("singleton")
 */
class ConsoleService
{
    /**
     * @Flow\Inject
     * @var ObjectManager
     */
    protected $objectManager;

    public function run()
    {
        global $console_service;
        $console_service = $this;
	// flow sometimes fails in loading these classes as _ is part of namespaces for flow class loading
        \PhpParser\Autoloader::register();
        $shell = new Shell();
        $shell->run();
    }

    /**
     * @return ObjectManager
     */
    public function getObjectManager(): ObjectManager
    {
        return $this->objectManager;
    }

    /**
     * @param string $name
     * @return object
     * @throws \Neos\Flow\Object\Exception\UnknownObjectException
     */
    public function getObject(string $name)
    {
        $name = str_replace('.', '\\', $name);
        return $this->objectManager->get($name);
    }
}
