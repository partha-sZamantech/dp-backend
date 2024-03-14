<footer>
    <div class="container">
        <div class="footer-top">
            <div class="row">
                <div class="col-md-3 height-250 m-flex-center m-flex-column">
                    <a href="{{ fEnRoot() }}" class="footer-logo">
                        <img src="{{ asset(config('appconfig.commonImagePath').'logo_footer.png') }}" alt="Dhaka Prokash" title="Dhaka Prokash" class="img-responsive" style="max-width: 200px">
                    </a>

                    <div class="footer-address">
                        <p>93, Kazi Nazrul Islam Avenue, (5th Floor)<br>Karwan Bazar, Dhaka-1215.</p>
                    </div>

                    <div class="footer-editor invisible">
                        <h6 style="font-weight: normal!important; color: #00427A!important; font-size: 21px!important;">Chief Editor & Publisher</h6>
                        <p style="margin-bottom: 3px!important;">
                            <span style="font-size: 22px; font-weight: bold"></span>
                        </p>
                        <p><span> <a href=""></a></span></p>
                    </div>
                </div>
                <div class="col-md-3 height-250 m-flex-center m-flex-column m-mt-3">
                    <div class="footer-contact">
                        <h6 class="marginTop0" style="font-weight: normal!important; color: #00427A!important;font-size: 21px!important;">Newsroom</h6>
                        <p>
                            <span><a href="tel:+8801893385356">+880 961 333 1010</a></span>
                            <span> <a href="mailto:newsroom@dhakaprokash24.com">newsroom@dhakaprokash24.com</a> </span>
                            <span> <a href="mailto:literature@dhakaprokash24.com">literature@dhakaprokash24.com</a> </span>
                        </p>

                        <div style="margin-top: 38px">
                            <h6 style="margin-top: 20px; font-weight: normal!important; color: #00427A!important;font-size: 21px!important;">Marketing & Sales</h6>
                            <p>
                                <span><a href="tel:+8809613332020">+880 961 333 2020</a></span>
                                <span> <a href="mailto:marketking@dhakaprokash24.com">marketking@dhakaprokash24.com</a> </span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 height-250 m-flex-center m-flex-column m-mt-5">
                    <div class="footer-link">
                        <p style="padding: 5px 0;"><a href="{{url('/privacy-policy')}}" class="text-white my-2">Privacy Policy</a></p>
                        <p style="padding: 5px 0;"><a href="{{url('/terms-of-use')}}" class="text-white my-2">Terms of Use</a></p>
                        <p style="padding: 5px 0;"><a href="{{url('/about-us')}}" class="text-white my-2">About Us</a></p>
                        <p style="padding: 5px 0;"><a href="{{url('/contact')}}" class="text-white my-2">Contact</a></p>
                        <p style="padding: 5px 0;"><a href="{{url('/archive')}}" class="text-white my-2">Archive</a></p>
                    </div>
                </div>
                <div class="col-md-3 height-250 m-flex-center m-flex-column m-mt-5">
                    <img src="{{ asset(config('appconfig.commonImagePath').'contact-barcode.png') }}"  class="img-responsive" style="max-width: 200px">
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <p>© <?php echo date("Y");?> All Rights Reserved | Dhaka Prokash</p>
                </div>
            </div>
        </div>
    </div>
</footer>
{{--<div id="veta-version">Beta Version</div>--}}
