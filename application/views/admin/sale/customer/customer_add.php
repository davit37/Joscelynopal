<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button class="btn btn-primary" title="" data-toggle="tooltip" form="form-customer" type="submit" data-original-title="Save"><i class="fa fa-save"></i></button>
                <a class="btn btn-default" title="" data-toggle="tooltip" href="<?php echo base_url('admin/sale/customer') ?>" data-original-title="Cancel"><i class="fa fa-reply"></i></a></div>
            <h1>Customers</h1>
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url('admin/dashboard') ?>">Home</a></li>
                <li><a href="<?php echo base_url('admin/sale/customer') ?>">Customers</a></li>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> Add Customer</h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" id="form-customer" enctype="multipart/form-data" method="post" action="<?php echo base_url('admin/sale/customer/save') ?>">
                    <fieldset id="account">
                        <legend>Personal Details</legend>
                        <div class="form-group required <?php echo ($this->session->userdata('error_firstname')) ? 'has-error' : ''; ?>">
                            <label for="input-firstname" class="col-sm-2 control-label">First Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input-firstname" placeholder="First Name" value="<?php echo $this->session->userdata('value_firstname') ?>" name="firstname">
                                <?php if ($this->session->userdata('error_firstname')) { ?>
                                    <div class="text-danger"><?php echo $this->session->userdata('error_firstname') ?></div>
                                    <?php $this->session->unset_userdata('error_firstname') ?>
                                <?php } ?>
                                <?php $this->session->unset_userdata('value_firstname') ?>
                            </div>
                        </div>
                        <div class="form-group required <?php echo ($this->session->userdata('error_lastname')) ? 'has-error' : ''; ?>">
                            <label for="input-lastname" class="col-sm-2 control-label">Last Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input-lastname" placeholder="Last Name" value="<?php echo $this->session->userdata('value_lastname') ?>" name="lastname">
                                <?php if ($this->session->userdata('error_lastname')) { ?>
                                    <div class="text-danger"><?php echo $this->session->userdata('error_lastname') ?></div>
                                    <?php $this->session->unset_userdata('error_lastname') ?>
                                <?php } ?>
                                <?php $this->session->unset_userdata('value_lastname') ?>
                            </div>
                        </div>
                        <div class="form-group required <?php echo ($this->session->userdata('error_email')) ? 'has-error' : ''; ?>">
                            <label for="input-email" class="col-sm-2 control-label">E-Mail</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="input-email" placeholder="E-Mail" value="<?php echo $this->session->userdata('value_email') ?>" name="email">
                                <?php if ($this->session->userdata('error_email')) { ?>
                                    <div class="text-danger"><?php echo $this->session->userdata('error_email') ?></div>
                                    <?php $this->session->unset_userdata('error_email') ?>
                                <?php } ?>
                                <?php $this->session->unset_userdata('value_email') ?>
                            </div>
                        </div>
                        <div class="form-group required <?php echo ($this->session->userdata('error_telephone')) ? 'has-error' : ''; ?>">
                            <label for="input-telephone" class="col-sm-2 control-label">Telephone</label>
                            <div class="col-sm-10">
                                <input type="tel" class="form-control" id="input-telephone" placeholder="Telephone" value="<?php echo $this->session->userdata('value_telephone') ?>" name="telephone">
                                <?php if ($this->session->userdata('error_telephone')) { ?>
                                    <div class="text-danger"><?php echo $this->session->userdata('error_telephone') ?></div>
                                    <?php $this->session->unset_userdata('error_telephone') ?>
                                <?php } ?>
                                <?php $this->session->unset_userdata('value_telephone') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-fax" class="col-sm-2 control-label">Fax</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input-fax" placeholder="Fax" value="<?php echo $this->session->userdata('value_fax') ?>" name="fax">
                                <?php $this->session->unset_userdata('value_fax') ?>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset id="address">
                        <legend>Address</legend>
                        <div class="form-group">
                            <label for="input-company" class="col-sm-2 control-label">Company</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input-company" placeholder="Company" value="<?php echo $this->session->userdata('value_company') ?>" name="company">
                                <?php $this->session->unset_userdata('value_company') ?>
                            </div>
                        </div>
                        <div class="form-group required <?php echo ($this->session->userdata('error_address_1')) ? 'has-error' : ''; ?>">
                            <label for="input-address-1" class="col-sm-2 control-label">Address 1</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input-address-1" placeholder="Address 1" value="<?php echo $this->session->userdata('value_address_1') ?>" name="address_1">
                                <?php if ($this->session->userdata('error_address_1')) { ?>
                                    <div class="text-danger"><?php echo $this->session->userdata('error_address_1') ?></div>
                                    <?php $this->session->unset_userdata('error_address_1') ?>
                                <?php } ?>
                                <?php $this->session->unset_userdata('value_address_1') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-address-2" class="col-sm-2 control-label">Address 2</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input-address-2" placeholder="Address 2" value="<?php echo $this->session->userdata('value_address_2') ?>" name="address_2">
                            </div>
                        </div>
                        <div class="form-group required <?php echo ($this->session->userdata('error_city')) ? 'has-error' : ''; ?>">
                            <label for="input-city" class="col-sm-2 control-label">City</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input-city" placeholder="City" value="<?php echo $this->session->userdata('value_city') ?>" name="city">
                                <?php if ($this->session->userdata('error_city')) { ?>
                                    <div class="text-danger"><?php echo $this->session->userdata('error_city') ?></div>
                                    <?php $this->session->unset_userdata('error_city') ?>
                                <?php } ?>
                                <?php $this->session->unset_userdata('value_city') ?>
                            </div>
                        </div>
                        <div class="form-group required <?php echo ($this->session->userdata('error_postcode')) ? 'has-error' : ''; ?>">
                            <label for="input-postcode" class="col-sm-2 control-label">Post Code</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input-postcode" placeholder="Post Code" value="<?php echo $this->session->userdata('value_postcode') ?>" name="postcode">
                                <?php if ($this->session->userdata('error_postcode')) { ?>
                                    <div class="text-danger"><?php echo $this->session->userdata('error_postcode') ?></div>
                                    <?php $this->session->unset_userdata('error_postcode') ?>
                                <?php } ?>
                                <?php $this->session->unset_userdata('value_postcode') ?>
                            </div>
                        </div>
                        <div class="form-group required <?php echo ($this->session->userdata('error_country_id')) ? 'has-error' : ''; ?>">
                            <label for="input-country" class="col-sm-2 control-label">Country</label>
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
                        <div class="form-group required <?php echo ($this->session->userdata('error_zone_id')) ? 'has-error' : ''; ?>">
                            <label for="input-zone" class="col-sm-2 control-label">Region / State</label>
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
                        <legend>Password</legend>
                        <div class="form-group required <?php echo ($this->session->userdata('error_password')) ? 'has-error' : ''; ?>"">
                            <label for="input-password" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="input-password" placeholder="Password" value="" name="password">
                                <?php if ($this->session->userdata('error_password')) { ?>
                                    <div class="text-danger"><?php echo $this->session->userdata('error_password') ?></div>
                                    <?php $this->session->unset_userdata('error_password') ?>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group required <?php echo ($this->session->userdata('error_confirm')) ? 'has-error' : ''; ?>">
                            <label for="input-confirm" class="col-sm-2 control-label">Password Confirm</label>
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

                </form>
            </div>
        </div>
    </div>
</div>