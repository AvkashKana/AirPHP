# AirPHP
Airbnb PHP API caller

Reverse Engineered Airbnb API with Airbnb's Android App and [mitmproxy](https://github.com/mitmproxy/mitmproxy)

## Disclaimer
The Project is still in VERY!! Development.  
Right now it has roundabout 4 features (API-Calls)  
I won't guarrantee that a future version will be compatible with your code beeing written with a current one.

## Requirements
You need to have cURL installed: http://php.net/manual/en/curl.requirements.php

You need the Airbnb O-Auth Token. In the App's HTTPS Request you can find yours in the header referred as `X-Airbnb-OAuth-Token` (mitmproxy is your friend):
```
X-Return-Strategy:         single                                             
Content-Type:              application/json; charset=UTF-8                    
Content-Length:            258                                                
Host:                      api.airbnb.com                                     
Connection:                Keep-Alive                                         
Accept-Encoding:           gzip                                               
Cookie:                    **PRIVATE**  
User-Agent:                Airbnb/17860198 Android/5.1.1 Device/motorola_Moto X Carrier/Vodafone.de Type/Phone                   
X-Airbnb-SID:              **PRIVATE**          
X-Airbnb-Network-Type:     wifi                                               
X-Airbnb-Device-ID:        **PRIVATE**                                    
X-Airbnb-Carrier-Country:  de                                                 
X-Airbnb-OAuth-Token:      **This one!**                          
X-Airbnb-Advertising-ID:   **PRIVATE**          
```

You also need your listing ID(s). You can find the ID in the URL of your Listing:  
e.x. `https://www.airbnb.de/rooms/1234567`

## Usage
This Example will echo all details about your listing
```php
require("AirPHP.php");
$token = 'your oauth token';
$listingID = '1234567';
$airbnb = new AirPHP($token);
$airbnb->setlocale('de-DE'); //Set Language
$airbnb->setcurrency('RUB'); //Set currency
$airbnb->setecho(true); //if true: response will be echoed. if false: response will be returned as bigass string
$airbnb->getListing($listingID) //echo (or return) the Listing API stuff
```
## Documentation
Look at DOCUMENTATION.md for further details
