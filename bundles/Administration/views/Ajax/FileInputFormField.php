<?php

use Administration\Controls\FileInputFormField;
use Ima\Routing\Routing;
use Symfony\Component\HttpFoundation\File\File;

/* @var $object FileInputFormField */
$hasValueClass = ($object->getValue()!=NULL)? "1":"0";
try{
    $file = (new File($object->getValue()));
    $info = pathinfo($file);
    $pathName = $info["dirname"] . "/" .$info["basename"];
    $thumbnail = $info["dirname"] . "/thumb_" . $info["basename"];
    $extension = $file->getExtension();
    $isImage = ($extension=="png" || $extension=="jpg" || $extension=="gif")? true:false;
} catch(Exception $e) {
    $pathName = "";
    $isImage = false;
}
?>
<div class='form-row form-group fileInputFormFieldContainer <?php echo ($object->getVisible())? "":"hidden"; ?> <?php echo ($object->getHasError())?'has-error':''?>' <?php $object->outputAttributesString();?> has-value="<?php echo $hasValueClass;?>">
    <label for='<?php echo $object->getId();?>' class="uploadFileSelectorLabel"><span title="Subiendo" class="hidden spinner"><i class="fa fa-spinner fa-spin fa-3x fa-fw spinner" name="spinner" style="font-size: 12px;"></i> </span><?php echo $object->getLabel();?></label>        
    <input id='<?php echo $object->getId();?>' class='form-control uploadFileSelector' type="file" placeholder="<?php echo $object->getPlaceHolder();?>" <?php echo ($object->getEnabled())? '':'disabled';?>/>    
    <?php 
    //if($isImage) :
    ?>
    <img src="<?php echo Routing::getRoot(true);?>/image/?file=<?php echo urlencode($thumbnail);?>" class="img-thumbnail" width="50" data-toggle="modal" data-target="#<?php echo $object->getId();?>_modal" >    
    <!-- Modal -->
    <div id="<?php echo $object->getId();?>_modal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <img src="<?php echo Routing::getRoot(true);?>/image/?file=<?php echo urlencode($pathName);?>" class="image" width="100%" data-toggle="modal" data-target="#<?php echo $object->getId();?>_modal">
          <div class="imageOptions modal-body">
              Rotar
              <a href="#" class="rotateLeft btn btn-default"><span class="fa fa-rotate-left rotateIcon"></span><span class="fa fa-spinner fa-spin spinnerIcon" style="display:none;"></span></a>
              <a href="#" class="rotateRight btn btn-default"><span class="fa fa-rotate-right rotateIcon"></span><span class="fa fa-spinner fa-spin spinnerIcon" style="display:none;"></span></a>
          </div>
        </div>
      </div>
    </div>
    <?php    
    //endif;
    ?>
    <a class="btn btn-default changeButton" href="#"><span class="glyphicon glyphicon-pencil"></span> Cambiar</a>
    <?php if($object->getHasError()) :?>
    <span id="helpBlock2" class="help-block"><?php echo $object->getError();?></span>
    <?php endif;?>
    <input ajax-upload-path="<?php echo $object->getAjaxUploadPath();?>" auto-upload="<?php echo ($object->getAutoUpload())? "true":"false"; ?>" file-upload-directory="<?php echo $object->getUploadsDirectory();?>" name='<?php echo $object->findForm()->getName();?>[<?php echo $object->getId();?>]' class="uploadedFilePathInput fileInputFormField" style="display:none;" value='<?php echo $object->getValue();?>'/>
    <!--div id="progress">0%</div-->
</div>