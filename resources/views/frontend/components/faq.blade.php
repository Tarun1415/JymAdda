<section class="faq-section bg-white" style="padding: 100px 0;">
    <div class="container">
        <div class="row align-items-start">
            
            <!-- Left Side: Text & Button -->
            <div class="col-lg-4 mb-5 mb-lg-0 pe-lg-4" data-aos="fade-right">
                <h2 class="font-weight-bold text-dark mb-3" style="font-size: 40px; font-weight: 800; letter-spacing: -0.5px; line-height: 1.2;">
                    Frequently Asked Questions
                </h2>
                <p class="text-dark mb-4" style="font-size: 15px; line-height: 1.7;">
                    Get answers to common questions about our gym memberships, facilities, and services. Can't find what you're looking for? Contact our team for more help.
                </p>
                <a href="/contact" class="btn text-white fw-medium px-4 py-2" style="background-color: #f9952d; border-radius: 6px; font-size: 15px; box-shadow: 0 4px 6px rgba(249, 149, 45, 0.2);">
                    View All FAQs
                </a>
            </div>

            <!-- Right Side: Accordion -->
            <div class="col-lg-8" data-aos="fade-left" data-aos-delay="100">
                <div class="accordion premium-faq" id="faqAccordion">
                    
                    <!-- Item 1 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq-heading-1">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-1" aria-expanded="false" aria-controls="faq-collapse-1">
                                Is my personal data safe on GymHai?
                            </button>
                        </h2>
                        <div id="faq-collapse-1" class="accordion-collapse collapse" aria-labelledby="faq-heading-1" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Yes, absolutely. We use industry-standard encryption to protect your personal information and ensure your data remains secure and confidential.
                            </div>
                        </div>
                    </div>

                    <!-- Item 2 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq-heading-2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-2" aria-expanded="false" aria-controls="faq-collapse-2">
                                How do I contact GymHai support?
                            </button>
                        </h2>
                        <div id="faq-collapse-2" class="accordion-collapse collapse" aria-labelledby="faq-heading-2" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                You can contact our support team anytime through the 'Contact Us' page on our website or by emailing support@gymhai.online.
                            </div>
                        </div>
                    </div>

                    <!-- Item 3 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq-heading-3">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-3" aria-expanded="false" aria-controls="faq-collapse-3">
                                Does GymHai provide personal training programs?
                            </button>
                        </h2>
                        <div id="faq-collapse-3" class="accordion-collapse collapse" aria-labelledby="faq-heading-3" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                While we don't provide trainers directly, our platform features a dedicated 'For Trainers' section where you can find and connect with independent personal trainers in your area.
                            </div>
                        </div>
                    </div>

                    <!-- Item 4 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq-heading-4">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-4" aria-expanded="false" aria-controls="faq-collapse-4">
                                What if I face issues with a gym or trainer I found on GymHai?
                            </button>
                        </h2>
                        <div id="faq-collapse-4" class="accordion-collapse collapse" aria-labelledby="faq-heading-4" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                If you face any issues, please report them to our support team. We take community feedback seriously and will investigate to ensure the quality of our network.
                            </div>
                        </div>
                    </div>

                    <!-- Item 5 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq-heading-5">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-5" aria-expanded="false" aria-controls="faq-collapse-5">
                                Can I cancel or reschedule my booking?
                            </button>
                        </h2>
                        <div id="faq-collapse-5" class="accordion-collapse collapse" aria-labelledby="faq-heading-5" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Cancellation and rescheduling policies depend entirely on the individual gym or trainer you booked with. Please reach out to them directly.
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Premium FAQ Split Design Styles */
    .premium-faq .accordion-item {
        background-color: #ffffff;
        border: 1px solid #f9ba7b !important; /* Soft orange border matching screenshot */
        border-radius: 8px !important;
        margin-bottom: 14px;
        overflow: hidden;
    }

    .premium-faq .accordion-button {
        background-color: #ffffff;
        color: #334155;
        font-weight: 400;
        font-size: 16px;
        padding: 16px 24px;
        box-shadow: none !important;
        border-radius: 8px !important;
    }

    /* Change arrow to +/- */
    .premium-faq .accordion-button::after {
        background-image: none !important;
        content: '+';
        font-size: 26px;
        font-weight: 500;
        color: #0f172a;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.3s ease;
    }
    
    .premium-faq .accordion-button:not(.collapsed)::after {
        content: '-';
        transform: none;
    }

    .premium-faq .accordion-button:not(.collapsed) {
        background-color: #fff;
        color: #0f172a;
        font-weight: 500;
        border-bottom-left-radius: 0 !important;
        border-bottom-right-radius: 0 !important;
    }

    .premium-faq .accordion-body {
        background-color: #fff;
        padding: 0 24px 20px 24px;
        color: #475569;
        font-size: 15px;
        line-height: 1.6;
        border-top: none;
    }
</style>
