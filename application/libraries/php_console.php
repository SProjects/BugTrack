<?php

class php_console {

    function __construct(){
        $this->connector = PhpConsole\Connector::getInstance();
        $this->connector->setPassword("admin");

        // Configure eval provider
        $evalProvider = $this->connector->getEvalDispatcher()->getEvalProvider();
        $evalProvider->addSharedVar('post', $_POST); // so "return $post" code will return $_POST
        $evalProvider->setOpenBaseDirs(array(__DIR__)); // see http://php.net/open-basedir

        $this->connector->startEvalRequestsListener(); // must be called in the end of all configurations

        $this->handler = PhpConsole\Handler::getInstance();
        /* You can override default Handler behavior:
            $handler->setHandleErrors(false);  // disable errors handling
            $handler->setHandleExceptions(false); // disable exceptions handling
            $handler->setCallOldHandlers(false); // disable passing errors & exceptions to prviously defined handlers
        */
        $this->handler->start(); // initialize handlers
    }

}