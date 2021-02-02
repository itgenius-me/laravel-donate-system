<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li>
                    <a class="waves-effect waves-dark" href="{{ url('/') }}" aria-expanded="false">
                        <i class="icon-speedometer"></i>
                        <span class="hide-menu">{{ __('global.Dashboard.title') }}</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-asterisk"></i>
                        <span class="hide-menu">{{ __('global.Participants.title') }}</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li>
                            <a href="{{ url('/referral') }}">
                                {{ __('global.Participants.Referral.title') }}
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-asterisk"></i>
                        <span class="hide-menu">{{ __('global.MyPage.title') }}</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li>
                            <a href="{{ url('/my-page') }}">
                                {{ __('global.MyPage.title') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/letters-happiness') }}">
                                {{ __('global.MyPage.MyLettersofHappiness.title') }}
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{ url('/mavro') }}" aria-expanded="false">
                        <i class="mdi mdi-calendar-plus"></i>
                        <span class="hide-menu">{{ __('global.Mavro.title') }}</span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{ url('/account') }}" aria-expanded="false">
                        <i class="mdi mdi-application"></i>
                        <span class="hide-menu">{{ __('global.Account.title') }}</span>
                    </a>
                </li>
                <li class="nav-small-cap">--- {{ __('global.System') }}</li>
                <li>
                    <a class="waves-effect waves-dark" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();" aria-expanded="false">
                        <i class="fa fa-power-off text-danger"></i>
                        <span class="hide-menu">{{ __('global.Logout') }}</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
