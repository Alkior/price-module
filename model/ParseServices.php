<?php


use Bitrix\Main\Web\HttpClient;



class ParseServices
{

public $HttpClient;
public $cUrl;
public $content;
public $parameter;

    function __construct($getSearch) {
        if(!empty($getSearch)){$post = substr($post, 0, 200); $this->parameter = '/'. str_replace(' ', '&', $getSearch);}
        else{$this->parameter = '';}
        $this->HttpClient = new HttpClient();
        $name = iconv("windows-1251", "UTF-8", 'HTTP_service');
        $url = "http://".$name.":CUZmsch5687@10.20.3.6/hospital_pr1/hs/BaseInfo/Get".$this->parameter;    
        $this->cUrl = \Bitrix\Main\Web\Json::decode($this->HttpClient->get($url));        
    }
    
    function getCurl(){
        return $this->cUrl;
    }

    function convert($content){
         if(SITE_CHARSET == 'windows-1251'){
            global $APPLICATION;
            $APPLICATION->ConvertCharset($content, SITE_CHARSET, UTF-8);
            return $content;
        }
    }
    
}



