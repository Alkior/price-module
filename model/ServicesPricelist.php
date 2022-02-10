<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use ParseServices;
use ParseGroup;
use ParseItem;
/**
 * Description of ServicesPricelist
 *
 * @author epotapov
 */
class ServicesPricelist {
    
    public $getPricelist;
    public $t;
    public $date;
    public $arrPar = array();
    public $servArrName = array();
    public $cUrl;
    public $phpWord;
    
    function __construct($getSearch, $phpWord) {        
       $this->date = date("d/m/Y");       
       $this->t = new ParseServices($getSearch);
       $this->cUrl = $this->t->getCurl();
       $this->phpWord = $phpWord;
    }
    
    function getPricelistTest(){
        ob_end_clean();        
        $content = $this->parsePriceList();
        $filename =  "����������� �� $this->date";
        
        	
        $this->phpWord->setDefaultFontName('Times New Roman');
        
        $sectionStyle = array(
 
            'orientation' => 'landscape',
            'marginTop' => \PhpOffice\PhpWord\Shared\Converter::pixelToTwip(10),
            'marginLeft' => 600,
            'marginRight' => 600,
            'colsNum' => 1,
            'pageNumberingStart' => 1,
            'borderBottomSize'=>100,
            'borderBottomColor'=>'C0C0C0'
 
            );
        $section = $this->phpWord->addSection($sectionStyle);
        
        $text = '�������� ���� �������� �������� ������ �� ����';
        $fontStyle = array('name'=>'Arial', 'size'=>36, 'color'=>'075776', 'bold'=>TRUE, 'italic'=>TRUE);
        $parStyle = array('align'=>'right','spaceBefore'=>10);
 
        $section->addText(htmlspecialchars($text), $fontStyle,$parStyle); 
        
        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment; filename=' . $filename);
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');
        //header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');//header('Content-Type: application/msword'); //��� text/plain
        //header('Content-Disposition: attachment; filename=' . $filename);
        
        //$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($this->phpWord, 'Word2007');
        //$objWriter->save("php://output");
        echo $this->t->convert($content);
        exit();     
       
    }
    
    function getPricelist(){
        ob_end_clean();        
        $content = $this->parsePriceList();
        $filename =  "����������� �� $this->date.doc";
        
        	
        
        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment; filename=' . $filename);
        header('Content-Type: application/msword');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');
        //header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');//header('Content-Type: application/msword'); //��� text/plain
        //header('Content-Disposition: attachment; filename=' . $filename);
        
        
        echo $content;
        exit();     
       
    }
    
    function parseServices()
{
    
        foreach($this->cUrl as $serv)
        {        
            if (!empty($serv['�������������������']))
            {              
               $this->servArrName[$serv['�������������������']][] = $serv;
               
            }
        }
    
}
    
    function parsePricelist(){
        if($this->parameter != ''){
            $this->parameter = '';            
        }        
        $this->parseArray();
    }
    
    function parseArray(){        
        $arrName = $this->servArrName;       
        foreach ($arrName as $servName=>$keys){
                print("\r\n" . "=============" . "\r\n" . "* $servName: ". "\r\n" . "=============" . "\r\n" . "\r\n" . "\r\n");                
                foreach ($keys as $key){
                   $service= $key['������������������']; $price = $key['����'];
                   print("$service" . '   -   ' . "$price" . ' ��� ' . "\r\n" . "\r\n"); 
                }
            }
        
    }
    function parseServicesTest(){
        
        
        foreach ($this->cUrl as $items){
            if(!in_array([$items['�������������������']])){
                $this->servArrName[$items['�������������������']] = new ParseGroup($items['�������������������']);
            }
            if($items['����������������������'] != null || $items['����������������������'] != "���"){
                $this->servArrName[$items['�������������������']]->subGroup[] = new ParseGroup($items['����������������������']);
                $this->servArrName[$items['�������������������']]->subGroup[]->groupItems[] = new ParseItem($items['������������������'], $items['����']);
            }
            else{
                $this->servArrName[$items['�������������������']]->groupItems[] = new ParseItem($items['������������������'], $items['����']);
            }
            
        }
        return $this->servArrName;
    }
}
