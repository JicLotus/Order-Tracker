<?php

return array(
 
    'driver' => 'smtp',
 
    'host' => 'smtp.gmail.com',
 
    'port' => 587,
 
    'from' => array('address' => 'OrderTracker@AltaCliente', 'name' => 'Alta Cliente Order Tracker'),
 
    'encryption' => 'tls',
 
    'username' => 'order.tracker.creacion.cliente@gmail.com',
 
    'password' => '123456789qwertyuioP',
 
    'sendmail' => '/usr/sbin/sendmail -bs',
 
    'pretend' => false,
 
);
