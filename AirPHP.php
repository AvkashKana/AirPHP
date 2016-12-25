<?php

class AirPHP {
  private $header = [""];
  private $curl;
  private $locale = "de-DE";
  private $currency = "EUR";
  private $echo = true;
  
	//constructor which sets header according to OAuth Token
  function __construct ($token) {
    $this->header = [
    "X-Airbnb-OAuth-Token:$token"
    ];
  }
  // Sets Locale in format: language-COUNTRY
  function setlocale ($locale) {
    $this->locale = $locale;
  }
  // Sets Currency in ISO 4217 Format (3 Chars)
  function setcurrency ($locale) {
		if (strlen($locale) != 3) return false;
    $this->currency = $currency;
  }
  function setecho ($echo) {
    $this->echo = $echo;
  }
  
  private function curl($url, $content) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    //curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $this->header);
    $server_output = curl_exec ($curl);
    curl_close ($curl);
		
    if ($this->echo) { // if echo then echo as json, else return from function
      header('Content-Type: application/json');
      echo $server_output;
    } else {
      return $server_output;
    }
  }
  
  function getCalendar($start_date, $end_date, $listingId) {
    $url = "https://api.airbnb.com/v2/threads?_format=for_messaging_sync&_limit=10&role=all&selected_inbox_type=host&locale=de-DE&currency=EUR";
    $content = "{
    \"_transaction\": false, 
    \"operations\": [
        {
            \"method\": \"GET\", 
            \"path\": \"/calendar_days\", 
            \"query\": {
                \"_format\": \"host_calendar\", 
                \"end_date\": \"".$end_date."\", 
                \"listing_id\": \"".$listingId."\", 
                \"start_date\": \"".$start_date."\"
            }
        }
    ]
    }";
    echo $this->curl($url, $content);
  }
	
	
  function getBatch() { // I dont know what this does.. captured from mitmproxy
    $url = "https://api.airbnb.com/v2/batch/?client_id=3092nxybyb0otqw18e8nh5nty&locale=de-DE&currency=EUR";
    $content = '{
    "_transaction": false, 
    "operations": [
        {
            "method": "GET", 
            "path": "/reservations", 
            "query": {
                "_format": "for_mobile_list", 
                "_limit": "30", 
                "_offset": "0", 
                "_order": "start_date", 
                "host_id": "11505978", 
                "start_date": "2016-11-06"
            }
        }, 
        {
            "method": "GET", 
            "path": "/threads", 
            "query": {
                "_format": "for_pending_requests", 
                "_limit": "15", 
                "_offset": "0", 
                "is_pending": "true"
            }
        }, 
        {
            "method": "GET", 
            "path": "/dashboard_alerts", 
            "query": {
                "_format": "for_mobile_host_v3", 
                "scope": "host_home"
            }
        }, 
        {
            "method": "GET", 
            "path": "/milestones", 
            "query": {
                "_format": "mobile", 
                "latest": "true"
            }
        }
    ]
}';
    echo $this->curl($url, $content);
  }
  
  function getListings($limit, $availability) {
    $url = "https://api.airbnb.com/v2/listings?_format=v1_legacy_long&_limit=$limit&_offset=0&has_availability=$availability&locale=$this->locale&currency=$this->currency";
    $content = "";
    echo $this->curl($url, $content);
  }
  
  function getListing($listingID) {
    $url = "https://api.airbnb.com/v2/listings/$listingID?_format=v1_legacy_long_manage_listing&locale=$this->locale&currency=$this->currency";
    $content = "";
    echo $this->curl($url, $content);
  }
}
?>
