<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 martop45">
    <div class="filter-search">
        <form class="form-horizontal make-center">
            <div class="form-group">
                <div class="text-center">
                    <h1 class="filterby">filter by</h1>
                    <span class="horizontal-strip"></span>
                </div>
            </div>
            <div class="form-group">
                <?php $extra = ' class="form-control theme-input" placeholder="Select Category" id="cat-list"'; ?>
                <?php echo form_dropdown('iCategoryID', $cat_options, '', $extra); ?>
            </div>
            <div class="form-group">
                <select class="form-control theme-input" placeholder="Sub Select" id="subcat-list">
                    <option>Subcategory Select</option>
                </select>
            </div>
            <div class="form-group">
                <input type="text" id="autocomplete" onFocus="geolocate()" class="form-control theme-input theme-input-text" placeholder="Enter Location">
            </div>
            <div class="form-group">
                <!-- Standard button -->
                <button type="button" class="btn btn-default filterbtn">filter</button>
            </div>
        </form>
    </div>
    <div class="filter-search"> 
        <form class="form-horizontal make-center">
            <div class="form-group">
                <div class="text-center">
                    <h1 class="filterby">Contact us</h1>
                    <span class="horizontal-strip"></span>
                </div>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="" placeholder="Your Name">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" id="inputEmail3" placeholder="Your Email">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="" placeholder="Contact Number">
            </div>
            <div class="form-group">
                <textarea name="" id="" class="form-control" rows="3" required="required" placeholder="Message"></textarea>
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-default filterbtn">submit</button>
            </div>
        </form>
    </div>
</div>


