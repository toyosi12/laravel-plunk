# laravel-plunk

[![Issues](	https://img.shields.io/github/issues/toyosi12/laravel-plunk)](https://github.com/toyosi12/laravel-plunk/issues)
[![Forks](	https://img.shields.io/github/forks/toyosi12/laravel-plunk)](https://github.com/toyosi12/laravel-plunk/network/members)
[![Stars](	https://img.shields.io/github/stars/toyosi12/laravel-plunk)](https://github.com/toyosi12/laravel-plunk/stargazers)

> A laravel package to easily integrate plunk

## Installation

[PHP](https://php.net) 7.2+ and [Composer](https://getcomposer.org) are required.

To get the latest version of Laravel Plunk, simply require it

```bash
composer require laravel-plunk
```
Once installed, the package automatically registers its service provider and facade.


## Configuration
You can publish the configuration file using this command:
```bash
php artisan vendor:publish --provider="Toyosi12\Plunk\PlunkServiceProvider"
```
A configuration file 'plunk.php' with some defaults is placed in your config directory.

## Usage


### 1. Update your environment file with your secret key as described below. Login to your Plunk dashboard to obtain your secret key.
```php
PLUNK_SECRET_KEY="<SECRET_KEY>"
```

### 2. Make a call to the method you need.
```php
use Toyosi12\Plunk\Facades\Plunk;
Plunk::countContacts();
```

 
 ## References

 ### Events
 
 - triggerEvent()
 Used to publish an event

 **Parameters**
 - event: The name of the event to publish
 - email: The email address of the user to publish the event to 
 - data [Optional]: An object containing the data to attach to the user

 Sample request: 
 ```php
    use Toyosi12\Plunk\Facades\Plunk;
    $request = {
        "event": "test-project",
        "email": "toyosi@nomail.com"
    }
    Plunk::triggerEvent($request);
 ```


 ### Emails
 
 - triggerEvent()
 Used to send transactional email

 **Parameters**
- to: The email address of the recipient
- subject: The subject of the email
- body: The body of the email
- type [Optional]: The type of email to send (html or markdown)
- from [Optional]: The email address of the sender
- name [Optional]: The name of the sender
- withUnsubscribe [Optional]: Whether to include an unsubscribe link hosted by Plunk in the email

 Sample request: 
 ```php
    use Toyosi12\Plunk\Facades\Plunk;
    $request = {
        "to": "toyosi@nomail.com",
        "subject": "Test Plunk",
        "body": "Testing plunk"
    }
    Plunk::sendTransactionalEmail($request);
```
 ## Contributing
 Do feel free to fork this repo and contribute by submitting a pull request. Let's make it better.
 
 ## Star
 I'd love you to star this repo. Also [follow me on twitter](https://twitter.com/dev_toyosi)
 
 ## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.






