<footer style="padding-bottom: {{isMobile() ? '50px' : '90px'}};" class="d-print-none">
    <div class="container">
        <div class="footer-top">
            <div class="row">
                <div class="col-md-3 height-250 m-flex-center m-flex-column">
                    <a href="{{ url('/') }}" class="footer-logo">
                        <img src="{{ asset(config('appconfig.commonImagePath').'logo_footer.png') }}" alt="Dhaka Prokash" title="Dhaka Prokash" class="img-responsive" style="max-width: 200px">
                    </a>

                    <div class="footer-address">
                        <p>৯৩, কাজী নজরুল ইসলাম এভিনিউ, (ষষ্ঠ তলা)<br>কারওয়ান বাজার, ঢাকা-১২১৫।</p>
                    </div>

                    <div class="footer-editor invisible">
                        <h6 style="font-weight: normal!important; color: #00427A!important;">প্রধান সম্পাদক ও প্রকাশক</h6>
                        <p style="margin-bottom: 3px!important;"><span style="font-size: 24px; font-weight: bold"> </span></p>
                        <p><span> <a href=""></a></span></p>
                    </div>
                </div>
                <div class="col-md-3 height-250 m-flex-center m-flex-column m-mt-3">
                    <div class="footer-contact">
                        <h6 class="marginTop0" style="font-weight: normal!important; color: #00427A!important;">নিউজরুম</h6>
                        <p>
                            <span style="line-height: 12px"><a href="tel:+8809613331010">+৮৮০ ৯৬১ ৩৩৩ ১০১০</a></span>
                        </p>
                        <p>
                            <span style="line-height: 12px"><a href="mailto:newsroom@dhakaprokash24.com">newsroom@dhakaprokash24.com</a></span>
                        </p>
                        <p>
                            <span style="line-height: 12px"><a href="mailto:literature@dhakaprokash24.com">literature@dhakaprokash24.com</a></span>
                        </p>

                        <div style="margin-top: 25px">
                        <h6 style="margin-top: 20px;font-weight: normal!important; color: #00427A!important;">মার্কেটিং</h6>
                        <p>
                            <span style="line-height: 12px"><a href="tel:+8809613332020">+৮৮০ ৯৬১ ৩৩৩ ২০২০</a></span>
                        </p>
                        <p>
                            <span style="line-height: 12px"> <a href="mailto:marketking@dhakaprokash24.com">marketking@dhakaprokash24.com</a></span>
                        </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 height-250 m-flex-center m-flex-column m-mt-5">
                    <div class="footer-link">
                        <p style="padding: 2px 0;"><a href="{{url('/privacy-policy')}}" class="text-white my-2">গোপনীয়তার নীতি</a></p>
                        <p style="padding: 2px 0;"><a href="{{url('/terms-of-use')}}" class="text-white my-2">ব্যবহারের শর্তাবলি</a></p>
                        <p style="padding: 2px 0;"><a href="{{url('/about-us')}}" class="text-white my-2">আমাদের সম্পর্কে</a></p>
                        <p style="padding: 2px 0;"><a href="{{url('/contact')}}" class="text-white my-2">যোগাযোগ</a></p>
                        <p style="padding: 2px 0;"><a href="{{url('/archive')}}" class="text-white my-2">আর্কাইভ</a></p>
                        <p style="padding: 2px 0;"><a href="{{url('/converter')}}" target="_blank" class="text-white my-2">কনভার্টার</a></p>
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
                    <p>© <?php echo fFormatDateEn2Bn(date("Y"));?> সর্বস্বত্ব সংরক্ষিত | ঢাকাপ্রকাশ</p>
                </div>
            </div>
        </div>
    </div>
</footer>
{{--<div id="veta-version">Beta Version</div>--}}
