<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 no-padding-xs">

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="content">

            <?php if ($this->session->userdata('error_agree')) { ?>

                <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> Warning: You must agree to the Privacy Policy!</div>

                <?php $this->session->unset_userdata('error_agree') ?>

            <?php } ?>

            <h1>Register Account</h1>

            <p>If you already have an account with us, please login at the <a href="<?php echo base_url('account/login') ?>">login page</a>.</p>

            <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo base_url('account/register/save') ?>">

                <fieldset id="account">

                    <legend>Your Personal Details</legend>

                    <div class="form-group <?php echo ($this->session->userdata('error_firstname')) ? 'has-error' : ''; ?>">

                        <label for="input-firstname" class="col-sm-2 control-label"><span class="required">*</span> First Name</label>

                        <div class="col-sm-10">

                            <input type="text" class="form-control" id="input-firstname" placeholder="First Name" value="<?php echo $this->session->userdata('value_firstname') ?>" name="firstname">

                            <?php if ($this->session->userdata('error_firstname')) { ?>

                                <div class="text-danger"><?php echo $this->session->userdata('error_firstname') ?></div>

                                <?php $this->session->unset_userdata('error_firstname') ?>

                            <?php } ?>

                        </div>

                    </div>

                    <div class="form-group <?php echo ($this->session->userdata('error_lastname')) ? 'has-error' : ''; ?>">

                        <label for="input-lastname" class="col-sm-2 control-label"><span class="required">*</span> Last Name</label>

                        <div class="col-sm-10">

                            <input type="text" class="form-control" id="input-lastname" placeholder="Last Name" value="<?php echo $this->session->userdata('value_lastname') ?>" name="lastname">

                            <?php if ($this->session->userdata('error_lastname')) { ?>

                                <div class="text-danger"><?php echo $this->session->userdata('error_lastname') ?></div>

                                <?php $this->session->unset_userdata('error_lastname') ?>

                            <?php } ?>

                        </div>

                    </div>

                    <div class="form-group <?php echo ($this->session->userdata('error_email')) ? 'has-error' : ''; ?>">

                        <label for="input-email" class="col-sm-2 control-label"><span class="required">*</span> E-Mail</label>

                        <div class="col-sm-10">

                            <input type="email" class="form-control" id="input-email" placeholder="E-Mail" value="<?php echo $this->session->userdata('value_email') ?>" name="email">

                            <?php if ($this->session->userdata('error_email')) { ?>

                                <div class="text-danger"><?php echo $this->session->userdata('error_email') ?></div>

                                <?php $this->session->unset_userdata('error_email') ?>

                            <?php } ?>

                        </div>

                    </div>

                    <div class="form-group <?php echo ($this->session->userdata('error_telephone')) ? 'has-error' : ''; ?>">

                        <label for="input-telephone" class="col-sm-2 control-label"><span class="required">*</span> Telephone</label>

                        <div class="col-sm-10">

                            <input type="tel" class="form-control" id="input-telephone" placeholder="Telephone" value="<?php echo $this->session->userdata('value_telephone') ?>" name="telephone">

                            <?php if ($this->session->userdata('error_telephone')) { ?>

                                <div class="text-danger"><?php echo $this->session->userdata('error_telephone') ?></div>

                                <?php $this->session->unset_userdata('error_telephone') ?>

                            <?php } ?>

                        </div>

                    </div>

                    <div class="form-group">

                        <label for="input-fax" class="col-sm-2 control-label">Fax</label>

                        <div class="col-sm-10">

                            <input type="text" class="form-control" id="input-fax" placeholder="Fax" value="<?php echo $this->session->userdata('value_fax') ?>" name="fax">

                        </div>

                    </div>

                </fieldset>

                <fieldset id="address">

                    <legend>Your Address</legend>

                    <div class="form-group">

                        <label for="input-company" class="col-sm-2 control-label">Company</label>

                        <div class="col-sm-10">

                            <input type="text" class="form-control" id="input-company" placeholder="Company" value="<?php echo $this->session->userdata('value_company') ?>" name="company">

                        </div>

                    </div>

                    <div class="form-group <?php echo ($this->session->userdata('error_address_1')) ? 'has-error' : ''; ?>">

                        <label for="input-address-1" class="col-sm-2 control-label"><span class="required">*</span> Address 1</label>

                        <div class="col-sm-10">

                            <input type="text" class="form-control" id="input-address-1" placeholder="Address 1" value="<?php echo $this->session->userdata('value_address_1') ?>" name="address_1">

                            <?php if ($this->session->userdata('error_address_1')) { ?>

                                <div class="text-danger"><?php echo $this->session->userdata('error_address_1') ?></div>

                                <?php $this->session->unset_userdata('error_address_1') ?>

                            <?php } ?>

                        </div>

                    </div>

                    <div class="form-group">

                        <label for="input-address-2" class="col-sm-2 control-label">Address 2</label>

                        <div class="col-sm-10">

                            <input type="text" class="form-control" id="input-address-2" placeholder="Address 2" value="<?php echo $this->session->userdata('value_address_2') ?>" name="address_2">

                        </div>

                    </div>

                    <div class="form-group <?php echo ($this->session->userdata('error_city')) ? 'has-error' : ''; ?>">

                        <label for="input-city" class="col-sm-2 control-label"><span class="required">*</span> City</label>

                        <div class="col-sm-10">

                            <input type="text" class="form-control" id="input-city" placeholder="City" value="<?php echo $this->session->userdata('value_city') ?>" name="city">

                            <?php if ($this->session->userdata('error_city')) { ?>

                                <div class="text-danger"><?php echo $this->session->userdata('error_city') ?></div>

                                <?php $this->session->unset_userdata('error_city') ?>

                            <?php } ?>

                        </div>

                    </div>

                    <div class="form-group <?php echo ($this->session->userdata('error_postcode')) ? 'has-error' : ''; ?>">

                        <label for="input-postcode" class="col-sm-2 control-label"><span class="required">*</span> Post Code</label>

                        <div class="col-sm-10">

                            <input type="text" class="form-control" id="input-postcode" placeholder="Post Code" value="<?php echo $this->session->userdata('value_postcode') ?>" name="postcode">

                            <?php if ($this->session->userdata('error_postcode')) { ?>

                                <div class="text-danger"><?php echo $this->session->userdata('error_postcode') ?></div>

                                <?php $this->session->unset_userdata('error_postcode') ?>

                            <?php } ?>

                        </div>

                    </div>

                    <div class="form-group <?php echo ($this->session->userdata('error_country_id')) ? 'has-error' : ''; ?>">

                        <label for="input-country" class="col-sm-2 control-label"><span class="required">*</span> Country</label>

                        <div class="col-sm-10">

                            <select class="form-control" id="input-country" name="country_id">

                                <option value=""> --- Please Select --- </option>

                                <?php foreach ($countries as $country) { ?>

                                    <option value="<?php echo $country['country_id'] ?>" <?php echo ($country['country_id'] == 100) ? "selected='selected'" : "" ?>><?php echo $country['name'] ?></option>

                                <?php } ?>

                            </select> 

                            <?php if ($this->session->userdata('error_country_id')) { ?>

                                <div class="text-danger"><?php echo $this->session->userdata('error_country_id') ?></div>

                                <?php $this->session->unset_userdata('error_country_id') ?>

                            <?php } ?>

                        </div>

                    </div>

                    <div class="form-group <?php echo ($this->session->userdata('error_zone_id')) ? 'has-error' : ''; ?>">

                        <label for="input-zone" class="col-sm-2 control-label"><span class="required">*</span> Region / State</label>

                        <div class="col-sm-10">

                            <select class="form-control" id="input-zone" name="zone_id">

                                <option value=""> --- Please Select --- </option>

                                <?php foreach ($zones as $zone) { ?>

                                    <option value="<?php echo $zone['zone_id'] ?>"><?php echo $zone['name'] ?></option>

                                <?php } ?>

                            </select>

                            <?php if ($this->session->userdata('error_zone_id')) { ?>

                                <div class="text-danger"><?php echo $this->session->userdata('error_zone_id') ?></div>

                                <?php $this->session->unset_userdata('error_zone_id') ?>

                            <?php } ?>

                        </div>

                    </div>

                </fieldset>

                <fieldset>

                    <legend>Your Password</legend>

                    <div class="form-group <?php echo ($this->session->userdata('error_password')) ? 'has-error' : ''; ?>"">

                        <label for="input-password" class="col-sm-2 control-label"><span class="required">*</span> Password</label>

                        <div class="col-sm-10">

                            <input type="password" class="form-control" id="input-password" placeholder="Password" value="" name="password">

                            <?php if ($this->session->userdata('error_password')) { ?>

                                <div class="text-danger"><?php echo $this->session->userdata('error_password') ?></div>

                                <?php $this->session->unset_userdata('error_password') ?>

                            <?php } ?>

                        </div>

                    </div>

                    <div class="form-group <?php echo ($this->session->userdata('error_confirm')) ? 'has-error' : ''; ?>">

                        <label for="input-confirm" class="col-sm-2 control-label"><span class="required">*</span> Password Confirm</label>

                        <div class="col-sm-10">

                            <input type="password" class="form-control" id="input-confirm" placeholder="Password Confirm" value="" name="confirm">

                            <?php if ($this->session->userdata('error_confirm')) { ?>

                                <div class="text-danger"><?php echo $this->session->userdata('error_confirm') ?></div>

                                <?php $this->session->unset_userdata('error_confirm') ?>

                            <?php } ?>

                        </div>

                    </div>

                </fieldset>

                <fieldset>

                    <legend>Newsletter</legend>

                    <div class="form-group">

                        <label class="col-sm-2 control-label">Subscribe</label>

                        <div class="col-sm-10">

                            <label class="radio-inline">

                                <input type="radio" value="1" name="newsletter">

                                Yes</label>

                            <label class="radio-inline">

                                <input type="radio" checked="checked" value="0" name="newsletter">

                                No</label>

                        </div>

                    </div>

                </fieldset>

                <div class="buttons">

                    <div class="pull-right">I have read and agree to the <a class="agree" data-toggle="modal" data-target="#myModal"><b>Privacy Policy</b></a>                       

                        <input type="checkbox" value="1" name="agree">

                        &nbsp;

                        <input type="submit" class="btn btn-primary" value="Continue">

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>



<!-- Modal -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title" id="myModalLabel">Term & Conditions</h4>

            </div>

            <div class="modal-body">

                Welcome to Jewelry Television® and to jtv.com! These terms and conditions are entered into by and between you and America’s Collectibles Network, Inc. d/b/a Jewelry Television® (“JTV”) (the “Agreement”). By accessing and/or using the jtv.com website including linked sites (the "website") and/or by ordering products and/or services offered on the website or the JTV television network (the “network”), you are agreeing to this Agreement. If you do not agree to be bound by the Agreement, then you cannot access or use the website or make an order on the website or the network.



                JTV is affiliated with a variety of other companies (“Affiliated Companies”) such as Multimedia Commerce Group, Inc. (“MCGI”), the parent company of JTV. For purposes of these terms and conditions, Affiliated Companies shall include any entity or joint venture that is wholly or partially owned or controlled by JTV or MCGI, that wholly or partially owns or controls JTV or MCGI, or that is related to JTV or MCGI through common ownership. The references to “JTV” in these terms and conditions also refer to Affiliated Companies that utilize jtv.com or that link to these terms and conditions from another website.



                Use of the website. Use of the website is restricted to individuals who are either age 18 or over, or those between the ages of 13 and 18, who are using the website with the permission of a parent or guardian. By using the website, you represent to JTV that you are in one of these age categories.



                In addition to agreeing to the terms and conditions contained herein, you agree to abide by any and all laws, statutes, ordinances, rules and regulations concerning your use of the website and/or the network. As a condition of access to and use of the website and/or the network, you warrant to JTV that you will not access or use the website or the network for any purpose that is unlawful or prohibited by this Agreement.



                If you would like, you may register on the website by creating an account. In order to register, you must provide your name (not an assumed name), valid address, valid email address and valid phone number. You are responsible for providing JTV with updated contact information. JTV will rely on the most recent information provided by you in order to contact you.



                It is your sole responsibility to maintain the security of your account and password. Your password is for your personal use only and may not be used by any third party, even with your permission. You are solely responsible for any and all actions taken under your password on this website. You agree to be financially responsible for all of your use of this website.



                Mobile Site and Applications (“Apps”). You may also access the website from your mobile phone or other device via JTV’s Mobile Site or Mobile Apps (the “Mobile Services”), including the ability to research products and place orders. JTV does not charge for this access, but your mobile carrier’s normal data, Internet, text messaging (SMS), and other service fees and charges apply to your use of, and access to, the Mobile Services. You are responsible for all charges and fees from your mobile carrier. Do not use the Mobile Services while driving. The Mobile Services may not be compatible with all mobile devices and carriers. If you have installed the Mobile App on your mobile device, you may receive “push” messages from JTV even when the Mobile App is not active, unless you “opt out” of receiving such messages. You agree that JTV may communicate with you by SMS, MMS, or other electronic means and that certain information about your usage of the Mobile Services may be communicated to JTV. Data about your location may be transmitted to JTV in order to provide you with certain information such as the JTV broadcast channel in your area. JTV does not guarantee that the Mobile Services will be available at all times or in all areas. Unfortunately, no data transmission via a mobile device can be guaranteed to be 100% secure; accordingly, you acknowledge that your use of the Mobile Services, including the transmission of personal information, is at your own risk. All terms and conditions pertaining to the website also apply to the Mobile Services.



                Disclaimer and Limitation of Liability as to the Website and Content. JTV MAKES NO WARRANTIES OR REPRESENTATIONS WHATSOEVER WITH RESPECT TO THE WEBSITE, THE CONTENT, OR ANY LINKED WEBSITE, INCLUDING THE AVAILABILITY OF ANY WEBSITE OR THE CONTENT INFORMATION AND MATERIALS ON IT OR THE ACCURACY, COMPLETENESS OR TIMELINESS OF THAT CONTENT, INFORMATION AND MATERIALS. JTV ALSO DOES NOT WARRANT OR REPRESENT THAT YOUR ACCESS TO OR USE OF THE WEBSITE OR ANY LINKED WEBSITE WILL BE UNINTERRUPTED OR FREE OF ERRORS OR OMISSIONS, THAT DEFECTS WILL BE CORRECTED, OR THAT THE WEBSITE OR ANY LINKED WEBSITE IS FREE OF COMPUTER VIRUSES OR OTHER HARMFUL COMPONENTS. WITHOUT LIMITING THE FOREGOING THE WEBSITE AND ALL CONTENT PROVIDED ON THE WEBSITE IS PROVIDED TO USERS "AS IS," WITH NO WARRANTY OF ANY KIND, EITHER EXPRESS OR IMPLIED INCLUDING BUT NOT LIMITED TO IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE, TITLE, NON-INFRINGEMENT SECURITY OR ACCURACY. THE "AS IS" CONDITION OF CONTENT IS EXPRESSLY MADE A CONDITION OF ANY TRANSACTION ARISING THROUGH OR AS A RESULT OF THE WEBSITE. Please note that some jurisdictions may not allow the exclusion of implied warranties, so some of the above exclusions may not apply to you. Check your local laws for any restrictions or limitations regarding the exclusion of implied warranties.



                UNDER NO CIRCUMSTANCES SHALL JTV, ITS SUPPLIERS OR THEIR RESPECTIVE DIRECTORS, OFFICERS, EMPLOYEES OR AGENTS BE LIABLE TO YOU OR TO ANY THIRD PARTY FOR ANY INDIRECT, CONSEQUENTIAL, INCIDENTAL, SPECIAL OR PUNITIVE DAMAGES, WHETHER IN CONTRACT OR IN TORT INCLUDING NEGLIGENCE, ARISING IN ANY WAY OUT OF ACCESS TO OR USE OF OR INABILITY TO ACCESS OR USE THE WEBSITE OR ANY LINKED WEBSITE OR ITS CONTENTS, LOST PROFITS, BUSINESS INTERRUPTION OR LOSS OF PROGRAMS OR OTHER DATA ON COMPUTER SYSTEMS OR OTHERWISE, EVEN IF JTV IS EXPRESSLY ADVISED OF THE POSSIBILITY OF SUCH DAMAGES. IN NO EVENT SHALL JTV’S LIABILITY EXCEED TEN DOLLARS AND NO CENTS ($10.00).



            </div>

            <div class="modal-footer">



            </div>

        </div>

    </div>

</div>



<?php

// Unset Data Population

$this->session->set_userdata('value_firstname');

$this->session->set_userdata('value_lastname');

$this->session->set_userdata('value_email');

$this->session->set_userdata('value_telephone');

$this->session->set_userdata('value_fax');

$this->session->set_userdata('value_company');

$this->session->set_userdata('value_address_1');

$this->session->set_userdata('value_address_2');

$this->session->set_userdata('value_city');

$this->session->set_userdata('value_postcode');

?>



<script type="text/javascript"><!--

$('select[name=\'country_id\']').on('change', function() {

        $.ajax({

            url: '<?php echo base_url('account/register/country') . '/'; ?>' + this.value,

            dataType: 'json',

            beforeSend: function() {

                $('select[name=\'country_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');

            },

            complete: function() {

                $('.fa-spin').remove();

            },

            success: function(json) {

                html = '<option value=""> --- Please Select --- </option>';



                for (i = 0; i < json.length; i++) {

                    html += '<option value="' + json[i]['zone_id'] + '"';

                    html += '>' + json[i]['name'] + '</option>';

                }



                $('select[name=\'zone_id\']').html(html);

            },

            error: function(xhr, ajaxOptions, thrownError) {

                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);

            }

        });

    });



    $('select[name=\'country_id\']').trigger('change');

//--></script>