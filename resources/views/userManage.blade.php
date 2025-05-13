<!-- component -->
<!DOCTYPE html>
<html x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
    <!-- Favicon -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>

    <!-- Tombol Emergency Call -->
    <a href="tel:113" title="Hubungi Pemadam Kebakaran"
    class="fixed bottom-6 right-6 bg-red-600 hover:bg-red-700 text-white flex items-center gap-2 px-4 py-3 rounded-full shadow-lg z-50">
    <!-- Ikon Emergency -->
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M12 9v3m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
    <!-- Label -->
    <span class="font-semibold">Emergency Call</span>
    </a>

<body>
    <style>
    .button-custom {
      padding: 6px 12px;
      margin: 5px;
      cursor: pointer;
      width:15%;
    }
    .button-custom:hover{
        opacity:80%;
    }
    table {
      width: 100%;
      margin-top: 20px;
      border-collapse: collapse;
    }
    th, td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: center;
    }
    .modal {
      display: none;
      position: fixed;
      z-index: 999;
      left: 0; top: 0;
      width: 100%; height: 100%;
      background-color: rgba(0,0,0,0.4);
    }
    .modal-content {
      background-color: #fff;
      padding: 20px;
      width: 300px;
      margin: 100px auto;
      border-radius: 5px;
    }
    .modal input, .modal textarea {
      width: 100%;
      margin-bottom: 10px;
      padding: 8px;
    }
    </style>
    <div class="flex h-screen bg-gray-800 " :class="{ 'overflow-hidden': isSideMenuOpen }">

        <!-- Desktop sidebar -->
        <aside class="z-20 flex-shrink-0 hidden w-60 pl-3 overflow-y-auto bg-orange-700  md:block">
            <div>
                <div class="text-white">
                    <div class=" p-2  bg-orange-700 ">
                        <div class=" py-2 px-2 text-white flex flex-col items-center pt-5"> <p class=" ml-2 font-bold pt-5 pb-2 text-lg bg-gradient-to-r from-red-500 via-orange-400 to-yellow-400 bg-clip-text text-transparent"> FIRE DETECTOR MQ2</p>
                        <p class="ml-2 font-bold text-sm opacity-80"> LOGGED IN AS USER</p>
                    </div>
                    </div>
                    <div class="flex justify-center items-center">
                        <div class="flex justify-center items-center flex-col">
                        <img id="userProfileImage" class="hidden h-24 w-24 rounded-full sm:block object-cover mr-2 border-4 border-white" src="" alt="Profile Image">
                        <p class="font-semibold text-base text-white pt-2 text-center w-40 pb-5">{{ session('displayName') }}</p>
                        </div>
                    </div>

                    <div>
                        <ul class="mt-6 leading-10">
                            <li class="relative px-2 py-1 ">
                                <a class="inline-flex items-center w-full text-sm font-semibold text-white transition-colors duration-150 cursor-pointer hover:text-orange-300" 
                                    href="/userDashboard">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    <span class="ml-4">DASHBOARD</span>
                                </a>
                            </li>
                            <li class="relative px-2 py-1 ">
                                <a class="inline-flex items-center w-full text-sm font-semibold text-white transition-colors duration-150 cursor-pointer hover:text-orange-300" 
                                    href="/userData">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 3v18h18M9 17v-6M15 17V9" />
                                    </svg>
                                    <span class="ml-4">DATA</span>
                                </a>
                            </li>
                            <li class="relative px-2 py-1 ">
                                <a class="inline-flex items-center w-full text-sm font-semibold text-white transition-colors duration-150 cursor-pointer hover:text-orange-300" 
                                    href="/userManage">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 20h16M6 16v-4M10 16v-8M14 16v-2M18 16v-6" />
                                    </svg>

                                    <span class="ml-4">TRESHOLD</span>
                                </a>
                            </li>
                            <li class="relative px-2 py-1 ">
                                <a class="inline-flex items-center w-full text-sm font-semibold text-white transition-colors duration-150 cursor-pointer hover:text-orange-300" 
                                    href="/userHistory">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>


                                    <span class="ml-4">HISTORY</span>
                                </a>
                            </li>
                            <li class="relative px-2 py-1 ">
                            <div class="mo-fire">
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    width="100px" height="120px" viewBox="0 0 125 189.864" enable-background="new 0 0 125 189.864" xml:space="preserve">
                                <path class="flame-main" fill="#F36E21" d="M76.553,186.09c0,0-10.178-2.976-15.325-8.226s-9.278-16.82-9.278-16.82s-0.241-6.647-4.136-18.465
                                    c0,0,3.357,4.969,5.103,9.938c0,0-5.305-21.086,1.712-30.418c7.017-9.333,0.571-35.654-2.25-37.534c0,0,13.07,5.64,19.875,47.54
                                    c6.806,41.899,16.831,45.301,6.088,53.985"/>
                                <path class="flame-main one" fill="#F6891F" d="M61.693,122.257c4.117-15.4,12.097-14.487-11.589-60.872c0,0,32.016,10.223,52.601,63.123
                                    c20.585,52.899-19.848,61.045-19.643,61.582c0.206,0.537-19.401-0.269-14.835-18.532S57.576,137.656,61.693,122.257z"/>
                                <path class="flame-main two" fill="#FFD04A" d="M81.657,79.192c0,0,11.549,24.845,3.626,40.02c-7.924,15.175-21.126,41.899-0.425,64.998
                                    C84.858,184.21,125.705,150.905,81.657,79.192z"/>
                                <path class="flame-main three" fill="#FDBA16" d="M99.92,101.754c0,0-23.208,47.027-12.043,80.072c0,0,32.741-16.073,20.108-45.79
                                    C95.354,106.319,99.92,114.108,99.92,101.754z"/>
                                <path class="flame-main four" fill="#F36E21" d="M103.143,105.917c0,0,8.927,30.753-1.043,46.868c-9.969,16.115-14.799,29.041-14.799,29.041
                                    S134.387,164.603,103.143,105.917z"/>
                                <path class="flame-main five" fill="#FDBA16" d="M62.049,104.171c0,0-15.645,67.588,10.529,77.655C98.753,191.894,69.033,130.761,62.049,104.171z"/>
                                <path class="flame" fill="#F36E21" d="M101.011,112.926c0,0,8.973,10.519,4.556,16.543C99.37,129.735,106.752,117.406,101.011,112.926z"/>
                                <path class="flame one" fill="#F36E21" d="M55.592,126.854c0,0-3.819,13.29,2.699,16.945C64.038,141.48,55.907,132.263,55.592,126.854z"/>
                                <path class="flame two" fill="#F36E21" d="M54.918,104.595c0,0-3.959,6.109-1.24,8.949C56.93,113.256,52.228,107.329,54.918,104.595z"/>
                                </svg>
                            </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Mobile sidebar -->
        <!-- Backdrop -->
        <div x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-10 flex items-end bg-stone-800 bg-opacity-50 sm:items-center sm:justify-center"></div>

        <aside
            class="fixed inset-y-0 z-20 flex-shrink-0 w-full mt-16 overflow-y-auto  bg-red-700 dark:bg-red-700 md:hidden"
            x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
            x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="closeSideMenu"
            @keydown.escape="closeSideMenu">
            <div>
            <div class="text-white">
                    <div class=" p-2  bg-red-700 ">
                        <div class=" py-3 px-2 text-white flex flex-col items-center"> <p class=" ml-2 font-bold pt-5 pb-2 text-lg bg-gradient-to-r from-red-500 via-orange-400 to-yellow-400 bg-clip-text text-transparent"> FIRE DETECTOR MQ2</p>
                        <p class="ml-2 font-bold text-sm opacity-80"> LOGGED IN AS ADMIN</p>
                    </div>
                    </div>
                    <div class="flex justify-center items-center">
                        <div class="flex justify-center items-center flex-col">
                        <p class="font-semibold text-base text-white pt-1 text-center w-40 pb-5">{{ session('displayName') }}</p>
                        </div>
                    </div>

                    <div class=" items-center">
                        <ul class="mt-6 leading-10 w-full flex flex-col gap-y-2">
                            <li class="relative px-2 py-1 bg-orange-800 border-1 border-red-950 pt-2">
                                <a class="inline-flex items-center w-full text-sm font-semibold text-white transition-colors duration-150 cursor-pointer hover:text-orange-300" 
                                    href="/userDashboard">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    <span class="ml-4">DASHBOARD</span>
                                </a>
                            </li>
                            <li class="relative px-2 py-1 bg-orange-800 border-1 border-red-950 pt-2">
                                <a class="inline-flex items-center w-full text-sm font-semibold text-white transition-colors duration-150 cursor-pointer hover:text-orange-300" 
                                    href="/userData">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 3v18h18M9 17v-6M15 17V9" />
                                    </svg>
                                    <span class="ml-4">DATA</span>
                                </a>
                            </li>
                            <li class="relative px-2 py-1 bg-orange-800 border-1 border-red-950 pt-2">
                                <a class="inline-flex items-center w-full text-sm font-semibold text-white transition-colors duration-150 cursor-pointer hover:text-orange-300" 
                                    href="/userManage">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 20h16M6 16v-4M10 16v-8M14 16v-2M18 16v-6" />
                                    </svg>

                                    <span class="ml-4">TRESHOLD</span>
                                </a>
                            </li>
                            <li class="relative px-2 py-1 bg-orange-800 border-1 border-red-950 pt-2">
                                <a class="inline-flex items-center w-full text-sm font-semibold text-white transition-colors duration-150 cursor-pointer hover:text-orange-300" 
                                    href="/userHistory">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>


                                    <span class="ml-4">HISTORY</span>
                                </a>
                            </li>
                            <li class="relative px-2 ">
                            <div class="mo-fire">
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    width="120px" height="120px" viewBox="0 0 125 189.864" enable-background="new 0 0 125 189.864" xml:space="preserve">
                                <path class="flame-main" fill="#F36E21" d="M76.553,186.09c0,0-10.178-2.976-15.325-8.226s-9.278-16.82-9.278-16.82s-0.241-6.647-4.136-18.465
                                    c0,0,3.357,4.969,5.103,9.938c0,0-5.305-21.086,1.712-30.418c7.017-9.333,0.571-35.654-2.25-37.534c0,0,13.07,5.64,19.875,47.54
                                    c6.806,41.899,16.831,45.301,6.088,53.985"/>
                                <path class="flame-main one" fill="#F6891F" d="M61.693,122.257c4.117-15.4,12.097-14.487-11.589-60.872c0,0,32.016,10.223,52.601,63.123
                                    c20.585,52.899-19.848,61.045-19.643,61.582c0.206,0.537-19.401-0.269-14.835-18.532S57.576,137.656,61.693,122.257z"/>
                                <path class="flame-main two" fill="#FFD04A" d="M81.657,79.192c0,0,11.549,24.845,3.626,40.02c-7.924,15.175-21.126,41.899-0.425,64.998
                                    C84.858,184.21,125.705,150.905,81.657,79.192z"/>
                                <path class="flame-main three" fill="#FDBA16" d="M99.92,101.754c0,0-23.208,47.027-12.043,80.072c0,0,32.741-16.073,20.108-45.79
                                    C95.354,106.319,99.92,114.108,99.92,101.754z"/>
                                <path class="flame-main four" fill="#F36E21" d="M103.143,105.917c0,0,8.927,30.753-1.043,46.868c-9.969,16.115-14.799,29.041-14.799,29.041
                                    S134.387,164.603,103.143,105.917z"/>
                                <path class="flame-main five" fill="#FDBA16" d="M62.049,104.171c0,0-15.645,67.588,10.529,77.655C98.753,191.894,69.033,130.761,62.049,104.171z"/>
                                <path class="flame" fill="#F36E21" d="M101.011,112.926c0,0,8.973,10.519,4.556,16.543C99.37,129.735,106.752,117.406,101.011,112.926z"/>
                                <path class="flame one" fill="#F36E21" d="M55.592,126.854c0,0-3.819,13.29,2.699,16.945C64.038,141.48,55.907,132.263,55.592,126.854z"/>
                                <path class="flame two" fill="#F36E21" d="M54.918,104.595c0,0-3.959,6.109-1.24,8.949C56.93,113.256,52.228,107.329,54.918,104.595z"/>
                                </svg>
                            </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>

        <div class="flex flex-col flex-1 w-full overflow-y-auto bg-gradient-to-r from-red-800 via-orange-800 to-yellow-500 0">
            <header class="z-40 py-4  bg-gradient-to-r from-red-800 via-orange-800 to-yellow-500  ">
                <div class="flex items-center justify-between h-8 px-6 mx-auto">
                    <!-- Mobile hamburger -->
                    <button class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple"
                        @click="toggleSideMenu" aria-label="Menu">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                    </button>

                    <!-- Search Input -->
                    <div class="flex justify-center  mt-2 mr-4">
                        <div class="relative flex w-full flex-wrap items-stretch mb-3">

                        </div>
                    </div>

                    <ul class="flex items-center flex-shrink-0 space-x-6">

                        <!-- Notifications menu -->
                        <li class="relative">
                            <template x-if="isNotificationsMenuOpen">
                                <ul x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                    @click.away="closeNotificationsMenu" @keydown.escape="closeNotificationsMenu"
                                    class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-orange-500 border border-orange-600 rounded-md shadow-md">
                                    <li class="flex">
                                        <a class="text-white inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800"
                                            href="#">
                                            <span>Messages</span>
                                            <span
                                                class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-600 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-600">
                                                13
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </template>
                        </li>

                        <!-- Profile menu -->
                        <li class="relative">
                            <button
                                class="p-2 bg-white text-orange-700 align-middle rounded-full hover:text-white hover:bg-red-600 focus:outline-none "
                                @click="toggleProfileMenu" @keydown.escape="closeProfileMenu" aria-label="Account"
                                aria-haspopup="true">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                            </button>
                            <template x-if="isProfileMenuOpen">
                                <ul x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                    @click.away="closeProfileMenu" @keydown.escape="closeProfileMenu"
                                    class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-red-600 border border-red-700 rounded-md shadow-md"
                                    aria-label="submenu">
                                    <li class="flex">
                                        <a class="text-white inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800" id="signout">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                            <span>Log out</span>
                                        </a>
                                    </li>
                                </ul>
                            </template>
                        </li>
                    </ul>

                </div>
            </header>
            <main class="px-4 sm:px-6 lg:px-8 py-10">
                <div class="grid gap-8 rounded-3xl bg-white border-4 border-orange-700 p-6 sm:p-8 lg:p-10">

                    <!-- Breadcrumb -->
                    <div class="flex items-center h-10">
                    <h2 class="text-sm sm:text-base md:text-lg font-semibold truncate opacity-80">/Page/Treshold Management</h2>
                    </div>

                    <!-- Heading -->
                    <div>
                    <h1 class="font-semibold text-2xl sm:text-3xl md:text-4xl">Treshold Management</h1>
                    <p class="font-light mt-2 text-sm sm:text-base">Watch out for your treshold notification!</p>
                    </div>

                    <!-- Card: Riwayat Notifikasi -->
                    <div class="bg-white shadow-md rounded-xl p-4 sm:p-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 gap-4">
                        <h2 class="text-xl sm:text-2xl font-semibold">Riwayat Notifikasi</h2>
                        <button id="clearNotifBtn" class="text-sm rounded-3xl bg-orange-500 text-white px-4 py-2 hover:opacity-80">Clear Notification</button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full table-auto border border-gray-300 rounded-lg text-sm sm:text-base">
                        <thead class="bg-orange-500 text-white">
                            <tr>
                            <th class="px-4 py-2">Waktu</th>
                            <th class="px-4 py-2">PPM</th>
                            <th class="px-4 py-2">Deskripsi</th>
                            <th class="px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="notificationTable" class="text-center"></tbody>
                        </table>
                    </div>
                    </div>
                    
                </div>
                </main>


        </div>
    </div>

        <script type="module">
    import { initializeApp } from "https://www.gstatic.com/firebasejs/11.6.0/firebase-app.js";
    import { getAuth, signOut } from "https://www.gstatic.com/firebasejs/11.6.0/firebase-auth.js";

    // 1. Firebase config kamu
    const firebaseConfig = {
        apiKey: "AIzaSyCPcA9PrXIV-9eH84APA8gbCYk9y3b8FfA",
        authDomain: "apps-1ca7f.firebaseapp.com",
        projectId: "apps-1ca7f",
        storageBucket: "apps-1ca7f.appspot.com",
        messagingSenderId: "522627139650",
        appId: "1:522627139650:web:81e6bbc25998fbe5a105db",
        measurementId: "G-QQH7TPZSYG"
    };

    // 2. Harus inisialisasi dulu
    const app = initializeApp(firebaseConfig);
    const auth = getAuth();

    // Wait until the DOM is fully loaded
    document.addEventListener('DOMContentLoaded', () => {
        // Use event delegation on a parent element
        document.body.addEventListener("click", function (event) {
        // Check if the clicked element is the signout button
        if (event.target && event.target.id === "signout") {
            signOut(auth)
            .then(() => {
                // Sign-out successful.
                window.location = '/signout';  // Redirect after sign-out
            })
            .catch((error) => {
                console.error("Sign out error:", error);
            });
        }
        });
    });
    </script>
    <script src="/js/dashboard2.js"></script>
    <script type="module" src="/js/data-manage.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>