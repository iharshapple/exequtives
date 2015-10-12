
<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 paddinggrid">
    <?php echo $this->load->view('search/search_header') ?>
    
    <div class="grid-div">
        
        <?php for ($i = 0; $i < 7; $i++): ?>
            <div class="row marginright0">

                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 padding0 heightfix">
                    <img src="<?= DOMAIN_URL ?>bootstrap/img/temp_img.jpg" alt="Category" class="img-responsive">
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-6 padding-info">

                    <div class="main_title">
                        <div class="row margin0">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 padtb12">
                                <span class="person-title pull-left">JOHN DOE</span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 padding0 hidden-xs">
                                <img src="<?= DOMAIN_URL ?>bootstrap/img/category-plain.png" alt="Category" class="img-responsive cat-image">
                                <span class="person-category">
                                    category
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="intro_desc"><p>Notepad is abasic text-editing program and it’s most commenly used to view or edit text files. A text file is a file type typically identified by the .txt file name extension.</p></div>
                    <div> <button type="button" class="btn btn-default filterbtn">read more</button></div>
                </div>
            </div>
        <div class="separator"></div>
        <?php endfor; ?>
        </div>
     
</div>