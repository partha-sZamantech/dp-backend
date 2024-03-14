@extends('frontend.bn.app')

@section('custom-css')
    <style>
        .subheader.typography {
            padding: 50px 0;
            background: url('data:image/png;base64,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'), #0c3568;
        }

        .typography {
            padding: 50px 0;
        }

        .subheader {
            position: relative;
            padding: 0;
            margin: 0;
            min-height: 200px;
        }

        .subheader {
            margin-top: .2rem;
            margin-bottom: .5rem;
            font-weight: 400;
            line-height: 1.4;
            color: #8a8a8a;
        }

        .subheader.typography h3 {
            margin-bottom: 25px;
        }

        .subheader.typography p {
            color: #F0F0EE;
        }

        .subheader h3 {
            font-size: 33px;
            font-weight: 800;
            color: #fff;
            text-align: center;
        }

        .page-content {
            font-size: 17px;
        }

        .contant-section-page {
            padding: 30px 0;
            border-bottom: 1px solid #222227;
        }

        .contant-section-page .contact-element-wrapper h3, .contant-section-page .contact-element-wrapper .icon, .contant-section-page .contact-element-wrapper p, .contant-section-page .contact-element-wrapper a {
            -webkit-transition: all .3s cubic-bezier(.645, .045, .355, 1);
            transition: all .3s cubic-bezier(.645, .045, .355, 1);
        }

        .content p a {
            font-size: 18px !important;
        }

        .content p {
            color: black;
        }

        .iframe-contact {
            padding: 30px 0;
            /*background: #0B3364;*/
            border-bottom: 1px solid #222227;
        }

        .iframe-contact h3 {
            font-size: 32px;
            line-height: 44px;
            font-weight: 500;
            color: black;
            margin-top: 15px;
            margin-bottom: 20px;
        }

        .marginTop40 {
            margin-top: 40px!important;
        }

        .contact-icon {
            margin-right: 4px!important;
            color: #0B3364;
        }

        @media (max-width: 1000px) {
            .contant-section-page .contact-element-wrapper {
                margin-bottom: 30px;
            }

            .contant-section-page {
                padding: 25px 0;
            }
        }
    </style>
@endsection

@section('mainContent')
    <div class="main-content" style="margin-top: 0;">
        <div class="subheader typography">
            <div class="row">
                <div class="small-12 columns">
                    <h3>Contact Us</h3>
                    <p class="text-center">Thanks for reaching out. We appreciate your opinion.</p>
                </div>
            </div>
        </div>
        <div class="contant-section-page">
            <div class="container">

                <div class="row" style="display: flex; justify-content: center;">
                    <div class="page-content col-lg-10 marginTopBottom20 justify-content-center">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-4">
                                <div class="content">
                                    <h3 class="marginTop0">Newsroom</h3>
                                    <p>
                                        <span>
                                            <i class="fa fa-phone contact-icon"></i>
                                            <a href="tel:+8809613331010">+880 961 333 1010</a>
                                        </span>
                                    </p>
                                    <p>
                                        <span>
                                            <i class="fa fa-envelope contact-icon"></i>
                                            <a href="mailto:news@dhakaprokash24.com">news@dhakaprokash.com</a>
                                        </span>
                                    </p>
                                    <p>
                                        <span>
                                            <i class="fa fa-envelope contact-icon"></i>
                                            <a href="mailto:literature@dhakaprokash24.com">literature@dhakaprokash.com</a>
                                        </span>
                                    </p>
                                </div>
                                <div class="content marginTop40">
                                    <h3 class="">Marketing</h3>
                                    <p>
                                        <span>
                                            <i class="fa fa-phone contact-icon"></i>
                                            <a href="tel:+8809613331010">+880 961 333 2020</a>
                                        </span>
                                    </p>
                                    <p>
                                        <span>
                                            <i class="fa fa-envelope contact-icon"></i>
                                            <a href="mailto:marketing@dhakaprokash24.com">marketing@dhakaprokash24.com</a>
                                        </span>
                                    </p>
                                </div>
                                <div class="content marginTop40">
                                    <h3 class="marginTop0">Contact </h3>
                                    <div class="footer-address">
                                        <p>93, Kazi Nazrul Islam Avenue, (5th Floor)<br>Karwan Bazar, Dhaka-1215</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="iframe-contact">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p>
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.7939334926746!2d90.38950151438847!3d23.754726694529264!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b958fd49ffbd%3A0x9c54cbb11ea61300!2sdhaka%20prokash!5e0!3m2!1sen!2sbd!4v1653985963848!5m2!1sen!2sbd"
                                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
