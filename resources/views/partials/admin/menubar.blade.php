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
                    <a class="waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="icon-people"></i>
                        <span class="hide-menu">{{ __('global.UserManage.title') }}</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li>
                            <a href="{{ url('/admin/users') }}">
                                {{ __('global.UserManage.Users') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/referal-teams') }}">
                                {{ __('global.UserManage.ReferalTeams') }}
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{ url('/testimonial') }}" aria-expanded="false">
                        <i class="mdi mdi-history"></i>
                        <span class="hide-menu">{{ __('global.Testimonial.title') }}</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-asterisk"></i>
                        <span class="hide-menu">{{ __('global.OrderManage.title') }}</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li>
                            <a href="{{ url('/view-orders') }}">
                                {{ __('global.OrderManage.ViewOrders.title') }}
                            </a>
                        </li>
{{--                        <li>--}}
{{--                            <a href="{{ url('/view-orders-disputed') }}">--}}
{{--                                {{ __('global.OrderManage.ViewOrdersDisputed.title') }}--}}
{{--                            </a>--}}
{{--                        </li>--}}
                        <li>
                            <a href="{{ url('/admin/get-help') }}">
                                {{ __('global.OrderManage.GetHelp.title') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/provide-help') }}">
                                {{ __('global.OrderManage.ProvideHelp.title') }}
                            </a>
                        </li>
{{--                        <li>--}}
{{--                            <a href="{{ url('/view-growth') }}">--}}
{{--                                {{ __('global.OrderManage.ViewGrowth.title') }}--}}
{{--                            </a>--}}
{{--                        </li>--}}
                    </ul>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{ url('/order-generate') }}" aria-expanded="false">
                        <i class="mdi mdi-calendar-plus"></i>
                        <span class="hide-menu">{{ __('global.OrderGenerate.title') }}</span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{ url('/application') }}" aria-expanded="false">
                        <i class="mdi mdi-application"></i>
                        <span class="hide-menu">{{ __('global.Application.title') }}</span>
                    </a>
                </li>
                <li class="nav-small-cap">--- {{ __('global.System') }}</li>
                <li>
                    <a class="waves-effect waves-dark" href="{{ url('/my-account') }}" aria-expanded="false">
                        <i class="ti-user text-info"></i>
                        <span class="hide-menu">{{ __('global.MyAccount.title') }}</span>
                    </a>
                </li>
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
