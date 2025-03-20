<x-guest-layout>
    <div class="contact-hero">
        <div class="themesflat-container">
            <div class="row">
                <div class="col-12">
                    <h1 class="contact-heading text-center">Get in Touch</h1>
                    <ul class="breadcrumbs flex justify-center">
                        <li>
                            <a href="{{ route('home') }}" wire:navigate>Home</a>
                            <span class="separator"><i class="fa fa-chevron-right"></i></span>
                        </li>
                        <li class="active">
                            <span>Contact</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="tf-section contact-section">
        <div class="themesflat-container">
            <div class="row">
                <div class="col-lg-5 col-md-12">
                    <div class="contact-info">
                        <h2 class="section-title">Let's Connect</h2>
                        <p class="contact-desc">Have questions or feedback? We'd love to hear from you. Our team is
                            ready to provide solutions for your needs.</p>

                        <div class="info-item">
                            <div class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                            <div class="text">Dirham App Office
                                Al Majaz Tower, Office 304
                                Al Majaz 3, Sharjah, UAE
                                P.O. Box: 123456
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="icon"><i class="fa fa-phone" aria-hidden="true"></i></div>
                            <div class="text"><a href="tel:+971501234567">+971501234567</a></div>
                        </div>

                        <div class="info-item">
                            <div class="icon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                            <div class="text"><a href="mailto:support@dirhamapp.com">support@dirhamapp.com</a>
                            </div>
                        </div>

                        {{-- <div class="socials">
                            <h3 class="follow-title">Follow Us</h3>
                            <ul class="socials-list">
                                <li><a href="https://www.facebook.com/troubleshoot/" target="_blank"><i
                                            class="fa fa-facebook"></i></a></li>
                                <li><a href="https://twitter.com/troubleshoot" target="_blank"><i
                                            class="fa-brands fa-facebook"></i></a></li>
                                <li><a href="https://www.linkedin.com/company/troubleshoot/" target="_blank"><i
                                            class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                <li><a href="https://www.instagram.com/troubleshoot/" target="_blank"><i
                                            class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            </ul>
                        </div> --}}
                    </div>
                </div>

                <div class="col-lg-7 col-md-12">
                    <div class="contact-form-wrapper">
                        <h2 class="form-title">Send Us a Message</h2>
                        <form action="javascript:void(0)" method="POST" wire:submit.prevent="sendContact"
                            class="contact-form">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" placeholder="Your Name" wire:model="contact.name"
                                            class="input-text" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" placeholder="Your Email" wire:model="contact.email"
                                            class="input-text" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" placeholder="Subject" wire:model="contact.subject"
                                            class="input-text" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea placeholder="Your Message" wire:model="contact.message" class="input-textarea"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="themesflat-button">
                                        <span>Send Message</span>
                                        <i class="fa fa-paper-plane"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
<style>
    /* Hero Section */
    .contact-hero {
        background: linear-gradient(135deg, #232323 0%, #000000 100%);
        padding: 60px 0;
        position: relative;
        overflow: hidden;
    }

    .contact-hero:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('/assets/images/pattern.svg');
        opacity: 0.05;
    }

    .contact-heading {
        font-size: 48px;
        font-weight: 700;
        color: #DDF247;
        margin-bottom: 15px;
        letter-spacing: -1px;
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

    /* Contact Section */
    .contact-section {
        padding: 100px 0;
        background-color: #161616;
    }

    .section-title,
    .form-title {
        font-size: 36px;
        font-weight: 700;
        color: #DDF247;
        margin-bottom: 25px;
        font-family: 'Azeret Mono', monospace;
    }

    .contact-desc {
        color: rgba(255, 255, 255, 0.7);
        margin-bottom: 40px;
        font-size: 16px;
        line-height: 1.6;
    }

    .contact-info {
        padding-right: 30px;
    }

    .info-item {
        display: flex;
        margin-bottom: 25px;
        align-items: flex-start;
    }

    .info-item .icon {
        width: 50px;
        height: 50px;
        background-color: rgba(221, 242, 71, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        flex-shrink: 0;
    }

    .info-item .icon i {
        color: #DDF247;
        font-size: 20px;
    }

    .info-item .text {
        color: rgba(255, 255, 255, 0.8);
        font-size: 16px;
        line-height: 1.5;
        padding-top: 12px;
    }

    .info-item .text a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .info-item .text a:hover {
        color: #DDF247;
    }

    .follow-title {
        font-size: 18px;
        font-weight: 600;
        color: #ffffff;
        margin-bottom: 15px;
        font-family: 'Azeret Mono', monospace;
    }

    .socials {
        margin-top: 40px;
    }

    .socials-list {
        display: flex;
        padding: 0;
        margin: 0;
        list-style: none;
    }

    .socials-list li {
        margin-right: 15px;
    }

    .socials-list li a {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background-color: rgba(255, 255, 255, 0.08);
        border-radius: 50%;
        color: #DDF247;
        font-size: 18px;
        transition: all 0.3s ease;
    }

    .socials-list li a:hover {
        background-color: #DDF247;
        color: #161616;
        transform: translateY(-3px);
    }

    /* Contact Form */
    .contact-form-wrapper {
        background-color: #232323;
        border-radius: 10px;
        padding: 40px;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .contact-form .row {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -10px;
    }

    .contact-form .row>div {
        padding: 0 10px;
    }

    .contact-form .input-text,
    .contact-form .input-textarea {
        background-color: #161616;
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 5px;
        padding: 15px 20px;
        width: 100%;
        font-size: 15px;
        font-family: 'Azeret Mono', monospace;
        color: rgba(255, 255, 255, 0.8);
        transition: all 0.3s ease;
    }

    .contact-form .input-text:focus,
    .contact-form .input-textarea:focus {
        border-color: rgba(221, 242, 71, 0.5);
        box-shadow: 0 0 0 3px rgba(221, 242, 71, 0.1);
        outline: none;
    }

    .contact-form .input-text::placeholder,
    .contact-form .input-textarea::placeholder {
        color: rgba(255, 255, 255, 0.3);
    }

    .contact-form .input-textarea {
        height: 150px;
        resize: none;
    }

    .themesflat-button {
        background-color: #DDF247;
        border: none;
        border-radius: 5px;
        color: #161616;
        font-size: 16px;
        font-family: 'Azeret Mono', monospace;
        font-weight: 600;
        padding: 15px 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 100%;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .themesflat-button i {
        margin-left: 10px;
        transition: all 0.3s ease;
    }

    .themesflat-button:hover {
        background-color: #c2d63e;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(221, 242, 71, 0.2);
    }

    .themesflat-button:hover i {
        transform: translateX(5px);
    }

    /* Responsive */
    @media (max-width: 991px) {
        .contact-info {
            margin-bottom: 50px;
            padding-right: 0;
        }

        .contact-heading {
            font-size: 36px;
        }

        .section-title,
        .form-title {
            font-size: 28px;
        }
    }

    @media (max-width: 767px) {
        .contact-hero {
            padding: 40px 0;
        }

        .contact-section {
            padding: 60px 0;
        }

        .contact-form-wrapper {
            padding: 30px 20px;
        }

        .contact-heading {
            font-size: 28px;
        }
    }
</style>
