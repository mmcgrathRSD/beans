# Beanstalk Implementation

This is beanstald implementation written in php. It contains the mongo driver since thats what we are currently using for jobs.

## Producer

See producer.php for a sample producer implementation.

To create a producer, you must first instanciate an instance of a beanstalk connection.

```php

<?php
//Bring in the connection
use xobotyi\beansclient\Connection;

//-- 1. Create an instance of the connection

/**
 * @param string $host - The host of the beanstalkd server
 * @param int $port - The port of the beanstalkd server
 * @param int $timeout - The default timeout in seconds
 * @param bool $persistent - weather the connection should persist
 */
$connection = new Connection('127.0.0.1', 11300, 2, true);

//-- 2. Create a beanstalk Producer
/**
 * @param \xobotyi\beansclient\Connection $connection - The connection created in step one
 * @param string $tubeName - The name of the tube (queue) the producer should write to
 *
 */
$producer = new Producer($connection, 'myTube');

//--3. Create a job with the producer

$job = $producer->put(new Payload(['payload_key' => 'payload_val']));

?>
```

## Consumer

See consumer.php for a sample consumer implementation.

## Traits

**MetaStampable**
This trait adds helpful meta time information, and should be written to a mongo property called "created".

```php
$model->created = \Popcorn\Beans\Traits\MetaStampable::getDate( 'now' );
```
