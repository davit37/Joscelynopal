
<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 contact">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?php if(isset($result_page) && !empty($result_page)){ 
            if(!empty($result_page[0]['title'])){ ?>
            <div class="title"><?php echo $result_page[0]['title'] ?></div>
            <?php } } ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <div class="content">
                <?php if(isset($result_page) && !empty($result_page)){ 
                if(!empty($result_page[0]['description'])){
                echo $result_page[0]['description']; } } ?>
            
                <?php
                if ($this->session->userdata('contact_success')) {
                    echo '<div class="alert alert-success"><i class="fa fa-check-circle"></i> '.$this->session->userdata('contact_success').'<button data-dismiss="alert" class="close" type="button">×</button></div>';
                    $this->session->unset_userdata('contact_success');
                }
                ?>
            
                <form class="form-horizontal" method="post" action="<?php echo base_url('contact/notify') ?>">
                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">Name <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" name="name">
                            <?php
                            if($this->session->userdata('error_name')) {
                                echo '<div class="required">'.$this->session->userdata('error_name').'</div>';
                                $this->session->unset_userdata('error_name');
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-3 control-label">Email Address <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="email" name="email">
                            <?php
                            if($this->session->userdata('error_email')) {
                                echo '<div class="required">'.$this->session->userdata('error_email').'</div>';
                                $this->session->unset_userdata('error_email');
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="comment" class="col-sm-3 control-label">Comment <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="comment"></textarea>
                            <?php
                            if($this->session->userdata('error_comment')) {
                                echo '<div class="required">'.$this->session->userdata('error_comment').'</div>';
                                $this->session->unset_userdata('error_comment');
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="validation" class="col-sm-3 control-label">What is <?php echo $int1 ?> + <?php echo $int2 ?>? <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="validation" name="validation">
                            <?php
                            if($this->session->userdata('error_validation')) {
                                echo '<div class="required">'.$this->session->userdata('error_validation').'</div>';
                                $this->session->unset_userdata('error_validation');
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <div class="checkbox">
                                <label>
                                    <span class="required">*</span> denotes a required field.
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <button type="submit" class="btn btn-default">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php if($this->uri->segment(1) == 'contact'){ if(isset($result_page) && !empty($result_page)){
        if(!empty($result_page[0]['image'])){
        ?>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <img class="contact-image" src="<?php echo base_url("upload/".$result_page[0]['image']) ?>" class="img-responsive">
        </div>
        <?php } }} ?>
    </div>
</div>