<!DOCTYPE html>
<!-- unused -->
<html data-scompiler-id="0" dir="ltr" lang="en">



<head>
    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-VFP42SKZDY"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-VFP42SKZDY');
</script>

    <meta charset="UTF-8">

    <meta content="width=device-width, initial-scale=1" name="viewport">

    <meta content="telephone=no" name="format-detection">

    <title>Arbortrue Laboratoires Dashboard </title><!-- icon -->

    <link href="{{asset('images/logo.png')}}" rel="icon" type="image/png"><!-- fonts -->

    <link rel="stylesheet" href="{{asset('backend/vendors/bootstrap/dist/css/bootstrap.min.css')}}">

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet"><!-- css -->

    <link href="{{ asset('vendor/bootstrap/css/bootstrap.ltr.css')}}" rel="stylesheet">

    <link href="{{ asset('vendor/highlight.js/styles/github.css')}}" rel="stylesheet">

    <link href="{{ asset('vendor/simplebar/simplebar.min.css')}}" rel="stylesheet">

    <link href="{{ asset('vendor/quill/quill.snow.css')}}" rel="stylesheet">

    <link href="{{ asset('vendor/air-datepicker/css/datepicker.min.css')}}" rel="stylesheet">

    <link href="{{ asset('vendor/select2/css/select2.min.css')}}" rel="stylesheet">

    <link href="{{ asset('vendor/datatables/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet">

    <link href="{{ asset('vendor/nouislider/nouislider.min.css')}}" rel="stylesheet">

    <link href="{{ asset('vendor/fullcalendar/main.min.css')}}" rel="stylesheet">

    <link href="{{ asset('css/style.css')}}" rel="stylesheet">

    <!-- for Modal -->

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->

    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->

    <!--  -->
    <link href="{{asset('images/logo/logo-White.png')}}" sizes="128x128" rel="shortcut icon" type="image/x-icon" />

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-97489509-8">

    </script>

    <script>

           window.dataLayer = window.dataLayer || [];

           function gtag(){dataLayer.push(arguments);}

           gtag('js', new Date());



           gtag('config', 'UA-97489509-8');

    </script>

    

</head>

<body>

    <!-- sa-app -->

    <div class="sa-app sa-app--desktop-sidebar-shown sa-app--mobile-sidebar-hidden sa-app--toolbar-fixed">

        <!-- sa-app__sidebar -->

        <div class="sa-app__sidebar">

            <div class="sa-sidebar">

                <div class="sa-sidebar__header">

                    <a class="sa-sidebar__logo" href="/"><!-- logo -->

                    <div class="sa-sidebar-logo">

                        <img width="150px" src="<?php echo url('/') ?>/images/logo.png">

                    </div><!-- logo / end --></a>

                </div>

                <div class="sa-sidebar__body" data-simplebar="">

                    <ul class="sa-nav sa-nav--sidebar" data-sa-collapse="">

                        <li class="sa-nav__section">

                            <div class="sa-nav__section-title">

                                <span>Application</span>

                            </div>

                            <ul class="sa-nav__menu sa-nav__menu--root">

                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">

                                    <a class="sa-nav__link" href="{{route('admin.dashboard.index')}}"><span class="sa-nav__icon">

                                        <svg height="1em" viewbox="0 0 16 16" width="1em" xmlns="http://www.w3.org/2000/svg">

                                    <path d="M8,13.1c-4.4,0-8,3.4-8-3C0,5.6,3.6,2,8,2s8,3.6,8,8.1C16,16.5,12.4,13.1,8,13.1zM8,4c-3.3,0-6,2.7-6,6c0,4,2.4,0.9,5,0.2C7,9.9,7.1,9.5,7.4,9.2l3-2.3c0.4-0.3,1-0.2,1.3,0.3c0.3,0.5,0.2,1.1-0.2,1.4l-2.2,1.7c2.5,0.9,4.8,3.6,4.8-0.2C14,6.7,11.3,4,8,4z"></path>

                                </svg></span><span class="sa-nav__title">Dashboard</span></a>

                                </li>

                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon" data-sa-collapse-item="sa-nav__menu-item--open">

                                    <a class="sa-nav__link" href="{{route('admin.category.create')}}"><span class="sa-nav__icon"><i class="fas fa-cubes"></i>

                                        </span><span class="sa-nav__title">Create Category</span></a>

                                  

                                </li>

                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon" data-sa-collapse-item="sa-nav__menu-item--open">

                                    <a class="sa-nav__link" href="{{route('admin.category.index')}}"><span class="sa-nav__icon"><i class="fas fa-cube"></i>

                                       </span><span class="sa-nav__title">Category List</span></a>

                                  

                                </li>

                                 <li class="sa-nav__menu-item sa-nav__menu-item--has-icon" data-sa-collapse-item="sa-nav__menu-item--open">

                                    <a class="sa-nav__link" href="{{route('admin.product.create')}}"><span class="sa-nav__icon"><i class="fas fa-box"></i>

                                        </span><span class="sa-nav__title">Add Product </span></a>

                                  

                                </li>

                                

                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon" data-sa-collapse-item="sa-nav__menu-item--open">

                                    <a class="sa-nav__link" href="{{route('admin.product.index')}}"><span class="sa-nav__icon"><i class="fas fa-box-open"></i>

                                        </span><span class="sa-nav__title">Products List</span></a>

                                  

                                </li>

                              

                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon" data-sa-collapse-item="sa-nav__menu-item--open">

                                    <a class="sa-nav__link" href="{{route('admin.order.index')}}"><span class="sa-nav__icon"><i class="	fas fa-cart-arrow-down"></i>

                                      </span><span class="sa-nav__title">Orders List</span></a>

                                  

                                </li>



                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">

                                    <a class="sa-nav__link" href="{{route('admin.invoice.index')}}"><span class="sa-nav__icon"><i class="fas fa-file-alt"></i></span><span class="sa-nav__title">Invoice</span></a>

                                </li>



                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">

                                    <a class="sa-nav__link" href="{{route('admin.user.index')}}"><span class="sa-nav__icon"><i class="fas fa-user-alt"></i></span><span class="sa-nav__title">Users</span></a>

                                </li>

                                

                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon" data-sa-collapse-item="sa-nav__menu-item--open">

                                    <a class="sa-nav__link" href="{{route('admin.settings.index')}}"><span class="sa-nav__icon"><svg height="1em" viewbox="0 0 16 16" width="1em" xmlns="http://www.w3.org/2000/svg">

                                    <path d="M14,6.8l-0.2,0.1C14,7.3,14,7.6,14,8c0,0.4,0,0.7-0.1,1.1L14,9.2c1,0.6,1.4,1.9,0.8,3c-0.5,0.9-1.6,1.2-2.5,0.7l-0.5-0.3c-0.6,0.5-1.2,0.8-1.9,1.1v0.8c0,0.9-0.7,1.6-1.6,1.6H7.6C6.7,16,6,15.3,6,14.4v-0.8c-0.7-0.2-1.3-0.6-1.9-1.1l-0.5,0.3c-0.9,0.5-2,0.2-2.5-0.7c-0.6-1-0.3-2.4,0.8-3l0.2-0.1C2,8.7,2,8.4,2,8c0-0.4,0-0.7,0.1-1.1L2,6.8c-1.1-0.6-1.4-2-0.8-3C1.7,3,2.8,2.7,3.6,3.2l0.5,0.3C4.7,3,5.3,2.6,6,2.4V1.6C6,0.7,6.7,0,7.6,0h0.8C9.3,0,10,0.7,10,1.6v0.8c0.7,0.2,1.3,0.6,1.9,1.1l0.5-0.3c0.9-0.5,2-0.2,2.5,0.7C15.4,4.9,15.1,6.2,14,6.8z M8,5.5C6.6,5.5,5.5,6.6,5.5,8s1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5S9.4,5.5,8,5.5z"></path></svg></span><span class="sa-nav__title">Settings</span></a>

                                    

                                </li>





                            </ul>

                        </li>

                       

                        

                    </ul>

                </div>

            </div>

            <div class="sa-app__sidebar-shadow"></div>

            <div class="sa-app__sidebar-backdrop" data-sa-close-sidebar=""></div>

        </div>

        <!-- sa-app__sidebar / end -->



  <!-- sa-app__content -->

        <div class="sa-app__content">

            <!-- sa-app__toolbar -->

            <div class="sa-toolbar sa-toolbar--search-hidden sa-app__toolbar">

                <div class="sa-toolbar__body">

                    <div class="sa-toolbar__item">

                        <button aria-label="Menu" class="sa-toolbar__button" data-sa-toggle-sidebar="" type="button"><svg height="20" viewbox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg">

                        <path d="M1,11V9h18v2H1z M1,3h18v2H1V3z M15,17H1v-2h14V17z"></path></svg></button>

                    </div>

                    <!-- <div class="sa-toolbar__item sa-toolbar__item--search">

                        <form class="sa-search sa-search--state--pending">

                            <div class="sa-search__body">

                                <label class="visually-hidden" for="input-search">Search for:</label>

                                <div class="sa-search__icon">

                                    <svg height="1em" viewbox="0 0 16 16" width="1em" xmlns="http://www.w3.org/2000/svg">

                                    <path d="M16.243 14.828C16.243 14.828 16.047 15.308 15.701 15.654C15.34 16.015 14.828 16.242 14.828 16.242L10.321 11.736C9.247 12.522 7.933 13 6.5 13C2.91 13 0 10.09 0 6.5C0 2.91 2.91 0 6.5 0C10.09 0 13 2.91 13 6.5C13 7.933 12.522 9.247 11.736 10.321L16.243 14.828ZM6.5 2C4.015 2 2 4.015 2 6.5C2 8.985 4.015 11 6.5 11C8.985 11 11 8.985 11 6.5C11 4.015 8.985 2 6.5 2Z"></path></svg>

                                </div><input autocomplete="off" class="sa-search__input" id="input-search" placeholder="Search for the truth" type="text"><button aria-label="Close search" class="sa-search__cancel d-sm-none" type="button"><svg height="12" viewbox="0 0 12 12" width="12" xmlns="http://www.w3.org/2000/svg">

                                <path d="M10.8,10.8L10.8,10.8c-0.4,0.4-1,0.4-1.4,0L6,7.4l-3.4,3.4c-0.4,0.4-1,0.4-1.4,0l0,0c-0.4-0.4-0.4-1,0-1.4L4.6,6L1.2,2.6 c-0.4-0.4-0.4-1,0-1.4l0,0c0.4-0.4,1-0.4,1.4,0L6,4.6l3.4-3.4c0.4-0.4,1-0.4,1.4,0l0,0c0.4,0.4,0.4,1,0,1.4L7.4,6l3.4,3.4 C11.2,9.8,11.2,10.4,10.8,10.8z"></path></svg></button>

                                <div class="sa-search__field"></div>

                            </div>

                            <div class="sa-search__dropdown">

                                <div class="sa-search__dropdown-loader"></div>

                                <div class="sa-search__dropdown-wrapper">

                                    <div class="sa-search__suggestions sa-suggestions"></div>

                                    <div class="sa-search__help sa-search__help--type--no-results">

                                        <div class="sa-search__help-title">

                                            No results for &quot;<span class="sa-search__query"></span>&quot;

                                        </div>

                                        <div class="sa-search__help-subtitle">

                                            Make sure that all words are spelled correctly.

                                        </div>

                                    </div>

                                    <div class="sa-search__help sa-search__help--type--greeting">

                                        <div class="sa-search__help-title">

                                            Start typing to search for

                                        </div>

                                        <div class="sa-search__help-subtitle">

                                            Products, orders, customers, actions, etc.

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="sa-search__backdrop"></div>

                        </form>

                    </div> -->

                    <div class="mx-auto"></div>

                    <div class="sa-toolbar__item d-sm-none">

                        <button aria-label="Show search" class="sa-toolbar__button" data-sa-action="show-search" type="button"><svg height="1em" viewbox="0 0 16 16" width="1em" xmlns="http://www.w3.org/2000/svg">

                        <path d="M16.243 14.828C16.243 14.828 16.047 15.308 15.701 15.654C15.34 16.015 14.828 16.242 14.828 16.242L10.321 11.736C9.247 12.522 7.933 13 6.5 13C2.91 13 0 10.09 0 6.5C0 2.91 2.91 0 6.5 0C10.09 0 13 2.91 13 6.5C13 7.933 12.522 9.247 11.736 10.321L16.243 14.828ZM6.5 2C4.015 2 2 4.015 2 6.5C2 8.985 4.015 11 6.5 11C8.985 11 11 8.985 11 6.5C11 4.015 8.985 2 6.5 2Z"></path></svg></button>

                    </div>

                    

                   

                    <div class="dropdown sa-toolbar__item">

                        <button aria-expanded="false" class="sa-toolbar-user" data-bs-offset="0,1" data-bs-toggle="dropdown" id="dropdownMenuButton" type="button"><span class="sa-toolbar-user__avatar sa-symbol sa-symbol--shape--rounded"><img alt="" height="64" src="{{ asset('storage/app/product/' . auth()->user()->image) }}" width="64"></span><span class="sa-toolbar-user__info"><span class="sa-toolbar-user__title">{{auth()->user()->name}}</span><span class="sa-toolbar-user__subtitle">{{auth()->user()->email}}</span></span></button>

                        <ul aria-labelledby="dropdownMenuButton" class="dropdown-menu w-100">

                            <li>

                                <a class="dropdown-item" href="{{route('admin.profile.index')}}">Profile</a>

                            </li>

                            <!-- <li>

                                <a class="dropdown-item" href="app-inbox-list.html">Inbox</a>

                            </li>

                            <li>

                                <a class="dropdown-item" href="app-settings-toc.html">Settings</a>

                            </li> -->

                            <li>

                                <hr class="dropdown-divider">

                            </li>

                            <li>

                                <a class="dropdown-item" href="{{ route('logout') }}"

                                        onclick="event.preventDefault();

                                        document.getElementById('logout-form').submit();">Sign Out</a>

                            </li>

                        </ul>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">

                        @csrf

                        </form>

                    </div>

                </div>

                <div class="sa-toolbar__shadow"></div>

            </div>



            <!-- sa-app__toolbar / end -->