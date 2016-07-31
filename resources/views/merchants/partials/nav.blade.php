<div class="wizard">
            <div class="wizard-inner">
                <div class="connecting-line"></div>
                <ul class="nav nav-tabs" role="tablist">

                    <li role="presentation" class="{{ !session()->has('merchant_completed_step') ||  session('merchant_completed_step') == '0' ? 'active' : 'disabled' }}">
                        <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                            <span class="round-tab">
                                <i class="fa fa-briefcase"></i>
                            </span>
                        </a>
                    </li>

                    <li role="presentation" class="{{ session()->has('merchant_completed_step') &&  session('merchant_completed_step') == '1' ? 'active' : 'disabled' }}">
                        <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                            <span class="round-tab">
                                <i class="fa fa-money"></i>
                            </span>
                        </a>
                    </li>
                    <li role="presentation" class="{{ session()->has('merchant_completed_step') &&  session('merchant_completed_step') == '2' ? 'active' : 'disabled' }}">
                        <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                            <span class="round-tab">
                                <i class="fa fa-phone-square"></i>
                            </span>
                        </a>
                    </li>

                    <li role="presentation" class="{{ session()->has('merchant_completed_step') &&  session('merchant_completed_step') == '3' ? 'active' : 'disabled' }}">
                        <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                            <span class="round-tab">
                                <i class="fa fa-check-circle"></i>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
</div>
