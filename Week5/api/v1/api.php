<?php
namespace API\models\services;

final class Index {
    
    public function __construct() {
        // error reporting - all errors for development (ensure you have display_errors = On in your php.ini file)
        error_reporting(E_ALL | E_STRICT);
        mb_internal_encoding('UTF-8');           
        spl_autoload_register(array($this, 'loadClass'));

    }
     
    function loadClass($base) {
    
        $baseName = explode( '\\', $base );
        $className = end( $baseName );     

       $folders = array(    "models".DIRECTORY_SEPARATOR."helpers",
                            "models".DIRECTORY_SEPARATOR."dao",
                            "models".DIRECTORY_SEPARATOR."do",
                            "models".DIRECTORY_SEPARATOR."interfaces",
                            "models".DIRECTORY_SEPARATOR."exceptions",
                            "models".DIRECTORY_SEPARATOR."services",
                            "models".DIRECTORY_SEPARATOR."requests"
                        );

        $classFile = FALSE;

        foreach($folders as $folder) {       
            $classFile = $folder.DIRECTORY_SEPARATOR.$className.'.php';
            if ( is_dir($folder) &&  file_exists( $classFile ) ) {
                require_once $classFile;
                break;
            } 
        }  

    }

 }



 function runPage() {
     
    $_configURL = '.' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.ini.php';
    $index = new Index();    

    /*
     * Functions to use for Dependency Injection
     */
    $_config = new Config($_configURL);
    $_log = new FileLogging();
    $_pdo = new DB($_config->getConfigData('db:dev'), $_log);
    $_validator = new Validator();

    $_emailTypemodel = new EmailTypeModel();
    $_emailModel = new EmailModel();

    $_emailTypeDAO = new EmailTypeDAO($_pdo->getDB(), $_emailTypemodel, $_log);
    $_emailDAO = new EmailDAO($_pdo->getDB(), $_emailModel, $_log);

    $_emailTypeService = new EmailTypeService($_emailTypeDAO, $_validator, $_emailTypemodel );
    $_emailService = new EmailService($_emailDAO, $_emailTypeService, $_validator, $_emailModel );        
     
     
    /*
     * Rest Server
     */
     
    $_restServerModel = new RestServerModel();
    $_restServerResponseModel = new RestServerResponseModel();    
    $_restServer = new RestServer( $_restServerModel, $_restServerResponseModel, $_log );

    //http://php.net/manual/en/functions.anonymous.php

    $_restServer->addDIResourceRequest('emailtypes', function() use ($_emailTypeService ) {       
        return new EmailtypeRequest($_emailTypeService);
    })    
    ->addDIResourceRequest('emails', function() use ($_emailService ) {       
        return new EmailRequest($_emailService);
    })
    ;
    // run application!
    //echo $_restServer->authorized();
    echo $_restServer->process();
}
    
runPage();










