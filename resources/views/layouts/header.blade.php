<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="index" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{URL::asset ('assets/images/logo-sm.svg')}}" alt="" height="26">
                    </span>
                    <span class="logo-lg">
                        <img src="{{URL::asset ('assets/images/logo-sm.svg')}}" alt="" height="26"> <span class="logo-txt">Vuesy</span>
                    </span>
                </a>

                <a href="index" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{URL::asset ('assets/images/logo-sm.svg')}}" alt="" height="26">
                    </span>
                    <span class="logo-lg">
                        <img src="{{URL::asset ('assets/images/logo-sm.svg')}}" alt="" height="26"> <span class="logo-txt">Vuesy</span>
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item" data-bs-toggle="collapse" id="horimenu-btn" data-bs-target="#topnav-menu-content">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <div class="topnav">
                <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                    <div class="collapse navbar-collapse" id="topnav-menu-content">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link dropdown-toggle arrow-none" href="index" id="topnav-dashboard" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-home-circle icon"></i>
                                    <span data-key="t-dashboard">Dashboard</span>
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-uielement" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-tone icon"></i>
                                    <span data-key="t-elements">Elements</span>
                                    <div class="arrow-down"></div>
                                </a>

                                <div class="dropdown-menu mega-dropdown-menu px-2 dropdown-mega-menu-xl" aria-labelledby="topnav-uielement">
                                    <div class="ps-2 p-lg-0">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div>
                                                    <div class="menu-title">Components</div>
                                                    <div class="row g-0">
                                                        <div class="col-lg-5">
                                                            <div>
                                                                <a href="ui-alerts" class="dropdown-item" data-key="t-alerts">Alerts</a>
                                                                <a href="ui-buttons" class="dropdown-item" data-key="t-buttons">Buttons</a>
                                                                <a href="ui-cards" class="dropdown-item" data-key="t-cards">Cards</a>
                                                                <a href="ui-carousel" class="dropdown-item" data-key="t-carousel">Carousel</a>
                                                                <a href="ui-dropdowns" class="dropdown-item" data-key="t-dropdowns">Dropdowns</a>
                                                                <a href="ui-grid" class="dropdown-item" data-key="t-grid">Grid</a>
                                                                <a href="ui-images" class="dropdown-item" data-key="t-images">Images</a>
                                                                <a href="ui-modals" class="dropdown-item" data-key="t-modals">Modals</a>
                                                                <a href="ui-offcanvas" class="dropdown-item" data-key="t-offcanvas">Offcanvas</a>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-5">
                                                            <div>
                                                                <a href="ui-placeholders" class="dropdown-item" data-key="t-placeholders">Placeholders</a>
                                                                <a href="ui-progressbars" class="dropdown-item" data-key="t-progress-bars">Progress Bars</a>
                                                                <a href="ui-tabs-accordions" class="dropdown-item" data-key="t-tabs-accordions">Tabs & Accordions</a>
                                                                <a href="ui-typography" class="dropdown-item" data-key="t-typography">Typography</a>
                                                                <a href="ui-video" class="dropdown-item" data-key="t-video">Video</a>
                                                                <a href="ui-general" class="dropdown-item" data-key="t-general">General</a>
                                                                <a href="ui-colors" class="dropdown-item" data-key="t-colors">Colors</a>
                                                                <a href="ui-utilities" class="dropdown-item" data-key="t-utilities">Utilities</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div>
                                                    <div class="menu-title">Extended</div>
                                                    <div>
                                                        <a href="extended-lightbox" class="dropdown-item" data-key="t-lightbox">Lightbox</a>
                                                        <a href="extended-rangeslider" class="dropdown-item" data-key="t-range-slider">Range Slider</a>
                                                        <a href="extended-sweet-alert" class="dropdown-item" data-key="t-sweet-alert">SweetAlert 2</a>
                                                        <a href="extended-rating" class="dropdown-item" data-key="t-rating">Rating</a>
                                                        <a href="extended-notifications" class="dropdown-item" data-key="t-notifications">Notifications</a>
                                                        <a href="extended-swiperslider" class="dropdown-item" data-key="t-swiperslider">Swiper Slider</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                                    <i class="bx bx-customize icon"></i>
                                    <span data-key="t-apps">Apps</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-pages">

                                    <a href="apps-calendar" class="dropdown-item" data-key="t-calendar">Calendar</a>
                                    <a href="apps-chat" class="dropdown-item" data-key="t-chat">Chat</a>
                                    <a href="apps-kanban-board" class="dropdown-item" data-key="t-kanban">Kanban Board</a>
                                    <a href="apps-file-manager" class="dropdown-item" data-key="t-filemanager">File Manager</a>

                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-ecommerce" role="button">
                                            <span data-key="t-ecommerce">Ecommerce</span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-ecommerce">
                                            <a href="ecommerce-products" class="dropdown-item" data-key="t-products">Products</a>
                                            <a href="ecommerce-product-detail" class="dropdown-item" data-key="t-product-detail">Product Detail</a>
                                            <a href="ecommerce-orders" class="dropdown-item" data-key="t-orders">Orders</a>
                                            <a href="ecommerce-customers" class="dropdown-item" data-key="t-customers">Customers</a>
                                            <a href="ecommerce-cart" class="dropdown-item" data-key="t-cart">Cart</a>
                                            <a href="ecommerce-checkout" class="dropdown-item" data-key="t-checkout">Checkout</a>
                                            <a href="ecommerce-shops" class="dropdown-item" data-key="t-shops">Shops</a>
                                            <a href="ecommerce-add-product" class="dropdown-item" data-key="t-add-product">Add Product</a>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-email" role="button">
                                            <span data-key="t-email">Email</span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-email">
                                            <a href="email-inbox" class="dropdown-item" data-key="t-inbox">Inbox</a>
                                            <a href="email-read" class="dropdown-item" data-key="t-read-email">Read Email</a>
                                        </div>
                                    </div>

                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-contact" role="button">
                                            <span data-key="t-contacts">Contacts</span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-contact">
                                            <a href="contacts-grid" class="dropdown-item" data-key="t-user-grid">User Grid</a>
                                            <a href="contacts-list" class="dropdown-item" data-key="t-user-list">User List</a>
                                            <a href="contacts-settings" class="dropdown-item" data-key="t-user-settings">User Settings</a>
                                        </div>
                                    </div>

                                    <a href="apps-gallery" class="dropdown-item" data-key="t-gallery">Gallery</a>


                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-projects" role="button">
                                            <span data-key="t-projects">Projects</span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-projects">
                                            <a href="projects-grid" class="dropdown-item" data-key="t-p-grid">Projects Grid</a>
                                            <a href="projects-list" class="dropdown-item" data-key="t-p-list">Projects List</a>
                                            <a href="projects-overview" class="dropdown-item" data-key="t-p-overview">Project Overview</a>
                                            <a href="projects-create" class="dropdown-item" data-key="t-create-new">Create New</a>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-components" role="button">
                                    <i class="bx bx-layer icon"></i>
                                    <span data-key="t-components">Components</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-components">
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-form" role="button">
                                            <span data-key="t-forms">Forms</span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-form">
                                            <a href="form-elements" class="dropdown-item" data-key="t-basic-elements">Basic Elements</a>
                                            <a href="form-validation" class="dropdown-item" data-key="t-validation">Validation</a>
                                            <a href="form-advanced" class="dropdown-item" data-key="t-advanced-plugins">Advanced Plugins</a>
                                            <a href="form-editors" class="dropdown-item" data-key="t-editors">Editors</a>
                                            <a href="form-uploads" class="dropdown-item" data-key="t-file-upload">File Upload</a>
                                            <a href="form-wizard" class="dropdown-item" data-key="t-wizard">Wizard</a>
                                            <a href="form-mask" class="dropdown-item" data-key="t-mask">Mask</a>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-table" role="button">
                                            <span data-key="t-tables">Tables</span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-table">
                                            <a href="tables-basic" class="dropdown-item" data-key="t-bootstrap-basic">Bootstrap Basic</a>
                                            <a href="tables-advanced" class="dropdown-item" data-key="t-advanced-tables">Advance Tables</a>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-charts" role="button">
                                            <span data-key="t-apex-charts">Apex Charts</span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-charts">
                                            <a href="charts-line" class="dropdown-item" data-key="t-line">Line</a>
                                            <a href="charts-area" class="dropdown-item" data-key="t-area">Area</a>
                                            <a href="charts-column" class="dropdown-item" data-key="t-column">Column</a>
                                            <a href="charts-bar" class="dropdown-item" data-key="t-bar">Bar</a>
                                            <a href="charts-mixed" class="dropdown-item" data-key="t-mixed">Mixed</a>
                                            <a href="charts-timeline" class="dropdown-item" data-key="t-timeline">Timeline</a>
                                            <a href="charts-candlestick" class="dropdown-item" data-key="t-candlestick">Candlestick</a>
                                            <a href="charts-boxplot" class="dropdown-item" data-key="t-boxplot">Boxplot</a>
                                            <a href="charts-bubble" class="dropdown-item" data-key="t-bubble">Bubble</a>
                                            <a href="charts-scatter" class="dropdown-item" data-key="t-scatter">Scatter</a>
                                            <a href="charts-heatmap" class="dropdown-item" data-key="t-heatmap">Heatmap</a>
                                            <a href="charts-treemap" class="dropdown-item" data-key="t-treemap">Treemap</a>
                                            <a href="charts-pie" class="dropdown-item" data-key="t-pie">Pie</a>
                                            <a href="charts-radialbar" class="dropdown-item" data-key="t-radialbar">Radialbar</a>
                                            <a href="charts-radar" class="dropdown-item" data-key="t-radar">Radar</a>
                                            <a href="charts-polararea" class="dropdown-item" data-key="t-polararea">Polararea</a>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-icons" role="button">
                                            <span data-key="t-icons">Icons</span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-icons">
                                            <a href="icons-unicons" class="dropdown-item" data-key="t-unicons">Unicons</a>
                                            <a href="icons-feathericons" class="dropdown-item" data-key="t-feather-icons">Feather icons</a>
                                            <a href="icons-boxicons" class="dropdown-item" data-key="t-boxicons">Boxicons</a>
                                            <a href="icons-materialdesign" class="dropdown-item" data-key="t-material-design">Material Design</a>
                                            <a href="icons-fontawesome" class="dropdown-item" data-key="t-font-awesome">Font Awesome 5</a>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-map" role="button">
                                            <span data-key="t-maps">Maps</span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-map">
                                            <a href="maps-google" class="dropdown-item" data-key="t-google">Google</a>
                                            <a href="maps-vector" class="dropdown-item" data-key="t-vector">Vector</a>
                                            <a href="maps-leaflet" class="dropdown-item" data-key="t-leaflet">Leaflet</a>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-more" role="button">
                                    <i class="bx bx-file icon"></i>
                                    <span data-key="t-pages">Pages</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-more">
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-pricing" role="button">
                                            <span data-key="t-pricing">Pricing</span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-pricing">
                                            <a href="pricing-basic" class="dropdown-item" data-key="t-basic">Basic</a>
                                            <a href="pricing-table" class="dropdown-item" data-key="t-table">table</a>
                                        </div>
                                    </div>

                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-invoices" role="button">
                                            <span data-key="t-invoices">Invoices</span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-invoices">
                                            <a href="invoices-list" class="dropdown-item" data-key="t-invoice-list">Invoice List</a>
                                            <a href="invoices-detail" class="dropdown-item" data-key="t-invoice-detail">Invoice Detail</a>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-timeline" role="button">
                                            <span data-key="t-timeline">Timeline</span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-timeline">
                                            <a href="timeline-center" class="dropdown-item" data-key="t-center-view">Center View</a>
                                            <a href="timeline-left" class="dropdown-item" data-key="t-left-view">Left View</a>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-auth" role="button">
                                            <span data-key="t-authentication">Authentication</span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-auth">
                                            <div class="dropdown">
                                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-auth-basic" role="button">
                                                    <span data-key="t-basic">Basic</span>
                                                    <div class="arrow-down"></div>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="topnav-auth-basic">
                                                    <a href="auth-signin-basic" class="dropdown-item" data-key="t-signin">Sign In</a>
                                                    <a href="auth-signup-basic" class="dropdown-item" data-key="t-signup">Sign Up</a>
                                                    <a href="auth-signout-basic" class="dropdown-item" data-key="t-signout">Sign Out</a>
                                                    <a href="auth-lockscreen-basic" class="dropdown-item" data-key="t-lock-screen">Lock Screen</a>
                                                    <a href="auth-forgotpassword-basic" class="dropdown-item" data-key="t-forgot-password">Forgot Password</a>
                                                    <a href="auth-resetpassword-basic" class="dropdown-item" data-key="t-reset-password">Reset Password</a>
                                                    <a href="auth-emailverification-basic" class="dropdown-item" data-key="t-email-verification">Email Verification</a>
                                                    <a href="auth-2step-basic" class="dropdown-item" data-key="t-2step-verification">2-step Verification</a>
                                                    <a href="auth-thankyou-basic" class="dropdown-item" data-key="t-thankyou">Thank you</a>
                                                </div>
                                            </div>
                                            <div class="dropdown">
                                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-auth-cover" role="button">
                                                    <span data-key="t-cover">Cover</span>
                                                    <div class="arrow-down"></div>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="topnav-auth-cover">
                                                    <a href="auth-signin-cover" class="dropdown-item" data-key="t-signin">Sign In</a>
                                                    <a href="auth-signup-cover" class="dropdown-item" data-key="t-signup">Sign Up</a>
                                                    <a href="auth-signout-cover" class="dropdown-item" data-key="t-signout">Sign Out</a>
                                                    <a href="auth-lockscreen-cover" class="dropdown-item" data-key="t-lock-screen">Lock Screen</a>
                                                    <a href="auth-forgotpassword-cover" class="dropdown-item" data-key="t-forgot-password">Forgot Password</a>
                                                    <a href="auth-resetpassword-cover" class="dropdown-item" data-key="t-reset-password">Reset Password</a>
                                                    <a href="auth-emailverification-cover" class="dropdown-item" data-key="t-email-verification">Email Verification</a>
                                                    <a href="auth-2step-cover" class="dropdown-item" data-key="t-2step-verification">2-step Verification</a>
                                                    <a href="auth-thankyou-cover" class="dropdown-item" data-key="t-thankyou">Thank you</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-error" role="button">
                                            <span data-key="t-error-pages">Error Pages</span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-error">
                                            <div class="dropdown">
                                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-404" role="button">
                                                    <span>404</span>
                                                    <div class="arrow-down"></div>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="topnav-404">
                                                    <a href="error-404-basic" class="dropdown-item" data-key="t-basic">Basic</a>
                                                    <a href="error-404-cover" class="dropdown-item" data-key="t-cover">Cover</a>
                                                </div>
                                            </div>
                                            <div class="dropdown">
                                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-500" role="button">
                                                    <span>500</span>
                                                    <div class="arrow-down"></div>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="topnav-500">
                                                    <a href="error-500-basic" class="dropdown-item" data-key="t-basic">Basic</a>
                                                    <a href="error-500-cover" class="dropdown-item" data-key="t-cover">Cover</a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-utility" role="button">
                                            <span data-key="t-utility">Utility</span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-utility">
                                            <a href="pages-starter" class="dropdown-item" data-key="t-starter-page">Starter Page</a>
                                            <a href="pages-profile" class="dropdown-item" data-key="t-profile">Profile</a>
                                            <a href="pages-maintenance" class="dropdown-item" data-key="t-maintenance">Maintenance</a>
                                            <a href="pages-comingsoon" class="dropdown-item" data-key="t-coming-soon">Coming Soon</a>
                                            <a href="pages-faqs" class="dropdown-item" data-key="t-faqs">FAQs</a>
                                        </div>
                                    </div>

                                    <a href="layout-vertical" class="dropdown-item" data-key="t-vertical">Vertical</a>
                                </div>
                            </li>

                        </ul>
                    </div>
                </nav>
            </div>

        </div>

        <div class="d-flex">
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-search icon-sm"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0">
                    <form class="p-2">
                        <div class="search-box">
                            <div class="position-relative">
                                <input type="text" class="form-control rounded bg-light border-0" placeholder="Search...">
                                <i class="bx bx-search search-icon"></i>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="dropdown d-inline-block language-switch">
                <button type="button" class="btn header-item noti-icon" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img id="header-lang-img" src="assets/images/flags/us.jpg" alt="Header Language" height="16">
                </button>
                <div class="dropdown-menu dropdown-menu-end">

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item language" onclick="changeAppLanguage(this,'en')" >
                        <img src="assets/images/flags/us.jpg" alt="user-image" class="me-2" height="12"> <span class="align-middle">English</span>
                    </a>
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item language"  onclick="changeAppLanguage(this,'ar')" >
                        <img src="assets/images/flags/spain.jpg" alt="user-image" class="me-2" height="12"> <span class="align-middle">Arabic</span>
                    </a>

                    {{-- <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="gr">
                        <img src="assets/images/flags/germany.jpg" alt="user-image" class="me-2" height="12"> <span class="align-middle">German</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="it">
                        <img src="assets/images/flags/italy.jpg" alt="user-image" class="me-2" height="12"> <span class="align-middle">Italian</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="ru">
                        <img src="assets/images/flags/russia.jpg" alt="user-image" class="me-2" height="12"> <span class="align-middle">Russian</span>
                    </a> --}}
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-bell icon-sm"></i>
                    <span class="noti-dot bg-danger rounded-pill">3</span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="m-0 font-size-15"> Notifications </h5>
                            </div>
                            <div class="col-auto">
                                <a href="javascript:void(0);" class="small"> Mark all as read</a>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 250px;">
                        <h6 class="dropdown-header bg-light">New</h6>
                        <a href="" class="text-reset notification-item">
                            <div class="d-flex border-bottom align-items-start">
                                <div class="flex-shrink-0">
                                    <img src="assets/images/users/avatar-3.jpg" class="me-3 rounded-circle avatar-sm" alt="user-pic">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Justin Verduzco</h6>
                                    <div class="text-muted">
                                        <p class="mb-1 font-size-13">Your task changed an issue from "In Progress" to <span class="badge badge-soft-success">Review</span></p>
                                        <p class="mb-0 font-size-10 text-uppercase fw-bold"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="" class="text-reset notification-item">
                            <div class="d-flex border-bottom align-items-start">
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm me-3">
                                        <span class="avatar-title bg-primary rounded-circle font-size-16">
                                            <i class="uil-shopping-basket"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">New order has been placed</h6>
                                    <div class="text-muted">
                                        <p class="mb-1 font-size-13">Open the order confirmation or shipment confirmation.</p>
                                        <p class="mb-0 font-size-10 text-uppercase fw-bold"><i class="mdi mdi-clock-outline"></i> 5 hours ago</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <h6 class="dropdown-header bg-light">Earlier</h6>
                        <a href="" class="text-reset notification-item">
                            <div class="d-flex border-bottom align-items-start">
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm me-3">
                                        <span class="avatar-title bg-soft-success text-success rounded-circle font-size-16">
                                            <i class="uil-truck"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Your item is shipped</h6>
                                    <div class="text-muted">
                                        <p class="mb-1 font-size-13">Here is somthing that you might light like to know.</p>
                                        <p class="mb-0 font-size-10 text-uppercase fw-bold"><i class="mdi mdi-clock-outline"></i> 1 day ago</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="" class="text-reset notification-item">
                            <div class="d-flex border-bottom align-items-start">
                                <div class="flex-shrink-0">
                                    <img src="assets/images/users/avatar-4.jpg" class="me-3 rounded-circle avatar-sm" alt="user-pic">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Salena Layfield</h6>
                                    <div class="text-muted">
                                        <p class="mb-1 font-size-13">Yay ! Everything worked!</p>
                                        <p class="mb-0 font-size-10 text-uppercase fw-bold"><i class="mdi mdi-clock-outline"></i> 3 days ago</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="p-2 border-top d-grid">
                        <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="javascript:void(0)">
                            <i class="uil-arrow-circle-right me-1"></i> <span>View More..</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon right-bar-toggle" id="right-bar-toggle">
                    <i class="bx bx-cog icon-sm"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item user text-start d-flex align-items-center" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="assets/images/users/avatar-3.jpg" alt="Header Avatar">
                    <span class="ms-2 d-none d-xl-inline-block user-item-desc">
                        <span class="user-name">{{ Auth::user()->name }}<i class="mdi mdi-chevron-down"></i></span>
                    </span>
                </button>
                <div class="dropdown-menu dropdown-menu-end pt-0">
                    <h6 class="dropdown-header">{{ Auth::user()->name }}</h6>
                    <a class="dropdown-item" href="pages-profile"><i class="mdi mdi-account-circle text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Profile</span></a>
                    <a class="dropdown-item" href="users"><i class="mdi mdi-account-circle text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Users</span></a>
                    <a class="dropdown-item" href="apps-chat"><i class="mdi mdi-message-text-outline text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Messages</span></a>
                    <a class="dropdown-item" href="apps-kanban-board"><i class="mdi mdi-calendar-check-outline text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Taskboard</span></a>
                    <a class="dropdown-item" href="pages-faqs"><i class="mdi mdi-lifebuoy text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Help</span></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"><i class="mdi mdi-wallet text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Balance : <b>$6951.02</b></span></a>
                    <a class="dropdown-item d-flex align-items-center" href="contacts-settings"><i class="mdi mdi-cog-outline text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Settings</span><span class="badge badge-soft-success ms-auto">New</span></a>
                    <a class="dropdown-item" href="auth-lockscreen-cover"><i class="mdi mdi-lock text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Lock screen</span></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="">
                                        @csrf
                    <button type="submit" class="dropdown-item" href="auth-signout-cover"><i class="mdi mdi-logout text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Logout</span></button>
                                    </form>
                    
                </div>
            </div>
        </div>
    </div>

    <div class="collapse show dash-content" id="dashtoggle">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                {{-- <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0">Welcome !</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Welcome !</li>
                                    </ol>
                                </div>

                            </div>
                        </div> --}}
                @yield('breadcrumb')
            </div>

            {{-- @extends('components.breadcrumb') --}}
            <!-- end page title -->

            <!-- start dash info -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card dash-header-box shadow-none border-0">
                        <div class="card-body p-0">
                            <div class="row row-cols-xxl-6 row-cols-md-3 row-cols-1 g-0">
                                <div class="col">
                                    <div class="mt-md-0 py-3 px-4 mx-2">
                                        <p class="text-white-50 mb-2 text-truncate">Campaign Sent </p>
                                        <h3 class="text-white mb-0">197</h3>
                                    </div>
                                </div><!-- end col -->

                                <div class="col">
                                    <div class="mt-3 mt-md-0 py-3 px-4 mx-2">
                                        <p class="text-white-50 mb-2 text-truncate">Annual Profit</p>
                                        <h3 class="text-white mb-0">$489.4k</h3>
                                    </div>
                                </div><!-- end col -->

                                <div class="col">
                                    <div class="mt-3 mt-md-0 py-3 px-4 mx-2">
                                        <p class="text-white-50 mb-2 text-truncate">Lead Coversation</p>
                                        <h3 class="text-white mb-0">32.89%</h3>
                                    </div>
                                </div><!-- end col -->

                                <div class="col">
                                    <div class="mt-3 mt-md-0 py-3 px-4 mx-2">
                                        <p class="text-white-50 mb-2 text-truncate">Sales Forecast</p>
                                        <h3 class="text-white mb-0">75.35%</h3>
                                    </div>
                                </div><!-- end col -->

                                <div class="col">
                                    <div class="mt-3 mt-lg-0 py-3 px-4 mx-2">
                                        <p class="text-white-50 mb-2 text-truncate">Daily Average Income</p>
                                        <h3 class="text-white mb-0">$1,596.5</h3>
                                    </div>
                                </div><!-- end col -->

                                <div class="col">
                                    <div class="mt-3 mt-lg-0 py-3 px-4 mx-2">
                                        <p class="text-white-50 mb-2 text-truncate">Annual Deals</p>
                                        <h3 class="text-white mb-0">2,659</h3>
                                    </div>
                                </div><!-- end col -->

                            </div><!-- end row -->
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div>
            <!-- end dash info -->
        </div>
    </div>

    <!-- start dash troggle-icon -->
    <div>
        <a class="dash-troggle-icon" id="dash-troggle-icon" data-bs-toggle="collapse" href="#dashtoggle" aria-expanded="true" aria-controls="dashtoggle">
            <i class="bx bx-up-arrow-alt"></i>
        </a>
    </div>
    <!-- end dash troggle-icon -->

</header>

<div class="hori-overlay"></div>

@section('script')

<script>

    function changeAppLanguage(e, lang ){
        console.log(lang);
    }
    </script>
@endsection