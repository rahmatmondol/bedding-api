<x-guest-layout>
    <div class="account-hero">
        <div class="themesflat-container">
            <div class="row">
                <div class="col-12">
                    <h1 class="account-heading text-center">Delete Account</h1>
                    <ul class="breadcrumbs flex justify-center">
                        <li>
                            <a href="{{ route('home') }}" wire:navigate>Home</a>
                            <span class="separator"><i class="fa fa-chevron-right"></i></span>
                        </li>
                        <li>
                            <a href="" wire:navigate>Account</a>
                            <span class="separator"><i class="fa fa-chevron-right"></i></span>
                        </li>
                        <li class="active">
                            <span>Delete Account</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <div class="tf-section delete-account-section">
        <div class="themesflat-container">
            <div class="row">
                <div class="col-lg-8 col-md-12 mx-auto">
                    <div class="delete-account-wrapper">
                        <div class="account-warning">
                            <div class="warning-icon">
                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                            </div>
                            <div class="warning-content">
                                <h3>This action cannot be undone</h3>
                                <p>Once you delete your account, all of your data will be permanently removed. This includes your profile, saved items, and activity history.</p>
                            </div>
                        </div>
                        
                        <div class="delete-form-container">
                            <h2 class="form-title">Account Deletion</h2>
                            <p class="deletion-desc">Please confirm that you want to delete your account by entering your password and selecting the reason for deletion.</p>
                            
                            <form action="javascript:void(0)" method="POST" wire:submit.prevent="deleteAccount" class="delete-form">
                                <div class="form-group">
                                    <label for="password">Current Password</label>
                                    <input type="password" id="password" placeholder="Enter your current password" wire:model="password" class="input-text" required />
                                </div>
                                
                                <div class="form-group">
                                    <label for="reason">Reason for Leaving</label>
                                    <select id="reason" wire:model="reason" class="input-select" required>
                                        <option value="">Select a reason</option>
                                        <option value="not_satisfied">Not satisfied with service</option>
                                        <option value="found_alternative">Found a better alternative</option>
                                        <option value="no_longer_needed">No longer need the service</option>
                                        <option value="privacy_concerns">Privacy concerns</option>
                                        <option value="too_complicated">Too complicated to use</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                
                                <div class="form-group" x-show="$wire.reason === 'other'">
                                    <label for="other_reason">Please specify</label>
                                    <textarea id="other_reason" placeholder="Tell us more about why you're leaving..." wire:model="other_reason" class="input-textarea"></textarea>
                                </div>
                                
                                <div class="form-group">
                                    <label for="feedback">Additional Feedback (Optional)</label>
                                    <textarea id="feedback" placeholder="Is there anything we could have done better?" wire:model="feedback" class="input-textarea"></textarea>
                                </div>
                                
                                <div class="form-group confirmation-check">
                                    <label class="checkbox-container">
                                        <input type="checkbox" wire:model="confirm_deletion" required />
                                        <span class="checkmark"></span>
                                        <span class="checkbox-text">I understand that this action is permanent and cannot be undone</span>
                                    </label>
                                </div>
                                
                                <div class="form-actions">
                                    <a href="" wire:navigate class="cancel-button">
                                        <span>Cancel</span>
                                    </a>
                                    <button type="submit" class="delete-button" wire:loading.attr="disabled">
                                        <span>Delete Account</span>
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>

<style>
    /* Hero Section */
    .account-hero {
        background: linear-gradient(135deg, #232323 0%, #000000 100%);
        padding: 60px 0;
        position: relative;
        overflow: hidden;
    }
    
    .account-hero:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('/assets/images/pattern.svg');
        opacity: 0.05;
    }
    
    .account-heading {
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
    
    /* Delete Account Section */
    .delete-account-section {
        padding: 100px 0;
        background-color: #161616;
    }
    
    .delete-account-wrapper {
        background-color: #232323;
        border-radius: 10px;
        padding: 40px;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    }
    
    .form-title {
        font-size: 32px;
        font-weight: 700;
        color: #DDF247;
        margin-bottom: 20px;
        font-family: 'Azeret Mono', monospace;
    }
    
    .deletion-desc {
        color: rgba(255, 255, 255, 0.7);
        margin-bottom: 30px;
        font-size: 16px;
        line-height: 1.6;
    }
    
    /* Warning Box */
    .account-warning {
        display: flex;
        align-items: flex-start;
        background-color: rgba(231, 76, 60, 0.1);
        border-left: 4px solid #e74c3c;
        padding: 20px;
        border-radius: 5px;
        margin-bottom: 40px;
    }
    
    .warning-icon {
        flex-shrink: 0;
        width: 40px;
        height: 40px;
        background-color: rgba(231, 76, 60, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 20px;
    }
    
    .warning-icon i {
        color: #e74c3c;
        font-size: 20px;
    }
    
    .warning-content h3 {
        color: #e74c3c;
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 8px;
        font-family: 'Azeret Mono', monospace;
    }
    
    .warning-content p {
        color: rgba(255, 255, 255, 0.7);
        font-size: 14px;
        line-height: 1.5;
        margin: 0;
    }
    
    /* Form Styles */
    .form-group {
        margin-bottom: 25px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: rgba(255, 255, 255, 0.8);
        font-size: 14px;
        font-weight: 600;
        font-family: 'Azeret Mono', monospace;
    }
    
    .delete-form .input-text,
    .delete-form .input-textarea,
    .delete-form .input-select {
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
    
    .delete-form .input-text:focus,
    .delete-form .input-textarea:focus,
    .delete-form .input-select:focus {
        border-color: rgba(221, 242, 71, 0.5);
        box-shadow: 0 0 0 3px rgba(221, 242, 71, 0.1);
        outline: none;
    }
    
    .delete-form .input-text::placeholder,
    .delete-form .input-textarea::placeholder {
        color: rgba(255, 255, 255, 0.3);
    }
    
    .delete-form .input-textarea {
        height: 120px;
        resize: none;
    }
    
    /* Checkbox Styles */
    .confirmation-check {
        margin-top: 30px;
    }
    
    .checkbox-container {
        display: block;
        position: relative;
        padding-left: 35px;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }
    
    .checkbox-container input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }
    
    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 20px;
        width: 20px;
        background-color: #161616;
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 3px;
    }
    
    .checkbox-container:hover input ~ .checkmark {
        border-color: rgba(255, 255, 255, 0.4);
    }
    
    .checkbox-container input:checked ~ .checkmark {
        background-color: #DDF247;
        border-color: #DDF247;
    }
    
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }
    
    .checkbox-container input:checked ~ .checkmark:after {
        display: block;
    }
    
    .checkbox-container .checkmark:after {
        left: 7px;
        top: 3px;
        width: 5px;
        height: 10px;
        border: solid #161616;
        border-width: 0 2px 2px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }
    
    .checkbox-text {
        color: rgba(255, 255, 255, 0.8);
        font-size: 14px;
    }
    
    /* Button Styles */
    .form-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 40px;
    }
    
    .cancel-button,
    .delete-button {
        padding: 15px 30px;
        border-radius: 5px;
        font-size: 15px;
        font-family: 'Azeret Mono', monospace;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        text-decoration: none;
    }
    
    .cancel-button {
        background-color: transparent;
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: rgba(255, 255, 255, 0.8);
    }
    
    .cancel-button:hover {
        background-color: rgba(255, 255, 255, 0.05);
        border-color: rgba(255, 255, 255, 0.3);
        transform: translateY(-2px);
    }
    
    .delete-button {
        background-color: #e74c3c;
        border: none;
        color: #ffffff;
        width: auto;
        flex: 1;
        margin-left: 15px;
    }
    
    .delete-button i {
        margin-left: 10px;
        transition: all 0.3s ease;
    }
    
    .delete-button:hover {
        background-color: #c0392b;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(231, 76, 60, 0.2);
    }
    
    .delete-button:hover i {
        transform: translateX(5px);
    }
    
    .delete-button[disabled] {
        opacity: 0.6;
        cursor: not-allowed;
    }
    
    /* Responsive */
    @media (max-width: 991px) {
        .account-heading {
            font-size: 36px;
        }
        
        .form-title {
            font-size: 28px;
        }
        
        .delete-account-wrapper {
            padding: 30px;
        }
    }
    
    @media (max-width: 767px) {
        .account-hero {
            padding: 40px 0;
        }
        
        .delete-account-section {
            padding: 60px 0;
        }
        
        .account-heading {
            font-size: 28px;
        }
        
        .delete-account-wrapper {
            padding: 25px 20px;
        }
        
        .form-actions {
            flex-direction: column;
            gap: 15px;
        }
        
        .cancel-button,
        .delete-button {
            width: 100%;
            margin: 0;
        }
        
        .cancel-button {
            order: 2;
        }
        
        .delete-button {
            order: 1;
        }
    }
</style>