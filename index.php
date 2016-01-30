<?php 
setlocale(LC_MONETARY,"en_US.UTF-8");

class ZillowApi
{
    protected $apiKey = 'X1-ZWz1dyb53fdhjf_6jziz';
    protected $apiBaseUrl = 'http://www.zillow.com/webservice/GetSearchResults.htm';
    protected $address;
    protected $citystatezip;
    protected $searchResult;
    
    /**
     * URL encode the address attribute then assign
     *
     * @param  string  $address
     * @return ZillowApi Object
     */
    public function setAddress($address='')
    {
        $this->address = urlencode($address);
        return $this;
    }
    /**
     * URL encode the city, state, zip attribute then assign
     *
     * @param  string  $citystatezip
     * @return ZillowApi Object
     */
    public function setCityStateZip($citystatezip='')
    {
        $this->citystatezip = urlencode($citystatezip);
        return $this;
    }
    /**
     * Make a search via calling Zillow Api and assign result set
     *
     * @param  none
     * @return ZillowApi Object
     */
    public function homeSearch() 
    {
        try {
        $res = $this->requestApi($this->getApiUrl());
            $result = simplexml_load_string($res);
            $this->searchResult = $result;
        } catch (Exception $e) {
            echo "Error: parsing xml result";
            return false;
        }
        return $this;
    }
    
    /**
     * Display result template from search result
     *
     * @param  none
     * @return void
     */
    public function displayResult()
    {
        include 'home.tpl.php';
    }
    
    /**
     * Generate API url for class attributes
     *
     * @param  none
     * @return String
     */    
    private function getApiUrl()
    {
        $url  = $this->apiBaseUrl;
        $url .= "?zws-id=" . $this->apiKey;
        $url .= "&address=" . $this->address;
        $url .= "&citystatezip=" . $this->citystatezip;
        
        return $url;
    }

    /**
     * Using cUrl to make external API call
     *
     * @param  $url
     * @return String
     */    
    public function requestApi($url='')
    {
        if (!function_exists('curl_init')){
            die('Sorry cURL is not installed!');
        }
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;        
    }
    /**
     * Header template
     *
     */    
    public function printHeader()
    {
        include 'header.tpl.php';
    }
    /**
     * Footer template
     *
     */    
  
    public function printFooter()
    {
        include 'footer.tpl.php';
    }
}

//Initialize Zillow Api
$zillow = new ZillowApi();

$zillow->printHeader();

if(!empty($_POST['address']) && !empty($_POST['citystatezip'])) {
    
    $zillow->setAddress($_POST['address'])
           ->setCityStateZip($_POST['citystatezip'])
           ->homeSearch()
           ->displayResult();

}

$zillow->printFooter();
?>