<?php
/**
 * Created by JetBrains PhpStorm.
 * User: edseventeen
 * Date: 3/29/13
 * Time: 9:29 AM
 * To change this template use File | Settings | File Templates.
 */

if(!defined('ABSPATH'))
    die('Forbidden');

smart_forms_load_license_manager("");

wp_enqueue_script('jquery');
wp_enqueue_script('isolated-slider',SMART_FORMS_DIR_URL.'js/rednao-isolated-jq.js',array('jquery'));


wp_enqueue_script('smart-forms-add-new',SMART_FORMS_DIR_URL.'js/main_screens/smart-forms-add-new.js',array('isolated-slider'));
wp_enqueue_script('smart-forms-event-manager',SMART_FORMS_DIR_URL.'js/formBuilder/eventmanager.js',array('isolated-slider'));
wp_enqueue_script('smart-forms-formelements',SMART_FORMS_DIR_URL.'js/formBuilder/formelements.js',array('isolated-slider'));
wp_enqueue_script('smart-forms-elementsProperties',SMART_FORMS_DIR_URL.'js/formBuilder/elementsproperties.js',array('smart-forms-formelements'));
wp_enqueue_script('smart-forms-formBuilder',SMART_FORMS_DIR_URL.'js/formBuilder/formbuilder.js',array('smart-forms-elementsProperties'));
wp_enqueue_script('smart-forms-dragmanager',SMART_FORMS_DIR_URL.'js/formBuilder/dragManager/dragmanager.js');
wp_enqueue_script('smart-forms-dragitembehaviors',SMART_FORMS_DIR_URL.'js/formBuilder/dragManager/dragitembehaviors.js');






//wp_enqueue_script('smart-forms-mce',SMART_FORMS_DIR_URL.'js/tn_mce/tinymce.min.js',array('smart-forms-add-new'));
wp_enqueue_script('email-editor',SMART_FORMS_DIR_URL.'js/editors/email-editor.js',array('isolated-slider'));

wp_enqueue_script('json2');



wp_enqueue_style('smart-forms-main-style',SMART_FORMS_DIR_URL.'css/mainStyle.css');
wp_enqueue_style('smart-forms-Slider',SMART_FORMS_DIR_URL.'css/smartFormsSlider/jquery-ui-1.10.2.custom.min.css');
wp_enqueue_style('form-builder-boot-strap',SMART_FORMS_DIR_URL.'css/formBuilder/bootstrap.min.css');
wp_enqueue_style('form-builder-custom',SMART_FORMS_DIR_URL.'css/formBuilder/custom.css');

?>


<script type="text/javascript">


    var smartForms_arrow_closed="<?php echo SMART_FORMS_DIR_URL?>images/arrow_right.png";
    var smartForms_arrow_open="<?php echo SMART_FORMS_DIR_URL?>images/arrow_down.png";

    var smartFormsRootPath="<?php echo SMART_FORMS_DIR_URL?>";


</script>




<div id="redNaoEmailEditor" title="Email" style="display: none;">
    <table>
        <tr>
            <td style="text-align: right">From email address</td><td> <input placeholder="Default (wordpress@yoursite.com)" type="text" id="redNaoFromEmail" style="width:300px"></td>
        </tr>

        <tr>
            <td style="text-align: right">From name</td><td> <input placeholder="Default (Wordpress)" type="text" id="redNaoFromName" style="width:300px"></td>
        </tr>

        <tr>
            <td style="text-align: right">To email address(es)</td><td> <input placeholder="Default (Blog Administrator)" type="text" id="redNaoToEmail" style="width:300px"></td>
        </tr>

        <tr>
            <td style="text-align: right">Email subject</td><td> <input placeholder="Default (Form Submitted)" type="text" id="redNaoEmailSubject" style="width:300px"></td>
        </tr>
    </table>
    <div id="redNaoEmailEditorComponent">
    <?php wp_editor( "", "redNaoTinyMCEEditor"); ?>


    <div id="redNaoAccordion" class="smartFormsSlider" style="float:right;">
        <h3>Form Fields</h3>
        <div>
            <ul id="redNaoEmailFormFields">

            </ul>
        </div>

    </div>
    </div>
    <div style="text-align: right;clear: both;">
        <button onclick="RedNaoEmailEditorVar.CloseEmailEditor();">Close</button>
        <button onclick="SmartFormsAddNewVar.SendTestEmail();">Send Test Email</button>
    </div>
</div>






<form id='smart_forms_general_options'>
    <div id="rednaoSmartForms">

        <input type="hidden" id="smartFormsId" value=""/>

        <div  >
            <div class="treeDiv" id="smartFormsBasic" style="display: inline-block">
                <img class="treeButton" src="<?php echo SMART_FORMS_DIR_URL?>images/arrow_down.png" alt=""/>
                <h2 class="treeTitle">Basic</h2>
            </div>
            <button style="margin-left: 530px;width:100px;cursor: hand;cursor: pointer;" id="smartFormsSaveButton" >Save</button>
        </div>
        <div  id="smartFormsBasicDetail">
            <hr/>
            <div class="category">
                <span><?php echo __("Name"); ?></span>
                <input type="text"  id="smartFormName"/>
                <span class="description" style="margin-bottom:5px;"> <?php echo __("*The name of the form, this name is displayed in the form list"); ?></span>
                <br/>

                <span><?php echo __("Description"); ?></span>
                <input type="text"  id="smartFormDescription"/>
                <span class="description" style="margin-bottom:5px;"> <?php echo __("*The form description, this is displayed in the form list"); ?></span>
                <br/>


                <span><?php echo __("On submission send notification email"); ?></span>
                <input type="checkbox"  id="smartFormsSendNotificationEmail"/>
                <button id="redNaoEditEmailButton" disabled="disabled"><?php echo __("Edit Email"); ?></button>
                <br/>
            </div>
        </div>


        <br/>

<!--

        <div class="treeDiv" id="smartDonationsAdvanced">
            <img class="treeButton" src="<?php echo plugin_dir_url(__FILE__)?>images/arrow_right.png" alt=""/>
            <h2 class="treeTitle">Advanced Options</h2>
        </div>
        <div  id="smartDonationsAdvancedDetail">
            <hr/>
            <div class="category" >
                <span>Currency</span>
                <select id="smartDonationsCurrencyDropDown" name="donation_currency"></select>
                <span class="description">*the selected currency for the donation</span>
                <br/>
                <span>Returning Url</span>
                <input type="text" id="smartDonationsReturningUrl"/>
                <span class="description">*Page displayed after he does a donation</span>
                <br/>
                <span>Donation Description</span>
                <input type="text" id="smartDonationsDonationDescription"/>
                <span class="description">*This text is going to be shown in the paypal invoice</span>
            </div>


        </div>-->

<hr style="margin:20px -17px 0px -17px;"/>

       <div id="redNaoFormBackground" style="background-color: #efefef;">
            <div class="rednaoformbuilder container rednaoFormContainer">

                <table style="border-collapse: collapse;background-color: #efefef;">
                    <tr>

                    <td style="vertical-align: top;background-color: white">

                   <div class="span6 " id="newFormContainer">
                            <div class="clearfix" style="text-align:left;">


                                <div id="build">
                                    <div id="target" class="form-horizontal" style="background-color:white;">
                                        <fieldset id="redNaoElementlist" class="formelements" >
                                            <div class="formelement last" style="height:77px;width:100%; ">

                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                    </div>

                </td>


                <td style="background-color: #efefef; vertical-align: top;border-left:1px solid #cfcfcf">
                   <div id="formSettingsScrollArea">
                       <div id="formSettings" >
                            <div id="formBuilderButtonSet" class="smartFormsSlider">
                                <input type="radio" id="formRadio1" value="Fields"  name="smartFormsFormEditStyle"  checked="checked" style="display:inline-block;"/><label style="margin:0px;width:150px;display:inline-block;" for="formRadio1">Fields</label>
                                <input type="radio" id="formRadio2"  value="Settings" name="smartFormsFormEditStyle" style="display:inline-block;"/><label label style="width:150px;margin:0px;margin-left:-5px;display:inline-block;" for="formRadio2">Field Settings</label>
                            </div>

                            <div id="formBuilderContainer">
                                <div class="span6" id="formBuilderComponents">
                                    <h2 class="redNaoFormContainerHeading">Drag &amp; Drop components</h2>
                                    <hr>
                                    <div class="tabbable" >
                                        <ul class="nav nav-tabs" id="navtab">
                                            <li><a id="alayout" class="formtab" >Layout</a></li>
                                            <li><a id="atabinput" class="formtab selectedTab" >Input</a></li>
                                            <li><a id="atabradioscheckboxes" class="formtab">Radios / Checkboxes</a></li>
                                            <li><a id="atabselect" class="formtab">Select</a></li>
                                         <!--   <li><a id="atabbuttons" class="formtab">Paypal</a></li>-->
                                        </ul>
                                        <div class="form-horizontal" id="components">
                                            <fieldset  >
                                                <div class="tab-content">
                                                    <div class="tab-pane active rednaotablist" id="layout" style="display: none">
                                                        <div class="component">
                                                            <div class="control-group rednaotitle">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane active rednaotablist" id="tabinput">
                                                        <div class="component">
                                                            <div class="control-group rednaotextinput">
                                                            </div>
                                                        </div>
                                                        <div class="component">
                                                            <div class="control-group rednaoprependedtext">
                                                            </div>
                                                        </div>
                                                        <div class="component">
                                                            <div class="control-group rednaoappendedtext">
                                                            </div>
                                                        </div>
                                                        <div class="component">
                                                            <div class="control-group rednaoprependedcheckbox">
                                                            </div>
                                                        </div>
                                                        <div class="component">
                                                            <div class="control-group rednaoappendedcheckbox">
                                                            </div>
                                                        </div>
                                                        <div class="component">
                                                            <div class="control-group rednaotextarea">
                                                            </div>
                                                        </div>

                                                        <div class="component">
                                                            <div class="control-group rednaosubmissionbutton">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane rednaotablist" id="tabradioscheckboxes" style="display: none;">
                                                        <div class="component">
                                                            <div class="control-group rednaomultipleradios"></div>
                                                        </div>

                                                        <div class="component">
                                                            <div class="control-group rednaomultiplecheckboxes">
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="tab-pane rednaotablist" id="tabselect"  style="display: none;">
                                                        <div class="component">
                                                            <div class="control-group rednaoselectbasic">
                                                            </div>
                                                        </div>

                                                    </div>
                                              <!--      <div class="tab-pane rednaotablist" id="tabbuttons"  style="display: none;">
                                                        <div class="component">
                                                            <div class="control-group rednaodonationrecurrence">
                                                            </div>
                                                        </div>
                                                        <div class="component">
                                                            <div class="control-group rednaodonationamount">
                                                            </div>
                                                        </div>
                                                        <div class="component">
                                                            <div class="control-group rednaodonationbutton">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>-->
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                                <div id="formPropertiesContainer" style="padding:5px;display:none;">
                                    <table id="smartFormPropertiesTable" style="width:100%">

                                    </table>
                                </div>
                            </div>
                       </div>
                   </div>
                 </td>
                </tr>
                    </table>

            </div>
       </div>
</form>
<hr />

<div  id="rednaoPropertiesPanel" style="top: 74px; left: 711px; display: none;">
    <div class="arrow" ></div>
    <h3 class="rednaopopover-title">Form Name</h3>

    <div class="rednaopopover-content">
        <div class="rednaopropertiesform">
            <div id="rednaoPropertiesList" style="margin:0;padding:0;">
                <label class="control-label" id="rednaoFormTitle">Form Name</label>
                <input class="input-large field" data-type="input" type="text" name="name" id="name" value="Form Name">
            </div>
            <div>
                <hr>
                <button id="rednaoPropertySave" class="rednaoBtn rednaoBtnSave" onclick="return false;">Save</button>
                <button id="rednaoPropertyCancel" class="rednaoBtn rednaoBtnCancel" onclick="return false;">Cancel</button>
            </div>

        </div>
    </div>
</div>



