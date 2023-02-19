<?php
session_start();
error_reporting(0);

include 'action/dbconn.php';

$email = $_SESSION['email']; ?>
<!DOCTYPE html>
<html lang="bg" class="overflow-x-hidden">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="keywords" content="услуги, почистване, оферти, къщи, офиси, салони, поръчки, Варна, Carpet Services, Carpet Serv, Carpet Service">
  <meta name="description" content="Carpet Services - Получете най-добрите услуги в областта на почистването.">

  <link rel="shortcut icon" href="images/title.png" />
  <link rel="stylesheet" href="css/app.css" />
  <link rel="stylesheet" href="css/alert.css" />
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/vue@3.2.47/dist/vue.global.js"></script>

  <title>Carpet Cleaning | Начало</title>

</head>

<body class="scroll-smooth">
  <div id="site-load" class="loader__wrap" role="alertdialog" aria-busy="true" aria-live="polite" aria-label="Loading…">
    <div class="loader" aria-hidden="true">
      <div class="loader__sq"></div>
      <div class="loader__sq"></div>
    </div>
  </div>

  <div id="app">
    <div class="w-full h-1 rounded-r-full fixed z-40 top-0 left-0 bg-blue-400" :style="{ width: progress }"></div>

    <div class="fixed z-30 right-4 bottom-4 w-10 h-10 hidden bg-blue-500 hover:bg-blue-600 lg:flex rounded-full justify-center items-center cursor-pointer transition-all shadow-box-2" v-show="scY > 300" @click="goTop">
      <svg fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-7 h-7 rounded-full -mt-0.5 text-white">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
      </svg>
    </div>

    <nav class="bg-white border-b border-slate-200 shadow-md sm:px-0 pt-3 md:py-3 top-0 sticky z-30">
      <div class="bg-white flex flex-wrap sm:px-5 md:px-6 lg:px-12 pb-3 md:pb-0 items-center justify-between">
        <a href="/" class="flex items-center pl-5 sm:pl-0">
          <img src="images/main-logo.png" class="h-7 mr-3 md:h-12" alt="Main logo" />
        </a>
        <div class="flex items-center pr-5 sm:pr-0">
          <svg fill="none" viewBox="0 0 24 24" stroke-width="1.4" stroke="currentColor" class="w-8 h-8 text-slate-700 cursor-pointer hover:opacity-75 transition-all md:hidden login-btn">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
          <img class="w-[26px] h-[25.5px] object-cover cursor-pointer hover:opacity-75 transition-all rounded-full md:hidden ml-2.5 mr-1" src="images/britain-flag.png" alt="english" />
          <button @click="hamburgerIcon = !hamburgerIcon" id="open-nav-bar" data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 pr-0 text-sm text-gray-500 rounded-lg md:hidden focus:outline-none focus:ring-0 transition-all" aria-controls="navbar-default" aria-expanded="false">
            <svg v-show="hamburgerIcon" class="w-8 h-8" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
            </svg>
            <svg v-show="!hamburgerIcon" fill="none" viewBox="0 0 24 24" stroke-width="2.4" stroke="currentColor" class="w-8 h-8">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <div class="hidden w-full md:block md:w-auto relative" id="navbar-default">
          <ul class="flex flex-col -mb-3 md:-mb-0.5 p-4 mt-4 border border-gray-100 md:rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:text-lg md:font-semibold md:border-0 md:bg-white">
            <li>
              <a href="/" class="flex items-center py-2 pl-3 pr-4 text-white bg-blue-600 rounded-md md:bg-transparent md:text-blue-700 md:p-0 active:scale-90" aria-current="page">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1 md:hidden">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                Начало
              </a>
            </li>
            <li>
              <a href="#" class="flex items-center py-2 pl-3 pr-4 text-gray-700 rounded-md hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 transition-all active:scale-90">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1 md:hidden">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Услуги
              </a>
            </li>
            <li>
              <a href="#" class="flex items-center py-2 pl-3 pr-4 text-gray-700 rounded-md hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 transition-all active:scale-90">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1 md:hidden">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>
                За нас
              </a>
            </li>
            <li>
              <a href="#" class="flex items-center py-2 pl-3 pr-4 text-gray-700 rounded-md hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 transition-all active:scale-90">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1 md:hidden">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                </svg>
                Контакти
              </a>
            </li>
            <?php
            $query = "SELECT image FROM customers WHERE email = '$email'";
            $query_run = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($query_run);

            $image = $row['image'] ? "uploaded-files/customer-images/" . $row['image'] : "images/user.png";

            if ($row) { ?>
              <li>
                <a href="account">
                  <img src="<?= $image ?>" alt="profile-image" class="w-8 h-8 cursor-pointer hover:opacity-75 transition-all rounded-full object-cover hidden md:block active:scale-90 update-photo">
                </a>
              </li>
            <?php } else { ?>
              <li class="login-btn">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.4" stroke="currentColor" class="w-10 h-10 -mt-1 -mr-3.5 text-slate-700 cursor-pointer hover:opacity-75 transition-all hidden md:block active:scale-90">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
              </li>
            <?php } ?>
            <li>
              <img class="w-8 h-8 object-cover cursor-pointer hover:opacity-75 transition-all rounded-full hidden md:block" src="images/britain-flag.png" alt="english" />
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div id="customer-login-modal" class="bg-gray-900 hidden bg-opacity-50 fixed inset-0 z-40">
      <div class="h-full w-full p-4 overflow-x-hidden overflow-y-auto flex justify-center items-center">
        <div class="relative w-full h-auto max-w-md animate__animated animate__zoomIn animate__fast">
          <div class="relative bg-gray-100 rounded-lg shadow">
            <button type="button" class="absolute top-3 right-2.5 text-slate-400 bg-transparent hover:bg-slate-200 hover:text-slate-700 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center transition-all customer-close-login-modal">
              <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
              </svg>
            </button>
            <div class="px-6 py-6 lg:px-8 text-slate-700">
              <h3 class="mb-4 text-xl font-semibold">Вашият профил</h3>
              <form id="sing-up-form" class="space-y-5">
                <div>
                  <label for="email" class="block ml-1 mb-1 text-sm font-semibold text-slate-500">
                    Вашият имейл
                  </label>
                  <div class="relative mb-6">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                      <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                      </svg>
                    </div>
                    <input type="email" name="email" id="email" class="bg-white border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-0 focus:outline-none focus:border-gray-400 block w-full pl-10 p-2.5" placeholder="example@gmail.com" />
                  </div>
                </div>
                <div>
                  <label for="password" class="block ml-1 mb-1 text-sm font-semibold text-slate-500">
                    Вашата парола
                  </label>
                  <div class="relative mb-6">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                      <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                      </svg>
                    </div>
                    <input :type="passwordState ? 'password' : 'text'" name="passowrdLogin" id="password" class="bg-white border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-0 focus:outline-none focus:border-gray-400 block w-full px-10 p-2.5" placeholder="••••••••••" />
                    <div @click="passwordState = !passwordState" class="absolute inset-y-0 right-0 flex items-center pr-3">
                      <svg v-show="passwordState" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-500 cursor-pointer transition-all hover:text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                      </svg>
                      <svg v-show="!passwordState" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-500 cursor-pointer transition-all hover:text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                      </svg>
                    </div>
                  </div>
                </div>
                <div class="flex justify-between">
                  <div class="flex items-start group">
                    <div class="flex items-center h-5">
                      <input id="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 cursor-pointer" />
                    </div>
                    <label for="remember" class="ml-1.5 text-sm font-medium group-hover:text-blue-500 transition-all cursor-pointer">
                      Запомни ме
                    </label>
                  </div>
                  <div id="change-password-btn" class="text-sm hover:text-blue-500 transition-all font-semibold cursor-pointer">Забравена парола ?</div>
                </div>
                <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-0 font-semibold rounded-md text-sm px-5 py-2.5 text-center transition-all active:scale-95">
                  Вход
                </button>
                <div class="w-full border border-gray-300"></div>
                <button type="submit" class="w-full bg-gray-100 hover:bg-slate-200 border border-gray-300 text-slate-700 focus:outline-none focus:ring-0 font-semibold rounded-md text-sm px-5 py-2.5 flex justify-center items-center transition-all active:scale-90">
                  <svg class="w-6 h-6 mr-1.5" viewBox="0 0 24 24">
                    <path fill="#EA4335" d="M5.26620003,9.76452941 C6.19878754,6.93863203 8.85444915,4.90909091 12,4.90909091 C13.6909091,4.90909091 15.2181818,5.50909091 16.4181818,6.49090909 L19.9090909,3 C17.7818182,1.14545455 15.0545455,0 12,0 C7.27006974,0 3.1977497,2.69829785 1.23999023,6.65002441 L5.26620003,9.76452941 Z" />
                    <path fill="#34A853" d="M16.0407269,18.0125889 C14.9509167,18.7163016 13.5660892,19.0909091 12,19.0909091 C8.86648613,19.0909091 6.21911939,17.076871 5.27698177,14.2678769 L1.23746264,17.3349879 C3.19279051,21.2936293 7.26500293,24 12,24 C14.9328362,24 17.7353462,22.9573905 19.834192,20.9995801 L16.0407269,18.0125889 Z" />
                    <path fill="#4A90E2" d="M19.834192,20.9995801 C22.0291676,18.9520994 23.4545455,15.903663 23.4545455,12 C23.4545455,11.2909091 23.3454545,10.5272727 23.1818182,9.81818182 L12,9.81818182 L12,14.4545455 L18.4363636,14.4545455 C18.1187732,16.013626 17.2662994,17.2212117 16.0407269,18.0125889 L19.834192,20.9995801 Z" />
                    <path fill="#FBBC05" d="M5.27698177,14.2678769 C5.03832634,13.556323 4.90909091,12.7937589 4.90909091,12 C4.90909091,11.2182781 5.03443647,10.4668121 5.26620003,9.76452941 L1.23999023,6.65002441 C0.43658717,8.26043162 0,10.0753848 0,12 C0,13.9195484 0.444780743,15.7301709 1.23746264,17.3349879 L5.27698177,14.2678769 Z" />
                  </svg>
                  <span>Вход с Google</span>
                </button>
                <button type="submit" class="w-full bg-gray-100 hover:bg-slate-200 border border-gray-300 text-slate-700 focus:outline-none focus:ring-0 font-semibold rounded-md text-sm px-5 py-2.5 flex justify-center items-center transition-all active:scale-90">
                  <svg class="w-6 h-6 mr-1.5" viewBox="0 0 291.319 291.319">
                    <path style="fill: #4e71bd" d="M145.659,0c80.45,0,145.66,65.219,145.66,145.66c0,80.45-65.21,145.659-145.66,145.659
		                  S0,226.109,0,145.66C0,65.219,65.21,0,145.659,0z" />
                    <path style="fill: #ffffff" d="M163.394,100.277h18.772v-27.73h-22.067v0.1c-26.738,0.947-32.218,15.977-32.701,31.763h-0.055
                      v13.847h-18.207v27.156h18.207v72.793h27.439v-72.793h22.477l4.342-27.156h-26.81v-8.366
                      C154.791,104.556,158.341,100.277,163.394,100.277z" />
                  </svg>
                  <span>Вход с Facebook</span>
                </button>

                <div class="text-sm font-medium text-gray-500">
                  Нямате профил ?
                  <span class="text-slate-700 hover:hover:text-blue-500 font-semibold transition-all cursor-pointer register-btn">Създаване на профил</span>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="customer-password-modal" class="bg-gray-900 hidden bg-opacity-50 fixed inset-0 z-40">
      <div class="h-full w-full p-4 overflow-x-hidden overflow-y-auto flex justify-center items-center">
        <div class="relative w-full h-auto max-w-md animate__animated animate__zoomIn animate__fast">
          <div class="relative bg-gray-100 rounded-lg shadow">
            <div id="customer-forgot-password-spinner" class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 hidden">
              <svg aria-hidden="true" class="inline w-12 h-12 text-gray-200 animate-spin fill-blue-600" viewBox="0 0 100 101" fill="none">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
              </svg>
            </div>
            <button type="button" class="absolute top-3 right-2.5 text-slate-400 bg-transparent hover:bg-slate-200 hover:text-slate-700 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center transition-all customer-close-password-modal">
              <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
              </svg>
            </button>
            <div class="px-6 py-6 lg:px-8 text-slate-700">
              <h3 class="mb-4 text-xl font-semibold">Забравена парола</h3>
              <div id="forget-password" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-slate-700 bg-white border w-72 text-justify rounded-lg shadow-lg opacity-0 tooltip">
                Ще изпратим случайно генериран имейл с, който ще можете да влезе във Вашият профил. Ако искате да я смените след това, може да го нправите от секция парола.
              </div>
              <form id="generate-password-form" class="space-y-5">
                <div>
                  <label for="email-forgot-password" class="block ml-1 mb-1 text-sm font-semibold text-slate-500 flex items-center">
                    <span>Вашият имейл</span>
                    <span>
                      <svg data-tooltip-target="forget-password" data-tooltip-placement="right" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-4 h-4 ml-1 mt-0.5 cursor-pointer hover:text-slate-700 transition-all">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                      </svg>
                    </span>
                  </label>
                  <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                      <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                      </svg>
                    </div>
                    <input type="email" name="customerEmail" id="email-forgot-password" class="bg-white border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-0 focus:outline-none focus:border-gray-400 block w-full pl-10 p-2.5" placeholder="example@gmail.com" />
                  </div>
                </div>
                <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-0 font-semibold rounded-md text-sm px-5 py-2.5 text-center transition-all active:scale-95">
                  Изпрати
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="customer-register-modal" class="bg-gray-900 hidden bg-opacity-50 fixed inset-0 z-40">
      <div class="h-full w-full p-4 overflow-x-hidden overflow-y-auto flex justify-center 2xl:items-center">
        <div class="relative w-full h-full 2xl:h-auto max-w-md animate__animated animate__zoomIn animate__fast">
          <div class="relative bg-gray-100 rounded-lg shadow mb-6">
            <div id="customer-registration-spinner" class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 hidden">
              <svg aria-hidden="true" class="inline w-12 h-12 text-gray-200 animate-spin fill-blue-600" viewBox="0 0 100 101" fill="none">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
              </svg>
            </div>
            <button type="button" class="absolute top-3 right-2.5 text-slate-400 bg-transparent hover:bg-slate-200 hover:text-slate-700 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center transition-all close-customer-register-modal">
              <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
              </svg>
            </button>
            <div class="px-6 py-6 lg:px-8 text-slate-700">
              <h3 class="mb-4 text-xl font-semibold">Създайте профил</h3>
              <form id="sign-in-form" class="space-y-5">
                <div class="flex items-center space-x-5 w-full">
                  <div class="w-1/2">
                    <label for="first_name" class="block ml-1 mb-1 text-sm font-semibold text-slate-500">
                      Име
                    </label>
                    <input type="text" id="first_name" name="firstName" class="bg-white border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-0 focus:outline-none focus:border-gray-400 block w-full p-2.5" placeholder="Въведете име" minlength="2" />
                  </div>
                  <div class="w-1/2">
                    <label for="family_name" class="block ml-1 mb-1 text-sm font-semibold text-slate-500">
                      Фамилия
                    </label>
                    <input type="text" id="family_name" name="familyName" class="bg-white border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-0 focus:outline-none focus:border-gray-400 block w-full p-2.5" placeholder="Въведете фамилия" minlength="2" />
                  </div>
                </div>
                <div>
                  <label for="email-signUp" class="block ml-1 mb-1 text-sm font-semibold text-slate-500">
                    Имейл
                  </label>
                  <input type="email" id="email-signUp" name="email" class="bg-white border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-0 focus:outline-none focus:border-gray-400 block w-full p-2.5" placeholder="Въведете имейл" minlength="5" />
                </div>
                <div>
                  <label for="phone" class="block ml-1 mb-1 text-sm font-semibold text-slate-500">
                    Телефонен номер
                  </label>
                  <div class="flex">
                    <button id="states-button" data-dropdown-toggle="dropdown-states" class="flex-shrink-0 z-10 inline-flex items-center p-2.5 text-sm font-medium text-center text-gray-500 bg-white border border-gray-200 border-r-none rounded-l-lg hover:bg-gray-100 focus:ring-0 focus:outline-none transition-all" type="button">
                      {{phoneCountry}}
                      <svg aria-hidden="true" class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                      </svg>
                    </button>
                    <div id="dropdown-states" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-md shadow w-44">
                      <ul class="py-1 text-sm text-gray-700" aria-labelledby="states-button">
                        <li v-for="country in countries">
                          <div :class="{ 'bg-gray-100' : phoneCountry == country.countryCode}" @click="phoneCountry = country.countryCode; countryCode = country.code" class="inline-flex w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer transition-all font-semibold">
                            <div class="inline-flex items-center">
                              <img class="w-4 h-4 mr-1 object-cover rounded-full border border-slate-100" :src="country.image" :alt="country.name" />
                              {{country.name}}
                            </div>
                          </div>
                        </li>
                      </ul>
                    </div>
                    <input type="text" id="phone" name="phone" v-model="countryCode" class="bg-white border border-gray-200 border-l-0 text-gray-900 text-sm rounded-r-lg focus:ring-0 focus:outline-none block w-full p-2.5" placeholder="Въведете телефонен номер" minlength="6" />
                  </div>
                </div>
                <div>
                  <label for="register-password" class="block mb-1.5 text-sm font-semibold text-slate-500">
                    Вашата парола
                  </label>
                  <div class="relative">
                    <input :type="passwordReg ? 'password' : 'text'" name="password" id="register-password" class="bg-white border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-0 focus:outline-none focus:border-gray-400 block w-full pr-10 p-2.5" placeholder="••••••••" minlength="8" />
                    <div @click="passwordReg = !passwordReg" class="absolute inset-y-0 right-0 flex items-center pr-3">
                      <svg v-show="passwordReg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-500 cursor-pointer transition-all hover:text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                      </svg>
                      <svg v-show="!passwordReg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-500 cursor-pointer transition-all hover:text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                      </svg>
                    </div>
                  </div>
                </div>
                <div>
                  <label for="register-password-rep" class="block mb-1.5 text-sm font-semibold text-slate-500">
                    Повтори парола
                  </label>
                  <div class="relative">
                    <input :type="passwordRegRep ? 'password' : 'text'" name="passwordRep" id="register-password-rep" class="bg-white border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-0 focus:outline-none focus:border-gray-400 block w-full pr-10 p-2.5" placeholder="••••••••" minlength="8" />
                    <div @click="passwordRegRep = !passwordRegRep" class="absolute inset-y-0 right-0 flex items-center pr-3">
                      <svg v-show="passwordRegRep" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-500 cursor-pointer transition-all hover:text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                      </svg>
                      <svg v-show="!passwordRegRep" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-500 cursor-pointer transition-all hover:text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                      </svg>
                    </div>
                  </div>
                </div>
                <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-0 font-semibold rounded-md text-sm px-5 py-2.5 text-center transition-all active:scale-90">
                  Регистрация
                </button>
                <div class="w-full border border-gray-300"></div>
                <button type="submit" class="w-full bg-gray-100 hover:bg-slate-200 border border-gray-300 text-slate-700 focus:outline-none focus:ring-0 font-semibold rounded-md text-sm px-5 py-2.5 flex justify-center items-center transition-all active:scale-90">
                  <svg class="w-6 h-6 mr-1.5" viewBox="0 0 24 24">
                    <path fill="#EA4335" d="M5.26620003,9.76452941 C6.19878754,6.93863203 8.85444915,4.90909091 12,4.90909091 C13.6909091,4.90909091 15.2181818,5.50909091 16.4181818,6.49090909 L19.9090909,3 C17.7818182,1.14545455 15.0545455,0 12,0 C7.27006974,0 3.1977497,2.69829785 1.23999023,6.65002441 L5.26620003,9.76452941 Z" />
                    <path fill="#34A853" d="M16.0407269,18.0125889 C14.9509167,18.7163016 13.5660892,19.0909091 12,19.0909091 C8.86648613,19.0909091 6.21911939,17.076871 5.27698177,14.2678769 L1.23746264,17.3349879 C3.19279051,21.2936293 7.26500293,24 12,24 C14.9328362,24 17.7353462,22.9573905 19.834192,20.9995801 L16.0407269,18.0125889 Z" />
                    <path fill="#4A90E2" d="M19.834192,20.9995801 C22.0291676,18.9520994 23.4545455,15.903663 23.4545455,12 C23.4545455,11.2909091 23.3454545,10.5272727 23.1818182,9.81818182 L12,9.81818182 L12,14.4545455 L18.4363636,14.4545455 C18.1187732,16.013626 17.2662994,17.2212117 16.0407269,18.0125889 L19.834192,20.9995801 Z" />
                    <path fill="#FBBC05" d="M5.27698177,14.2678769 C5.03832634,13.556323 4.90909091,12.7937589 4.90909091,12 C4.90909091,11.2182781 5.03443647,10.4668121 5.26620003,9.76452941 L1.23999023,6.65002441 C0.43658717,8.26043162 0,10.0753848 0,12 C0,13.9195484 0.444780743,15.7301709 1.23746264,17.3349879 L5.27698177,14.2678769 Z" />
                  </svg>
                  <span>Регистрация с Google</span>
                </button>
                <button type="submit" class="w-full bg-gray-100 hover:bg-slate-200 border border-gray-300 text-slate-700 focus:outline-none focus:ring-0 font-semibold rounded-md text-sm px-5 py-2.5 flex justify-center items-center transition-all active:scale-95">
                  <svg class="w-6 h-6 mr-1.5" viewBox="0 0 291.319 291.319">
                    <path style="fill: #4e71bd" d="M145.659,0c80.45,0,145.66,65.219,145.66,145.66c0,80.45-65.21,145.659-145.66,145.659
		                  S0,226.109,0,145.66C0,65.219,65.21,0,145.659,0z" />
                    <path style="fill: #ffffff" d="M163.394,100.277h18.772v-27.73h-22.067v0.1c-26.738,0.947-32.218,15.977-32.701,31.763h-0.055
                      v13.847h-18.207v27.156h18.207v72.793h27.439v-72.793h22.477l4.342-27.156h-26.81v-8.366
                      C154.791,104.556,158.341,100.277,163.394,100.277z" />
                  </svg>
                  <span>Регистрация с Facebook</span>
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <section>
      <div id="indicators-carousel" class="relative z-10 group" data-carousel="static">
        <div class="relative h-64 overflow-hidden md:h-[32rem] xl:[40rem] 2xl:h-[46rem] w-full">
          <div class="hidden duration-700 ease-in-out text-center" data-carousel-item="active">
            <div class="relative h-64 md:h-[32rem] xl:[40rem] 2xl:h-[46rem] flex justify-center items-center z-20 text-slate-100">
              <div>
                <div class="animate__animated animate__slow animate__fadeInDown">
                  <img src="images/stars.png" alt="stars" class="object-cover h-5 w-5 md:h-6 md:w-6 mx-auto mb-1.5" />
                  <div style="font-family: 'Dancing Script'" class="text-3xl md:text-5xl lg:text-6xl font-bold">
                    Carpet Cleaning
                  </div>
                  <div class="mt-1 text-lg md:text-xl lg:text-2xl italic font-semibold px-10">
                    Позволи ни да свършим твоята мръсна работа
                  </div>
                </div>
                <div class="animate__animated animate__slow animate__fadeInUp animate__delay-2s">
                  <button class="inline-flex items-center justify-center px-3 md:px-5 py-1.5 md:py-2 mt-2 md:mt-4 bg-blue-500 hover:bg-blue-600 text-sm md:text-base font-semibold rounded-md transition-all active:scale-95">
                    Нашите услуги
                  </button>
                </div>
              </div>
            </div>
            <img src="images/slide1.jpg" class="absolute object-cover brightness-[.8] block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 h-64 md:h-[32rem] xl:[40rem] 2xl:h-[46rem] opacity-75" alt="slider-photo1" />
          </div>
          <div class="hidden duration-700 ease-in-out text-center" data-carousel-item>
            <div class="relative h-64 md:h-[32rem] xl:[40rem] 2xl:h-[46rem] flex justify-center items-center z-20 text-slate-100">
              <div>
                <div class="text-2xl md:text-3xl lg:text-4xl font-bold px-14 md:px-0">
                  Добре дошли в нашият сайт
                </div>
                <div class="mt-1 text-lg md:text-xl lg:text-2xl italic font-semibold px-10">
                  Позволете ни да направим домът ви блестящ и лъскав
                </div>
                <button class="inline-flex items-center justify-center px-3 md:px-5 py-1.5 md:py-2 mt-2 md:mt-4 bg-blue-500 hover:bg-blue-600 text-sm md:text-base font-semibold rounded-md transition-all active:scale-95">
                  Нашите услуги
                </button>
              </div>
            </div>
            <img src="images/slide2.jpg" class="absolute object-cover brightness-75 block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 h-64 md:h-[32rem] xl:[40rem] 2xl:h-[46rem]" alt="slider-photo2" />
          </div>
          <div class="hidden duration-700 ease-in-out text-center" data-carousel-item>
            <div class="relative h-64 md:h-[32rem] xl:[40rem] 2xl:h-[46rem] flex justify-center items-center z-20 text-slate-100">
              <div>
                <div class="text-2xl md:text-3xl lg:text-4xl font-bold px-14 md:px-0">
                  На правилното място сте
                </div>
                <div class="mt-1 text-lg md:text-xl lg:text-2xl italic font-semibold px-10">
                  Опитни професионалисти в услугите за почистване
                </div>
                <button class="inline-flex items-center justify-center px-3 md:px-5 py-1.5 md:py-2 mt-2 md:mt-4 bg-blue-500 hover:bg-blue-600 text-sm md:text-base font-semibold rounded-md transition-all active:scale-95">
                  Нашите услуги
                </button>
              </div>
            </div>
            <img src="images/slide3.jpg" class="absolute object-cover brightness-[.8] block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 h-64 md:h-[32rem] xl:[40rem] 2xl:h-[46rem]" alt="slider-photo3" />
          </div>
        </div>
        <div class="flex lg:hidden lg:group-hover:flex absolute z-30 space-x-3 -translate-x-1/2 bottom-3 md:bottom-8 left-1/2">
          <button type="button" class="w-2 h-2 md:w-3 md:h-3 rounded-full" data-carousel-slide-to="0"></button>
          <button type="button" class="w-2 h-2 md:w-3 md:h-3 rounded-full" data-carousel-slide-to="1"></button>
          <button type="button" class="w-2 h-2 md:w-3 md:h-3 rounded-full" data-carousel-slide-to="2"></button>
        </div>
        <svg v-show="hideScrollBtn" @click="goTo('second-section')" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 hidden lg:block absolute z-30 bottom-1 lg:left-[48.9%] xl:left-[49.2%] 2xl:left-[49.42%] text-slate-100 animate-pulse cursor-pointer">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15.042 21.672L13.684 16.6m0 0l-2.51 2.225.569-9.47 5.227 7.917-3.286-.672zM12 2.25V4.5m5.834.166l-1.591 1.591M20.25 10.5H18M7.757 14.743l-1.59 1.59M6 10.5H3.75m4.007-4.243l-1.59-1.59" />
        </svg>

        <div class="flex lg:hidden lg:group-hover:flex transition-all duration-300">
          <button type="button" class="absolute top-0 left-0 z-30 bg-white rounded-r-md md:rounded-r-none opacity-40 md:opacity-100 md:bg-transparent flex items-center justify-center h-full sm:px-1 md:px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full md:w-12 md:h-12 md:bg-blue-400 md:group-hover:bg-blue-500 group-focus:ring-0 group-focus:ring-white group-focus:outline-none transition-all active:scale-90">
              <svg aria-hidden="true" class="text-slate-700 md:text-white w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
              </svg>
            </span>
          </button>
          <button type="button" class="absolute top-0 right-0 z-30 bg-white rounded-l-md md:rounded-l-none opacity-40 md:opacity-100 md:bg-transparent flex items-center justify-center h-full sm:px-1 md:px-4 cursor-pointer group focus:outline-none" data-carousel-next>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full md:w-12 md:h-12 md:bg-blue-400 md:group-hover:bg-blue-500 group-focus:ring-0 group-focus:ring-white group-focus:outline-none transition-all active:scale-90">
              <svg aria-hidden="true" class="text-slate-700 md:text-white w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
              </svg>
            </span>
          </button>
        </div>
      </div>
    </section>

    <section ref="second-section">
      <div class="w-full md:-mt-[1px] md:flex items-center bg-[#0082ca] md:-mb-28 lg:-mb-32">
        <div class="flex items-center p-6 md:p-5 lg:p-8 bg-[#0082ca] w-full lg:w-4/12">
          <svg viewBox="0 0 24 24" fill="currentColor" class="w-9 h-9 sm:w-10 sm:h-10 md:w-11 md:h-11 text-[#ffd800] mr-2.5 z-20">
            <path fill-rule="evenodd" d="M1.5 4.5a3 3 0 013-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 01-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 006.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 011.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 01-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5z" clip-rule="evenodd" />
          </svg>
          <div>
            <div class="text-white font-semibold text-sm lg:text-base xl:text-lg relative z-20">
              Имате въпроси ? Обадете ни се
            </div>
            <div class="text-[#96cbe9] font-black text-base sm:text-lg lg:text-xl xl:text-2xl relative z-20">
              +359 899 845 743
            </div>
          </div>
        </div>
        <div class="flex items-center p-6 md:p-5 lg:p-8 w-full lg:w-4/12 bg-[#0082ca] border-y md:border-y-0 md:border-x border-slate-100">
          <svg viewBox="0 0 24 24" fill="currentColor" class="w-9 h-9 sm:w-10 sm:h-10 md:w-11 md:h-11 text-[#ffd800] mr-2.5 z-20">
            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 000-1.5h-3.75V6z" clip-rule="evenodd" />
          </svg>
          <div>
            <div class="text-white font-semibold text-sm lg:text-base xl:text-lg relative z-20">
              Ние работим от понеделник - петък
            </div>
            <div class="text-[#96cbe9] font-black text-base sm:text-lg lg:text-xl xl:text-2xl relative z-20">
              08:00 - 17:00
            </div>
          </div>
        </div>
        <div class="flex items-center p-6 md:p-5 lg:p-8 bg-[#0082ca] w-full lg:w-4/12">
          <svg viewBox="0 0 24 24" fill="currentColor" class="w-9 h-9 sm:w-10 sm:h-10 md:w-11 md:h-11 text-[#ffd800] mr-2.5 z-20">
            <path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
          </svg>
          <div>
            <div class="text-white font-semibold text-sm lg:text-base xl:text-lg relative z-20">
              Нуждаете се от почистване ?
            </div>
            <div class="text-[#96cbe9] font-black text-base sm:text-lg lg:text-xl xl:text-2xl relative z-20">
              Варна, ул."Васил Петров" 27
            </div>
          </div>
        </div>
      </div>
      <div class="hidden w-full md:flex">
        <div class="w-4/12 flex justify-center">
          <svg viewBox="0 0 24 24" fill="currentColor" class="w-28 h-28 lg:w-32 lg:h-32 text-[#008ccf] z-10">
            <path fill-rule="evenodd" d="M1.5 4.5a3 3 0 013-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 01-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 006.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 011.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 01-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5z" clip-rule="evenodd" />
          </svg>
        </div>
        <div class="w-4/12 flex justify-center">
          <svg viewBox="0 0 24 24" fill="currentColor" class="w-28 h-28 lg:w-32 lg:h-32 text-[#008ccf] z-10">
            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 000-1.5h-3.75V6z" clip-rule="evenodd" />
          </svg>
        </div>
        <div class="w-4/12 flex justify-center">
          <svg viewBox="0 0 24 24" fill="currentColor" class="w-28 h-28 lg:w-32 lg:h-32 text-[#008ccf] z-10">
            <path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
          </svg>
        </div>
      </div>
    </section>

    <section>
      <div class="w-full py-10 md:py-14 lg:py-20 xl:py-24 2xl:py-32 md:flex items-center">
        <div class="w-full md:w-1/2 sm:flex justify-evenly md:justify-center items-end group space-y-5 sm:space-y-0" data-aos="slide-right" data-aos-duration="2000">
          <img class="w-64 h-64 sm:w-56 sm:h-56 md:w-80 md:h-80 lg:w-96 lg:h-96 mx-auto sm:mx-0 object-cover rounded-lg lg:group-hover:scale-[1.15] transition-all duration-1000 shadow-box-1" src="images/8.jpg" alt="our services" />
          <img class="w-64 h-64 sm:w-56 sm:h-56 md:w-36 md:h-36 lg:w-44 lg:h-44 mx-auto sm:mx-0 md:border-4 lg:border-8 border-[#5ca1e1] object-cover rounded-lg md:rounded-full md:-ml-20 lg:-ml-24 lg:group-hover:scale-[1.15] transition-all duration-1000 shadow-box-1" src="images/2-3.jpg" alt="our services" />
        </div>
        <div class="w-full md:w-1/2 text-slate-700 px-10 md:px-0 md:pr-6 lg:pr-24" data-aos="slide-left" data-aos-duration="2000">
          <h1 class="font-bold md:text-lg lg:text-2xl xl:text-3xl lg:pr-20 xl:pr-36 mt-5 md:mt-0 text-center md:text-left">
            Ние сме задължени да даваме само най-добрите услуги
          </h1>
          <div style="box-shadow: 0 0 25px rgb(0 0 0 / 8%)" class="border-l-4 border-blue-400 text-sm lg:text-lg xl:text-xl italic font-semibold p-6 lg:p-8 my-3 sm:my-4 lg:my-5 lg:hover:scale-105 transition-all duration-700 cursor-default sm:mx-6 md:mx-0">
            Нашият оперативен екип е 24 часа на разположение в денонощието !
            Доверете ни се !
          </div>
          <div class="text-sm lg:text-base text-justify sm:px-10 md:px-0">
            Екипите ни са обучени по приетите европейски изисквания за
            професионално почистване. Всеки един наш служител подхожда с
            голямо внимание към детайлите и дава максимума от своите
            възможности.
          </div>
          <div class="w-full flex items-center mt-3.5 sm:mt-4 md:mt-5 sm:pl-10 md:pl-0">
            <button data-modal-toggle="call-us-modal" class="px-6 py-1.5 lg:px-8 lg:py-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-lg lg:text-lg xl:text-xl transition-all active:scale-95">
              Поръчка
            </button>
            <div class="border-l-2 border-dotted pl-2.5 ml-2.5 sm:pl-3 sm:ml-3 lg:pl-4 lg:ml-4">
              <div class="text-slate-500 text-xs lg:text-base">
                Безплатна консултация
              </div>
              <div class="font-bold text-slate-700 text-sm lg:text-base">
                +359 899 845 743
              </div>
            </div>
          </div>
        </div>
      </div>

      <div id="call-us-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
        <div class="relative w-full h-full max-w-2xl md:h-auto animate__animated animate__zoomIn animate__fast">
          <div class="relative bg-gray-100 rounded-lg shadow">
            <button type="button" class="absolute top-2 right-2 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="call-us-modal">
              <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
              </svg>
              <span class="sr-only">Close modal</span>
            </button>
            <div class="p-7 sm:space-x-8 pr-9 sm:flex items-center">
              <img class="object-cover h-44 w-48 sm:h-48 sm:w-52 md:h-52 md:w-56 mx-auto md:mx-0" src="images/4-1.png" alt="service" />
              <div class="w-full mt-2.5 sm:mt-0">
                <h1 class="text-center font-bold text-slate-700 text-xl">
                  Оставете вашите данни.
                </h1>
                <h1 class="text-center font-bold text-slate-700 text-xl">
                  Ние ще се свържем с Вас!
                </h1>
                <div class="relative my-4">
                  <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-5 h-5 text-gray-500">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                  </div>
                  <input type="text" name="name" class="bg-white border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-0 focus:outline-none focus:border-gray-400 block w-full pl-10 p-2.5" placeholder="Вашите имена" />
                </div>
                <div class="relative my-4">
                  <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-5 h-5 text-gray-500">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                    </svg>
                  </div>
                  <input type="text" name="phone" class="bg-white border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-0 focus:outline-none focus:border-gray-400 block w-full pl-10 p-2.5" placeholder="Вашият тел. номер" />
                </div>
                <button class="inline-flex items-center justify-center w-full sm:w-auto px-6 py-[7px] bg-blue-500 hover:bg-blue-600 text-sm md:text-base font-semibold rounded-md transition-all text-white active:scale-90">
                  Изпрати
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section>
      <div style="background-image: url(images/House-cleaning-service.png)" class="w-full brightness-[0.3] md:brightness-[0.4] h-[32rem] sm:h-[34rem] md:h-[36rem] lg:h-[40rem] bg-fixed bg-cover bg-center flex justify-center items-center"></div>
      <div class="-mt-[30rem] sm:-mt-[32rem] md:-mt-[34rem] lg:-mt-[36rem] relative z-10 w-full" data-aos="slide-up" data-aos-duration="2000">
        <div class="text-center text-white font-extrabold text-2xl md:text-3xl xl:text-4xl">
          Всеки детайл е важен
        </div>
        <div class="bg-white w-28 lg:w-32 h-0.5 my-8 mx-auto"></div>
        <div class="text-white text-center md:text-lg xl:text-xl mt-6 mb-12">
          Приоритизираме следното
        </div>
        <div class="mb-5 sm:mb-4">
          <ul class="flex justify-evenly text-sm font-medium text-center">
            <li @click="ourClientTab = true; processTab = false; communicationTab = false" :class="ourClientTab ? 'text-blue-500' : 'text-slate-100 hover:text-blue-500'" class="cursor-pointer transition-all">
              <svg viewBox="0 0 24 24" fill="currentColor" class="w-14 h-14 sm:w-16 sm:h-16 lg:w-20 lg:h-20 cursor-pointer mx-auto">
                <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM15.75 9.75a3 3 0 116 0 3 3 0 01-6 0zM2.25 9.75a3 3 0 116 0 3 3 0 01-6 0zM6.31 15.117A6.745 6.745 0 0112 12a6.745 6.745 0 016.709 7.498.75.75 0 01-.372.568A12.696 12.696 0 0112 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 01-.372-.568 6.787 6.787 0 011.019-4.38z" clip-rule="evenodd" />
                <path d="M5.082 14.254a8.287 8.287 0 00-1.308 5.135 9.687 9.687 0 01-1.764-.44l-.115-.04a.563.563 0 01-.373-.487l-.01-.121a3.75 3.75 0 013.57-4.047zM20.226 19.389a8.287 8.287 0 00-1.308-5.135 3.75 3.75 0 013.57 4.047l-.01.121a.563.563 0 01-.373.486l-.115.04c-.567.2-1.156.349-1.764.441z" />
              </svg>
              <div class="sm:uppercase font-semibold lg:text-lg">
                Нашите Клиенти
              </div>
            </li>
            <li @click="processTab = true; ourClientTab = false; communicationTab = false" :class="processTab ? 'text-blue-500' : 'text-slate-100 hover:text-blue-500'" class="cursor-pointer transition-all">
              <svg viewBox="0 0 24 24" fill="currentColor" class="w-14 h-14 sm:w-16 sm:h-16 lg:w-20 lg:h-20 cursor-pointer mx-auto">
                <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
              </svg>
              <div class="sm:uppercase font-semibold lg:text-lg">
                Процес
              </div>
            </li>
            <li @click="communicationTab = true; processTab = false; ourClientTab = false" :class="communicationTab ? 'text-blue-500' : 'text-slate-100 hover:text-blue-500'" class="cursor-pointer transition-all">
              <svg viewBox="0 0 24 24" fill="currentColor" class="w-14 h-14 sm:w-16 sm:h-16 lg:w-20 lg:h-20 cursor-pointer mx-auto">
                <path d="M4.913 2.658c2.075-.27 4.19-.408 6.337-.408 2.147 0 4.262.139 6.337.408 1.922.25 3.291 1.861 3.405 3.727a4.403 4.403 0 00-1.032-.211 50.89 50.89 0 00-8.42 0c-2.358.196-4.04 2.19-4.04 4.434v4.286a4.47 4.47 0 002.433 3.984L7.28 21.53A.75.75 0 016 21v-4.03a48.527 48.527 0 01-1.087-.128C2.905 16.58 1.5 14.833 1.5 12.862V6.638c0-1.97 1.405-3.718 3.413-3.979z" />
                <path d="M15.75 7.5c-1.376 0-2.739.057-4.086.169C10.124 7.797 9 9.103 9 10.609v4.285c0 1.507 1.128 2.814 2.67 2.94 1.243.102 2.5.157 3.768.165l2.782 2.781a.75.75 0 001.28-.53v-2.39l.33-.026c1.542-.125 2.67-1.433 2.67-2.94v-4.286c0-1.505-1.125-2.811-2.664-2.94A49.392 49.392 0 0015.75 7.5z" />
              </svg>
              <div class="sm:uppercase font-semibold lg:text-lg">
                Комуникация
              </div>
            </li>
          </ul>
        </div>
        <div class="px-5 sm:px-16 lg:px-32 2xl:px-36 text-justify md:text-center text-sm md:text-base">
          <p v-show="ourClientTab" class="sm:p-4 bg-transperent rounded-lg text-white">
            Нашите услуги за почистване са достъпни и нашите експерти по
            почистване са високо обучени. Ако по някаква причина не сте
            доволни от нашите професионални почистващи услуги, свържете се с
            нас. Ще се върнем и почистим конкретните зони, които не
            отговарят на вашите очаквания. Нищо не е по-важно за нас от
            вашето удовлетворение.
          </p>
          <p v-show="processTab" class="sm:p-4 bg-transperent rounded-lg text-white">
            Нашият непрекъснат стремеж към съвършенство води до постоянен
            растеж всяка година. Нашият фокус е да изслушваме нашите
            клиенти, да разбираме техните нужди и да предоставяме
            изключително ниво на услуги за почистване на жилищни и търговски
            сгради. Изберете нас заради нашата отлична репутация.
          </p>
          <p v-show="communicationTab" class="sm:p-4 bg-transperent rounded-lg text-white">
            Ако по някаква причина не сте доволни от нашите услуги за
            почистване, моля свържете се с нас. Ще се върнем и ще почистим
            конкретните зони, които не отговарят. В случай, че имате нужда
            от специална почистваща услуга, ние ще се радваме да изпълним
            всяка заявка, за да надминем вашите очаквания. Доверете ни се !
          </p>
        </div>
      </div>
    </section>

    <section>
      <svg style="transform: rotate(0deg); transition: 0.3s" viewBox="0 0 1440 200" class="w-full mt-8 sm:mt-[50px] md:mt-6">
        <defs>
          <linearGradient id="sw-gradient-0" x1="0" x2="0" y1="1" y2="0">
            <stop stop-color="rgba(255, 255, 255, 1)" offset="0%"></stop>
            <stop stop-color="rgba(255, 255, 255, 1)" offset="100%"></stop>
          </linearGradient>
        </defs>
        <path style="transform: translate(0, 0px); opacity: 1" fill="url(#sw-gradient-0)" d="M0,0L40,26.7C80,53,160,107,240,123.3C320,140,400,120,480,96.7C560,73,640,47,720,56.7C800,67,880,113,960,126.7C1040,140,1120,120,1200,93.3C1280,67,1360,33,1440,30C1520,27,1600,53,1680,53.3C1760,53,1840,27,1920,13.3C2000,0,2080,0,2160,26.7C2240,53,2320,107,2400,133.3C2480,160,2560,160,2640,143.3C2720,127,2800,93,2880,90C2960,87,3040,113,3120,133.3C3200,153,3280,167,3360,156.7C3440,147,3520,113,3600,90C3680,67,3760,53,3840,56.7C3920,60,4000,80,4080,73.3C4160,67,4240,33,4320,20C4400,7,4480,13,4560,16.7C4640,20,4720,20,4800,26.7C4880,33,4960,47,5040,53.3C5120,60,5200,60,5280,50C5360,40,5440,20,5520,40C5600,60,5680,120,5720,150L5760,180L5760,200L5720,200C5680,200,5600,200,5520,200C5440,200,5360,200,5280,200C5200,200,5120,200,5040,200C4960,200,4880,200,4800,200C4720,200,4640,200,4560,200C4480,200,4400,200,4320,200C4240,200,4160,200,4080,200C4000,200,3920,200,3840,200C3760,200,3680,200,3600,200C3520,200,3440,200,3360,200C3280,200,3200,200,3120,200C3040,200,2960,200,2880,200C2800,200,2720,200,2640,200C2560,200,2480,200,2400,200C2320,200,2240,200,2160,200C2080,200,2000,200,1920,200C1840,200,1760,200,1680,200C1600,200,1520,200,1440,200C1360,200,1280,200,1200,200C1120,200,1040,200,960,200C880,200,800,200,720,200C640,200,560,200,480,200C400,200,320,200,240,200C160,200,80,200,40,200L0,200Z"></path>
      </svg>
      <div class="text-center" data-aos="slide-up" data-aos-duration="2000">
        <div class="uppercase font-bold text-lg md:text-xl lg:text-2xl text-[#0082ca]">
          работен процес
        </div>
        <div class="text-slate-700 font-bold text-2xl md:text-3xl lg:text-4xl mt-0.5 lg:mt-1.5">
          Как работим ние
        </div>
        <div class="flex items-center justify-center mt-4 md:mt-5 lg:mt-6 mb-10 sm:mb-36">
          <div class="w-4 lg:w-5 h-0.5 lg:h-[3px] bg-[#5ca1e1] mr-2.5"></div>
          <div class="w-16 lg:w-20 h-0.5 lg:h-[3px] bg-[#5ca1e1]"></div>
        </div>
        <div>
          <img class="mx-auto hidden sm:block px-5 xl:px-0 -mb-40 md:-mb-44 lg:-mb-48" src="images/workprocess.png" alt="line" />
        </div>
        <div class="sm:flex justify-evenly items-center space-y-6 sm:space-y-0">
          <div class="group">
            <img class="object-cover h-44 w-44 sm:h-36 sm:w-36 md:h-40 md:w-40 lg:h-48 lg:w-48 rounded-full border-2 border-[#5ca1e1] mx-auto md:group-hover:scale-125 transition-all duration-700" src="images/12.jpg" alt="step 1" />
            <div class="absolute inline-flex sm:flex items-center justify-center text-center w-14 h-14 lg:w-16 lg:h-16 bg-[#5ca1e1] -mt-14 md:group-hover:scale-[1.15] md:group-hover:bg-[#ffb400] transition-all duration-700 ml-10 sm:ml-0 hexagon">
              <span style="font-family: 'Poppins', sans-serif" class="text-3xl font-black text-white">01</span>
            </div>
            <div class="text-slate-700 font-semibold text-xl mt-1.5 sm:mt-3 md:group-hover:mt-8 transition-all duration-700">
              Поръчай онлайн
            </div>
          </div>
          <div>
            <img class="object-cover h-52 w-52 sm:h-52 sm:w-52 md:h-56 md:w-56 lg:h-64 lg:w-64 rounded-full border-2 border-[#5ca1e1] mx-auto" src="images/14.jpg" alt="step 2" />
            <div class="absolute inline-flex items-center justify-center text-center w-14 h-14 lg:w-16 lg:h-16 bg-[#ffb400] -mt-52 md:-mt-56 lg:-mt-64 ml-12 hexagon">
              <span style="font-family: 'Poppins', sans-serif" class="text-3xl font-black text-white">02</span>
            </div>
            <div class="text-slate-700 font-semibold text-xl mt-1 sm:mt-2">
              Експертно почистване
            </div>
          </div>
          <div class="group">
            <img class="object-cover h-44 w-44 sm:h-36 sm:w-36 md:h-40 md:w-40 lg:h-48 lg:w-48 rounded-full border-2 border-[#5ca1e1] mx-auto md:group-hover:scale-125 transition-all duration-700" src="images/13.jpg" alt="step 3" />
            <div class="absolute inline-flex sm:flex items-center justify-center text-center w-14 h-14 lg:w-16 lg:h-16 bg-[#5ca1e1] -mt-14 md:group-hover:scale-[1.15] md:group-hover:bg-[#ffb400] transition-all duration-700 ml-10 sm:ml-0 hexagon">
              <span style="font-family: 'Poppins', sans-serif" class="text-3xl font-black text-white">03</span>
            </div>
            <div class="text-slate-700 font-semibold text-xl mt-1.5 sm:mt-3 md:group-hover:mt-8 transition-all duration-700">
              Релакс & наслада
            </div>
          </div>
        </div>
      </div>
    </section>

    <section>
      <div class="w-full bg-[#f2f2f2] flex items-center px-10 pt-10 md:px-12 md:pt-12 mt-20 space-x-10">
        <div class="w-full md:w-1/2 pb-10 md:pb-12" data-aos="slide-right" data-aos-duration="2000">
          <h3 class="uppercase font-bold text-xs lg:text-sm text-gray-400 text-center md:text-left">
            Първи според мнението на клиентите
          </h3>
          <h1 class="text-slate-700 font-semibold text-xl md:text-2xl lg:text-3xl text-center md:text-left">
            Имате проблем, свързан с почистването?
          </h1>
          <p class="text-justify text-gray-500 indent-5 my-5 text-sm lg:text-base">
            Не се притеснявайте да се свържeте с нас! Ние предлагаме много
            голям асортимент от професионални почистващи услуги. Клиентите ни
            нареждат на първо място по качество и бързина на предоставенaта
            услуга! Изберете нас за да можем да направим домът Ви удобен и
            уютен.
          </p>
          <p class="text-justify text-gray-500 indent-5 text-sm lg:text-base">
            Носители на наградата "Excelent cleaning servises " за 2023 г. Ние
            сме първите на локалния пазар, които предоставиха пълен пакет за
            почистване!
          </p>
          <button class="inline-flex mt-5 items-center justify-center w-full md:w-auto px-6 py-1.5 bg-blue-400 hover:bg-blue-500 text-sm lg:text-base font-semibold rounded-md transition-all text-white active:scale-90">
            Нашите услуги
          </button>
        </div>
        <div class="hidden md:flex w-1/2 justify-center">
          <img class="object-cover" src="images/about-2-434x410.png" alt="team photo" />
        </div>
      </div>
    </section>

    <section>
      <div class="text-slate-700 mt-16">
        <h1 class="text-center font-semibold text-xl md:text-2xl lg:text-3xl px-4 sm:px-0">
          Предлагаме висококачествени услуги
        </h1>
        <h2 class="text-center font-bold text-xl md:text-2xl lg:text-3xl">
          На достъпни цени
        </h2>
        <div class="flex items-center justify-center mt-4 md:mt-5 mb-10 md:mb-14">
          <div class="w-4 lg:w-5 h-0.5 lg:h-[3px] bg-[#5ca1e1] mr-2.5"></div>
          <div class="w-16 lg:w-20 h-0.5 lg:h-[3px] bg-[#5ca1e1]"></div>
        </div>
        <div class="lg:flex items-center w-full px-8 md:px-16 lg:px-20 gap-x-14">
          <div class="w-full lg:w-4/12" data-aos="slide-right" data-aos-duration="2000">
            <div class="shadow-2xl lg:shadow-none p-6 lg:p-0 rounded-lg border lg:border-0 border-slate-100">
              <div class="w-full flex justify-center lg:justify-end">
                <img src="images/icon-5.png" alt="vacum machine" />
              </div>
              <div class="text-center lg:text-right font-bold text-lg md:text-xl lg:text-2xl mt-1 md:mt-1.5">
                Почистване на домове
              </div>
              <div class="flex lg:justify-end mt-2 md:mt-2.5">
                <div class="text-justify md:text-center lg:text-justify text-sm md:text-base">
                  Поддържаме дома Ви блестящо чист и без микроби. Нашият
                  процес на дезинфекция убива 99% от често срещаните бактерии
                  и вируси.
                </div>
              </div>
            </div>
            <div class="shadow-2xl lg:shadow-none p-6 lg:p-0 rounded-lg border lg:border-0 border-slate-100 mt-8 md:mt-10">
              <div class="w-full flex justify-center lg:justify-end">
                <img src="images/icon-7.png" alt="washing machine" />
              </div>
              <div class="text-center lg:text-right font-bold text-lg md:text-xl lg:text-2xl mt-1 md:mt-1.5">
                Цялостно пране
              </div>
              <div class="flex lg:justify-end mt-2 md:mt-2.5">
                <div class="text-justify md:text-center lg:text-justify text-sm md:text-base">
                  Почистване и пране на мека мебел и мебели. Грижим се всяко
                  кътче от домът ви да е изящен и блестящ, отговарящо на
                  нашите стандарти.
                </div>
              </div>
            </div>
          </div>
          <div class="hidden lg:block w-4/12" data-aos="slide-up" data-aos-duration="2000">
            <div class="rounded-full p-5 border-2 border-gray-200">
              <img class="object-cover rounded-full w-full" src="images/image_03-1-600x600.jpg" alt="girl with dog" />
            </div>
            <div class="w-full flex justify-center">
              <button class="inline-flex mt-8 xl:mt-5 items-center justify-center w-full md:w-auto px-6 py-2.5 bg-blue-400 hover:bg-blue-500 text-sm lg:text-base font-semibold rounded-3xl transition-all text-white active:scale-90">
                Вижте повече
              </button>
            </div>
          </div>
          <div class="w-full lg:w-4/12" data-aos="slide-left" data-aos-duration="2000">
            <div class="shadow-2xl lg:shadow-none p-6 lg:p-0 rounded-lg border lg:border-0 border-slate-100 mt-8 md:mt-10 lg:mt-0">
              <div class="w-full flex justify-center lg:justify-start">
                <img src="images/icon-8.png" alt="ring" />
              </div>
              <div class="text-center lg:text-left font-bold text-lg md:text-xl lg:text-2xl mt-1 md:mt-1.5">
                Почистване на офиси
              </div>
              <div class="mt-2 md:mt-2.5">
                <div class="text-justify md:text-center lg:text-justify text-sm md:text-base">
                  Поддържаме офиса Ви блестящо чист и без микроби. Нашият
                  процес на дезинфекция убива 99% от често срещаните бактерии
                  и вируси.
                </div>
              </div>
            </div>
            <div class="shadow-2xl lg:shadow-none p-6 lg:p-0 rounded-lg border lg:border-0 border-slate-100 mt-8 md:mt-10">
              <div class="w-full flex justify-center lg:justify-start">
                <img src="images/icon-9.png" alt="window" />
              </div>
              <div class="text-center lg:text-left font-bold text-lg md:text-xl lg:text-2xl mt-1 md:mt-1.5">
                Почистване на прозорци
              </div>
              <div class="mt-2 md:mt-2.5">
                <div class="text-justify md:text-center lg:text-justify text-sm md:text-base">
                  Нашите екипи прилагат съвременни методи за почистване на
                  прозорци. Нашите препарати поддържат прозорците чисти
                  по-дълго.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section>
      <div class="bg-[#f5f5f5] text-slate-700 mt-16 lg:mt-20 py-10 md:py-12 lg:py-14 px-6 sm:px-8 md:px-16 lg:px-28 xl:px-40">
        <div class="text-center font-bold text-xl sm:text-2xl md:text-3xl lg:text-4xl sm:px-16 xl:px-20 2xl:px-24">
          Разгледайте нашите оферти и направете подходящият избор за Вас
        </div>
        <div class="flex items-center justify-center mt-5 md:mt-6 mb-10 md:mb-14">
          <div class="w-4 lg:w-5 h-0.5 lg:h-[3px] bg-[#5ca1e1] mr-2.5"></div>
          <div class="w-16 lg:w-20 h-0.5 lg:h-[3px] bg-[#5ca1e1]"></div>
        </div>
        <div class="text-justify sm:text-center md:text-lg lg:text-xl font-semibold">
          Carpet Cleaning предоставя калкулатор на разходите – уникален
          инструмент, който Ви позволява лесно да пресметнете и оцените нашите
          цени. Направете сами преценка коя оферта е подходяща за Вас!
        </div>
        <div class="sm:flex sm:space-x-6 lg:space-x-8 xl:space-x-12 space-y-8 sm:space-y-0 mt-8 md:mt-12 lg:mt-14 mb-8 lg:mb-10">
          <div class="w-full sm:w-1/2 p-6 md:p-8 border border-slate-100 bg-white rounded shadow-box">
            <div class="italic text-sm md:text-base font-semibold">
              Oбща площ за почистване в квадратни метра
            </div>
            <div class="flex mt-2 md:mt-3">
              <input id="slider" type="range" value="1000" min="0" max="2000" class="w-full h-2 mr-5 mt-3.5" />
              <input type="text" id="final" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:bg-transparent focus:outline-none focus:ring-0 block py-2 w-16 font-semibold text-center transition-all" value="1000" />
            </div>
          </div>
          <div class="w-full sm:w-1/2 p-6 md:p-8 border border-slate-100 bg-white rounded shadow-box">
            <div class="italic font-semibold text-sm md:text-base">
              Изберете вид на помещение
            </div>
            <select id="select-buil" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm mt-2 md:mt-3 rounded-md focus:ring-0 focus:border block w-full py-2 px-3">
              <option value="0">Къща</option>
              <option value="1">Офис</option>
              <option value="2">Салон</option>
            </select>
          </div>
        </div>

        <div class="md:flex items-center justify-between space-y-10 md:space-y-0 md:space-x-5 lg:space-x-12">
          <div class="w-full md:w-72 xl:w-80 2xl:w-96 p-4 bg-white shadow-lg rounded-md">
            <p class="mb-4 text-xl font-bold text-gray-800 text-center md:text-left">
              Основна оферта
            </p>
            <p class="text-3xl text-gray-900 text-center md:text-left">
              <span id="slider_value0" class="font-bold">150.00 лв.</span>
              <span class="text-sm text-slate-400 font-semibold"> / еднократно</span>
            </p>
            <ul class="w-full mt-6 mb-6 text-sm text-gray-600">
              <span v-for="(service, index) in services">
                <li v-show="index < 3" class="mb-3 flex items-center">
                  <svg class="w-6 h-6 mr-2" stroke="currentColor" fill="#10b981" viewBox="0 0 1792 1792">
                    <path d="M1412 734q0-28-18-46l-91-90q-19-19-45-19t-45 19l-408 407-226-226q-19-19-45-19t-45 19l-91 90q-18 18-18 46 0 27 18 45l362 362q19 19 45 19 27 0 46-19l543-543q18-18 18-45zm252 162q0 209-103 385.5t-279.5 279.5-385.5 103-385.5-103-279.5-279.5-103-385.5 103-385.5 279.5-279.5 385.5-103 385.5 103 279.5 279.5 103 385.5z"></path>
                  </svg>
                  {{ service }}
                </li>
                <li v-show="index > 2" class="mb-3 flex items-center opacity-50">
                  <svg class="w-6 h-6 mr-2" fill="red" viewBox="0 0 1792 1792">
                    <path d="M1277 1122q0-26-19-45l-181-181 181-181q19-19 19-45 0-27-19-46l-90-90q-19-19-46-19-26 0-45 19l-181 181-181-181q-19-19-45-19-27 0-46 19l-90 90q-19 19-19 46 0 26 19 45l181 181-181 181q-19 19-19 45 0 27 19 46l90 90q19 19 46 19 26 0 45-19l181-181 181 181q19 19 45 19 27 0 46-19l90-90q19-19 19-46zm387-226q0 209-103 385.5t-279.5 279.5-385.5 103-385.5-103-279.5-279.5-103-385.5 103-385.5 279.5-279.5 385.5-103 385.5 103 279.5 279.5 103 385.5z"></path>
                  </svg>
                  {{ service }}
                </li>
              </span>
            </ul>
            <?php if ($email) { ?>
              <button type="button" onclick="location.replace('account')" class="py-2 px-4 bg-blue-600 hover:bg-blue-700 focus:ring-0 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none rounded-lg active:scale-90">
                Направете поръчка
              </button>
            <?php } else { ?>
              <button type="button" onclick="location.replace('order')" class="py-2 px-4 bg-blue-600 hover:bg-blue-700 focus:ring-0 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none rounded-lg active:scale-90">
                Направете поръчка
              </button>
            <?php } ?>
          </div>

          <div class="w-full md:w-72 xl:w-80 2xl:w-96 p-4 bg-white shadow-lg rounded-md">
            <p class="mb-4 text-xl font-bold text-gray-800 text-center md:text-left">
              Премиум оферта
            </p>
            <p class="text-3xl font-bold text-gray-900 text-center md:text-left">
              <span id="slider_value1" class="font-bold">200.00 лв.</span>
              <span class="text-sm text-slate-400 font-semibold"> / еднократно</span>
            </p>
            <ul class="w-full mt-6 mb-6 text-sm text-gray-600">
              <span v-for="(service, index) in services">
                <li v-show="index < 5" class="mb-3 flex items-center">
                  <svg class="w-6 h-6 mr-2" stroke="currentColor" fill="#10b981" viewBox="0 0 1792 1792">
                    <path d="M1412 734q0-28-18-46l-91-90q-19-19-45-19t-45 19l-408 407-226-226q-19-19-45-19t-45 19l-91 90q-18 18-18 46 0 27 18 45l362 362q19 19 45 19 27 0 46-19l543-543q18-18 18-45zm252 162q0 209-103 385.5t-279.5 279.5-385.5 103-385.5-103-279.5-279.5-103-385.5 103-385.5 279.5-279.5 385.5-103 385.5 103 279.5 279.5 103 385.5z"></path>
                  </svg>
                  {{ service }}
                </li>
                <li v-show="index > 4" class="mb-3 flex items-center opacity-50">
                  <svg class="w-6 h-6 mr-2" fill="red" viewBox="0 0 1792 1792">
                    <path d="M1277 1122q0-26-19-45l-181-181 181-181q19-19 19-45 0-27-19-46l-90-90q-19-19-46-19-26 0-45 19l-181 181-181-181q-19-19-45-19-27 0-46 19l-90 90q-19 19-19 46 0 26 19 45l181 181-181 181q-19 19-19 45 0 27 19 46l90 90q19 19 46 19 26 0 45-19l181-181 181 181q19 19 45 19 27 0 46-19l90-90q19-19 19-46zm387-226q0 209-103 385.5t-279.5 279.5-385.5 103-385.5-103-279.5-279.5-103-385.5 103-385.5 279.5-279.5 385.5-103 385.5 103 279.5 279.5 103 385.5z"></path>
                  </svg>
                  {{ service }}
                </li>
              </span>
            </ul>
            <?php if ($email) { ?>
              <button type="button" onclick="location.replace('account')" class="py-2 px-4 bg-blue-600 hover:bg-blue-700 focus:ring-0 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none rounded-lg active:scale-90">
                Направете поръчка
              </button>
            <?php } else { ?>
              <button type="button" onclick="location.replace('order')" class="py-2 px-4 bg-blue-600 hover:bg-blue-700 focus:ring-0 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none rounded-lg active:scale-90">
                Направете поръчка
              </button>
            <?php } ?>
          </div>

          <div class="w-full md:w-72 xl:w-80 2xl:w-96 p-4 bg-white shadow-lg rounded-md">
            <p class="mb-4 text-xl font-bold text-gray-800 text-center md:text-left">
              Вип оферта
            </p>
            <p class="text-3xl font-bold text-gray-900 text-center md:text-left">
              <span id="slider_value2" class="font-bold">250.00 лв.</span>
              <span class="text-sm text-slate-400 font-semibold"> / еднократно</span>
            </p>
            <ul class="w-full mt-6 mb-6 text-sm text-gray-600">
              <li v-for="service in services" class="mb-3 flex items-center">
                <svg class="w-6 h-6 mr-2" stroke="currentColor" fill="#10b981" viewBox="0 0 1792 1792">
                  <path d="M1412 734q0-28-18-46l-91-90q-19-19-45-19t-45 19l-408 407-226-226q-19-19-45-19t-45 19l-91 90q-18 18-18 46 0 27 18 45l362 362q19 19 45 19 27 0 46-19l543-543q18-18 18-45zm252 162q0 209-103 385.5t-279.5 279.5-385.5 103-385.5-103-279.5-279.5-103-385.5 103-385.5 279.5-279.5 385.5-103 385.5 103 279.5 279.5 103 385.5z"></path>
                </svg>
                {{ service }}
              </li>
            </ul>
            <?php if ($email) { ?>
              <button type="button" onclick="location.replace('account')" class="py-2 px-4 bg-blue-600 hover:bg-blue-700 focus:ring-0 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none rounded-lg active:scale-90">
                Направете поръчка
              </button>
            <?php } else { ?>
              <button type="button" onclick="location.replace('order')" class="py-2 px-4 bg-blue-600 hover:bg-blue-700 focus:ring-0 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none rounded-lg active:scale-90">
                Направете поръчка
              </button>
            <?php } ?>
          </div>
        </div>
      </div>
    </section>

    <section>
      <div class="p-8 md:p-12 lg:p-14 xl:p-16 text-slate-700">
        <div class="uppercase font-bold text-xs lg:text-sm text-gray-400 text-center">
          нашите служители
        </div>
        <h1 class="text-center font-semibold text-xl md:text-2xl lg:text-3xl">
          Какво казват нашите професионалисти
        </h1>
        <p class="text-gray-400 text-justify md:text-center text-sm md:text-base lg:text-lg md:px-16 lg:px-32 mt-6">
          Мнението на служителите е изграждаща единица в развитието на всяка
          компания. Ето защо мнението на нашите служители е важно за нас за
          поддържаме нашата репутация на високо ниво! Благодарим, че избрахте
          нас!
        </p>
        <div class="lg:flex lg:space-x-16 space-y-8 lg:space-y-0 mt-12">
          <div class="w-full lg:w-4/12">
            <div class="p-10 lg:p-6 rounded border border-t-[3px] border-t-[#ffd800] bordr-slate-100 text-center shadow-md">
              <p>
                "За нас е важно винаги да предоставяме само еднотипни
                качествени услуги и продукти на нашите клиенти"
              </p>
            </div>
            <img class="object-cover mx-auto mt-6" src="images/testimonials-1.png" alt="Filip Ivanov" />
            <h1 class="text-center font-semibold text-xl lg:text-2xl">
              Филип Иванов
            </h1>
            <h3 class="font-semibold text-center text-gray-400 text-sm lg:text-base">
              SEO специалист
            </h3>
          </div>
          <div class="w-full lg:w-4/12">
            <div class="p-10 lg:p-6 rounded border border-t-[3px] border-t-[#91c63f] bordr-slate-100 text-center shadow-md">
              <p>
                "Най-добрата реклама е добре свършената работа. Това ни
                мотивира да даваме 100% от себе си"
              </p>
            </div>
            <img class="object-cover mx-auto mt-6" src="images/testimonials-3.png" alt="Viktoriq Markova" />
            <h1 class="text-center font-semibold text-xl lg:text-2xl">
              Виктория Маркова
            </h1>
            <h3 class="font-semibold text-center text-gray-400 text-sm lg:text-base">
              Директор
            </h3>
          </div>
          <div class="w-full lg:w-4/12">
            <div class="p-10 lg:p-6 rounded border border-t-[3px] border-t-[#0082ca] bordr-slate-100 text-center shadow-md">
              <p>
                "Успеха за всяка фирма идва от добре свършената работа и
                най-вече от доволните клиенти"
              </p>
            </div>
            <img class="object-cover mx-auto mt-6" src="images/testimonials-2.png" alt="Konstadin Todorov" />
            <h1 class="text-center font-semibold text-xl lg:text-2xl">
              Костадин Тодоров
            </h1>
            <h3 class="font-semibold text-center text-gray-400 text-sm lg:text-base">
              Маркетинг специалист
            </h3>
          </div>
        </div>
      </div>
    </section>

    <footer class="bg-slate-700">
      <div class="md:flex space-y-8 md:space-y-0 md:space-x-10 justify-evenly p-6 pb-0 sm:pb-0 sm:p-6 text-slate-100">
        <div>
          <h2 class="mb-3.5 font-medium md:font-semibold uppercase">Контакти</h2>
          <ul class="font-semibold">
            <li class="mb-3 flex items-center">
              <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-3.5 h-3.5 mr-1">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
              </svg>
              <span>Варна, ул. "Костадин Петков" 26</span>
            </li>
            <li class="mb-3 flex items-center">
              <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-3.5 h-3.5 mr-1">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
              </svg>
              <span class="hover:underline transition-all"><a href="mailto:carpetserv@gmail.com">carpetserv@gmail.com</a></span>
            </li>
            <li class="mb-3 flex items-center">
              <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-3.5 h-3.5 mr-1">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
              </svg>
              <span class="hover:underline transition-all"><a href="tel:+359-899-845-743">+359 899 845 743</a></span>
            </li>
          </ul>
        </div>
        <div>
          <h2 class="mb-3.5 font-medium md:font-semibold uppercase">Работно време</h2>
          <ul class="w-full font-medium md:font-semibold">
            <li class="mb-3">
              <span class="mr-3 text-slate-400">09:00 - 17:00</span>
              <span>Пон - Сря</span>
            </li>
            <li class="mb-3">
              <span class="mr-3 text-slate-400">09:00 - 17:00</span>
              <span>Чет - Пет</span>
            </li>
            <li>
              <span class="mr-6 text-slate-400">Затворено</span>
              <span>Съб - Нед</span>
            </li>
          </ul>
        </div>
        <div>
          <h2 class="mb-4 font-medium md:font-semibold uppercase">Бюлетин</h2>
          <div class="relative mb-2">
            <input type="text" class="bg-slate-700 border border-slate-600 text-white text-sm rounded-lg focus:outline-none focus:ring-0 focus:border-slate-600 block w-full pr-8 p-2.5 caret-white" placeholder="Въведете имейл" />
            <button class="absolute inset-y-0 right-0 flex items-center px-2.5 bg-blue-500 hover:bg-blue-600 rounded-r-lg transition-all active:scale-90">
              <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-slate-100">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
              </svg>
            </button>
          </div>
          <div class="font-medium md:font-semibold">Абонирайте се за нашия бюлетин за да сте актуални!</div>
        </div>
      </div>

      <div class="sm:flex sm:items-center sm:justify-between py-3.5 sm:py-6 px-6 sm:px-8 md:px-16 bg-gray-100 mt-5 md:mt-7">
        <span class="text-sm text-gray-500 sm:text-center">
          © 2022 <span class="font-semibold">Ерсин Хюсеин</span> Всички права запазени.
        </span>
        <div class="flex gap-x-6 justify-center mt-2.5 sm:mt-0 text-gray-500">
          <a href="#">
            <svg class="w-5 h-5 hover:text-[#4267B2] transition-all" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
            </svg>
          </a>
          <a href="#">
            <svg class="w-5 h-5 hover:text-[#1DA1F2] transition-all" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
            </svg>
          </a>
          <a href="#">
            <svg class="w-5 h-5 hover:text-[#8a3ab9] transition-all" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
            </svg>
          </a>
          <a href="#">
            <svg class="w-5 h-5 hover:text-[#ea4c89] transition-all" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path fill-rule="evenodd" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c5.51 0 10-4.48 10-10S17.51 2 12 2zm6.605 4.61a8.502 8.502 0 011.93 5.314c-.281-.054-3.101-.629-5.943-.271-.065-.141-.12-.293-.184-.445a25.416 25.416 0 00-.564-1.236c3.145-1.28 4.577-3.124 4.761-3.362zM12 3.475c2.17 0 4.154.813 5.662 2.148-.152.216-1.443 1.941-4.48 3.08-1.399-2.57-2.95-4.675-3.189-5A8.687 8.687 0 0112 3.475zm-3.633.803a53.896 53.896 0 013.167 4.935c-3.992 1.063-7.517 1.04-7.896 1.04a8.581 8.581 0 014.729-5.975zM3.453 12.01v-.26c.37.01 4.512.065 8.775-1.215.25.477.477.965.694 1.453-.109.033-.228.065-.336.098-4.404 1.42-6.747 5.303-6.942 5.629a8.522 8.522 0 01-2.19-5.705zM12 20.547a8.482 8.482 0 01-5.239-1.8c.152-.315 1.888-3.656 6.703-5.337.022-.01.033-.01.054-.022a35.318 35.318 0 011.823 6.475 8.4 8.4 0 01-3.341.684zm4.761-1.465c-.086-.52-.542-3.015-1.659-6.084 2.679-.423 5.022.271 5.314.369a8.468 8.468 0 01-3.655 5.715z" clip-rule="evenodd" />
            </svg>
          </a>
        </div>
      </div>
    </footer>
  </div>

  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init({
      disable: function() {
        var maxWidth = 850;
        return window.innerWidth < maxWidth;
      },
    });
  </script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
  <script src="js/main-vue.js"></script>
  <script src="js/main.js"></script>
  <script src="js/ajax.js"></script>
  <script src="loader/siteLoader.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
</body>

</html>