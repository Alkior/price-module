<style><?require($_SERVER["DOCUMENT_ROOT"]."/local/modules/servicesprice/css/style.css");?></style>

<?
require($_SERVER["DOCUMENT_ROOT"]."/local/modules/servicesprice/model/ParseServices.php");
require($_SERVER["DOCUMENT_ROOT"]."/local/modules/servicesprice/model/ServicesPricelist.php");
//require($_SERVER["DOCUMENT_ROOT"]."/local/modules/servicesprice/model/ParseGroup.php");
//require($_SERVER["DOCUMENT_ROOT"]."/local/modules/servicesprice/model/ParseItem.php");
require($_SERVER["DOCUMENT_ROOT"]."/local/modules/servicesprice/PHPWord/vendor/autoload.php");


$getSearch = htmlspecialchars($_GET['search']);
$getPricelist = $_GET['getPricelist'];
$phpWord = new \PhpOffice\PhpWord\PhpWord();
$p = new ServicesPricelist($getSearch, $phpWord);
$p->parseServices();
//if(isset($getPricelist)){    
//    $p->getPricelist();    
//}

?>
<?require($_SERVER["DOCUMENT_ROOT"]."/local/modules/servicesprice/view/index_service.php");?>
<script type="text/javascript" src="/local/modules/servicesprice/js/index.js"></script>