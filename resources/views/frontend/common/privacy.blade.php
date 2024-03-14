@extends('frontend.bn.app')

@section('custom-css')
    <style>
        .breadcrumb {
            margin: 0 !important;
        }

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
    </style>
@endsection

@section('mainContent')
    <div class="main-content" style="margin-top: 0;">
        <div class="subheader typography">
            <div class="row">
                <div class="small-12 columns">
                    <h3>Privacy Policy</h3>
                    <p class="text-center">Learn more about how we use and store your personal information.</p>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row" style="display: flex; justify-content: center;">
                <div class="page-content col-lg-8 marginTopBottom20">
                    <p>DhakaProkash24.com is committed to protecting your personal information when you are
                        using any of the websites or applications from DhakaProkash24.com. This Privacy Policy relates to use of
                        any personal information that it collects from visitors/readers via following, among other,
                        services:</p>
                    <ul>
                        <li>any DhakaProkash24.com website that links to this privacy policy;</li>
                        <li>social media or official DhakaProkash24.com content on other websites;</li>
                        <li>mobile and web applications (“Apps”)</li>
                    </ul>
                    <p>In all the above services, the “Privacy Policy” shall apply only when the
                        application, website or contents therein are truly &amp; genuinely generated by DhakaProkash24.com.
                        Provided that, no application, website or contents therein are generated or presented at any false
                        or fake website, page or group in the name( or with false logo) of Dhaka Prokash, won’t get this
                        protection.</p>
                    <p>DhakaProkash24.com collects or receives information about its users for many
                        purposes; for instance, to provide services designed to serve the user, to monitor and improve the
                        services offerings, for marketing or targeting advertisement etc. Such information may include your
                        name, address, phone number, email address, age, social network account etc. (“the
                        Information”).</p>
                    <p>There may be other privacy policies that apply to certain services provided by
                        DhakaProkash24.com. Visitors are requested to read these while registering or subscribing to these services
                        on these sites. DhakaProkash24.com respects the privacy of its visitors/readers and makes use of its best
                        effort to ensure that the information collected is used for the limited purpose for which it was
                        received.</p>
                    <h3>Special Precaution</h3>
                    <p>
                        There lies, in the name of DhakaProkash24.com/প্রথম আলো’, multiple fake websites and facebook pages and
                        unauthorized/ unwanted facebook groups in online. DhakaProkash24.com shall hold no responsibility for any
                        content generated, published or shared in those fake websites, unauthorized pages &amp; groups in
                        social media.
                    </p>
                    <h3>How DhakaProkash24.com collects the information</h3>
                    <p>DhakaProkash24.com collects the information on a user upon the user’s access to the
                        DhakaProkash24.com website – (i) by registering to the site or Apps, (ii) subscribing to the newsletter,
                        (iii) responding to a survey or participating in a competition, (iv) logging-in to a site or page,
                        etc.</p>
                    <h3>Disclosure of Information Collected</h3>
                    <p>DhakaProkash24.com does not sell, trade or otherwise provide personally identifiable
                        information to any other parties except for those that assist DhakaProkash24.com in operating its website,
                        conducting the business and serving the users. It may share visitor’s/reader’s personal information
                        internally to understand the user base, promote the number of users and increase user
                        engagement.</p>
                    <p>In the event that DhakaProkash24.com desires to use personal information in a
                        different way than that described above it shall seek consent of the individual. DhakaProkash24.com may
                        release personally identifiable information if it is required to comply with the laws of
                        Bangladesh.</p>
                    <p>Notwithstanding anything contained in this Privacy Policy, DhakaProkash24.com may
                        disclose or share information collected including personal information to service providers,
                        affiliate companies, consultants or advisors or Partners that it has engaged to perform business
                        related functions on its behalf. DhakaProkash24.com may also share the information in response to legal
                        process, or protect its interest in any forum. The information may be used for investigating or
                        preventing potentially illegal activities, or situations involving potential threats to any person,
                        us, or the services, or violations of our policies, the law or our “Terms of Use” as well as to
                        verify or enforce compliance with the policies governing our Services. The information may as well
                        be shared to offer market products or services to the visitors/readers. However, in all these events
                        or any other event when a personal information is shared or disclosed, DhakaProkash24.com shall use its
                        best endeavors to control the share or disclosure and shall only share to such extent as it is
                        required to meet the purpose.</p>
                    <h3>Data Retention</h3>
                    <p>We shall hold visitors/readers personal information if your account exists
                        with DhakaProkash24.com. Notwithstanding, DhakaProkash24.com may retain data for a further period as per its own
                        internal data retention policy. Visitor’s/reader’s personal information shall be deleted upon expiry
                        of your DhakaProkash24.com account. Please note that there may be events when the erasing/deleting of
                        information may take more time than usual, and DhakaProkash24.com shall not hold any responsibility in such
                        events.</p>
                    <h3>Advertisement</h3>
                    <p>The advertisements included in the DhakaProkash24.com website and Apps, are by
                        third-party companies &amp; ad networks through independent ad tags, which may collect information
                        about users for which DhakaProkash24.com shall bear no responsibility that may arise as a result of
                        collecting and/or sharing the information with any other party.</p>
                    <p>DhakaProkash24.com shall not accept any liability that may arise as a result of any
                        content of any advertisement that may appear on the DhakaProkash24.com website.</p>
                    <h3>Third Party Advertisements and links</h3>
                    <p>At the discretion of DhakaProkash24.com, the website or application may display or
                        allow advertisements of third party services or products. These third-party sites may have separate
                        and independent privacy policies. DhakaProkash24.com accepts no responsibility or liability for the content
                        of advertising material, including, without limitation, any error, omission or inaccuracy
                        therein..</p>
                    <p>DhakaProkash24.com does not hold any responsibility for information leakage due to
                        the visitor/reader accessing a separate link, application or website, whether through a link in the
                        website or contents of DhakaProkash24.com.</p>
                    <h3>Use of Cookies</h3>
                    <p>DhakaProkash24.com does not collect any user data based on cookies, nor does it store
                        any sort of user information that may be personal to the user.</p>
                    <p>If a third party associated with the DhakaProkash24.com website collects user cookies
                        upon your visit to the DhakaProkash24.com website, DhakaProkash24.com does not control the use of these cookies
                        therefore you should check the relevant third-party website.</p>
                    <h3>Demographic and purchase information:</h3>
                    <p>We may reference other sources of demographic and other information to provide
                        you with more targeted communications and promotions. We use Google Analytics, among others, to
                        track the user behavior on our website. You can opt-out of Google Analytics for Display Advertising
                        and customize Google Display Network ads using the Ads Settings options provided by Google.</p>
                    <h3>Communication by DhakaProkash24.com</h3>
                    <p>From time to time, DhakaProkash24.com may contact its users via e-mail, phone or SMS
                        for invitation for participation in campaigns/competitions organized by DhakaProkash24.com, feedback,
                        survey etc, based on the information it has received from the users.</p>
                    <h3>Accessing the website from outside Bangladesh</h3>
                    <p>All personal information submitted by users outside Bangladesh will be
                        processed in accordance with these
                        <a href="https://dhakaprokash24.com/terms-of-use" target="_blank" rel="noopener noreferrer"> Terms of use </a>
                        and “Privacy Policy”.</p>
                    <h3>Governing Law</h3>
                    <p>The laws that govern “Privacy Policy” of DhakaProkash24.com and its relationship with
                        the user is the laws of Bangladesh and any dispute regarding the use, retention, disclosure, leakage
                        or dissemination of the information or date can only be raised before the courts of Bangladesh which
                        shall have exclusive jurisdiction on this matter. The entire “Privacy Policy” shall apply to all who
                        enter the website, receive service or use an application from DhakaProkash24.com regardless of their
                        nationality, location, residence or place of business.</p>
                    <h3>Modification of Privacy Policy</h3>
                    <p>DhakaProkash24.com reserves the right to amend, modify, alter, or omit any terms in
                        the “Privacy Policy” at any time but the changed policy shall be immediately uploaded or updated in
                        the website. By continuing to use our services after any changes are made, you accept those changes
                        and will be bound by them. We encourage you to periodically check back and review this policy so
                        that visitors/readers will always know what information we collect, how we use it, and with whom we
                        share it.</p>
                    <h3>Opt-out</h3>
                    <p>If, at any time, the users prefer not to receive email containing marketing
                        information from us, then the user can simply follow the unsubscribe options at the bottom of each
                        email.</p>
                    <p>If the users no longer wish to have a registered account, the user may
                        terminate the account by sending an email to info@dhakaprokash24.com.</p>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
