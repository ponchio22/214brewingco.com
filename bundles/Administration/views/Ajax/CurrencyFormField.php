<?php

use Administration\Controls\CurrencyFormField;
use Ima\Data\NumberFormat;

/* @var $object CurrencyFormField */
ob_start();
?><input id='<?php echo $object->getId();?>' class='form-control currency_field <?php echo $object->getCssclass();?>' novalidate="novalidate" type="number" step=".01" lang="es" name='<?php echo $object->findForm()->getName();?>[<?php echo $object->getName();?>]' placeholder="<?php echo $object->getPlaceHolder();?>" value='<?php echo $object->getValue();?>' <?php echo ($object->getEnabled())? '':'disabled';?> style="<?php echo ($object->getOutputOnlyInput() && !$object->getVisible())? "display:none":"";?>"/><?php
$input = ob_get_contents();
ob_clean();
if($object->getOutputOnlyInput()):
    echo $input;
else:
?>
<div class="currentyFormFieldContainer">
    <div class='form-row form-group currency_field_container <?php echo ($object->getVisible())? "":"hidden"; ?> <?php echo ($object->getHasError())?'has-error':''?>'>
        <label for='<?php echo $object->getId();?>'><?php echo $object->getLabel();?></label>  
        <div class="input-group">
            <div class="input-group-addon">$</div>            
            <?php
            echo $input;
            if($object->getUseCashSumCounter()):
            ?>
            <div class="input-group-btn"><button class="btn btn-default cashSumCounterButton" ><i class="fa fa-calculator" aria-hidden="true"></i></button></div>                
            <?php
            endif;
            ?>
        </div>    
        <span id="helpBlock2" class="help-block" style='<?php echo ($object->getHasError())? "":"display:none;";?>'><?php echo $object->getError();?></span>
    </div>
    <?php 
    if($object->getUseCashSumCounter()):
    ?>
    <div class="form-group panel panel-default cashSumCounterPanel " style="display:none;">
        <div class="panel-body">            
            <div class="controls">
                <span id="helpBlock2" class="help-block">Ingresa la denominación y cantidad de los billetes a contar</span>
                <div class='form-group'>
                <label>Denominación</label>
                <div class='input-group'>
                    <div class="input-group-addon">$</div>
                    <input type="number"  step=".01" novalidate="novalidate" class="form-control currency_field denomination input-sm" value="<?php echo NumberFormat::money(0); ?>"/>
                </div>
                </div>
                <div class='form-group'>
                <label>Cantidad</label>
                <input type="text" class="form-control quantity input-sm" value="0"/>
                </div>
                <div class='form-group'>
                    <div><span class='conteoActual'></span></div>
                </div>
                <div class='form-group'>                    
                    <div><label>Total: </label><span>$<span class='total'>0.00</span></span></div>                    
                </div>
                <button class='btn btn-default add'>Sumar y Continuar</button>
                <button class='btn btn-primary useValue'>Utilizar</button>
                <button class='btn btn-default cancel'>Cancelar</button>
            </div>
        </div>
    </div>
    <?php
    endif;
    ?>
</div>
<?php
endif;
?>