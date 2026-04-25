<!-- Custom Premium Footer for GymHai -->
<style>
    .site-footer {
        background: #0f172a;
        /* Dark Navy Blue */
        color: #94a3b8;
        padding: 80px 0 30px;
        font-size: 15px;
        position: relative;
        overflow: hidden;
    }

    .site-footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #4f46e5, #ec4899);
    }

    .footer-brand {
        margin-bottom: 24px;
    }

    .footer-logo {
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
        margin-bottom: 16px;
    }

    .footer-logo img {
        height: 40px;
        border-radius: 8px;
    }

    .footer-logo-text {
        font-size: 24px;
        font-weight: 800;
        color: #fff;
        line-height: 1;
    }

    .footer-desc {
        color: #cbd5e1;
        line-height: 1.6;
        margin-bottom: 24px;
        max-width: 320px;
    }

    .footer-widget h3 {
        color: #fff;
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 24px;
        position: relative;
        padding-bottom: 12px;
    }

    .footer-widget h3::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 40px;
        height: 2px;
        background: #4f46e5;
    }

    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-links li {
        margin-bottom: 12px;
    }

    .footer-links a {
        color: #94a3b8;
        text-decoration: none;
        transition: all 0.2s ease;
        display: inline-block;
    }

    .footer-links a:hover {
        color: #fff;
        transform: translateX(5px);
    }

    .footer-contact {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-contact li {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 16px;
        color: #cbd5e1;
    }

    .footer-contact svg {
        color: #4f46e5;
        flex-shrink: 0;
        margin-top: 3px;
    }

    .footer-contact a {
        color: #cbd5e1;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .footer-contact a:hover {
        color: #fff;
    }

    .footer-socials {
        display: flex;
        gap: 12px;
    }

    .social-btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.05);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .social-btn:hover {
        background: #4f46e5;
        transform: translateY(-3px);
    }

    .footer-bottom {
        margin-top: 60px;
        padding-top: 24px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
    }

    .copyright-text {
        margin: 0;
        color: #64748b;
    }

    .legal-links {
        display: flex;
        gap: 24px;
    }

    .legal-links a {
        color: #64748b;
        text-decoration: none;
        font-size: 14px;
        transition: color 0.2s;
    }

    .legal-links a:hover {
        color: #fff;
    }

    @media (max-width: 991px) {
        .footer-widget {
            margin-top: 40px;
        }
    }

    @media (max-width: 768px) {
        .footer-bottom {
            flex-direction: column;
            text-align: center;
        }
    }
</style>

<footer class="site-footer">
    <div class="container">
        <div class="row">
            <!-- Brand Column -->
            <div class="col-lg-4 col-md-6">
                <div class="footer-brand">
                    <a href="{{ url('/') }}" class="footer-logo">
                        <img src="{{ asset('images/logo21.png') }}" alt="Logo"
                            onerror="this.src='{{ asset('images/logo.png') }}';">

                    </a>
                    <p class="footer-desc">
                        Empowering fitness enthusiasts to find the perfect gym, and building smart CRM tools for Gym
                        owners to automate their business.
                    </p>
                    <div class="footer-socials">
                        <a href="#" class="social-btn" title="Facebook">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                fill="currentColor" stroke="none">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                            </svg>
                        </a>
                        <a href="#" class="social-btn" title="Instagram">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                            </svg>
                        </a>
                        <a href="#" class="social-btn" title="Twitter">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path
                                    d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6">
                <div class="footer-widget">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ route('gyms.index') }}">Explore Gyms</a></li>
                        <li><a href="{{ route('services') }}">Our Services</a></li>
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('contact') }}">Contact Support</a></li>
                    </ul>
                </div>
            </div>

            <!-- Partners Area -->
            <div class="col-lg-3 col-md-6">
                <div class="footer-widget">
                    <h3>For Gym Owners</h3>
                    <ul class="footer-links">
                        <li><a href="/partner/register">List Your Gym</a></li>
                        <li><a href="/partner/login">Partner Login</a></li>
                        {{-- <li><a href="#">Pricing & Plans</a></li>
                        <li><a href="#">CRM Documentation</a></li> --}}
                    </ul>
                </div>
            </div>

            <!-- Contact Detils -->
            <div class="col-lg-3 col-md-6">
                <div class="footer-widget">
                    <h3>Get In Touch</h3>
                    <ul class="footer-contact">
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            <span>B-104, Sec-63, Noida<br>Uttar Pradesh 201301</span>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path
                                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                </path>
                            </svg>
                            <a href="tel:+919876543210">+91 98765 43210</a>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                </path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                            <a href="mailto:support@GymHai.com">support@GymHai.com</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <p class="copyright-text">
                &copy; {{ date('Y') }} GymHai Platform. All Rights Reserved.
            </p>
            <div class="legal-links">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms & Conditions</a>
                <a href="#">Refund Policy</a>
            </div>
        </div>
    </div>
</footer>
