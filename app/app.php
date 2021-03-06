<?php
namespace CEPSearcher;

use CEPSearcher\Controller\AddressController;
use CEPSearcher\Controller\BolsaHashController;
use CEPSearcher\Controller\HomeController;
use CEPSearcher\Controller\ProvaRefractorController;

class App{
    private $structure=[
        "config" => [
            "app"
        ],
        "exception" => "*",
        "model" => "*",
        "engine" => "*",
        "controller" => [
            "Controller",
            "*"
        ],
    ];

    public function __construct(){
        chdir(dirname(__FILE__));

        foreach($this->structure as $dir => $structure_types_ordered) {
            if ($structure_types_ordered == "*") $this->require_dir($dir);
            else {
                foreach ($structure_types_ordered as $file_to_be_required)
                    if($file_to_be_required == "*") $this->require_dir($dir);
                    else require_once __DIR__
                        . DIRECTORY_SEPARATOR
                        . $dir
                        . DIRECTORY_SEPARATOR
                        . $file_to_be_required
                        . ".php";
            }
        }
    }

    private function require_dir($dir_path){
        rtrim($dir_path,"/");
        $dir_files=scandir($dir_path);
        foreach ($dir_files as $dir_item){
            if(!in_array($dir_item,[".",".."])) {
                $dir_item_full_path = $dir_path . DIRECTORY_SEPARATOR . $dir_item;
                if (is_dir($dir_item_full_path)) {
                    $this->require_dir($dir_item_full_path);
                } else require_once $dir_item_full_path;
            }
        }
    }
    public function cepExercise($api = false){
        $addressController=new AddressController();
        $addressController->run($api);
    }
    public function provaRefractor($exercise){
        $ProvaRefractorController=new ProvaRefractorController();
        switch ($exercise){
            case 1:
                $ProvaRefractorController->exercise1();
                break;
            case 2:
                $ProvaRefractorController->exercise2();
                break;
            case 3:
                $ProvaRefractorController->exercise3();
                break;
            default:
                header("HTTP/1.0 404 Not Found");
                die();
        }
    }
    public function index(){
        $HomeController = new HomeController();

        $HomeController->index();
    }
    public function bolsaHash($action=null){
        $BolsaController = new BolsaHashController();

        switch ($action){
            case "create":
                $BolsaController->create();
                break;
            case "delete":
                $BolsaController->remove();
                break;
            case "update":
                $BolsaController->update();
                break;
            case "generate":
                $BolsaController->generate();
                break;
            default:
                $BolsaController->index();
        }
    }
}

return new App();