 <!-- Footer -->
 <footer id="footer">
     <div class="themesflat-container">
         <div class="row">
             <div class="col-12">
                 <div class="footer-content flex flex-grow">
                     <div class="widget-logo flex-grow">
                         <div class="logo-footer" id="logo-footer">
                             <a href="index.html">
                                 <img id="logo_footer" src="{{ asset('user') }}/assets/images/logo/logo.png"
                                     data-retina="{{ asset('user') }}/assets/images/logo/logo.png"
                                     style="width: 160px;">
                             </a>
                         </div>
                     </div>
                     {{-- <div class="widget widget-menu style-1">
                        <h5 class="title-widget">Marketplace</h5>
                        <ul>
                            <li><a href="#">All NFTs</a></li>
                            <li><a href="#">Virtual worlds</a></li>
                            <li><a href="#">Domain names</a></li>
                            <li><a href="#">Photography</a></li>
                            <li><a href="#">Digital art</a></li>
                            <li><a href="#">Music</a></li>
                        </ul>
                    </div> --}}
                     {{-- <div class="widget widget-menu style-2">
                        <h5 class="title-widget">Resource</h5>
                        <ul>
                            <li><a href="#">Help center</a></li>
                            <li><a href="#">Platform status</a></li>
                            <li><a href="#">Partners</a></li>
                            <li><a href="#">Discount community</a></li>
                            <li><a href="#">Live auctions</a></li>
                            <li><a href="#">Discover</a></li>
                        </ul>
                    </div> --}}
                     <div class="widget widget-menu style-3">
                         <h5 class="title-widget">Account</h5>
                         <ul>
                             <li><a href="/login">login</a></li>
                             <li><a href="/register">Register</a></li>
                             <li><a href="/contact">Contact us</a></li>
                             <li><a href="/account-delete">Account Delete</a></li>
                             <li><a href="/faq">FAQ</a></li>
                         </ul>
                     </div>
                     <div class="widget-last">
                         <div class="widget-menu style-4">
                             <h5 class="title-widget">Company</h5>
                             <ul>
                                 <li><a href="#">Help center</a></li>
                                 <li><a href="#">Platform status</a></li>
                             </ul>
                         </div>
                         <h5 class="title-widget mt-30">Join the community</h5>
                         <div class="widget-social">
                             <ul class="flex">
                                 <li><a href="#" class="icon-facebook"></a></li>
                                 <li><a href="#" class="icon-twitter"></a></li>
                                 <li><a href="#" class="icon-vt"></a></li>
                                 <li><a href="#" class="icon-tiktok"></a></li>
                                 <li><a href="#" class="icon-youtube"></a></li>
                             </ul>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="footer-bottom">
             <p>© 2024 Dirham365. All rights reserved.</p>
             <ul class="flex">
                 <li>
                     <a href="{{ route('privacy-policy') }}" wire:navigate>Privacy Policy</a>
                 </li>
                 <li>
                     <a href="{{ route('terms-and-conditions') }}" wire:navigate>Terms & Conditions</a>
                 </li>
             </ul>
         </div>
     </div>
 </footer><!-- /#footer -->
