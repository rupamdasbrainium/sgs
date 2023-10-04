<x-guest-layout>
    @php
        $lang_id = getLocale();
    @endphp
    @section('title', $data['title'] . ' |')
    @include('header')
    <div class="banner_outer inner_banner">
        <div class="banner_slider">
            <div class="banner_panel">
                <div class="banner_img">
                    <img src="{{ asset('public/images/terms_conditions.png') }}" alt="">
                </div>
                <div class="banner_cont">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- <div class="banner_info">
                                    <h1>Elevate Your <span>Fitness,</span></h1>
                                    <h2>Ignite Your Potential!</h2>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="banner_outer_shape">
        </div>
    </div>
    <section class="maincontent_wrap innermain_content user_information">
        <div class="welcomesection def_padding inner_content_block">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="inner_def_cont">
                            <div class="welcomesec_info inner_heading">
                                <div class="round_opt_btn3">
                                    <img src="images/roundopt2.jpg" alt="">
                                </div>						
                                <h2>Privacy Policy</h2>
                                <p>Effective Date: [Date]</p>
                            </div>
                            <h3>1. Acceptance of Terms</h3>
                            <p>Welcome to SGS! By accessing or using our web app, you agree to be bound by these Terms of Service and Use ("Terms"). If you do not agree with these Terms, please do not use our web app.</p>
                            <h3>2. Description of Service</h3>
                            <p>SGS is an online platform that provides gym membership services, including class schedules, personal trainer bookings, and fitness tracking tools.</p>
                            <h3>3. Eligibility</h3>
                            <p>You must be at least 18 years old to use our web app. By using the web app, you represent and warrant that you are 18 years or older and have the legal capacity to enter these Terms.</p>
    
                            <h3>4. User Accounts</h3>
                            <p>To access certain features of the web app, you may need to create a user account. You are responsible for maintaining the confidentiality of your account credentials and for all activities that occur under your account. Notify us immediately of any unauthorized use or security breach of your account.</p>
    
                            <h3>5. Payment and Billing</h3>
                            <p>Our web app offers various membership plans and services. By subscribing to a plan, you agree to pay the applicable fees and charges. Payments are processed securely through our third-party payment processor. You are responsible for providing accurate billing information and maintaining a valid payment method. We may update our fees and billing methods from time to time.</p>
    
                            <h3>6. Use of the Web App</h3>
                            <p>You may use our web app for personal, non-commercial purposes only. You agree not to use the web app for any illegal or unauthorized purpose and to comply with all applicable laws and regulations.</p>
    
                            <h3>7. User Content</h3>
                            <p>You retain ownership of any content you submit to our web app, such as fitness goals, progress photos, and comments ("User Content"). By submitting User Content, you grant us a non-exclusive, worldwide, royalty-free license to use, reproduce, modify, and display the content for the purpose of providing our services.</p>
    
                            <h3>7. User Content</h3>
                            <p>You retain ownership of any content you submit to our web app, such as fitness goals, progress photos, and comments ("User Content"). By submitting User Content, you grant us a non-exclusive, worldwide, royalty-free license to use, reproduce, modify, and display the content for the purpose of providing our services.</p>
    
    
                            <h3>8. Prohibited Conduct</h3>
                            <p>You agree not to:</p>
                            <ol class="caplater_opt" type="a">
                            <li>Use the web app in any manner that violates these Terms or infringes on the rights of others.</li>
                            <li>Attempt to gain unauthorized access to the web app or any account not belonging to you.</li>
                            <li>Interfere with the security or integrity of the web app or its users' data.</li>
                            <li>Upload or distribute any harmful or malicious software or content.</li>
                            <li>Use the web app to promote or engage in spam, scams, or fraudulent activities.</li>
                            </ol>
    
                            <h3>9. Intellectual Property</h3>
                            <p>All intellectual property rights related to our web app, including trademarks, logos, and content, are owned by us or our licensors. You may not use or reproduce our intellectual property without our prior written consent.</p>
    
                            <h3>10. Limitation of Liability</h3>
                            <p>To the extent permitted by law, we shall not be liable for any direct, indirect, incidental, special, or consequential damages arising from the use of our web app or the inability to access it.</p>
    
    
                            <h3>11. Indemnification</h3>
                            <p>You agree to indemnify and hold us harmless from any claims, losses, damages, liabilities, and expenses arising out of your use of the web app or your violation of these Terms.</p>
    
    
                            <h3>12. Modifications to the Terms</h3>
                            <p>We reserve the right to update or modify these Terms at any time. If we make material changes, we will notify you by email or through the web app. Continued use of the web app after the changes will constitute your acceptance of the revised Terms.</p>
    
    
                            <h3>13. Termination</h3>
                            <p>We may terminate or suspend your access to the web app at any time, with or without cause, and without notice.</p>
    
                            <h3>14. Governing Law</h3>
                            <p>These Terms shall be governed by and construed in accordance with the laws of Canada.</p>
                            <h3>15. Contact Us</h3>
                            <p>If you have any questions or concerns about these Terms or our web app, please contact us at [Your Contact Email].</p>
                            <p>By clicking "<span>I Agree</span>" or by using our web app, you acknowledge that you have read and understood these Terms and agree to be bound by them.</p>
    
    
                        </div>
                    
                        
                    </div>
                </div>
            </div>
            
    
        </div>
    
        <div class="round_opt_btn rount_opt2">
            <img src="images/roundopt2.jpg" alt="">
        </div>
        <div class="round_opt_btn rount_opt3">
            <img src="images/roundopt2.jpg" alt="">
        </div>
    <!-- 	
        <div class="round_opt_btn">
            <img src="images/roundopt2.jpg" alt="">
        </div> -->
    
    </section>
    @include('footer')
</x-guest-layout>

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#franchise_name").on('change', function() {
                alert("The text has been changed.");
            });
            $.ajax({
                type: "POST",
                url: searchURI,
                dataType: "json",
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                    query: request.term,
                    date_range: $("#departure_date").val(),
                },
                success: function(data) {
                    if (!data.length) {
                        var result = [{
                            label: noMatch,
                            value: response.term,
                        }, ];
                        response(result);
                    } else {
                        response(data);
                    }
                },
            });
        })
    </script>
    <style>
        select.select_opts {
            border: 0px !important;
            outline: 0px !important;
            box-shadow: 0px 0px 0px transparent !important;
        }

        select.select_opts {
            width: 100%;
            border: 0px;
            padding: 15px;
            background: #ddf8f1;
            border-radius: 10px 10px 10px 0;
            appearance: none;
        }
    </style>
@endpush
