<?php

namespace Ima\Controller;

use Administration\Data\ProjectData;
use Ima\MySql\MySqlConnection;
use Ima\Pages\MysqlConfigPage;
use Ima\Pages\ProjectDataPage;
use Ima\Routing\Routing;
use Ima\Users\AuthenticationManagment;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Yaml\Yaml;

/**
 * ImaController
 * @author lpena
 */
class ImaController extends \Ima\Controller\Controller {
    
    const MYSQL_CONFIGURATION = 'mysql_config';
    
    const PROJECT_DATA_CONFIGURATION = "project_data_config";
    
    public function mysqlConfig(Request $request) {
        $filename = (new MySqlConnection())->getConfigFilename();        
        $exists = file_exists($filename);        
        if(!$exists || AuthenticationManagment::getInstance()->getCurrentSessionUser()->type > 2) {
            $page = new MysqlConfigPage();
            $form = $page->getMysqlConfigForm();
            if($exists) {
                $page->getPageAlert()->setVisible(false);
                $config = (new MySqlConnection())->loadParameters();
                $form->getDatabaseHost()->setValue($config->getServer());
                $form->getDatabaseName()->setValue($config->getDatabase());
                $form->getDatabaseUser()->setValue($config->getUsername());
                $form->getDatabasePassword()->setValue($config->getPassword());                
            }
            if($request->isMethod("POST")) {                                
                $form->updateFormFieldsFromRequest();
                $host = $form->getDatabaseHost()->getValue();
                $user = $form->getDatabaseUser()->getValue();
                $pass = $form->getDatabasePassword()->getValue();
                $db = $form->getDatabaseName()->getValue();  
                $link = @mysql_connect($host,$user,$pass);
                if($link && mysql_select_db($db)) {                      
                    file_put_contents($filename, Yaml::dump(['parameters'=>['database_host'=>$host,'database_name'=>$db,'database_user'=>$user,'database_password'=>$pass]]));
                    return $this->redirect(Routing::getPreviousUrl());
                } else {                     
                    $page->getResult()->setSuccess(false)->setText("The connection was not successful with the database information entered!<br><br>".mysql_error());                    
                }
            } 
            return $this->renderHtmlObject($page);
        }
    }
    
    public function projectConfig(Request $request) {
        $filename = (new ProjectData(false))->getConfigFilename();
        $exists = file_exists($filename);                
        if(!$exists || AuthenticationManagment::getInstance()->getCurrentSessionUser()->type > 2) {
            $page = new ProjectDataPage();
            if($exists){
                $page->getPageAlert()->setText("Once you update this information, all the project will be affected");                
            }            
            if($request->isMethod("POST")) {
                $form = $page->getProjectDataConfigForm();
                $form->updateFormFieldsFromRequest();
                $company = $form->getCompanyName()->getValue();
                $encryptionCode = $form->getEncryptionCode()->getValue();
                $email = $form->getEmail()->getValue();
                $emailServer = $form->getEmailServer()->getValue();
                $emailPassword = $form->getEmailPassword()->getValue();
                $cacheJs = $form->getCacheJs()->getChecked();
                $cacheCss = $form->getCacheCss()->getChecked();                
                $type = $form->getType()->getValue();
                if($company != "" || $encryptionCode != "") {
                    file_put_contents($filename, Yaml::dump(['information'=>['company'=>$company,'encryptCode'=>$encryptionCode,'email'=>$email,'emailServer'=>$emailServer,'emailPassword'=>$emailPassword,"type"=>$type],'cache'=>['js'=>$cacheJs,'css'=>$cacheCss]]));                    
                    return $this->redirect(Routing::getPreviousUrl());
                } else {
                    return $this->renderHtmlObject($page);
                }
            }            
            if($exists) {
                $data = new ProjectData();
                $page->getProjectDataConfigForm()->getCompanyName()->setValue($data->getCompanyName());
                $page->getProjectDataConfigForm()->getEncryptionCode()->setValue($data->getEncryptCode());
                $page->getProjectDataConfigForm()->getEmail()->setValue($data->getEmail());
                $page->getProjectDataConfigForm()->getEmailServer()->setValue($data->getEmailServer());
                $page->getProjectDataConfigForm()->getEmailPassword()->setValue($data->getEmailPassword());                
                $page->getProjectDataConfigForm()->getCacheCss()->setChecked($data->getCacheCss());
                $page->getProjectDataConfigForm()->getCacheJs()->setChecked($data->getCacheJs());
                $page->getProjectDataConfigForm()->getType()->setValue($data->getType());
                
            }
            return $this->renderHtmlObject($page);
        }        
    }
}
