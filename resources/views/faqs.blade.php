<x-guest-layout>
    <div class="faq-hero">
        <div class="themesflat-container">
            <div class="row">
                <div class="col-12">
                    <h1 class="faq-heading text-center">Dirham App – Frequently Asked Questions (FAQ)</h1>
                    <ul class="breadcrumbs flex justify-center">
                        <li>
                            <a href="{{ route('home') }}" wire:navigate>Home</a>
                            <span class="separator"><i class="fa fa-chevron-right"></i></span>
                        </li>
                        <li class="active">
                            <span>FAQ</span>
                        </li>
                    </ul>
                    <p class="faq-subtitle text-center">Find answers to the most common questions about our services</p>
                </div>
            </div>
        </div>
    </div>

    <div class="tf-section faq-section">
        <div class="themesflat-container">
            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <div class="faq-categories">
                        <h3 class="category-title">Topics</h3>
                        <ul class="category-list" x-data="{ active: 'general' }">
                            <li :class="{ 'active': active === 'general' }">
                                <a href="#general"
                                    @click.prevent="active = 'general'; document.getElementById('general').scrollIntoView({behavior: 'smooth'})">
                                    <i class="fa fa-circle"></i>
                                    <span>General Questions</span>
                                </a>
                            </li>
                            <li :class="{ 'active': active === 'account' }">
                                <a href="#account"
                                    @click.prevent="active = 'account'; document.getElementById('account').scrollIntoView({behavior: 'smooth'})">
                                    <i class="fa fa-user-circle"></i>
                                    <span>User Accounts & Registration</span>
                                </a>
                            </li>
                            <li :class="{ 'active': active === 'payments' }">
                                <a href="#payments"
                                    @click.prevent="active = 'payments'; document.getElementById('payments').scrollIntoView({behavior: 'smooth'})">
                                    <i class="fa fa-credit-card"></i>
                                    <span>Payments & Transactions</span>
                                </a>
                            </li>
                            <li :class="{ 'active': active === 'providers' }">
                                <a href="#providers"
                                    @click.prevent="active = 'providers'; document.getElementById('providers').scrollIntoView({behavior: 'smooth'})">
                                    <i class="fa fa-cogs"></i>
                                    <span>Service Providers & Bidding</span>
                                </a>
                            </li>
                            <li :class="{ 'active': active === 'support' }">
                                <a href="#support"
                                    @click.prevent="active = 'support'; document.getElementById('support').scrollIntoView({behavior: 'smooth'})">
                                    <i class="fa fa-wrench"></i>
                                    <span>Support & Policies</span>
                                </a>
                            </li>
                        </ul>

                        <div class="faq-contact">
                            <h3>Still Have Questions?</h3>
                            <p>Can't find the answer you're looking for? Please contact our support team.</p>
                            <a href="{{ route('contact') }}" class="contact-button" wire:navigate>
                                <span>Contact Us</span>
                                <i class="fa fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 col-md-12">
                    <div class="faq-content">
                        <div id="general" class="faq-category">
                            <h2 class="category-heading">General Questions</h2>

                            <div class="faq-accordion" x-data="{ activeAccordion: null }">
                                <div class="accordion-item" :class="{ 'active': activeAccordion === 1 }">
                                    <div class="accordion-header"
                                        @click="activeAccordion = activeAccordion === 1 ? null : 1">
                                        <h3>What is Dirham App?</h3>
                                        <span class="accordion-icon"><i class="fa"
                                                :class="activeAccordion === 1 ? 'fa-minus' : 'fa-plus'"></i></span>
                                    </div>
                                    <div class="accordion-content" x-show="activeAccordion === 1" x-collapse>
                                        <p>Dirham is a mobile and web-based platform that offers on-demand services and
                                            an auction system in the UAE. Users can request various services instantly
                                            and participate in auctions for products and services.</p>
                                    </div>
                                </div>

                                <div class="accordion-item" :class="{ 'active': activeAccordion === 2 }">
                                    <div class="accordion-header"
                                        @click="activeAccordion = activeAccordion === 2 ? null : 2">
                                        <h3>Which platforms does Dirham support?</h3>
                                        <span class="accordion-icon"><i class="fa"
                                                :class="activeAccordion === 2 ? 'fa-minus' : 'fa-plus'"></i></span>
                                    </div>
                                    <div class="accordion-content" x-show="activeAccordion === 2" x-collapse>
                                        <p>Dirham is available on Android, iOS, and Web platforms, ensuring seamless
                                            access across devices.</p>
                                    </div>
                                </div>

                                <div class="accordion-item" :class="{ 'active': activeAccordion === 3 }">
                                    <div class="accordion-header"
                                        @click="activeAccordion = activeAccordion === 3 ? null : 3">
                                        <h3>How does the on-demand service work?</h3>
                                        <span class="accordion-icon"><i class="fa"
                                                :class="activeAccordion === 3 ? 'fa-minus' : 'fa-plus'"></i></span>
                                    </div>
                                    <div class="accordion-content" x-show="activeAccordion === 3" x-collapse>
                                        <p>Users can browse available services, select a provider, and request immediate
                                            or scheduled assistance. Service providers respond in real time to fulfill
                                            the request.</p>
                                    </div>
                                </div>

                                <div class="accordion-item" :class="{ 'active': activeAccordion === 4 }">
                                    <div class="accordion-header"
                                        @click="activeAccordion = activeAccordion === 4 ? null : 4">
                                        <h3>How does the auction system work?</h3>
                                        <span class="accordion-icon"><i class="fa"
                                                :class="activeAccordion === 4 ? 'fa-minus' : 'fa-plus'"></i></span>
                                    </div>
                                    <div class="accordion-content" x-show="activeAccordion === 4" x-collapse>
                                        <p>Users can list items or services for auction, and interested buyers can place
                                            bids. The highest bidder wins once the auction ends.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="account" class="faq-category">
                            <h2 class="category-heading">User Accounts & Registration</h2>

                            <div class="faq-accordion" x-data="{ activeAccordion: null }">
                                <div class="accordion-item" :class="{ 'active': activeAccordion === 1 }">
                                    <div class="accordion-header"
                                        @click="activeAccordion = activeAccordion === 1 ? null : 1">
                                        <h3>How do I register on Dirham?</h3>
                                        <span class="accordion-icon"><i class="fa"
                                                :class="activeAccordion === 1 ? 'fa-minus' : 'fa-plus'"></i></span>
                                    </div>
                                    <div class="accordion-content" x-show="activeAccordion === 1" x-collapse>
                                        <p>You can sign up using your email, phone number, or social media accounts via
                                            the mobile app or website.</p>
                                    </div>
                                </div>

                                <div class="accordion-item" :class="{ 'active': activeAccordion === 2 }">
                                    <div class="accordion-header"
                                        @click="activeAccordion = activeAccordion === 2 ? null : 2">
                                        <h3>Is there a verification process?</h3>
                                        <span class="accordion-icon"><i class="fa"
                                                :class="activeAccordion === 2 ? 'fa-minus' : 'fa-plus'"></i></span>
                                    </div>
                                    <div class="accordion-content" x-show="activeAccordion === 2" x-collapse>
                                        <p>Yes, all users must verify their identity via phone number verification and,
                                            in some cases, ID verification for added security.</p>
                                    </div>
                                </div>

                                <div class="accordion-item" :class="{ 'active': activeAccordion === 3 }">
                                    <div class="accordion-header"
                                        @click="activeAccordion = activeAccordion === 3 ? null : 3">
                                        <h3>Can I use Dirham without an account?</h3>
                                        <span class="accordion-icon"><i class="fa"
                                                :class="activeAccordion === 3 ? 'fa-minus' : 'fa-plus'"></i></span>
                                    </div>
                                    <div class="accordion-content" x-show="activeAccordion === 3" x-collapse>
                                        <p>No, you must create an account to access the platform's services and
                                            auctions.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="payments" class="faq-category">
                            <h2 class="category-heading">Payments & Transactions</h2>

                            <div class="faq-accordion" x-data="{ activeAccordion: null }">
                                <div class="accordion-item" :class="{ 'active': activeAccordion === 1 }">
                                    <div class="accordion-header"
                                        @click="activeAccordion = activeAccordion === 1 ? null : 1">
                                        <h3>What payment methods are supported?</h3>
                                        <span class="accordion-icon"><i class="fa"
                                                :class="activeAccordion === 1 ? 'fa-minus' : 'fa-plus'"></i></span>
                                    </div>
                                    <div class="accordion-content" x-show="activeAccordion === 1" x-collapse>
                                        <p>Dirham supports multiple payment options, including credit/debit cards, bank
                                            transfers, and digital wallets.</p>
                                    </div>
                                </div>

                                <div class="accordion-item" :class="{ 'active': activeAccordion === 2 }">
                                    <div class="accordion-header"
                                        @click="activeAccordion = activeAccordion === 2 ? null : 2">
                                        <h3>Are transactions secure?</h3>
                                        <span class="accordion-icon"><i class="fa"
                                                :class="activeAccordion === 2 ? 'fa-minus' : 'fa-plus'"></i></span>
                                    </div>
                                    <div class="accordion-content" x-show="activeAccordion === 2" x-collapse>
                                        <p>Yes, all transactions are secured with encrypted payment gateways to ensure
                                            safe and seamless payments.</p>
                                    </div>
                                </div>

                                <div class="accordion-item" :class="{ 'active': activeAccordion === 3 }">
                                    <div class="accordion-header"
                                        @click="activeAccordion = activeAccordion === 3 ? null : 3">
                                        <h3>Does Dirham charge service fees?</h3>
                                        <span class="accordion-icon"><i class="fa"
                                                :class="activeAccordion === 3 ? 'fa-minus' : 'fa-plus'"></i></span>
                                    </div>
                                    <div class="accordion-content" x-show="activeAccordion === 3" x-collapse>
                                        <p>Some transactions may have a small service fee depending on the service or
                                            auction type. Full details are available before checkout.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="providers" class="faq-category">
                            <h2 class="category-heading">Service Providers & Bidding</h2>

                            <div class="faq-accordion" x-data="{ activeAccordion: null }">
                                <div class="accordion-item" :class="{ 'active': activeAccordion === 1 }">
                                    <div class="accordion-header"
                                        @click="activeAccordion = activeAccordion === 1 ? null : 1">
                                        <h3>How can I become a service provider?</h3>
                                        <span class="accordion-icon"><i class="fa"
                                                :class="activeAccordion === 1 ? 'fa-minus' : 'fa-plus'"></i></span>
                                    </div>
                                    <div class="accordion-content" x-show="activeAccordion === 1" x-collapse>
                                        <p>You can register as a provider through the app, submit your details, and
                                            complete the verification process.</p>
                                    </div>
                                </div>

                                <div class="accordion-item" :class="{ 'active': activeAccordion === 2 }">
                                    <div class="accordion-header"
                                        @click="activeAccordion = activeAccordion === 2 ? null : 2">
                                        <h3>How do I place a bid in an auction?</h3>
                                        <span class="accordion-icon"><i class="fa"
                                                :class="activeAccordion === 2 ? 'fa-minus' : 'fa-plus'"></i></span>
                                    </div>
                                    <div class="accordion-content" x-show="activeAccordion === 2" x-collapse>
                                        <p>To participate in an auction, simply select an item, enter your bid amount,
                                            and confirm. If you win, you'll be notified to complete the payment.</p>
                                    </div>
                                </div>

                                <div class="accordion-item" :class="{ 'active': activeAccordion === 3 }">
                                    <div class="accordion-header"
                                        @click="activeAccordion = activeAccordion === 3 ? null : 3">
                                        <h3>Can I cancel my bid?</h3>
                                        <span class="accordion-icon"><i class="fa"
                                                :class="activeAccordion === 3 ? 'fa-minus' : 'fa-plus'"></i></span>
                                    </div>
                                    <div class="accordion-content" x-show="activeAccordion === 3" x-collapse>
                                        <p>No, once a bid is placed, it cannot be canceled. Please bid responsibly.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="support" class="faq-category">
                            <h2 class="category-heading">Support & Policies</h2>

                            <div class="faq-accordion" x-data="{ activeAccordion: null }">
                                <div class="accordion-item" :class="{ 'active': activeAccordion === 1 }">
                                    <div class="accordion-header"
                                        @click="activeAccordion = activeAccordion === 1 ? null : 1">
                                        <h3>What if I face issues with a service or auction?</h3>
                                        <span class="accordion-icon"><i class="fa"
                                                :class="activeAccordion === 1 ? 'fa-minus' : 'fa-plus'"></i></span>
                                    </div>
                                    <div class="accordion-content" x-show="activeAccordion === 1" x-collapse>
                                        <p>You can contact Dirham's customer support via in-app chat, email, or phone
                                            for any assistance.</p>
                                    </div>
                                </div>

                                <div class="accordion-item" :class="{ 'active': activeAccordion === 2 }">
                                    <div class="accordion-header"
                                        @click="activeAccordion = activeAccordion === 2 ? null : 2">
                                        <h3>Does Dirham offer refunds?</h3>
                                        <span class="accordion-icon"><i class="fa"
                                                :class="activeAccordion === 2 ? 'fa-minus' : 'fa-plus'"></i></span>
                                    </div>
                                    <div class="accordion-content" x-show="activeAccordion === 2" x-collapse>
                                        <p>Refund policies vary based on the service or auction terms. Check the refund
                                            policy section in the app for details.</p>
                                    </div>
                                </div>

                                <div class="accordion-item" :class="{ 'active': activeAccordion === 3 }">
                                    <div class="accordion-header"
                                        @click="activeAccordion = activeAccordion === 3 ? null : 3">
                                        <h3>How do I report fraud or misuse?</h3>
                                        <span class="accordion-icon"><i class="fa"
                                                :class="activeAccordion === 3 ? 'fa-minus' : 'fa-plus'"></i></span>
                                    </div>
                                    <div class="accordion-content" x-show="activeAccordion === 3" x-collapse>
                                        <p>If you encounter fraudulent activity, report it immediately via the "Report"
                                            button in the app, or contact our support team.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>

<style>
    /* Hero Section */
    .faq-hero {
        background: linear-gradient(135deg, #232323 0%, #000000 100%);
        padding: 60px 0;
        position: relative;
        overflow: hidden;
    }

    .faq-hero:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('/assets/images/pattern.svg');
        opacity: 0.05;
    }

    .faq-heading {
        font-size: 48px;
        font-weight: 700;
        color: #DDF247;
        margin-bottom: 15px;
        letter-spacing: -1px;
    }

    .faq-subtitle {
        color: rgba(255, 255, 255, 0.7);
        font-size: 18px;
        max-width: 600px;
        margin: 20px auto 0;
    }

    .breadcrumbs {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .breadcrumbs li {
        display: flex;
        align-items: center;
        color: rgba(255, 255, 255, 0.6);
        font-size: 14px;
    }

    .breadcrumbs li a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .breadcrumbs li a:hover {
        color: #DDF247;
    }

    .breadcrumbs .separator {
        margin: 0 10px;
        color: rgba(255, 255, 255, 0.3);
        font-size: 12px;
    }

    .breadcrumbs li.active span {
        color: #DDF247;
    }

    /* FAQ Section */
    .faq-section {
        padding: 100px 0;
        background-color: #161616;
    }

    /* Categories Sidebar */
    .faq-categories {
        background-color: #232323;
        border-radius: 10px;
        padding: 30px;
        position: sticky;
        top: 100px;
    }

    .category-title {
        font-size: 22px;
        font-weight: 700;
        color: #DDF247;
        margin-bottom: 25px;
        font-family: 'Azeret Mono', monospace;
    }

    .category-list {
        list-style: none;
        padding: 0;
        margin: 0 0 40px;
    }

    .category-list li {
        margin-bottom: 10px;
    }

    .category-list li a {
        display: flex;
        align-items: center;
        padding: 12px 15px;
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
        font-size: 15px;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .category-list li a i {
        margin-right: 12px;
        font-size: 14px;
        color: rgba(255, 255, 255, 0.4);
        transition: all 0.3s ease;
    }

    .category-list li a:hover {
        background-color: rgba(255, 255, 255, 0.05);
        color: #DDF247;
    }

    .category-list li a:hover i {
        color: #DDF247;
    }

    .category-list li.active a {
        background-color: rgba(221, 242, 71, 0.1);
        color: #DDF247;
    }

    .category-list li.active a i {
        color: #DDF247;
    }

    /* Contact Box */
    .faq-contact {
        background-color: rgba(255, 255, 255, 0.05);
        border-radius: 8px;
        padding: 25px;
        border-left: 3px solid #DDF247;
    }

    .faq-contact h3 {
        font-size: 18px;
        font-weight: 600;
        color: #ffffff;
        margin-bottom: 12px;
        font-family: 'Azeret Mono', monospace;
    }

    .faq-contact p {
        color: rgba(255, 255, 255, 0.7);
        font-size: 14px;
        margin-bottom: 20px;
    }

    .contact-button {
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #DDF247;
        color: #161616;
        padding: 12px 20px;
        border-radius: 5px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        font-family: 'Azeret Mono', monospace;
    }

    .contact-button i {
        margin-left: 8px;
        transition: all 0.3s ease;
    }

    .contact-button:hover {
        background-color: #c2d63e;
        transform: translateY(-2px);
    }

    .contact-button:hover i {
        transform: translateX(5px);
    }

    /* FAQ Content */
    .faq-content {
        padding-left: 30px;
    }

    .faq-category {
        margin-bottom: 60px;
        scroll-margin-top: 100px;
    }

    .faq-category:last-child {
        margin-bottom: 0;
    }

    .category-heading {
        font-size: 32px;
        font-weight: 700;
        color: #DDF247;
        margin-bottom: 30px;
        font-family: 'Azeret Mono', monospace;
        position: relative;
        padding-bottom: 15px;
    }

    .category-heading:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 3px;
        background-color: #DDF247;
    }

    /* Accordion */
    .accordion-item {
        background-color: #232323;
        border-radius: 8px;
        margin-bottom: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .accordion-item.active {
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .accordion-header {
        padding: 20px 25px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .accordion-header:hover {
        background-color: rgba(255, 255, 255, 0.03);
    }

    .accordion-header h3 {
        font-size: 17px;
        font-weight: 600;
        color: #ffffff;
        margin: 0;
        font-family: 'Azeret Mono', monospace;
    }

    .accordion-icon {
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(221, 242, 71, 0.1);
        border-radius: 50%;
        color: #DDF247;
        flex-shrink: 0;
        transition: all 0.3s ease;
    }

    .accordion-icon i {
        font-size: 12px;
    }

    .accordion-item.active .accordion-icon {
        background-color: #DDF247;
        color: #161616;
        transform: rotate(180deg);
    }

    .accordion-content {
        padding: 0 25px 20px;
        font-size: 15px;
        line-height: 1.6;
        color: rgba(255, 255, 255, 0.7);
    }

    .accordion-content p {
        margin: 0;
    }

    /* Responsive */
    @media (max-width: 991px) {
        .faq-heading {
            font-size: 36px;
        }

        .faq-content {
            padding-left: 0;
            margin-top: 40px;
        }

        .category-heading {
            font-size: 28px;
        }

        .faq-categories {
            position: relative;
            top: 0;
        }
    }

    @media (max-width: 767px) {
        .faq-hero {
            padding: 40px 0;
        }

        .faq-section {
            padding: 60px 0;
        }

        .faq-heading {
            font-size: 28px;
        }

        .faq-subtitle {
            font-size: 16px;
        }

        .accordion-header h3 {
            font-size: 16px;
        }

        .accordion-header {
            padding: 15px 20px;
        }

        .accordion-content {
            padding: 0 20px 15px;
        }

        .faq-category {
            margin-bottom: 40px;
        }
    }
</style>
