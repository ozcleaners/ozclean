<!DOCTYPE html>
<html lang="en">

<head>
    <!--Meta Tag-->
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript">
        var baseurl = "<?php echo url('/'); ?>";
    </script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--website title-->
    <title>
        @yield('title')
    </title>

    <!--====favicon icon====-->
    <link rel=icon href="images/logo.png" type="image/png" sizes=16x16>
    @include('admin.layouts.css')
    @yield('cuscss')
</head>

<body>
<div id="app">
    @include('admin.layouts.header')
    <section class="full-content-wrapper">
        <div class="cnt-left-site_info mobile-view">
            <div id="mySidenav" class="sidenav" style="display: none;">
                <a href="javascript:void(0)" class="closebtn" id="closebtn" onclick="closeNav()">&times;</a>
                <div class="container-fluid">
                    <div class="page_title">
                        <h3>Recent</h3>
                    </div>
                    <div class="sub-category-info">
                        <div class="sub-category-info_links">
                            <h2>Favourites</h2>
                            <ul>
                                <li>
                                    <a href="javascript:void(0)"><i class="fas fa-cloud"></i> Airdrop</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><i class="fas fa-cloud"></i> Recents</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><i class="fas fa-cloud"></i> Applications</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><i class="fas fa-cloud"></i> Desktop</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><i class="fas fa-cloud"></i> Documents</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><i class="fas fa-cloud"></i> Download</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><i class="fas fa-cloud"></i> OneDrive</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><i class="fas fa-cloud"></i> htDocs</a>
                                </li>
                            </ul>
                        </div>
                        <div class="sub-category-info_links">
                            <h2>iCloud</h2>
                            <ul>
                                <li>
                                    <a href="javascript:void(0)"><i class="fas fa-cloud"></i> iCloud Drive</a>
                                </li>

                            </ul>
                        </div>
                        <div class="sub-category-info_links">
                            <h2>Locations</h2>
                        </div>
                        <div class="sub-category-info_links color_options">
                            <h2>Tags</h2>
                            <ul>
                                <li>
                                    <a href="javascript:void(0)"><span></span> AQ</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><span class="blue"></span> Blue</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><span class="green"></span> Green</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><i class="fas fa-toggle-off"></i> All Tags...</a>
                                </li>
                            </ul>
                        </div>
                        <div class="summery_list">
                            <h2>Summery</h2>
                            <div class="data_list">
                                <span>Total Data :</span>
                                <span>10</span>
                            </div>
                            <div class="date_range">
                                <span>Date Range :</span>
                                <br>
                                <span>20-15-2021-14-6-2022</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sidebar_open">
                <span onclick="openNav()"><i class="fas fa-chevron-right"></i></span>
            </div>
        </div>
        <div class="cnt-left-site_info desktop-view">
            <div class="container-fluid">
                <div class="sub-category-info">
                    @include('admin.layouts.nav-menu.left-sidebar-menu')
                    <div class="summery_list">
                        @yield('summary')
                    </div>
                </div>
            </div>
        </div>
        <div class="cnt-right-site_info">
            <div class="master-title-wrapper">
                @hasSection('title')
                    <div class="cnt-right-top_header">
                        <div class="row">
                            <div class="col-sm-12 col-lg-5">
                                <div class="recent-info d-flex">
                                    @yield('title')
                                </div>
                            </div>
                            <div class="col-lg-7 col-sm-12 text-right">
                                <div class="category-related-link px-3">
                                    @yield('filter')
                                </div>
                            </div>
                        </div>

                    </div>
                @endif
            </div>
            <!-- Page Description -->
            <div class="position-relative">
                @if(!empty(request()->get('hasPermission')))
                    @yield('content')
                    <div style="clear: both; "></div>
                    {{-- <div class="breadcrumb-content">
                        <div class="breadcrumb">
                            @yield('breadcrumb')
                        </div>
                    </div> --}}
                    <div style="clear: both; "></div>
                @else
                    <div class="content-wrapper">
                        <div class="alert alert-warning">
                            You have no permission for this route.
                        </div>
                    </div>
                @endif
            <!-- footer wrapper-->
                @include('admin.layouts.footer')
            </div>
        </div>
    </section>

</div>
@include('admin.layouts.js')
@include('admin.layouts.notification')
@yield('topcusjs')
@yield('cusjs')
</body>

</html>
