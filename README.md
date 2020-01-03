# Beanstalk Implementation

## Producer

See producer.php for a sample producer implementation.

## Consumer

See consumer.php for a sample consumer implementation.

## Traits

**MetaStampable**
This trait adds helpful meta time information, and should be written to a mongo property called "created".

```php
$model->created = \Popcorn\Beans\Traits\MetaStampable::getDate( 'now' );
```
