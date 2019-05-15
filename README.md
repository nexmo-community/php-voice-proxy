# Forward a Call Via Voice Proxy with PHP

This sample shows you how to proxy a voice call so that it appears to come from another number. It accompanies [this blog post](https://www.nexmo.com/blog/2019/05/15/forward-a-call-via-voice-proxy-with-php-dr/).

## Dependencies

The `slim` micro framework for web applications. Install it using `composer`:

```
composer require slim/slim:^3.8
```

## Buy a number

You can do this from either the [developer dashboard](https://dashboard.nexmo.com) or by using the [Nexmo CLI](Nexmo CLI):

```
npm install -g nexmo-cli 
```

Then, configure Nexmo CLI using your API key and secret (also in the [developer dashboard](https://dashboard.nexmo.com):

```
nexmo setup YOUR_API_KEY YOUR_API_SECRET
```

Search for a voice-enabled number, providing a two digit country code, e.g. 'US' or 'GB':

```
nexmo number:search COUNTRY_CODE --voice
```

Buy the numnber:

```
nexmo number:buy NUMBER
```

## Create a Voice API application and link your number to it

Specify the URLs for the publicly-accessible webhooks in `index.php`.

```
nexmo app:create “My Voice Proxy” ANSWER_URL EVENT_URL --keyfile private.key
```

Use the `application_id` returned by the above to link your number:

```
nexmo link:app NEXMO_NUMBER APPLICATION_ID
```

## Configure the application

Edit `php.ini` with the location and name of the file where you want to log call events.

Edit the `FROM_NUMBER` and `TO_NUMBER` constants in `index.php` with your own values. The first should be the Nexmo virtual number you purchased above, the second should be another number that you own that will receive the call.

## Run the application

Launch the application, e.g. (using the PHP built-in web server):

```
php -S localhost:3000 -c php.ini
```

Call the number you configured in `TO_NUMBER`. The device should ring but the call will appear to have been made from your Nexmo virtual number rather than the on you used to place the call.


