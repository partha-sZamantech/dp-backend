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
                    <h3>Terms of Use</h3>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row" style="display: flex; justify-content: center;">
                <div class="page-content col-lg-8 marginTopBottom20">
                    <p>Certain features of the Site may be subject to additional guidelines, terms, or rules, which will be posted on the Site in connection with such features.</p>

                    <p>All such additional terms, guidelines, and rules are incorporated by reference into these Terms.</p>

                    <p>These Terms of Use described the legally binding terms and conditions that oversee your use of the Site. BY LOGGING INTO THE SITE, YOU ARE BEING COMPLIANT THAT THESE TERMS and you represent that you have the authority and capacity to enter into these Terms. YOU SHOULD BE AT LEAST 18 YEARS OF AGE TO ACCESS THE SITE. IF YOU DISAGREE WITH ALL OF THE PROVISION OF THESE TERMS, DO NOT LOG INTO AND/OR USE THE SITE.<p>


                    <h2>Access to the Site</h2>

                    <p><strong>Subject to these Terms.</strong> Company grants you a non-transferable, non-exclusive, revocable, limited license to access the Site solely for your own personal, noncommercial use.</p>

                    <p><strong>Certain Restrictions.</strong> The rights approved to you in these Terms are subject to the following restrictions: (a) you shall not sell, rent, lease, transfer, assign, distribute, host, or otherwise commercially exploit the Site; (b) you shall not change, make derivative works of, disassemble, reverse compile or reverse engineer any part of the Site; (c) you shall not access the Site in order to build a similar or competitive website; and (d) except as expressly stated herein, no part of the Site may be copied, reproduced, distributed, republished, downloaded, displayed, posted or transmitted in any form or by any means unless otherwise indicated, any future release, update, or other addition to functionality of the Site shall be subject to these Terms.  All copyright and other proprietary notices on the Site must be retained on all copies thereof.</p>

                    <p>Company reserves the right to change, suspend, or cease the Site with or without notice to you.  You approved that Company will not be held liable to you or any third-party for any change, interruption, or termination of the Site or any part.</p>

                    <p><strong>No Support or Maintenance.</strong> You agree that Company will have no obligation to provide you with any support in connection with the Site.</p>

                    <p>Excluding any User Content that you may provide, you are aware that all the intellectual property rights, including copyrights, patents, trademarks, and trade secrets, in the Site and its content are owned by Company or Company’s suppliers. Note that these Terms and access to the Site do not give you any rights, title or interest in or to any intellectual property rights, except for the limited access rights expressed in Section 2.1. Company and its suppliers reserve all rights not granted in these Terms.</p>


                    <h2>Third-Party Links & Ads; Other Users</h2>

                    <p><strong>Third-Party Links & Ads.</strong> The Site may contain links to third-party websites and services, and/or display advertisements for third-parties.  Such Third-Party Links & Ads are not under the control of Company, and Company is not responsible for any Third-Party Links & Ads.  Company provides access to these Third-Party Links & Ads only as a convenience to you, and does not review, approve, monitor, endorse, warrant, or make any representations with respect to Third-Party Links & Ads.  You use all Third-Party Links & Ads at your own risk, and should apply a suitable level of caution and discretion in doing so. When you click on any of the Third-Party Links & Ads, the applicable third party’s terms and policies apply, including the third party’s privacy and data gathering practices.</p>

                    <p><strong>Other Users.</strong> Each Site user is solely responsible for any and all of its own User Content.  Because we do not control User Content, you acknowledge and agree that we are not responsible for any User Content, whether provided by you or by others.  You agree that Company will not be responsible for any loss or damage incurred as the result of any such interactions.  If there is a dispute between you and any Site user, we are under no obligation to become involved.</p>

                    <p>You hereby release and forever discharge the Company and our officers, employees, agents, successors, and assigns from, and hereby waive and relinquish, each and every past, present and future dispute, claim, controversy, demand, right, obligation, liability, action and cause of action of every kind and nature, that has arisen or arises directly or indirectly out of, or that relates directly or indirectly to, the Site. If you are a California resident, you hereby waive California civil code section 1542 in connection with the foregoing, which states: "a general release does not extend to claims which the creditor does not know or suspect to exist in his or her favor at the time of executing the release, which if known by him or her must have materially affected his or her settlement with the debtor."</p>

                    <p><strong>Cookies and Web Beacons.</strong> Like any other website, dhakaprokash24.com uses ‘cookies’. These cookies are used to store information including visitors’ preferences, and the pages on the website that the visitor accessed or visited. The information is used to optimize the users’ experience by customizing our web page content based on visitors’ browser type and/or other information.</p>

                    <p><strong>Google DoubleClick DART Cookie.</strong> Google is one of a third-party vendor on our site. It also uses cookies, known as DART cookies, to serve ads to our site visitors based upon their visit to www.website.com and other sites on the internet. However, visitors may choose to decline the use of DART cookies by visiting the Google ad and content network Privacy Policy at the following URL – <a href="https://policies.google.com/technologies/ads">https://policies.google.com/technologies/ads</a></p>

                    <p><strong>Our Advertising Partners.</strong> Some of advertisers on our site may use cookies and web beacons. Our advertising partners are listed below. Each of our advertising partners has their own Privacy Policy for their policies on user data. For easier access, we hyperlinked to their Privacy Policies below.</p>

                    <ul>
                        <li>
                            <p>Google</p>
                            <p><a href="https://policies.google.com/technologies/ads">https://policies.google.com/technologies/ads</a></p>
                        </li>
                    </ul>

                    <h2>Disclaimers</h2>

                    <p>The site is provided on an "as-is" and "as available" basis, and company and our suppliers expressly disclaim any and all warranties and conditions of any kind, whether express, implied, or statutory, including all warranties or conditions of merchantability, fitness for a particular purpose, title, quiet enjoyment, accuracy, or non-infringement.  We and our suppliers make not guarantee that the site will meet your requirements, will be available on an uninterrupted, timely, secure, or error-free basis, or will be accurate, reliable, free of viruses or other harmful code, complete, legal, or safe.  If applicable law requires any warranties with respect to the site, all such warranties are limited in duration to ninety (90) days from the date of first use.</p>

                    <p>Some jurisdictions do not allow the exclusion of implied warranties, so the above exclusion may not apply to you.  Some jurisdictions do not allow limitations on how long an implied warranty lasts, so the above limitation may not apply to you.</p>

                    <h2>Limitation on Liability</h2>

                    <p>To the maximum extent permitted by law, in no event shall company or our suppliers be liable to you or any third-party for any lost profits, lost data, costs of procurement of substitute products, or any indirect, consequential, exemplary, incidental, special or punitive damages arising from or relating to these terms or your use of, or incapability to use the site even if company has been advised of the possibility of such damages.  Access to and use of the site is at your own discretion and risk, and you will be solely responsible for any damage to your device or computer system, or loss of data resulting therefrom.</p>

                    <p>To the maximum extent permitted by law, notwithstanding anything to the contrary contained herein, our liability to you for any damages arising from or related to this agreement, will at all times be limited to a maximum of fifty U.S. dollars (u.s. $50). The existence of more than one claim will not enlarge this limit.  You agree that our suppliers will have no liability of any kind arising from or relating to this agreement.</p>

                    <p>Some jurisdictions do not allow the limitation or exclusion of liability for incidental or consequential damages, so the above limitation or exclusion may not apply to you.</p>

                    <p><strong>Term and Termination.</strong> Subject to this Section, these Terms will remain in full force and effect while you use the Site.  We may suspend or terminate your rights to use the Site at any time for any reason at our sole discretion, including for any use of the Site in violation of these Terms.  Upon termination of your rights under these Terms, your Account and right to access and use the Site will terminate immediately.  You understand that any termination of your Account may involve deletion of your User Content associated with your Account from our live databases.  Company will not have any liability whatsoever to you for any termination of your rights under these Terms.  Even after your rights under these Terms are terminated, the following provisions of these Terms will remain in effect: Sections 2 through 2.5, Section 3 and Sections 4 through 10.</p>

                    <h2>Copyright Policy.</h2>

                    <p>Company respects the intellectual property of others and asks that users of our Site do the same.  In connection with our Site, we have adopted and implemented a policy respecting copyright law that provides for the removal of any infringing materials and for the termination of users of our online Site who are repeated infringers of intellectual property rights, including copyrights.  If you believe that one of our users is, through the use of our Site, unlawfully infringing the copyright(s) in a work, and wish to have the allegedly infringing material removed, the following information in the form of a written notification (pursuant to 17 U.S.C. § 512(c)) must be provided to our designated Copyright Agent:</p>

                    <ul>
                        <li>your physical or electronic signature;</li>
                        <li>identification of the copyrighted work(s) that you claim to have been infringed;</li>
                        <li>identification of the material on our services that you claim is infringing and that you request us to remove;</li>
                        <li>sufficient information to permit us to locate such material;</li>
                        <li>your address, telephone number, and e-mail address;</li>
                        <li>a statement that you have a good faith belief that use of the objectionable material is not authorized by the copyright owner, its agent, or under the law; and</li>
                        <li>a statement that the information in the notification is accurate, and under penalty of perjury, that you are either the owner of the copyright that has allegedly been infringed or that you are authorized to act on behalf of the copyright owner.</li>
                    </ul>

                    <p>Please note that, pursuant to 17 U.S.C. § 512(f), any misrepresentation of material fact in a written notification automatically subjects the complaining party to liability for any damages, costs and attorney’s fees incurred by us in connection with the written notification and allegation of copyright infringement.</p>

                    <h2>General</h2>

                    <p>These Terms are subject to occasional revision, and if we make any substantial changes, we may notify you by sending you an e-mail to the last e-mail address you provided to us and/or by prominently posting notice of the changes on our Site.  You are responsible for providing us with your most current e-mail address.  In the event that the last e-mail address that you have provided us is not valid our dispatch of the e-mail containing such notice will nonetheless constitute effective notice of the changes described in the notice.  Any changes to these Terms will be effective upon the earliest of thirty (30) calendar days following our dispatch of an e-mail notice to you or thirty (30) calendar days following our posting of notice of the changes on our Site.  These changes will be effective immediately for new users of our Site.  Continued use of our Site following notice of such changes shall indicate your acknowledgement of such changes and agreement to be bound by the terms and conditions of such changes.
                        Dispute Resolution. Please read this Arbitration Agreement carefully. It is part of your contract with Company and affects your rights.  It contains procedures for MANDATORY BINDING ARBITRATION AND A CLASS ACTION WAIVER.</p>

                    <p><strong>Applicability of Arbitration Agreement.</strong> All claims and disputes in connection with the Terms or the use of any product or service provided by the Company that cannot be resolved informally or in small claims court shall be resolved by binding arbitration on an individual basis under the terms of this Arbitration Agreement.  Unless otherwise agreed to, all arbitration proceedings shall be held in English.  This Arbitration Agreement applies to you and the Company, and to any subsidiaries, affiliates, agents, employees, predecessors in interest, successors, and assigns, as well as all authorized or unauthorized users or beneficiaries of services or goods provided under the Terms.</p>

                    <p><strong>Notice Requirement and Informal Dispute Resolution.</strong> Before either party may seek arbitration, the party must first send to the other party a written Notice of Dispute describing the nature and basis of the claim or dispute, and the requested relief.  A Notice to the Company should be sent to: 93, Kazi Nazrul Islam Avenue, (6th Floor) Karwan Bazar, Dhaka-1215. After the Notice is received, you and the Company may attempt to resolve the claim or dispute informally.  If you and the Company do not resolve the claim or dispute within thirty (30) days after the Notice is received, either party may begin an arbitration proceeding.  The amount of any settlement offer made by any party may not be disclosed to the arbitrator until after the arbitrator has determined the amount of the award to which either party is entitled.</p>

                    <p><strong>Arbitration Rules.</strong> Arbitration shall be initiated through the American Arbitration Association, an established alternative dispute resolution provider that offers arbitration as set forth in this section.  If AAA is not available to arbitrate, the parties shall agree to select an alternative ADR Provider.  The rules of the ADR Provider shall govern all aspects of the arbitration except to the extent such rules are in conflict with the Terms.  The AAA Consumer Arbitration Rules governing the arbitration are available online at adr.org or by calling the AAA at 1-800-778-7879.  The arbitration shall be conducted by a single, neutral arbitrator.  Any claims or disputes where the total amount of the award sought is less than Ten Thousand U.S. Dollars (US $10,000.00) may be resolved through binding non-appearance-based arbitration, at the option of the party seeking relief.  For claims or disputes where the total amount of the award sought is Ten Thousand U.S. Dollars (US $10,000.00) or more, the right to a hearing will be determined by the Arbitration Rules.  Any hearing will be held in a location within 100 miles of your residence, unless you reside outside of the United States, and unless the parties agree otherwise.  If you reside outside of the U.S., the arbitrator shall give the parties reasonable notice of the date, time and place of any oral hearings. Any judgment on the award rendered by the arbitrator may be entered in any court of competent jurisdiction.  If the arbitrator grants you an award that is greater than the last settlement offer that the Company made to you prior to the initiation of arbitration, the Company will pay you the greater of the award or $2,500.00.  Each party shall bear its own costs and disbursements arising out of the arbitration and shall pay an equal share of the fees and costs of the ADR Provider.</p>

                    <p><strong>Additional Rules for Non-Appearance Based Arbitration.</strong> If non-appearance based arbitration is elected, the arbitration shall be conducted by telephone, online and/or based solely on written submissions; the specific manner shall be chosen by the party initiating the arbitration.  The arbitration shall not involve any personal appearance by the parties or witnesses unless otherwise agreed by the parties.</p>

                    <p><strong>Time Limits.</strong> If you or the Company pursues arbitration, the arbitration action must be initiated and/or demanded within the statute of limitations and within any deadline imposed under the AAA Rules for the pertinent claim.</p>

                    <p><strong>Authority of Arbitrator.</strong> If arbitration is initiated, the arbitrator will decide the rights and liabilities of you and the Company, and the dispute will not be consolidated with any other matters or joined with any other cases or parties.  The arbitrator shall have the authority to grant motions dispositive of all or part of any claim.  The arbitrator shall have the authority to award monetary damages, and to grant any non-monetary remedy or relief available to an individual under applicable law, the AAA Rules, and the Terms.  The arbitrator shall issue a written award and statement of decision describing the essential findings and conclusions on which the award is based.  The arbitrator has the same authority to award relief on an individual basis that a judge in a court of law would have.  The award of the arbitrator is final and binding upon you and the Company.</p>

                    <p><strong>Waiver of Jury Trial.</strong> THE PARTIES HEREBY WAIVE THEIR CONSTITUTIONAL AND STATUTORY RIGHTS TO GO TO COURT AND HAVE A TRIAL IN FRONT OF A JUDGE OR A JURY, instead electing that all claims and disputes shall be resolved by arbitration under this Arbitration Agreement.  Arbitration procedures are typically more limited, more efficient and less expensive than rules applicable in a court and are subject to very limited review by a court.  In the event any litigation should arise between you and the Company in any state or federal court in a suit to vacate or enforce an arbitration award or otherwise, YOU AND THE COMPANY WAIVE ALL RIGHTS TO A JURY TRIAL, instead electing that the dispute be resolved by a judge.</p>

                    <p><strong>Waiver of Class or Consolidated Actions.</strong> All claims and disputes within the scope of this arbitration agreement must be arbitrated or litigated on an individual basis and not on a class basis, and claims of more than one customer or user cannot be arbitrated or litigated jointly or consolidated with those of any other customer or user.</p>

                    <p><strong>Confidentiality.</strong> All aspects of the arbitration proceeding shall be strictly confidential.  The parties agree to maintain confidentiality unless otherwise required by law.  This paragraph shall not prevent a party from submitting to a court of law any information necessary to enforce this Agreement, to enforce an arbitration award, or to seek injunctive or equitable relief.</p>

                    <p><strong>Severability.</strong> If any part or parts of this Arbitration Agreement are found under the law to be invalid or unenforceable by a court of competent jurisdiction, then such specific part or parts shall be of no force and effect and shall be severed and the remainder of the Agreement shall continue in full force and effect.</p>

                    <p><strong>Right to Waive.</strong> Any or all of the rights and limitations set forth in this Arbitration Agreement may be waived by the party against whom the claim is asserted.  Such waiver shall not waive or affect any other portion of this Arbitration Agreement.</p>

                    <p><strong>Survival of Agreement.</strong> This Arbitration Agreement will survive the termination of your relationship with Company.</p>

                    <p><strong>Small Claims Court.</strong> Nonetheless the foregoing, either you or the Company may bring an individual action in small claims court.</p>

                    <p><strong>Emergency Equitable Relief.</strong> Anyhow the foregoing, either party may seek emergency equitable relief before a state or federal court in order to maintain the status quo pending arbitration.  A request for interim measures shall not be deemed a waiver of any other rights or obligations under this Arbitration Agreement.</p>

                    <p><strong>Claims Not Subject to Arbitration.</strong> Notwithstanding the foregoing, claims of defamation, violation of the Computer Fraud and Abuse Act, and infringement or misappropriation of the other party’s patent, copyright, trademark or trade secrets shall not be subject to this Arbitration Agreement.</p>

                    <p>In any circumstances where the foregoing Arbitration Agreement permits the parties to litigate in court, the parties hereby agree to submit to the personal jurisdiction of the courts located within Netherlands County, California, for such purposes.</p>

                    <p>The Site may be subject to U.S. export control laws and may be subject to export or import regulations in other countries. You agree not to export, re-export, or transfer, directly or indirectly, any U.S. technical data acquired from Company, or any products utilizing such data, in violation of the United States export laws or regulations.</p>

                    <p>Company is located at the address in Section 10.8. If you are a California resident, you may report complaints to the Complaint Assistance Unit of the Division of Consumer Product of the California Department of Consumer Affairs by contacting them in writing at 400 R Street, Sacramento, CA 95814, or by telephone at (800) 952-5210.</p>

                    <p><strong>Electronic Communications.</strong> The communications between you and Company use electronic means, whether you use the Site or send us emails, or whether Company posts notices on the Site or communicates with you via email. For contractual purposes, you (a) consent to receive communications from Company in an electronic form; and (b) agree that all terms and conditions, agreements, notices, disclosures, and other communications that Company provides to you electronically satisfy any legal obligation that such communications would satisfy if it were be in a hard copy writing.</p>

                    <p><strong>Entire Terms.</strong> These Terms constitute the entire agreement between you and us regarding the use of the Site. Our failure to exercise or enforce any right or provision of these Terms shall not operate as a waiver of such right or provision. The section titles in these Terms are for convenience only and have no legal or contractual effect. The word "including" means "including without limitation". If any provision of these Terms is held to be invalid or unenforceable, the other provisions of these Terms will be unimpaired and the invalid or unenforceable provision will be deemed modified so that it is valid and enforceable to the maximum extent permitted by law.  Your relationship to Company is that of an independent contractor, and neither party is an agent or partner of the other.  These Terms, and your rights and obligations herein, may not be assigned, subcontracted, delegated, or otherwise transferred by you without Company’s prior written consent, and any attempted assignment, subcontract, delegation, or transfer in violation of the foregoing will be null and void.  Company may freely assign these Terms.  The terms and conditions set forth in these Terms shall be binding upon assignees.</p>

                    <p><strong>Your Privacy.</strong> Please read our Privacy Policy.</p>

                    <p><strong>Copyright/Trademark Information.</strong> Copyright ©. All rights reserved.  All trademarks, logos and service marks displayed on the Site are our property or the property of other third-parties. You are not permitted to use these Marks without our prior written consent or the consent of such third party which may own the Marks.</p>

                    <h2>Contact Information</h2>

                    <p>Address: 93, Kazi Nazrul Islam Avenue, (6th Floor) Karwan Bazar, Dhaka-1215</p>
                    <p>Email: info@dhakaprokash24.com</p>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
