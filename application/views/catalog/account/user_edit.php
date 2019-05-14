<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo base_url('account/user/update') ?>">
                <fieldset id="account">
                    <legend>Your Personal Details</legend>
                    <div class="form-group <?php echo ($this->session->userdata('error_firstname')) ? 'has-error' : ''; ?>">
                        <label for="input-firstname" class="col-sm-2 control-label"><span class="required">*</span> First Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="input-firstname" placeholder="First Name" value="<?php echo $user[0]['firstname'] ?>" name="firstname">
                            <?php if ($this->session->userdata('error_firstname')) { ?>
                                <div class="text-danger"><?php echo $this->session->userdata('error_firstname') ?></div>
                                <?php $this->session->unset_userdata('error_firstname') ?>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group <?php echo ($this->session->userdata('error_lastname')) ? 'has-error' : ''; ?>">
                        <label for="input-lastname" class="col-sm-2 control-label"><span class="required">*</span> Last Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="input-lastname" placeholder="Last Name" value="<?php echo $user[0]['lastname'] ?>" name="lastname">
                            <?php if ($this->session->userdata('error_lastname')) { ?>
                                <div class="text-danger"><?php echo $this->session->userdata('error_lastname') ?></div>
                                <?php $this->session->unset_userdata('error_lastname') ?>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group <?php echo ($this->session->userdata('error_email')) ? 'has-error' : ''; ?>">
                        <label for="input-email" class="col-sm-2 control-label"><span class="required">*</span> E-Mail</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="input-email" placeholder="E-Mail" value="<?php echo $user[0]['email'] ?>" name="email">
                            <?php if ($this->session->userdata('error_email')) { ?>
                                <div class="text-danger"><?php echo $this->session->userdata('error_email') ?></div>
                                <?php $this->session->unset_userdata('error_email') ?>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group <?php echo ($this->session->userdata('error_telephone')) ? 'has-error' : ''; ?>">
                        <label for="input-telephone" class="col-sm-2 control-label"><span class="required">*</span> Telephone</label>
                        <div class="col-sm-10">
                            <input type="tel" class="form-control" id="input-telephone" placeholder="Telephone" value="<?php echo $user[0]['telephone'] ?>" name="telephone">
                            <?php if ($this->session->userdata('error_telephone')) { ?>
                                <div class="text-danger"><?php echo $this->session->userdata('error_telephone') ?></div>
                                <?php $this->session->unset_userdata('error_telephone') ?>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input-fax" class="col-sm-2 control-label">Fax</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="input-fax" placeholder="Fax" value="<?php echo $user[0]['fax'] ?>" name="fax">
                        </div>
                    </div>
                </fieldset>
                <fieldset id="address">
                    <legend>Your Address</legend>
                    <div class="form-group">
                        <label for="input-company" class="col-sm-2 control-label">Company</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="input-company" placeholder="Company" value="<?php echo $user[0]['company'] ?>" name="company">
                        </div>
                    </div>
                    <div class="form-group <?php echo ($this->session->userdata('error_address_1')) ? 'has-error' : ''; ?>">
                        <label for="input-address-1" class="col-sm-2 control-label"><span class="required">*</span> Address 1</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="input-address-1" placeholder="Address 1" value="<?php echo $user[0]['address_1'] ?>" name="address_1">
                            <?php if ($this->session->userdata('error_address_1')) { ?>
                                <div class="text-danger"><?php echo $this->session->userdata('error_address_1') ?></div>
                                <?php $this->session->unset_userdata('error_address_1') ?>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input-address-2" class="col-sm-2 control-label">Address 2</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="input-address-2" placeholder="Address 2" value="<?php echo $user[0]['address_2'] ?>" name="address_2">
                        </div>
                    </div>
                    <div class="form-group <?php echo ($this->session->userdata('error_city')) ? 'has-error' : ''; ?>">
                        <label for="input-city" class="col-sm-2 control-label"><span class="required">*</span> City</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="input-city" placeholder="City" value="<?php echo $user[0]['city'] ?>" name="city">
                            <?php if ($this->session->userdata('error_city')) { ?>
                                <div class="text-danger"><?php echo $this->session->userdata('error_city') ?></div>
                                <?php $this->session->unset_userdata('error_city') ?>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group <?php echo ($this->session->userdata('error_postcode')) ? 'has-error' : ''; ?>">
                        <label for="input-postcode" class="col-sm-2 control-label"><span class="required">*</span> Post Code</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="input-postcode" placeholder="Post Code" value="<?php echo $user[0]['postcode'] ?>" name="postcode">
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
                                    <option value="<?php echo $country['country_id'] ?>" <?php echo ($country['country_id'] == $user[0]['country_id']) ? "selected='selected'" : "" ?>><?php echo $country['name'] ?></option>
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
                    <legend>Newsletter</legend>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Subscribe</label>
                        <div class="col-sm-10">
                            <label class="radio-inline">
                                <input type="radio" <?php echo ($user[0]['newsletter'] == 1) ? 'checked="checked"' : '' ?> value="1" name="newsletter">
                                Yes</label>
                            <label class="radio-inline">
                                <input type="radio" <?php echo ($user[0]['newsletter'] == 0) ? 'checked="checked"' : '' ?> value="0" name="newsletter">
                                No</label>
                        </div>
                    </div>
                </fieldset>
                <div class="buttons clearfix">
                    <div class="pull-left">
                        <a class="btn btn-default" href="<?php echo base_url('account/user'); ?>">Back</a>
                    </div>
                    <div class="pull-right">
                        <input type="submit" class="btn btn-primary" value="Continue">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

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
                    
                    if (json[i]['zone_id'] == '<?php echo $user[0]['zone_id']; ?>') {
			html += ' selected="selected"';
		    }
                    
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