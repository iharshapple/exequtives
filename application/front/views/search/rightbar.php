
<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 paddinggrid">
    <?php echo $this->load->view('search/search_header') ?>
    <div class="row marleft40 marginright0">
        <?php for ($i = 0; $i < 16; $i++): ?>
            <div class="listing_div">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0 heightfix">
                    <img src="<?= DOMAIN_URL ?>bootstrap/img/temp_img.jpg" alt="Category" class="img-responsive">
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0">
                    <div class="row margin0 padding0 background27c6db maxwidth100per">
                        <div class="col-lg-6 col-md-5 col-sm-6 col-xs-12 padding0 listing_btn_div listing_category_name">
                            <div class="btn btn-group ">
                                <img src="<?= DOMAIN_URL ?>bootstrap/img/category_icon.png" alt="Category">
                                <span> Category </span>
                            </div>
                        </div>
                        <div class="btn col-lg-6 col-md-7 col-sm-6 col-xs-12 listing_btn_div padding0">
                            <div class="btn btn-group">
                                <span> Jonn Deo </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
        <?php endfor; ?>
        </div>
</div>