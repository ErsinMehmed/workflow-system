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

  <link rel="shortcut icon" href="images/title.png" />
  <link rel="stylesheet" href="css/app.css" />
  <link rel="stylesheet" href="css/alert.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

  <script src="https://unpkg.com/vue@3.2.47/dist/vue.global.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>

  <title>Carpet Cleaning | Акаунт</title>
</head>

<body>
  <div id="site-load" class="loader__wrap" role="alertdialog" aria-busy="true" aria-live="polite" aria-label="Loading…">
    <div class="loader" aria-hidden="true">
      <div class="loader__sq"></div>
      <div class="loader__sq"></div>
    </div>
  </div>

  <?php if ($email) { ?>
    <section>
      <div id="app">
        <div class="w-full h-1 rounded-r-full fixed z-40 top-0 left-0 bg-blue-400" :style="{ width: progress }"></div>
        <div class="fixed z-30 right-4 bottom-4 w-10 h-10 hidden bg-blue-500 hover:bg-blue-600 lg:flex rounded-full justify-center items-center cursor-pointer transition-all" style="
            box-shadow: rgb(0 0 0 / 25%) 0px 14px 28px,
              rgb(0 0 0 / 22%) 0px 10px 10px;
          " v-show="scY > 300" @click="goTop">
          <svg fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-7 h-7 rounded-full -mt-0.5 text-white">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
          </svg>
        </div>

        <div v-show="imagePreview != null && documentSection" id="toast-message" class="hidden md:flex fixed z-40 top-24 right-4 items-center p-4 w-full max-w-sm text-gray-500 bg-white rounded-lg shadow-xl border border-slate-100" role="alert">
          <div class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-green-500 bg-green-100 rounded-lg">
            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
            </svg>
          </div>
          <div class="ml-3 text-sm font-normal">
            Натиснете върху снимката за да я смените.
          </div>
          <button type="button" class="bg-white text-gray-400 hover:text-gray-700 rounded-lg focus:outline-none focus:ring-0 p-1.5 hover:bg-gray-50 inline-flex h-8 w-8 transition-all" data-dismiss-target="#toast-message" aria-label="Close">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
          </button>
        </div>

        <nav class="bg-white border-b border-slate-200 shadow-md sm:px-0 pt-3 md:py-3 top-0 sticky z-30">
          <div class="bg-white flex flex-wrap sm:px-5 md:px-6 lg:px-12 pb-3 md:pb-0 items-center justify-between">
            <a href="/" class="flex items-center pl-5 sm:pl-0">
              <img src="images/main-logo.png" class="h-7 mr-3 md:h-12" alt="Main logo" />
            </a>
            <div class="flex items-center pr-5 sm:pr-0">
              <?php
              $query = "SELECT * FROM customers WHERE email = '$email'";
              $query_run = mysqli_query($con, $query);
              $rows = mysqli_fetch_array($query_run);

              $src = ($rows["image"] != "") ? "uploaded-files/customer-images/{$rows["image"]}" : "images/user.png"; ?>
              <img src="<?= $src ?>" alt="profile-image" class="w-8 h-8 cursor-pointer hover:opacity-75 transition-all rounded-full object-cover md:hidden active:scale-90 update-photo">
              <img class="w-8 h-8 object-cover cursor-pointer hover:opacity-75 transition-all rounded-full md:hidden ml-2.5 mr-1" src="images/britain-flag.png" alt="english" />
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
                  <a href="/" class="flex items-center py-2 pl-3 pr-4 text-gray-700 rounded-md hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 transition-all active:scale-90">
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
                $query = "SELECT * FROM customers WHERE email = '$email'";
                $query_run = mysqli_query($con, $query);

                while ($rows = mysqli_fetch_array($query_run)) {
                  if ($rows["image"] != "") { ?>
                    <li>
                      <img src="uploaded-files/customer-images/<?= $rows["image"] ?>" alt="Profile image" class="w-8 h-8 cursor-pointer hover:opacity-75
                  transition-all rounded-full object-cover hidden md:block
                  active:scale-90 update-photo">
                    </li>
                  <?php } else { ?>
                    <li>
                      <img src="images/user.png" alt="Profile image" class="w-8 h-8 cursor-pointer hover:opacity-75 transition-all rounded-full object-cover hidden md:block active:scale-90" />
                    </li>
                <?php }
                } ?>
                <li>
                  <img class="w-8 h-8 object-cover cursor-pointer hover:opacity-75 transition-all rounded-full hidden md:block active:scale-90" src="images/britain-flag.png" alt="english" />
                </li>
              </ul>
            </div>
          </div>
        </nav>

        <div class="h-screen md:h-full md:mt-10 w-full md:flex md:justify-center md:items-center md:my-10">
          <div class="w-full md:w-[50rem] lg:w-[55rem] xl:w-[65rem] 2xl:w-[66rem] md:shadow-xl py-6 px-6 md:py-8 md:px-10 md:rounded-xl md:border border-slate-50 md:flex md:space-x-10">
            <div class="w-full md:w-[20%] mx-auto">
              <ul class="flex justify-between md:block md:space-y-3 text-slate-600 font-semibold sm:px-6 md:px-0 pb-3 md:pb-0 md:mt-0">
                <li @click="accountSection = true; passwordSection = false;  historySection= false; documentSection = false; orderSection = false; rateSection = false ; activeOrders = false" :class="accountSection ? 'text-slate-700 bg-[#deebfd] hover:bg-[#d1e4ff]' : 'bg-white hover:bg-[#deebfd] hover:text-slate-700'" class="flex items-center justify-center md:justify-start py-2.5 md:py-1.5 px-2.5 md:pl-3 transition-all rounded-lg md:rounded-xl cursor-pointer active:scale-90">
                  <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 md:w-5 md:h-5 md:mr-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                  </svg>
                  <span class="hidden md:block">Акаунт</span>
                </li>
                <li @click="passwordSection = true; accountSection = false;  historySection = false; documentSection = false; orderSection = false; rateSection = false; activeOrders = false" :class="passwordSection ? 'text-slate-700 bg-[#deebfd] hover:bg-[#d1e4ff]' : 'bg-white hover:bg-[#deebfd] hover:text-slate-700'" class="flex items-center justify-center md:justify-start py-2.5 md:py-1.5 px-2.5 md:pl-3 transition-all rounded-lg md:rounded-xl cursor-pointer active:scale-90">
                  <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 md:w-5 md:h-5 md:mr-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                  </svg>
                  <span class="hidden md:block">Парола</span>
                </li>
                <?php
                $query = "SELECT * FROM orders WHERE email = '$email' AND status = 'В процес'";
                $query_run = mysqli_query($con, $query);
                while ($rows = mysqli_fetch_array($query_run)) {
                  if ($rows["step"] > 0 && $rows["step"] < 5) { ?>
                    <li @click="activeOrders = true; passwordSection = false; accountSection = false;  historySection = false; documentSection = false; orderSection = false; rateSection = false" :class="activeOrders ? 'text-slate-700 bg-[#deebfd] hover:bg-[#d1e4ff]' : 'bg-white hover:bg-[#deebfd] hover:text-slate-700'" class="flex items-center justify-center md:justify-start py-2.5 md:py-1.5 px-2.5 md:pl-3 transition-all rounded-lg md:rounded-xl cursor-pointer active:scale-90">
                      <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 md:w-5 md:h-5 md:mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 00-3.7-3.7 48.678 48.678 0 00-7.324 0 4.006 4.006 0 00-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3l-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 003.7 3.7 48.656 48.656 0 007.324 0 4.006 4.006 0 003.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3l-3 3" />
                      </svg>
                      <span class="hidden md:block">Активни</span>
                    </li>
                <?php }
                } ?>
                <li @click=" historySection = true; accountSection = false;  passwordSection = false; documentSection = false; orderSection = false; rateSection = false; activeOrders = false" :class=" historySection ? 'text-slate-700 bg-[#deebfd] hover:bg-[#d1e4ff]' : 'bg-white hover:bg-[#deebfd] hover:text-slate-700'" class="flex items-center justify-center md:justify-start py-2.5 md:py-1.5 px-2.5 md:pl-3 transition-all rounded-lg md:rounded-xl cursor-pointer active:scale-90">
                  <svg fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor" class="w-7 h-7 md:w-5 md:h-5 md:mr-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  <span class="hidden md:block">История</span>
                </li>
                <li @click="documentSection = true; accountSection = false;  passwordSection = false; historySection = false; orderSection = false; rateSection = false; activeOrders = false" :class="documentSection ? 'text-slate-700 bg-[#deebfd] hover:bg-[#d1e4ff]' : 'bg-white hover:bg-[#deebfd] hover:text-slate-700'" class="flex items-center justify-center md:justify-start py-2.5 md:py-1.5 px-2.5 md:pl-3 transition-all rounded-lg md:rounded-xl cursor-pointer active:scale-90">
                  <svg fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor" class="w-7 h-7 md:w-5 md:h-5 md:mr-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75" />
                  </svg>
                  <span class="hidden md:block">Документи</span>
                </li>
                <li @click="orderSection = true; documentSection = false; accountSection = false;  passwordSection = false; historySection = false; rateSection = false; activeOrders = false" :class="orderSection ? 'text-slate-700 bg-[#deebfd] hover:bg-[#d1e4ff]' : 'bg-white hover:bg-[#deebfd] hover:text-slate-700'" class="flex items-center justify-center md:justify-start py-2.5 md:py-1.5 px-2.5 md:pl-3 transition-all rounded-lg md:rounded-xl cursor-pointer active:scale-90">
                  <svg fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor" class="w-7 h-7 md:w-5 md:h-5 md:mr-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                  </svg>
                  <span class="hidden md:block">Поръчка</span>
                </li>
                <li @click="rateSection = true; orderSection = false; documentSection = false; accountSection = false;  passwordSection = false; historySection = false; activeOrders = false" :class="rateSection ? 'text-slate-700 bg-[#deebfd] hover:bg-[#d1e4ff]' : 'bg-white hover:bg-[#deebfd] hover:text-slate-700'" class="flex items-center justify-center md:justify-start py-2.5 md:py-1.5 px-2.5 md:pl-3 transition-all rounded-lg md:rounded-xl cursor-pointer active:scale-90">
                  <svg fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor" class="w-7 h-7 md:w-5 md:h-5 md:mr-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                  </svg>
                  <span class="hidden md:block">Оценки</span>
                </li>
                <li id="log-out" class="flex items-center justify-center md:justify-start py-3 md:py-1.5 px-3 md:pl-3 transition-all rounded-xl cursor-pointer active:scale-90 bg-white hover:bg-[#deebfd] hover:text-slate-700">
                  <svg fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor" class="w-7 h-7 md:w-5 md:h-5 md:mr-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                  </svg>
                  <span class="hidden md:block">Изход</span>
                </li>
              </ul>
            </div>

            <div v-show="accountSection" class="w-full md:w-[80%] shadow-lg rounded-xl border border-slate-50 p-6 md:p-8 text-slate-700 animate__animated animate__fadeIn">
              <?php
              $query = "SELECT * FROM customers WHERE email = '$email'";
              $query_run = mysqli_query($con, $query);
              while ($rows = mysqli_fetch_array($query_run)) {
                if ($rows["email_verify"] == "") { ?>
                  <div id="alert-additional-content" class="p-3.5 border border-gray-300 rounded-lg bg-gray-50 mb-2.5">
                    <div class="flex items-center">
                      <svg aria-hidden="true" class="w-5 h-5 mr-1.5 text-slate-700" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                      </svg>
                      <h3 class="text-lg font-semibold text-slate-700">Не сте потвърдили имейла си</h3>
                    </div>
                    <div class="mt-1.5 mb-3 text-sm text-slate-700">
                      За да можете да направите поръчка трябва да потвърдите имейла си с изпратения от нас код на имейлът Ви.
                    </div>
                    <div class="flex">
                      <button id="email-verify-btn" type="button" class="text-white bg-gray-500 hover:bg-gray-600 focus:outline-none font-semibold rounded-lg text-xs px-3 py-1.5 mr-2 text-center inline-flex items-center transition-all active:scale-90">
                        <svg viewBox="0 0 24 24" fill="currentColor" class="mr-1 h-3.5 w-3.5">
                          <path d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z" />
                          <path d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z" />
                        </svg>
                        Потвърждаване
                      </button>
                      <button type="button" class="text-slate-700 bg-transparent border border-gray-700 hover:bg-slate-700 hover:text-white focus:outline-none font-semibold rounded-lg text-xs px-3 py-1.5 text-center transition-all active:scale-90" data-dismiss-target="#alert-additional-content" aria-label="Close">
                        По-късно
                      </button>
                    </div>
                  </div>
                <?php }
                if ($rows["phone_verify"] == "") { ?>
                  <div id="alert-additional-content-mobile" class="p-3.5 border border-blue-100 rounded-lg bg-blue-50 mb-2.5">
                    <div class="flex items-center">
                      <svg aria-hidden="true" class="w-5 h-5 mr-1.5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                      </svg>
                      <h3 class="text-lg font-semibold text-blue-600">Не сте потвърдили телефонният си номер</h3>
                    </div>
                    <div class="mt-1.5 mb-3 text-sm text-blue-600">
                      За да можете да направите поръчка трябва да потвърдите телефонният си номер с изпратения от нас код на посоченият от Вас номер.
                    </div>
                    <div class="flex">
                      <button id="phone-verify-btn" type="button" class="text-white bg-blue-500 hover:bg-blue-600 focus:outline-none font-semibold rounded-lg text-xs px-3 py-1.5 mr-2 text-center inline-flex items-center transition-all active:scale-90">
                        <svg viewBox="0 0 24 24" fill="currentColor" class="mr-1 h-3.5 w-3.5">
                          <path fill-rule="evenodd" d="M1.5 4.5a3 3 0 013-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 01-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 006.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 011.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 01-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5z" clip-rule="evenodd" />
                        </svg>
                        Потвърждаване
                      </button>
                      <button type="button" class="text-blue-600 bg-transparent border border-blue-600 hover:bg-blue-600 hover:text-white focus:outline-none font-semibold rounded-lg text-xs px-3 py-1.5 text-center transition-all active:scale-90" data-dismiss-target="#alert-additional-content-mobile" aria-label="Close">
                        По-късно
                      </button>
                    </div>
                  </div>
              <?php }
              } ?>
              <h1 class="font-bold text-2xl mb-6 md:mb-8 text-center sm:text-left">
                Акаунт
              </h1>
              <div class="font-bold sm:ml-4 mb-2 text-center sm:text-left">
                Снимка
              </div>
              <?php
              $query = "SELECT * FROM customers WHERE email = '$email'";
              $query_run = mysqli_query($con, $query);

              while ($rows = mysqli_fetch_array($query_run)) { ?>
                <div class="sm:flex items-center sm:space-x-4">
                  <img class="object-cover w-24 h-24 rounded-full shadow-lg mx-auto sm:mx-0 update-photo" :src="profileImgPreview ? profileImgPreview : ('<?= $rows["image"] ?>' ? 'uploaded-files/customer-images/<?= $rows["image"] ?>' : 'images/user.png')" alt="Profile photo" />
                  <form id="customer-image-form">
                    <div class="sm:inline-flex sm:gap-x-4 space-y-4 sm:space-y-0 mt-3 sm:mt-0">
                      <button v-show="profileImgPreview != null" @click="profileImgPreview = null" type="submit" class="w-full block py-2 px-6 text-sm font-bold text-white focus:outline-none bg-blue-500 rounded-lg shadow-md border border-blue-500 hover:bg-blue-600 transition-all active:scale-90">
                        Запази
                      </button>
                      <input type="hidden" id="getCustomerEmail" name="customerEmail" value="<?= $email ?>" />
                      <label class="w-full block py-2 px-6 text-sm font-bold text-blue-600 hover:text-blue-700 focus:outline-none bg-white rounded-lg shadow-md border border-gray-100 hover:bg-gray-50 transition-all active:scale-90 cursor-pointer" for="profile-photo-input">
                        <div class="text-center">Избери</div>
                        <input @change="profilePhotoUpdate" id="profile-photo-input" name="customerImage" type="file" class="hidden" accept="image/png, image/jpg, image/jpeg" />
                      </label>
                    </div>
                  </form>
                </div>

                <hr class="w-full my-5 sm:my-6" />
                <form id="user-info-form">
                  <div class="sm:flex items-center sm:space-x-5 space-y-4 sm:space-y-0">
                    <div class="sm:w-1/2">
                      <label for="full-name" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                        Име
                      </label>
                      <input id="full-name" type="text" minlength="2" value="<?= $rows['name'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 focus:outline-none cursor-not-allowed" readonly />
                    </div>
                    <div class="sm:w-1/2">
                      <label for="username" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                        Потребителско име
                      </label>
                      <input id="username" type="text" minlength="2" name="username" value="<?= $rows['username'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring-0 focus:border-gray-400 w-full p-2.5" placeholder="Потребителско име" />
                    </div>
                  </div>
                  <div class="sm:flex items-center sm:space-x-5 space-y-4 sm:space-y-0 mt-6">
                    <div class="sm:w-1/2">
                      <label for="userEmail" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                        Имейл
                      </label>
                      <input id="userEmail" type="text" minlength="5" name="userEmail" value="<?= $rows['email'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 focus:outline-none cursor-not-allowed" readonly />
                    </div>
                    <div class="sm:w-1/2">
                      <label for="phone-number" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                        Телефонен номер
                      </label>
                      <input id="phone-number" type="text" minlength="9" name="phoneAccount" value="<?= $rows['phone'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring-0 focus:border-gray-400 w-full p-2.5" placeholder="Въведете телефон" />
                    </div>
                  </div>
                  <hr class="w-full mt-7 mb-6" />
                  <div class="w-full text-slate-700">
                    <div class="text-sm font-semibold">Линкове към акаунти</div>
                    <div class="text-xs font-semibold text-slate-400">
                      Ние Ви позволяваме да се регистрирате по-лесно без да губите
                      време
                    </div>
                  </div>
                  <div class="flex justify-between items-center mt-4">
                    <div class="flex items-center">
                      <svg viewBox="0 0 24 24" class="w-8 h-8">
                        <path fill="#EA4335" d="M5.26620003,9.76452941 C6.19878754,6.93863203 8.85444915,4.90909091 12,4.90909091 C13.6909091,4.90909091 15.2181818,5.50909091 16.4181818,6.49090909 L19.9090909,3 C17.7818182,1.14545455 15.0545455,0 12,0 C7.27006974,0 3.1977497,2.69829785 1.23999023,6.65002441 L5.26620003,9.76452941 Z" />
                        <path fill="#34A853" d="M16.0407269,18.0125889 C14.9509167,18.7163016 13.5660892,19.0909091 12,19.0909091 C8.86648613,19.0909091 6.21911939,17.076871 5.27698177,14.2678769 L1.23746264,17.3349879 C3.19279051,21.2936293 7.26500293,24 12,24 C14.9328362,24 17.7353462,22.9573905 19.834192,20.9995801 L16.0407269,18.0125889 Z" />
                        <path fill="#4A90E2" d="M19.834192,20.9995801 C22.0291676,18.9520994 23.4545455,15.903663 23.4545455,12 C23.4545455,11.2909091 23.3454545,10.5272727 23.1818182,9.81818182 L12,9.81818182 L12,14.4545455 L18.4363636,14.4545455 C18.1187732,16.013626 17.2662994,17.2212117 16.0407269,18.0125889 L19.834192,20.9995801 Z" />
                        <path fill="#FBBC05" d="M5.27698177,14.2678769 C5.03832634,13.556323 4.90909091,12.7937589 4.90909091,12 C4.90909091,11.2182781 5.03443647,10.4668121 5.26620003,9.76452941 L1.23999023,6.65002441 C0.43658717,8.26043162 0,10.0753848 0,12 C0,13.9195484 0.444780743,15.7301709 1.23746264,17.3349879 L5.27698177,14.2678769 Z" />
                      </svg>
                      <div class="text-slate-500 text-sm font-semibold ml-2">
                        Впишете се с Google
                      </div>
                    </div>
                    <button type="button" class="py-1.5 px-4 sm:px-6 text-sm font-bold text-blue-600 hover:text-blue-700 focus:outline-none bg-white rounded-lg shadow-md border border-gray-100 hover:bg-gray-50 transition-all active:scale-90">
                      Свързване
                    </button>
                  </div>
                  <div class="flex justify-between items-center mt-6">
                    <div class="flex items-center">
                      <svg class="w-8 h-8" viewBox="0 0 291.319 291.319" style="enable-background: new 0 0 291.319 291.319">
                        <path style="fill: #3b5998" d="M145.659,0c80.45,0,145.66,65.219,145.66,145.66c0,80.45-65.21,145.659-145.66,145.659
		                    S0,226.109,0,145.66C0,65.219,65.21,0,145.659,0z" />
                        <path style="fill: #ffffff" d="M163.394,100.277h18.772v-27.73h-22.067v0.1c-26.738,0.947-32.218,15.977-32.701,31.763h-0.055
                        v13.847h-18.207v27.156h18.207v72.793h27.439v-72.793h22.477l4.342-27.156h-26.81v-8.366
                        C154.791,104.556,158.341,100.277,163.394,100.277z" />
                      </svg>
                      <div class="text-slate-500 text-sm font-semibold ml-2">
                        Впишете се с Facebook
                      </div>
                    </div>
                    <button type="button" class="py-1.5 px-4 sm:px-6 text-sm font-bold text-blue-600 hover:text-blue-700 focus:outline-none bg-white rounded-lg shadow-md border border-gray-100 hover:bg-gray-50 transition-all active:scale-90">
                      Свързване
                    </button>
                  </div>
                  <hr class="w-full mt-7 mb-6" />
                  <div class="sm:flex justify-end">
                    <button type="submit" class="w-full sm:w-auto text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-0 font-semibold rounded-lg text-sm px-5 py-2.5 transition-all active:scale-90">
                      Запази промените
                    </button>
                  </div>
                <?php } ?>
                </form>
            </div>

            <div v-show="passwordSection" class="md:w-[80%] shadow-lg rounded-xl border border-slate-50 p-6 md:p-8 text-slate-700 animate__animated animate__fadeIn">
              <h1 class="font-bold text-2xl mb-6 md:mb-8 text-center sm:text-left">
                Парола
              </h1>
              <div class="font-semibold mb-1 sm:mb-2 text-slate-500 text-sm md:text-base text-center sm:text-left">
                Не сте сигурни, че акаунта Ви е защитен? Сменете паролата си!
              </div>
              <form id="update-customer-password">
                <div class="w-full mt-6">
                  <div class="sm:w-1/2 pr-2.5">
                    <input type="hidden" value="<?= $email ?>" name="customerEmail" />
                    <label for="old-password" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                      Стара парола
                    </label>
                    <input id="old-password" type="password" name="oldPassword" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring-0 focus:border-gray-400 w-full p-2.5" placeholder="••••••••••" />
                  </div>
                </div>
                <hr class="w-full my-5 sm:my-6" />
                <div class="sm:flex items-center sm:space-x-5 space-y-4 sm:space-y-0">
                  <div class="sm:w-1/2">
                    <label for="newPassword" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                      Нова парола
                    </label>
                    <input id="newPassword" type="password" minlength="8" name="newPassword" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring-0 focus:border-gray-400 w-full p-2.5" placeholder="••••••••••" />
                  </div>
                  <div class="sm:w-1/2">
                    <label for="passwordRep" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                      Повторете парола
                    </label>
                    <input id="passwordRep" type="password" minlength="8" name="newPasswordRep" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring-0 focus:border-gray-400 w-full p-2.5" placeholder="••••••••••" />
                  </div>
                </div>
                <div class="sm:flex justify-end mt-6">
                  <button type="submit" class="w-full sm:w-auto text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-0 font-semibold rounded-lg text-sm px-5 py-2.5 transition-all active:scale-90">
                    Запази промените
                  </button>
                </div>
              </form>
            </div>

            <div v-show="activeOrders" id="active-order-account" class="w-full">
              <?php
              $query = "SELECT * FROM orders WHERE email = '$email' AND status = 'В процес'";
              $query_run = mysqli_query($con, $query);
              while ($rows = mysqli_fetch_array($query_run)) { ?>
                <div class="w-full shadow-lg rounded-xl border border-slate-50 p-6 md:p-8 text-slate-700 animate__animated animate__fadeIn">
                  <div class="grid gap-6 row-gap-10 lg:grid-cols-2">
                    <div class="lg:py-5 lg:pr-16">
                      <div class="flex">
                        <div class="flex flex-col items-center mr-4">
                          <div>
                            <div class="flex items-center justify-center w-10 h-10 border rounded-full <?php echo ($rows["step"] >= 1) ? 'bg-green-100 border-green-200' : ''; ?>">
                              <?php if ($rows["step"] >= 1) { ?>
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 text-green-400">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                              <?php } else { ?>
                                <svg class="w-4 text-gray-600" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                  <line fill="none" stroke-miterlimit="10" x1="12" y1="2" x2="12" y2="22"></line>
                                  <polyline fill="none" stroke-miterlimit="10" points="19,15 12,22 5,15"></polyline>
                                </svg>
                              <?php } ?>
                            </div>
                          </div>
                          <div class="w-px h-full bg-gray-300"></div>
                        </div>
                        <div class="pt-1 pb-8">
                          <p class="mb-1.5 text-lg font-bold">Стъпка 1</p>
                          <p class="text-gray-700 text-sm">
                            Нашият екип внимателно почиства всички ваши мебели и техника.
                          </p>
                        </div>
                      </div>
                      <div class="flex">
                        <div class="flex flex-col items-center mr-4">
                          <div>
                            <div class="flex items-center justify-center w-10 h-10 border rounded-full <?php echo ($rows["step"] >= 2) ? 'bg-green-100 border-green-200' : ''; ?>">
                              <?php if ($rows["step"] >= 2) { ?>
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 text-green-400">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                              <?php } else { ?>
                                <svg class="w-4 text-gray-600" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                  <line fill="none" stroke-miterlimit="10" x1="12" y1="2" x2="12" y2="22"></line>
                                  <polyline fill="none" stroke-miterlimit="10" points="19,15 12,22 5,15"></polyline>
                                </svg>
                              <?php } ?>
                            </div>
                          </div>
                          <div class="w-px h-full bg-gray-300"></div>
                        </div>
                        <div class="pt-1 pb-8">
                          <p class="mb-1.5 text-lg font-bold">Стъпка 2</p>
                          <p class="text-gray-700 text-sm">
                            Екипа почиства вашите прозорци и стъклени повърхности.
                          </p>
                        </div>
                      </div>
                      <div class="flex">
                        <div class="flex flex-col items-center mr-4">
                          <div>
                            <div class="flex items-center justify-center w-10 h-10 border rounded-full <?php echo ($rows["step"] >= 3) ? 'bg-green-100 border-green-200' : ''; ?>">
                              <?php if ($rows["step"] >= 3) { ?>
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 text-green-400">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                              <?php } else { ?>
                                <svg class="w-4 text-gray-600" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                  <line fill="none" stroke-miterlimit="10" x1="12" y1="2" x2="12" y2="22"></line>
                                  <polyline fill="none" stroke-miterlimit="10" points="19,15 12,22 5,15"></polyline>
                                </svg>
                              <?php } ?>
                            </div>
                          </div>
                          <div class="w-px h-full bg-gray-300"></div>
                        </div>
                        <div class="pt-1 pb-8">
                          <p class="mb-1.5 text-lg font-bold">Стъпка 3</p>
                          <p class="text-gray-700 text-sm">
                            Почти свършихме! Екипът в момента почиства всички бани, тоалетни и градински пространства.
                          </p>
                        </div>
                      </div>
                      <div class="flex">
                        <div class="flex flex-col items-center mr-4">
                          <div>
                            <div class="flex items-center justify-center w-10 h-10 border rounded-full <?php echo ($rows["step"] >= 4) ? 'bg-green-100 border-green-200' : ''; ?>">
                              <?php if ($rows["step"] >= 4) { ?>
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 text-green-400">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                              <?php } else { ?>
                                <svg class="w-4 text-gray-600" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                  <line fill="none" stroke-miterlimit="10" x1="12" y1="2" x2="12" y2="22"></line>
                                  <polyline fill="none" stroke-miterlimit="10" points="19,15 12,22 5,15"></polyline>
                                </svg>
                              <?php } ?>
                            </div>
                          </div>
                        </div>
                        <div class="pt-1 pb-8">
                          <p class="mb-1.5 text-lg font-bold">Стъпка 4</p>
                          <p class="text-gray-700 text-sm">
                            Ето, че сме на края! Екипът почиства професионално вашият под с голямо внимание.
                          </p>
                        </div>
                      </div>
                    </div>
                    <div class="relative">
                      <?php
                      $imageFiles = array(
                        1 => "images/overCleaning.jpg",
                        2 => "images/windowCleaning.jpg",
                        3 => "images/bathroomCleaning.jpg",
                        4 => "images/floorCleaning.png"
                      );

                      if (isset($imageFiles[$rows["step"]])) { ?>
                        <img class="inset-0 object-cover object-bottom w-full rounded-md md:rounded shadow-lg lg:absolute lg:h-full" src="<?php echo $imageFiles[$rows["step"]]; ?>" alt="steps-photo" />
                      <?php } ?>
                    </div>
                  </div>
                  <?php if ($rows["step"] < 4) { ?>
                    <button :class="{'right-16' : scY > 300}" class="fixed bottom-4 right-4 flex items-center justify-center bg-blue-500 text-white active:scale-90 transition-all hover:bg-blue-400 w-28 h-10 rounded-xl font-semibold update-order-steps"><span>Обнови</span><svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 ml-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                      </svg>
                    </button>
                  <?php } ?>
                </div>
              <?php } ?>
            </div>

            <div v-show="historySection" class="md:w-[80%] shadow-lg rounded-xl border border-slate-50 p-6 md:p-8 text-slate-700 animate__animated animate__fadeIn">
              <h1 class="font-bold text-2xl mb-6 md:mb-8 text-center sm:text-left">
                История на поръчките
              </h1>
              <div class="sm:flex items-center font-semibold mb-1 text-slate-500 text-sm md:text-base text-center sm:text-left">
                <div class="mb-2.5 sm:mb-0">Тук можете да прегледате всички ваши поръчки към днешна дата.</div>
                <button @click="showFilter = !showFilter" class="h-9 sm:h-8 w-full sm:w-8 flex items-center justify-center sm:ml-1.5 rounded-md sm:rounded-full bg-blue-500 hover:bg-blue-600 transition-all active:scale-90">
                  <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-4 h-4 text-white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" />
                  </svg>
                </button>
              </div>
              <div :class="showFilter ? 'sm:flex' : 'hidden'" class="items-cneter space-y-4 sm:space-y-0 sm:space-x-2.5 my-5 bg-slate-50 px-2 py-3 rounded-lg shadow-md">
                <div class="relative w-full sm:w-1/2">
                  <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor" class="w-5 h-5 text-gray-500">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                    </svg>
                  </div>
                  <input id="date-picker-account" type="date" value="<?php echo date("Y-m-d"); ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 focus:border-gray-400 focus:outline-none block w-full pl-10 p-2.5 " placeholder="Изберете дата" />
                </div>
                <div class="relative w-full sm:w-1/2">
                  <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor" class="w-5 h-5 text-gray-500">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />
                    </svg>
                  </div>
                  <select id="account-offers" class="w-full bg-gray-50 border border-gray-300 text-gray-900 pl-10 text-sm rounded-lg focus:outline-none focus:ring-0 focus:border-gray-400 block p-2.5">
                    <option selected value="Основна">Основна</option>
                    <option value="Премиум">Премиум</option>
                    <option value="Вип">Вип</option>
                  </select>
                </div>
              </div>
              </form>
              <div id="history-section-load" class="flex items-center justify-center space-x-5 space-y-5 mt-10 w-full">
                <div id="history-section" class="grid gap-12 sm:grid-cols-2 md:grid-cols-1 lg:grid-cols-2 w-full">
                  <?php
                  $query = "SELECT * FROM orders WHERE email = '$email' ORDER BY add_date DESC LIMIT 10";
                  $query_run = mysqli_query($con, $query);

                  while ($rows = mysqli_fetch_array($query_run)) { ?>
                    <div class="relative bg-white py-3 px-4 rounded-3xl w-full md:w-80 lg:w-64 xl:w-72 shadow-xl border border-slate-50 hover:bg-slate-50 transition-all">
                      <div class="text-white flex items-center absolute rounded-full p-3 shadow-xl bg-blue-50 border border-blue-100 left-4 -top-6">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-7 w-7 text-blue-400">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                      </div>
                      <div class="mt-5">
                        <p class="text-xl font-semibold my-2"><?= $rows['offer'] ?></p>
                        <div class="flex text-gray-400 text-sm">
                          <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                          </svg>
                          <p><?= $rows['city'] ?></p>
                        </div>
                        <div class="flex space-x-2 text-gray-400 text-sm my-3">
                          <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" />
                          </svg>
                          <p><?= $rows['room'] ?></p>
                        </div>
                        <div class="flex space-x-2 text-gray-400 text-sm my-3">
                          <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                          </svg>
                          <p><?= $rows['price'] ?> лв.</p>
                        </div>
                        <div class="flex space-x-2 text-gray-400 text-sm my-3">
                          <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                          </svg>
                          <p><?= date("d.m.Y", strtotime($rows['date'])) ?></p>
                        </div>
                        <div class="border-t-2"></div>
                        <button @click="modalHistory = true" type="button" value="<?= $rows['id'] ?>" class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-0 font-semibold rounded-xl w-full text-sm px-5 py-2 mt-2.5 focus:outline-none transition-all history-view">Виж повече</button>
                      </div>
                    </div>
                  <?php } ?>
                </div>
              </div>
              <?php if (mysqli_num_rows($query_run) == 0) { ?>
                <div class="w-full text-center font-semibold text-slate-700 mt-6 md:mt-8 lg:mt-10">Нямате направени поръчки към днешна дата.</div>
              <?php } ?>
            </div>

            <div v-show="documentSection" class="md:w-[80%] shadow-lg rounded-xl border border-slate-50 p-6 md:p-8 text-slate-700 animate__animated animate__fadeIn">
              <h1 class="font-bold text-2xl ml-1 mb-6 md:mb-8 text-center sm:text-left">
                Документи
              </h1>
              <div class="font-semibold mb-1 sm:mb-2 ml-1 text-slate-500 text-sm md:text-base text-center sm:text-left">
                Можете да добавите снимка или карта на обекта си за Ви
                предоставим най-добите услуги. В тази секция можете да откриете
                и фактурите си (ако сте заявили).
              </div>
              <?php
              $query = "SELECT * FROM customers WHERE email = '$email' AND image_room1 != '' AND image_room2 != '' AND image_room3 != ''";
              $query_run = mysqli_query($con, $query);

              if (mysqli_num_rows($query_run) == 0) { ?>
                <form id="room-images-form">
                  <div class="w-full mt-6">
                    <div class="ml-1 mb-1.5 font-semibold text-sm md:text-base">
                      Снимка на обект (MAX 3)
                    </div>
                    <div class="flex items-center justify-center w-full">
                      <label @dragover="dragOver" @dragleave="dragFile = false" @drop="fileDropped" for="photo-file" :class="dragFile ? 'bg-blue-50 border-blue-200' : 'bg-gray-50 border-gray-300'" class="flex flex-col items-center justify-center group w-full h-48 md:h-44 lg:h-40 2xl:h-36 border-2 hover:border-blue-200 border-dashed rounded-lg cursor-pointer hover:bg-blue-50 transition-all">
                        <div v-show="imagePreview == null" class="flex flex-col items-center justify-center pt-5 pb-6">
                          <svg aria-hidden="true" :class="dragFile ? 'text-blue-300' : 'text-gray-400'" class="w-10 h-10 mb-2 group-hover:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                          </svg>
                          <p :class="dragFile ? 'text-blue-400' : 'text-gray-500'" class="mb-1.5 text-sm group-hover:text-blue-400">
                            <span v-show="!dragFile" class="font-semibold text-center">
                              Натиснете или провлачете за да добавите снимка
                            </span>
                            <span v-show="dragFile" class="font-semibold">
                              Пуснете файла тук
                            </span>
                          </p>
                          <p :class="dragFile ? 'text-blue-400' : 'text-gray-500'" class="text-xs sm:text-sm group-hover:text-blue-400">
                            PNG, JPG или JPEG (MAX 2MB)
                          </p>
                        </div>
                        <div v-show="imagePreview != null" class="w-full h-full rounded-lg">
                          <img class="h-48 md:h-44 lg:h-40 2xl:h-36 w-full object-cover rounded-lg" :src="imagePreview" />
                        </div>
                        <input type="hidden" value="<?= $email ?>" name="customerEmail">
                        <input id="photo-file" @change="onFileChange" type="file" name="roomImage" class="hidden" accept="image/png, image/jpg, image/jpeg" />
                      </label>
                    </div>
                    <div v-show="imagePreview != null" class="md:hidden w-full my-2.5 text-center text-sm">
                      Натиснете върху снимката за да я смените.
                    </div>
                    <div class="sm:flex justify-end mt-3">
                      <button @click="imagePreview = null" type="submit" class="w-full sm:w-auto text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-0 font-semibold rounded-lg text-sm px-4 py-2 transition-all active:scale-90">
                        Запази промените
                      </button>
                    </div>
                  </div>
                </form>
              <?php } ?>

              <div id="document-section">
                <?php
                $query = "SELECT * FROM customers WHERE email = '$email' AND (image_room1 != '' OR image_room2 != '' OR image_room3 != '')";
                $query_run = mysqli_query($con, $query);

                if (mysqli_num_rows($query_run) > 0) {
                  while ($rows = mysqli_fetch_array($query_run)) { ?>
                    <div class="w-full my-4">
                      <div class="ml-1 font-semibold text-sm md:text-base">Вашите снимки</div>
                      <div class="ml-1 mb-3 text-sm font-semibold text-slate-500">(Натиснете върху снимката за да я премахнете)</div>
                      <div class="flex flex-wrap items-center gap-5">
                        <?php
                        for ($i = 1; $i <= 3; $i++) {
                          $image_room = 'image_room' . $i;

                          if ($rows[$image_room] != '') { ?>
                            <div class="w-20 h-20 md:w-[120px] md:h-[120px] rounded-lg border border-slate-100 hover:brightness-90 group cursor-pointer shadow-lg transition-all">
                              <img class="w-full h-full rounded-lg object-cover" src="uploaded-files/room-images/<?= $rows[$image_room] ?>" alt="<?= $rows["image_room2"] ?>">
                              <div id="<?= $i ?>" class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-8 h-8 md:w-11 md:h-11 hidden group-hover:flex items-center justify-center bg-blue-300 border border-blue-400 rounded-full transition-all active:scale-90 room-img">
                                <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 md:w-6 md:h-6 text-white ">
                                  <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                                </svg>
                              </div>
                            </div>
                        <?php }
                        } ?>
                      </div>
                    </div>
                <?php }
                } ?>
              </div>

              <hr class="w-full my-5" />
              <div class="w-full">
                <div class="ml-1 mb-2.5 -mt-2.5 font-semibold text-sm md:text-base">Фактури</div>
                <div class="flex items-center w-full space-x-5">
                  <?php
                  $query = "SELECT * FROM orders WHERE email = '$email' AND invoice_document != ''";
                  $query_run = mysqli_query($con, $query);

                  if (mysqli_num_rows($query_run) > 0) {
                    while ($rows = mysqli_fetch_array($query_run)) { ?>
                      <button value="<?= $rows["id"] ?>" type="button" class="px-4 py-2 rounded-lg shadow-lg bg-white flex justify-center items-center border border-slate-100 cursor-pointer hover:opacity-80 transition-all active:scale-90 focus:ouline-none print-invoice">
                        <div>
                          <svg viewBox="0 0 512 512" style="enable-background: new 0 0 512 512" class="w-14 h-14 lg:w-20 lg:h-20 mx-auto mb-0.5">
                            <circle style="fill: #a7cefc" cx="256" cy="256" r="256" />
                            <path style="fill: #a7cefc" d="M508.497,298.324L373.226,163.052l-103.291,104.01L145.67,402.101l109.894,109.894
                            c0.147,0,0.291,0.005,0.436,0.005C382.966,512,488.324,419.566,508.497,298.324z" />
                            <polygon style="fill: #f4e3c3" points="299.386,89.212 145.67,89.212 145.67,402.101 373.226,402.101 373.226,163.052 " />
                            <polygon style="fill: #fed8b2" points="373.226,163.052 299.386,89.212 254.85,89.212 254.85,402.101 373.226,402.101 " />
                            <polygon style="fill: #ffd15d" points="299.386,163.052 373.226,163.052 299.386,89.212 " />
                            <rect x="211.178" y="188.768" style="fill: #f9b54c" width="128.431" height="6.896" />
                            <rect x="168.943" y="188.768" style="fill: #f9b54c" width="28.444" height="6.896" />
                            <rect x="211.178" y="217.212" style="fill: #f9b54c" width="128.431" height="6.896" />
                            <rect x="168.943" y="217.212" style="fill: #f9b54c" width="28.444" height="6.896" />
                            <rect x="211.178" y="245.657" style="fill: #f9b54c" width="128.431" height="6.896" />
                            <rect x="168.943" y="245.657" style="fill: #f9b54c" width="28.444" height="6.896" />
                            <rect x="211.178" y="274.101" style="fill: #f9b54c" width="128.431" height="6.896" />
                            <rect x="168.943" y="274.101" style="fill: #f9b54c" width="28.444" height="6.896" />
                            <rect x="237.899" y="343.488" style="fill: #f9b54c" width="56.889" height="6.896" />

                            <rect x="254.845" y="188.768" style="fill: #f4a200" width="84.764" height="6.896" />
                            <rect x="254.845" y="217.212" style="fill: #f4a200" width="84.764" height="6.896" />
                            <rect x="254.845" y="245.657" style="fill: #f4a200" width="84.764" height="6.896" />
                            <rect x="254.845" y="274.101" style="fill: #f4a200" width="84.764" height="6.896" />
                            <rect x="254.845" y="343.488" style="fill: #f4a200" width="39.943" height="6.896" />
                            <path style="fill: #f4a200" d="M340.34,334.932c1.5,0,2.717-1.217,2.717-2.717v-1.857c0-5.627-5.32-10.214-11.936-10.393v-0.71
                            c0-1.5-1.217-2.717-2.717-2.717c-1.5,0-2.717,1.217-2.717,2.717v0.71c-6.616,0.179-11.936,4.765-11.936,10.393v3.713
                            c0,5.627,5.32,10.214,11.936,10.392v13.665c-3.562-0.155-6.501-2.36-6.501-4.96v-1.857c0-1.5-1.217-2.717-2.717-2.717
                            c-1.5,0-2.717,1.217-2.717,2.717v1.857c0,5.627,5.32,10.214,11.936,10.392v0.71c0,1.5,1.217,2.717,2.717,2.717
                            c1.5,0,2.717-1.217,2.717-2.717v-0.71c6.616-0.179,11.936-4.765,11.936-10.392v-3.713c0-5.627-5.32-10.214-11.936-10.393v-13.665
                            c3.562,0.155,6.501,2.36,6.501,4.96v1.857C337.624,333.715,338.839,334.932,340.34,334.932z M319.185,334.072v-3.713
                            c0-2.6,2.939-4.806,6.501-4.96v13.634C322.124,338.877,319.185,336.672,319.185,334.072z M337.624,349.456v3.713
                            c0,2.6-2.939,4.805-6.501,4.96v-13.634C334.684,344.65,337.624,346.857,337.624,349.456z" />
                          </svg>
                          <div class="text-sm text-slate-700 font-semibold text-center flex items-center justify-center">
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.9" stroke="currentColor" class="w-4 h-4 mr-0.5 text-slate-500">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                            </svg>
                            <span><?= date("d.m.Y", strtotime($rows['date'])) ?></span>
                          </div>
                        </div>
                      </button>
                    <?php }
                  } else { ?>
                    <div class="text-center text-slate-700 font-semibold mt-10 ml-1 w-full">Нямате налични фактури</div>
                  <?php } ?>
                </div>
              </div>
            </div>

            <div v-show="orderSection" class="md:w-[80%] shadow-lg rounded-xl border border-slate-50 p-6 md:p-8 text-slate-700 animate__animated animate__fadeIn">
              <h1 class="font-bold text-2xl mb-6 md:mb-8 text-center sm:text-left">
                Направи поръчка
              </h1>
              <div class="font-semibold mb-1 sm:mb-2 text-slate-500 text-sm md:text-base text-center sm:text-left">
                Вече може да направите лесно поръчка и Вашият профил! Вече имаме
                част от вашите данни.
              </div>
              <?php
              $query = "SELECT * FROM customers WHERE email = '$email'";
              $query_run = mysqli_query($con, $query);

              while ($rows = mysqli_fetch_array($query_run)) { ?>
                <form id="customer-order-form">
                  <div class="w-full mt-6 flex items-center gap-10 flex-wrap gap-y-4">
                    <div class="flex items-center">
                      <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                      </svg>
                      <span><?= $rows["name"] ?></span>
                      <input type="hidden" name="customerName" value="<?= $rows["name"] ?>">
                    </div>
                    <div class="flex items-center">
                      <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                      </svg>
                      <span><?= $rows["email"] ?></span>
                      <input type="hidden" name="customerEmail" value="<?= $rows["email"] ?>">
                    </div>
                    <div class="flex items-center">
                      <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                      </svg>
                      <span class="order-section"><?= $rows["phone"] ?></span>
                      <input class="order-section" type="hidden" name="customerPhone" value="<?= $rows["phone"] ?>">
                    </div>
                  </div>
                <?php } ?>
                <hr class="w-full my-4" />

                <div class="block md:hidden ml-1 mb-1.5 font-semibold text-sm text-slate-700">
                  Квадратура на обекта
                </div>
                <div class="block md:hidden mb-4">
                  <input type="text" minlength="2" maxlength="4" class="bg-slate-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 focus:outline-none focus:border-gray-400 block w-full p-2.5 account-m2" placeholder="m2" />
                </div>

                <div class="block ml-1 mb-1.5 font-semibold text-sm md:text-base text-slate-700">
                  Изберете вид помещение
                </div>
                <ul class="flex flex-wrap gap-6 my-3.5">
                  <li>
                    <input id="building-house" class="sr-only peer building" type="radio" value="Къща" name="building" />
                    <label class="flex justify-center items-center w-28 h-28 bg-white border border-gray-200 rounded-md cursor-pointer focus:outline-none hover:bg-blue-50 hover:border-blue-200 peer-checked:border-blue-200 peer-checked:bg-blue-50" for="building-house">
                      <div>
                        <div class="h-10 w-10 rounded-full flex justify-center items-center bg-blue-100 mx-auto border border-blue-200">
                          <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                          </svg>
                        </div>
                        <div class="mt-1.5 text-sm font-semibold text-slate-700 text-center">
                          Къща
                        </div>
                      </div>
                    </label>
                  </li>
                  <li>
                    <input class="sr-only peer building" type="radio" value="Офис" name="building" id="building-office" />
                    <label class="flex justify-center items-center w-28 h-28 bg-white border border-gray-200 rounded-md cursor-pointer focus:outline-none hover:bg-blue-50 hover:border-blue-200 peer-checked:border-blue-200 peer-checked:bg-blue-50" for="building-office">
                      <div>
                        <div class="h-10 w-10 rounded-full flex justify-center items-center bg-blue-100 mx-auto border border-blue-200">
                          <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />
                          </svg>
                        </div>
                        <div class="mt-1.5 text-sm font-semibold text-slate-700 text-center">
                          Офис
                        </div>
                      </div>
                    </label>
                  </li>
                  <li>
                    <input class="sr-only peer building" type="radio" value="Салон" name="building" id="building-hall" />
                    <label class="flex justify-center items-center w-28 h-28 bg-white border border-gray-200 rounded-md cursor-pointer focus:outline-none hover:bg-blue-50 hover:border-blue-200 peer-checked:border-blue-200 peer-checked:bg-blue-50" for="building-hall">
                      <div>
                        <div class="h-10 w-10 rounded-full flex justify-center items-center bg-blue-100 mx-auto border border-blue-200">
                          <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                          </svg>
                        </div>
                        <div class="mt-1.5 text-sm font-semibold text-slate-700 text-center">
                          Салон
                        </div>
                      </div>
                    </label>
                  </li>
                </ul>

                <div class="block ml-1 mb-1.5 font-semibold text-sm md:text-base text-slate-700">
                  Изберете вид оферта
                </div>
                <ul class="flex flex-wrap gap-6 my-3.5">
                  <div id="tooltip-basic" role="tooltip" class="hidden md:inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium bg-white text-slate-700 rounded-lg opacity-0 transition-opacity duration-300 tooltip shadow-xl border border-slate-100">
                    <div v-for="(service, index) in services" class="flex mt-1.5 items-center">
                      <svg v-show="index < 3" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1 text-green-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                      </svg>
                      <div v-show="index < 3">{{service}}</div>
                    </div>
                  </div>
                  <li data-tooltip-target="tooltip-basic" data-tooltip-placement="bottom">
                    <input class="sr-only peer offer" type="radio" value="Основна" name="offer" id="offer_basic" />
                    <label class="flex justify-center items-center w-28 h-28 bg-white border border-gray-200 rounded-md cursor-pointer focus:outline-none hover:bg-blue-50 hover:border-blue-200 peer-checked:border-blue-200 peer-checked:bg-blue-50" for="offer_basic">
                      <div>
                        <div class="h-10 w-10 rounded-full flex justify-center items-center bg-blue-100 mx-auto border border-blue-200">
                          <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                          </svg>
                        </div>
                        <div class="mt-1.5 text-sm font-semibold text-slate-700 text-center">
                          Основна
                        </div>
                      </div>
                    </label>
                  </li>
                  <div id="tooltip-premium" role="tooltip" class="hidden md:inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium bg-white text-slate-700 rounded-lg opacity-0 transition-opacity duration-300 tooltip shadow-xl border border-slate-100">
                    <div v-for="(service, index) in services" class="flex mt-1.5 items-center">
                      <svg v-show="index < 5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1 text-green-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                      </svg>
                      <div v-show="index < 5">{{service}}</div>
                    </div>
                  </div>
                  <li data-tooltip-target="tooltip-premium" data-tooltip-placement="bottom">
                    <input class="sr-only peer offer" type="radio" value="Премиум" name="offer" id="offer_premium" />
                    <label class="flex justify-center items-center w-28 h-28 bg-white border border-gray-200 rounded-md cursor-pointer focus:outline-none hover:bg-blue-50 hover:border-blue-200 peer-checked:border-blue-200 peer-checked:bg-blue-50" for="offer_premium">
                      <div>
                        <div class="h-10 w-10 rounded-full flex justify-center items-center bg-blue-100 mx-auto border border-blue-200">
                          <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.5c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75A2.25 2.25 0 0116.5 4.5c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23H5.904M14.25 9h2.25M5.904 18.75c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 01-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 10.203 4.167 9.75 5 9.75h1.053c.472 0 .745.556.5.96a8.958 8.958 0 00-1.302 4.665c0 1.194.232 2.333.654 3.375z" />
                          </svg>
                        </div>
                        <div class="mt-1.5 text-sm font-semibold text-slate-700 text-center">
                          Премиум
                        </div>
                      </div>
                    </label>
                  </li>
                  <div id="tooltip-vip" role="tooltip" class="hidden md:inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium bg-white text-slate-700 rounded-lg opacity-0 transition-opacity duration-300 tooltip shadow-xl border border-slate-100">
                    <div v-for="service in services" class="flex mt-1.5 items-center">
                      <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1 text-green-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                      </svg>
                      <div>{{service}}</div>
                    </div>
                  </div>
                  <li data-tooltip-target="tooltip-vip" data-tooltip-placement="bottom">
                    <input class="sr-only peer offer" type="radio" value="Вип" name="offer" id="offer_vip" />
                    <label class="flex justify-center items-center w-28 h-28 bg-white border border-gray-200 rounded-md cursor-pointer focus:outline-none hover:bg-blue-50 hover:border-blue-200 peer-checked:border-blue-200 peer-checked:bg-blue-50" for="offer_vip">
                      <div>
                        <div class="h-10 w-10 rounded-full flex justify-center items-center bg-blue-100 mx-auto border border-blue-200">
                          <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                          </svg>
                        </div>
                        <div class="mt-1.5 text-sm font-semibold text-slate-700 text-center">
                          Вип
                        </div>
                      </div>
                    </label>
                  </li>
                </ul>

                <div class="block ml-1 my-4 font-semibold text-sm md:text-base text-slate-700">
                  Изберете дата и час
                </div>
                <div class="my-4 sm:flex items-center sm:space-x-5 space-y-4 sm:space-y-0">
                  <div class="sm:w-1/2">
                    <input type="date" name="date" min="<?= date("Y-m-d"); ?>" value="<?= date("Y-m-d"); ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:border-gray-400 focus:outline-none block w-full p-2.5 " placeholder="Изберете дата" />
                  </div>
                  <div class="w-1/2 flex space-x-5">
                    <div>
                      <input class="sr-only peer" type="radio" value="преди 13:00" name="time" id="time-before" />
                      <label class="flex justify-center items-center w-28 sm:w-32 md:w-28 lg:w-32 h-11 bg-white border border-gray-200 rounded-lg cursor-pointer focus:outline-none hover:bg-blue-50 hover:border-blue-200 peer-checked:border-blue-200 peer-checked:bg-blue-50" for="time-before">
                        <div class="px-2 text-sm font-semibold text-slate-700 text-center">
                          Преди 13:00
                        </div>
                      </label>
                    </div>
                    <div>
                      <input class="sr-only peer" type="radio" value="след 13:00" name="time" id="time-after" />
                      <label class="flex justify-center items-center w-28 sm:w-32 md:w-28 lg:w-32 h-11 bg-white border border-gray-200 rounded-lg cursor-pointer focus:outline-none hover:bg-blue-50 hover:border-blue-200 peer-checked:border-blue-200 peer-checked:bg-blue-50" for="time-after">
                        <div class="px-2 text-sm font-semibold text-slate-700 text-center">
                          След 13:00
                        </div>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="block ml-1 my-4 font-semibold text-sm md:text-base text-slate-700">
                  Начин на плащане
                </div>
                <div class="flex flex-wrap items-center gap-3.5">
                  <div>
                    <input class="sr-only peer" type="radio" value="В брой" name="payment" id="cash" />
                    <label class="flex justify-center items-center w-28 h-11 bg-white border border-gray-200 rounded-lg cursor-pointer focus:outline-none hover:bg-blue-50 hover:border-blue-200 peer-checked:border-blue-200 peer-checked:bg-blue-50" for="cash">
                      <div class="flex items-center">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                        </svg>
                        <div class="text-sm font-semibold text-slate-700 text-center">
                          В брой
                        </div>
                      </div>
                    </label>
                  </div>
                  <div id="tooltip-card-payment" role="tooltip" class="hidden text-center font-semibold md:inline-block max-w-sm absolute invisible z-10 py-2 px-3 text-sm bg-white text-slate-700 rounded-lg opacity-0 transition-opacity duration-300 tooltip shadow-xl border border-slate-100">
                    Не се притеснявайте ! Нашият екип ще носи POS терминал при посещението на имота Ви.
                  </div>
                  <div>
                    <input class="sr-only peer" type="radio" value="С карта" name="payment" id="card" />
                    <label data-tooltip-target="tooltip-card-payment" data-tooltip-placement="bottom" class="flex justify-center items-center w-28 h-11 bg-white border border-gray-200 rounded-lg cursor-pointer focus:outline-none hover:bg-blue-50 hover:border-blue-200 peer-checked:border-blue-200 peer-checked:bg-blue-50" for="card">
                      <div class="flex items-center">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                        </svg>
                        <div class="text-sm font-semibold text-slate-700 text-center">
                          С карта
                        </div>
                      </div>
                    </label>
                  </div>
                </div>
                <div class="block ml-1 my-4 font-semibold text-sm md:text-base text-slate-700">
                  Желаете ли фактура
                </div>
                <div class="flex flex-wrap items-center gap-3.5">
                  <div id="tooltip-invoice" role="tooltip" class="hidden text-center font-semibold text-slate-700 md:inline-block max-w-sm absolute invisible z-10 py-2 px-3 text-sm bg-white rounded-lg opacity-0 transition-opacity duration-300 tooltip shadow-xl border border-slate-100">
                    Можете да намерите Вашите фактури в раздел документи след като бъде извършено почистването.
                  </div>
                  <div>
                    <input class="sr-only peer" type="radio" value="Да" name="invoice" id="yes" />
                    <label @click="invoiceState = true" data-tooltip-target="tooltip-invoice" data-tooltip-placement="bottom" class="flex justify-center items-center w-28 h-11 bg-white border border-gray-200 rounded-lg cursor-pointer focus:outline-none hover:bg-blue-50 hover:border-blue-200 peer-checked:border-blue-200 peer-checked:bg-blue-50" for="yes">
                      <div class="flex items-center">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div class="text-sm font-semibold text-slate-700 text-center">
                          Да
                        </div>
                      </div>
                    </label>
                  </div>
                  <div>
                    <input class="sr-only peer" type="radio" value="Не" name="invoice" id="no" />
                    <label @click="invoiceState = false" class="flex justify-center items-center w-28 h-11 bg-white border border-gray-200 rounded-lg cursor-pointer focus:outline-none hover:bg-blue-50 hover:border-blue-200 peer-checked:border-blue-200 peer-checked:bg-blue-50" for="no">
                      <div class="flex items-center">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div class="text-sm font-semibold text-slate-700 text-center">
                          Не
                        </div>
                      </div>
                    </label>
                  </div>
                </div>
                <?php
                $query = "SELECT * FROM customers WHERE email = '$email'";
                $query_run = mysqli_query($con, $query);

                while ($rows = mysqli_fetch_array($query_run)) { ?>
                  <div v-show="invoiceState" class="sm:flex items-center sm:space-x-5 space-y-4 sm:space-y-0 mt-4 animate__animated animate__fadeIn">
                    <div class="sm:w-1/2">
                      <label for="company-name" class="block ml-1 mb-1 font-semibold text-sm md:text-base text-slate-700">
                        Име на фирмата
                      </label>
                      <input type="text" value="<?= $rows["company_name"] ?>" minlength="2" id="company-name" name="company" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring-0 focus:border-gray-400 w-full p-2.5" placeholder="Въведете име" />
                    </div>
                    <div class="sm:w-1/2">
                      <label for="company-eik" class="block ml-1 mb-1 font-semibold text-sm md:text-base text-slate-700">
                        ЕИК на фирмата
                      </label>
                      <input type="text" value="<?= $rows["company_eik"] ?>" minlength="12" maxlength="12" id="company-eik" name="eik" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring-0 focus:border-gray-400 w-full p-2.5" placeholder="Въведете ЕИК" />
                    </div>
                  </div>
                <?php } ?>
                <div class="block ml-1 my-4 font-semibold text-sm md:text-base text-slate-700">
                  Изберете град
                </div>
                <div class="flex flex-wrap items-center gap-3.5">
                  <div v-for="city in cities">
                    <input class="sr-only peer" type="radio" :value="city.name" name="city" :id="city.name" />
                    <label class="flex justify-center items-center w-[122px] h-11 bg-white border border-gray-200 rounded-lg cursor-pointer focus:outline-none hover:bg-blue-50 hover:border-blue-200 peer-checked:border-blue-200 peer-checked:bg-blue-50" :for="city.name">
                      <div class="text-sm font-semibold text-slate-700 text-center flex">
                        <div>
                          <img class="object-cover w-5 h-5 rounded-full mr-1" :src="city.image" :alt="city.name" />
                        </div>
                        <div>{{city.name}}</div>
                      </div>
                    </label>
                  </div>
                </div>

                <label for="customerAddress" class="block ml-1 mb-1.5 mt-4 font-semibold text-sm md:text-base text-slate-700">
                  Вашият адрес
                </label>
                <textarea @keyup="charCountAddress" minlength="6" id="customerAddress" name="address" v-model="address" rows="2" :class="{
                    'focus:border-red-500 border-red-500 bg-red-50': addressCount >= 200,
                  }" class="block p-2.5 w-full text-sm text-gray-900 bg-slate-50 rounded-lg border border-gray-300 focus:ring-0 focus:outline-none focus:border-gray-400 resize-none md:resize-y" placeholder="Напишете адреса си тук..."></textarea>
                <div :class="{
                    'text-red-500 font-semibold': addressCount >= 200,
                  }" class="w-full flex justify-end text-slate-600 text-sm -mb-1">
                  {{ addressLength }}
                </div>

                <label for="information" class="block ml-1 mb-1.5 mt-4 font-semibold text-sm md:text-base text-slate-700">
                  Допълнителна информация
                </label>
                <textarea @keyup="charCount" id="information" v-model="information" name="information" rows="2" :class="{
                    'focus:border-red-500 border-red-500 bg-red-50': informationCount >= 200,
                }" class="block p-2.5 w-full text-sm text-gray-900 bg-slate-50 rounded-lg border border-gray-300 focus:ring-0 focus:outline-none focus:border-gray-400 resize-none md:resize-y" placeholder="Пишете тук..."></textarea>
                <div :class="{
                    'text-red-500 font-semibold': informationCount >= 200,
                }" class="w-full flex justify-end text-slate-600 text-sm -mb-1">
                  {{ informationLength }}
                </div>

                <div v-show="orderSection" class="fixed md:flex bottom-4 right-4 items-center justify-center p-3 w-24 md:w-32 text-slate-700 bg-white rounded-md shadow-2xl border border-slate-100" :class="{'lg:right-4': scY < 300, 'lg:right-16': scY > 300}">
                  <div id="account-toast-price" class="font-semibold text-sm md:text-base">
                    0 лв.
                  </div>
                  <input id="input-account-price" type="hidden" name="price" />
                </div>

                <div id="tooltip-m2" role="tooltip" class="hidden font-medium md:inline-block max-w-sm absolute invisible z-10 py-2 px-3 text-sm bg-white text-slate-700 rounded-lg opacity-0 transition-opacity duration-300 tooltip shadow-xl border border-slate-100">
                  <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 -mt-1 mr-1 inline-flex">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  <span>Минимума е 10 квадратни метра.</span>
                </div>

                <div v-show="orderSection" data-tooltip-target="tooltip-m2" data-tooltip-placement="left" class="hidden fixed md:flex bottom-20 right-4 items-center justify-center py-2 px-3 w-32 text-slate-700 bg-white rounded-md shadow-lg border border-slate-100" :class="{'lg:right-4': scY < 300, 'lg:right-16': scY > 300}">
                  <div>
                    <label for="account-m2" class="block mb-1.5 text-sm font-semibold text-slate-700 text-center">
                      Квадратура
                    </label>
                    <input id="account-m2" type="text" minlength="2" maxlength="4" name="m2" class="bg-slate-50 border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-0 focus:outline-none focus:border-gray-300 block w-full p-1.5 text-center account-m2" placeholder="m2" />
                  </div>
                </div>

                <div class="sm:flex justify-start lg:justify-end mt-6">
                  <button type="submit" class="w-full sm:w-auto text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-0 font-semibold rounded-lg text-sm px-5 py-2.5 transition-all active:scale-90">
                    Направи поръчка
                  </button>
                </div>
                </form>
            </div>

            <div v-show="rateSection" class="w-full md:w-[80%] shadow-lg rounded-xl border border-slate-50 p-6 md:p-8 text-slate-700 animate__animated animate__fadeIn">
              <h1 class="font-bold text-2xl mb-6 md:mb-8 text-center sm:text-left">
                Оценки
              </h1>
              <div class="font-semibold mb-1 sm:mb-2 text-slate-500 text-sm md:text-base text-center sm:text-left">
                Оценете нашата работа и нашите служители, по този начин ще ни помогнете да подобрим нашите услуги и да предоставим по-качествени услуги следващият път.
              </div>
              <div id="rate-section" class="mt-6 space-y-5">
                <?php $query = "SELECT * FROM orders WHERE email = '$email' AND status = 'Приключена' AND (customer_opinion IS NULL OR customer_opinion = '')";
                $query_run = mysqli_query($con, $query);

                if (mysqli_num_rows($query_run) > 0) {
                  while ($rows = mysqli_fetch_array($query_run)) { ?>
                    <div class='break-inside relative overflow-hidden flex flex-col justify-between space-y-2 text-sm rounded-lg w-full p-3.5 px-4 bg-white text-black border border-slate-100 shadow-lg'>
                      <div class='flex items-center justify-between font-semibold'>
                        <span class='uppercase text-xs text-green-500'>Приключена успешно</span>
                        <span class='text-xs text-slate-500'>#carpetservices</span>
                      </div>
                      <div class='flex items-center sm:space-x-3'>
                        <div class="hidden sm:flex h-10 w-10 bg-blue-300 shadow-lg rounded-full items-center justify-center">
                          <?php if ($rows['room'] == 'Къща') { ?>
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-slate-100">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                          <?php } else if ($rows['room'] == 'Офис') { ?>
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-slate-100">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />
                            </svg>
                          <?php } else if ($rows['room'] == 'Салон') { ?>
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-slate-100">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                            </svg>
                          <?php } ?>
                        </div>
                        <div class="sm:flex items-center">
                          <div class="flex items-center my-0.5 sm:mr-1.5">
                            <div>Задачата е завършена на</div>
                            <div class="font-semibold ml-1"><?= date("d.m.Y", strtotime($rows['date'])) ?></div>
                          </div>
                          <div class="flex items-center my-0.5">
                            <span> в <span class="font-semibold"><?= date("H:i", strtotime($rows['end_time'])) ?></span> часа</span>
                          </div>
                        </div>
                      </div>
                      <div class='sm:flex justify-between items-center'>
                        <div>
                          <dd class='flex items-center justify-start -space-x-1.5'>
                            <div class="mr-2.5 text-sm font-semibold text-slate-700">Екип</div>
                            <?php
                            $teamID = $rows['team_id'];
                            $queryy = "SELECT * FROM users WHERE team_id = '$teamID'";
                            $query_runn = mysqli_query($con, $queryy);

                            while ($row = mysqli_fetch_array($query_runn)) {
                              $randomNumber = rand(); ?>
                              <div data-popover id="<?= $randomNumber ?>" role="tooltip" class="absolute z-10 invisible inline-block w-48 text-sm font-light text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0">
                                <div class="px-2.5 py-1.5 font-semibold flex space-x-3">
                                  <img class='h-11 w-11 rounded object-cover' src="uploaded-files/user-images/<?= $row["image"] ?>" alt='avatar' />
                                  <div>
                                    <p class="text-slate-700 font-bold"><?= $row['name'] ?></p>
                                    <p><?= $row['position'] ?></p>
                                  </div>
                                </div>
                              </div>
                              <img data-popover-target="<?= $randomNumber ?>" class='w-8 h-8 rounded-full object-cover ring-2 border border-slate-100 ring-white cursor-pointer hover:opacity-80 transition-all' src="uploaded-files/user-images/<?= $row["image"] ?>" alt='avatar' />
                            <?php } ?>

                            <div class="mr-2.5 text-sm font-semibold text-slate-700 px-3 ">Рейтинг</div>
                            <?php
                            $teamID = $rows['team_id'];
                            $queryyy = "SELECT CAST(AVG(rating) AS DECIMAL(10,1)) AS rating FROM team_ratings WHERE team_id = '$teamID'";
                            $query_runnn = mysqli_query($con, $queryyy);

                            while ($row = mysqli_fetch_array($query_runnn)) {
                              $randomNumber = rand(); ?>
                              <div data-popover id="<?= $randomNumber ?>" role="tooltip" class="absolute z-10 invisible inline-block w-64 text-sm font-semibold text-slate-700 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0">
                                <div class="px-3 py-2">
                                  <p>Средна оценка на този екип е <span class="font-bold"><?= $row['rating'] ?></span></p>
                                </div>
                                <div data-popper-arrow></div>
                              </div>
                              <?php if ($row['rating'] == "") { ?>
                                <div class="w-7 h-7 text-sm bg-blue-400 flex items-center justify-center font-semibold text-white rounded-md">0.0</div>
                              <?php } else { ?>
                                <div data-popover-target="<?= $randomNumber ?>" class="w-7 h-7 text-sm bg-blue-400 hover:bg-blue-500 transition-all cursor-pointer flex items-center justify-center font-semibold text-white rounded-md"><?= $row['rating'] ?></div>
                            <?php }
                            } ?>
                          </dd>
                        </div>
                        <button value="<?= $rows['id'] . ' ' . $rows['team_id'] ?>" class='w-full sm:w-auto mt-2.5 sm:mt-0 flex items-center justify-center text-sm font-semibold rounded-full px-4 py-1 space-x-1 border-2 border-blue-400 transition-all bg-white hover:bg-blue-400 hover:text-white text-blue-400 active:scale-90 open-rating-modal'>
                          <span>Оценка</span>
                          <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                          </svg>
                        </button>
                      </div>
                    </div>
                  <?php }
                } else { ?>
                  <div class="text-center text-slate-700 font-semibold mt-20">Нямате завършени услуги за оценяване</div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>

        <div id="customer-opinion-modal" class="bg-gray-900 hidden bg-opacity-50 fixed inset-0 z-40">
          <div class="h-full w-full p-4 overflow-x-hidden overflow-y-auto flex justify-center items-center">
            <div class="relative w-full h-auto max-w-md animate__animated animate__zoomIn animate__fasterer">
              <div class="relative bg-white rounded-xl shadow mb-6">
                <div class="px-8 md:px-10 xl:px-12 py-5">
                  <h2 class="text-gray-800 text-2xl text-center font-semibold">Оценете нашите услуги</h2>
                </div>
                <form id="customer-opinion-form">
                  <input type="hidden" id="stars-count" name="rating" />
                  <input type="hidden" id="get-order-id" name="id" />
                  <input type="hidden" id="get-team-id" name="team_id" />
                  <div class="bg-gray-200 py-4">
                    <div class="px-8 md:px-12 xl:px-14 py-2 text-slate-700">
                      <label class="ml-1 mb-1 font-semibold md:text-lg text-slate-700 text-center flex items-center justify-center">
                        <span>Как оценявате нашите услуги ?</span>
                        <div id="rate-star-value" class="bg-blue-400 w-6 h-6 rounded ml-2 flex text-sm items-center justify-center text-slate-50 font-semibold">0</div>
                      </label>
                      <div class="flex items-center justify-center">
                        <div class="flex items-center">
                          <svg id="first-star" class="w-8 h-8 md:w-10 md:h-10 text-gray-300 transition-all active:scale-90 cursor-pointer fa-star" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                          </svg>
                          <svg id="second-star" class="w-8 h-8 md:w-10 md:h-10 text-gray-300 transition-all active:scale-90 cursor-pointer fa-star" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                          </svg>
                          <svg id="third-star" class="w-8 h-8 md:w-10 md:h-10 text-gray-300 transition-all active:scale-90 cursor-pointer fa-star" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                          </svg>
                          <svg id="fourth-star" class="w-8 h-8 md:w-10 md:h-10 text-gray-300 transition-all active:scale-90 cursor-pointer fa-star" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                          </svg>
                          <svg id="fifth-star" class="w-8 h-8 md:w-10 md:h-10 text-gray-300 transition-all active:scale-90 cursor-pointer fa-star" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                          </svg>
                        </div>
                      </div>
                      <textarea rows="4" name="text" class="block bg-gray p-3 w-full text-sm text-slate-900 rounded-xl border border-gray-300 focus:border-gray-400 focus:outline-none resize-none mt-3.5" placeholder="Пишете тук..."></textarea>
                      <button type="submit" class="py-2 mt-4 bg-gradient-to-r from-blue-500 to-indigo-600 hover:opacity-90 transition-all font-semibold rounded-xl text-white w-full">Оцени</button>
                    </div>
                  </div>
                  <div class="text-gray-600 hover:text-gray-400 transition-all font-semibold py-6 text-center cursor-pointer close-customer-opinion-modal">Може би по-късно</div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <div id="email-verify-modal" class="bg-gray-900 hidden bg-opacity-50 fixed inset-0 z-40">
          <div class="h-full w-full p-4 overflow-x-hidden overflow-y-auto flex justify-center items-center">
            <div class="relative bg-white px-8 pt-9 pb-8 shadow-xl mx-auto h-auto w-full max-w-lg rounded-2xl animate__animated animate__zoomIn animate__faster">
              <div class="mx-auto flex w-full max-w-md flex-col space-y-8">
                <div class="flex flex-col items-center justify-center text-center space-y-2">
                  <div class="font-semibold text-3xl text-slate-700">
                    <p>Потвърдете имейла си</p>
                  </div>
                  <div class="flex flex-row text-sm font-medium text-gray-400">
                    <p>Изпратихме имейл до <?= $email ?></p>
                  </div>
                </div>
                <div>
                  <div class="flex flex-col space-y-8">
                    <div class="flex flex-row items-center justify-between mx-auto w-full px-4">
                      <div class="w-14 h-14">
                        <input class="w-full h-full flex flex-col items-center justify-center text-center px-5 outline-none rounded-xl border border-gray-200 text-lg bg-white focus:bg-gray-50 transition-all email-code" maxlength="1" type="text" id="first-num">
                      </div>
                      <div class="w-14 h-14">
                        <input class="w-full h-full flex flex-col items-center justify-center text-center px-5 outline-none rounded-xl border border-gray-200 text-lg bg-white focus:bg-gray-50 transition-all email-code" maxlength="1" type="text" id="second-num">
                      </div>
                      <div class="w-14 h-14">
                        <input class="w-full h-full flex flex-col items-center justify-center text-center px-5 outline-none rounded-xl border border-gray-200 text-lg bg-white focus:bg-gray-50 transition-all email-code" maxlength="1" type="text" id="third-num">
                      </div>
                      <div class="w-14 h-14">
                        <input class="w-full h-full flex flex-col items-center justify-center text-center px-5 outline-none rounded-xl border border-gray-200 text-lg bg-white focus:bg-gray-50 transition-all email-code" maxlength="1" type="text" id="fourth-num">
                      </div>
                      <div class="w-14 h-14">
                        <input class="w-full h-full flex flex-col items-center justify-center text-center px-5 outline-none rounded-xl border border-gray-200 text-lg bg-white focus:bg-gray-50 transition-all email-code" maxlength="1" type="text" id="fifth-num">
                      </div>
                      <div class="w-14 h-14">
                        <input class="w-full h-full flex flex-col items-center justify-center text-center px-5 outline-none rounded-xl border border-gray-200 text-lg bg-white focus:bg-gray-50 transition-all email-code" maxlength="1" type="text" id="sixth-num">
                      </div>
                    </div>
                    <input id="get-customer-email" type="hidden" value="<?= $email ?>">
                    <button id="close-email-verify-modal" class="flex flex-row items-center justify-center text-center font-semibold w-full border rounded-xl outline-none py-2.5 bg-blue-600 hover:bg-blue-700 border-none text-white shadow transition-all active:scale-90">
                      Затвори
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div id="phone-verify-modal" class="bg-gray-900 hidden bg-opacity-50 fixed inset-0 z-40">
          <div class="h-full w-full p-4 overflow-x-hidden overflow-y-auto flex justify-center items-center">
            <div class="relative bg-white px-8 pt-9 pb-8 shadow-xl mx-auto h-auto w-full max-w-lg rounded-2xl animate__animated animate__zoomIn animate__faster">
              <div class="mx-auto flex w-full max-w-md flex-col space-y-8">
                <div class="flex flex-col items-center justify-center text-center space-y-2">
                  <div class="font-semibold text-3xl text-slate-700">
                    <p>Потвърдете тел. номер си</p>
                  </div>
                  <div class="flex flex-row text-sm font-medium text-gray-400">
                    <p>Изпратихме SMS до вашият номер</p>
                  </div>
                </div>
                <div>
                  <div class="flex flex-col space-y-8">
                    <div class="flex flex-row items-center justify-between mx-auto w-full px-4">
                      <div class="w-14 h-14">
                        <input class="w-full h-full flex flex-col items-center justify-center text-center px-5 outline-none rounded-xl border border-gray-200 text-lg bg-white focus:bg-gray-50 transition-all phone-code" maxlength="1" type="text" id="first-num-p">
                      </div>
                      <div class="w-14 h-14">
                        <input class="w-full h-full flex flex-col items-center justify-center text-center px-5 outline-none rounded-xl border border-gray-200 text-lg bg-white focus:bg-gray-50 transition-all phone-code" maxlength="1" type="text" id="second-num-p">
                      </div>
                      <div class="w-14 h-14">
                        <input class="w-full h-full flex flex-col items-center justify-center text-center px-5 outline-none rounded-xl border border-gray-200 text-lg bg-white focus:bg-gray-50 transition-all phone-code" maxlength="1" type="text" id="third-num-p">
                      </div>
                      <div class="w-14 h-14">
                        <input class="w-full h-full flex flex-col items-center justify-center text-center px-5 outline-none rounded-xl border border-gray-200 text-lg bg-white focus:bg-gray-50 transition-all phone-code" maxlength="1" type="text" id="fourth-num-p">
                      </div>
                      <div class="w-14 h-14">
                        <input class="w-full h-full flex flex-col items-center justify-center text-center px-5 outline-none rounded-xl border border-gray-200 text-lg bg-white focus:bg-gray-50 transition-all phone-code" maxlength="1" type="text" id="fifth-num-p">
                      </div>
                      <div class="w-14 h-14">
                        <input class="w-full h-full flex flex-col items-center justify-center text-center px-5 outline-none rounded-xl border border-gray-200 text-lg bg-white focus:bg-gray-50 transition-all phone-code" maxlength="1" type="text" id="sixth-num-p">
                      </div>
                    </div>
                    <button id="close-phone-verify-modal" class="flex flex-row items-center justify-center text-center font-semibold w-full border rounded-xl outline-none py-2.5 bg-blue-600 hover:bg-blue-700 border-none text-white shadow transition-all active:scale-90">
                      Затвори
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div id="history-modal" class="bg-gray-900 hidden bg-opacity-50 fixed inset-0 z-40">
          <div class="h-full p-4 overflow-x-hidden overflow-y-auto flex 2xl:items-center justify-center">
            <div class="relative w-full max-w-lg h-auto animate__animated animate__zoomIn animate__faster">
              <div class="relative bg-white rounded-lg shadow">
                <button id="close-history-modal" type="button" class="absolute top-2 right-2 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                  <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                  </svg>
                </button>
                <div class="p-6 pt-8 pr-10 space-y-6 text-slate-700">
                  <div class="sm:flex items-center w-full space-y-4 sm:space-y-0 sm:space-x-5 xl:space-x-6">
                    <div class="w-full sm:w-1/2">
                      <div class="text-sm md:text-base font-semibold mb-1">Дата на заявката</div>
                      <div class="flex items-center py-1.5 px-2.5 shadow-lg border border-slate-100 rounded-md bg-blue-50">
                        <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mr-1.5 text-blue-300">
                          <path d="M12.75 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM7.5 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM8.25 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM9.75 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM10.5 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM12.75 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM14.25 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM15 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM16.5 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM15 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM16.5 13.5a.75.75 0 100-1.5.75.75 0 000 1.5z" />
                          <path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 017.5 3v1.5h9V3A.75.75 0 0118 3v1.5h.75a3 3 0 013 3v11.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V7.5a3 3 0 013-3H6V3a.75.75 0 01.75-.75zm13.5 9a1.5 1.5 0 00-1.5-1.5H5.25a1.5 1.5 0 00-1.5 1.5v7.5a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5v-7.5z" clip-rule="evenodd" />
                        </svg>
                        <div id="add_date"></div>
                      </div>
                    </div>
                    <div class="w-full sm:w-1/2">
                      <div class="text-sm md:text-base font-semibold mb-1">Час на заявката</div>
                      <div class="flex items-center py-1.5 px-2.5 shadow-lg border border-slate-100 rounded-md bg-blue-50">
                        <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mr-1.5 text-blue-300">
                          <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 000-1.5h-3.75V6z" clip-rule="evenodd" />
                        </svg>
                        <div id="add_time"></div>
                      </div>
                    </div>
                  </div>
                  <div class="sm:flex items-center w-full space-y-4 sm:space-y-0 sm:space-x-5 xl:space-x-6 sm:my-2.5">
                    <div class="w-full sm:w-1/2">
                      <div class="text-sm md:text-base font-semibold mb-1">Име на клиент</div>
                      <div class="flex items-center py-1.5 px-2.5 shadow-lg border border-slate-100 rounded-md bg-blue-50">
                        <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mr-1.5 text-blue-300">
                          <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                        </svg>
                        <div id="customer_name"></div>
                      </div>
                    </div>
                    <div class="w-full sm:w-1/2">
                      <div class="text-sm md:text-base font-semibold mb-1">Телефонен номер</div>
                      <div class="flex items-center py-1.5 px-2.5 shadow-lg border border-slate-100 rounded-md bg-blue-50">
                        <svg viewBox=" 0 0 24 24" fill="currentColor" class="w-5 h-5 mr-1.5 text-blue-300">
                          <path fill-rule="evenodd" d="M1.5 4.5a3 3 0 013-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 01-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 006.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 011.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 01-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5z" clip-rule="evenodd" />
                        </svg>
                        <div id="customer_phone"></div>
                      </div>
                    </div>
                  </div>
                  <div class="sm:flex items-center w-full space-y-4 sm:space-y-0 sm:space-x-5 xl:space-x-6 sm:my-2.5">
                    <div class="w-full sm:w-1/2">
                      <div class="text-sm md:text-base font-semibold mb-1">Помещение</div>
                      <div class="flex items-center py-1.5 px-2.5 shadow-lg border border-slate-100 rounded-md bg-blue-50">
                        <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mr-1.5 text-blue-300">
                          <path d="M11.584 2.376a.75.75 0 01.832 0l9 6a.75.75 0 11-.832 1.248L12 3.901 3.416 9.624a.75.75 0 01-.832-1.248l9-6z" />
                          <path fill-rule="evenodd" d="M20.25 10.332v9.918H21a.75.75 0 010 1.5H3a.75.75 0 010-1.5h.75v-9.918a.75.75 0 01.634-.74A49.109 49.109 0 0112 9c2.59 0 5.134.202 7.616.592a.75.75 0 01.634.74zm-7.5 2.418a.75.75 0 00-1.5 0v6.75a.75.75 0 001.5 0v-6.75zm3-.75a.75.75 0 01.75.75v6.75a.75.75 0 01-1.5 0v-6.75a.75.75 0 01.75-.75zM9 12.75a.75.75 0 00-1.5 0v6.75a.75.75 0 001.5 0v-6.75z" clip-rule="evenodd" />
                          <path d="M12 7.875a1.125 1.125 0 100-2.25 1.125 1.125 0 000 2.25z" />
                        </svg>
                        <div id="customer_building"></div>
                      </div>
                    </div>
                    <div class="w-full sm:w-1/2">
                      <div class="text-sm md:text-base font-semibold mb-1">Оферта</div>
                      <div class="flex items-center py-1.5 px-2.5 shadow-lg border border-slate-100 rounded-md bg-blue-50">
                        <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mr-1.5 text-blue-300">
                          <path fill-rule="evenodd" d="M7.5 5.25a3 3 0 013-3h3a3 3 0 013 3v.205c.933.085 1.857.197 2.774.334 1.454.218 2.476 1.483 2.476 2.917v3.033c0 1.211-.734 2.352-1.936 2.752A24.726 24.726 0 0112 15.75c-2.73 0-5.357-.442-7.814-1.259-1.202-.4-1.936-1.541-1.936-2.752V8.706c0-1.434 1.022-2.7 2.476-2.917A48.814 48.814 0 017.5 5.455V5.25zm7.5 0v.09a49.488 49.488 0 00-6 0v-.09a1.5 1.5 0 011.5-1.5h3a1.5 1.5 0 011.5 1.5zm-3 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                          <path d="M3 18.4v-2.796a4.3 4.3 0 00.713.31A26.226 26.226 0 0012 17.25c2.892 0 5.68-.468 8.287-1.335.252-.084.49-.189.713-.311V18.4c0 1.452-1.047 2.728-2.523 2.923-2.12.282-4.282.427-6.477.427a49.19 49.19 0 01-6.477-.427C4.047 21.128 3 19.852 3 18.4z" />
                        </svg>
                        <div id="customer_offer"></div>
                      </div>
                    </div>
                  </div>
                  <div class="sm:flex items-center w-full space-y-4 sm:space-y-0 sm:space-x-5 xl:space-x-6 sm:my-2.5">
                    <div class="w-full sm:w-1/2">
                      <div class="text-sm md:text-base font-semibold mb-1">Дата на изпълнение</div>
                      <div class="flex items-center py-1.5 px-2.5 shadow-lg border border-slate-100 rounded-md bg-blue-50">
                        <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mr-1.5 text-blue-300">
                          <path d="M12.75 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM7.5 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM8.25 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM9.75 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM10.5 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM12.75 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM14.25 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM15 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM16.5 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM15 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM16.5 13.5a.75.75 0 100-1.5.75.75 0 000 1.5z" />
                          <path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 017.5 3v1.5h9V3A.75.75 0 0118 3v1.5h.75a3 3 0 013 3v11.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V7.5a3 3 0 013-3H6V3a.75.75 0 01.75-.75zm13.5 9a1.5 1.5 0 00-1.5-1.5H5.25a1.5 1.5 0 00-1.5 1.5v7.5a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5v-7.5z" clip-rule="evenodd" />
                        </svg>
                        <div id="do_date"></div>
                      </div>
                    </div>
                    <div class="w-full sm:w-1/2">
                      <div class="text-sm md:text-base font-semibold mb-1">Час на изпълнение</div>
                      <div class="flex items-center py-1.5 px-2.5 shadow-lg border border-slate-100 rounded-md bg-blue-50">
                        <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mr-1.5 text-blue-300">
                          <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 000-1.5h-3.75V6z" clip-rule="evenodd" />
                        </svg>
                        <div id="do_time"></div>
                      </div>
                    </div>
                  </div>
                  <div class="sm:flex items-center w-full space-y-4 sm:space-y-0 sm:space-x-5 xl:space-x-6 sm:my-2.5">
                    <div class="w-full sm:w-1/2">
                      <div class="text-sm md:text-base font-semibold mb-1">Начин на плащане</div>
                      <div class="flex items-center py-1.5 px-2.5 shadow-lg border border-slate-100 rounded-md bg-blue-50">
                        <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mr-1.5 text-blue-300">
                          <path d="M4.5 3.75a3 3 0 00-3 3v.75h21v-.75a3 3 0 00-3-3h-15z" />
                          <path fill-rule="evenodd" d="M22.5 9.75h-21v7.5a3 3 0 003 3h15a3 3 0 003-3v-7.5zm-18 3.75a.75.75 0 01.75-.75h6a.75.75 0 010 1.5h-6a.75.75 0 01-.75-.75zm.75 2.25a.75.75 0 000 1.5h3a.75.75 0 000-1.5h-3z" clip-rule="evenodd" />
                        </svg>
                        <div id="customer_payment"></div>
                      </div>
                    </div>
                    <div class="w-full sm:w-1/2">
                      <div class="text-sm md:text-base font-semibold mb-1">Фактура</div>
                      <div class="flex items-center py-1.5 px-2.5 shadow-lg border border-slate-100 rounded-md bg-blue-50">
                        <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mr-1.5 text-blue-300">
                          <path fill-rule="evenodd" d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0016.5 9h-1.875a1.875 1.875 0 01-1.875-1.875V5.25A3.75 3.75 0 009 1.5H5.625zM7.5 15a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5A.75.75 0 017.5 15zm.75 2.25a.75.75 0 000 1.5H12a.75.75 0 000-1.5H8.25z" clip-rule="evenodd" />
                          <path d="M12.971 1.816A5.23 5.23 0 0114.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 013.434 1.279 9.768 9.768 0 00-6.963-6.963z" />
                        </svg>
                        <div id="customer_invoice"></div>
                      </div>
                    </div>
                  </div>
                  <div class="sm:flex items-center w-full space-y-4 sm:space-y-0 sm:space-x-5 xl:space-x-6 sm:my-2.5">
                    <div class="w-full sm:w-1/2">
                      <div class="text-sm md:text-base font-semibold mb-1">Квадратура</div>
                      <div class="flex items-center py-1.5 px-2.5 shadow-lg border border-slate-100 rounded-md bg-blue-50">
                        <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mr-1.5 text-blue-300">
                          <path fill-rule="evenodd" d="M8.161 2.58a1.875 1.875 0 011.678 0l4.993 2.498c.106.052.23.052.336 0l3.869-1.935A1.875 1.875 0 0121.75 4.82v12.485c0 .71-.401 1.36-1.037 1.677l-4.875 2.437a1.875 1.875 0 01-1.676 0l-4.994-2.497a.375.375 0 00-.336 0l-3.868 1.935A1.875 1.875 0 012.25 19.18V6.695c0-.71.401-1.36 1.036-1.677l4.875-2.437zM9 6a.75.75 0 01.75.75V15a.75.75 0 01-1.5 0V6.75A.75.75 0 019 6zm6.75 3a.75.75 0 00-1.5 0v8.25a.75.75 0 001.5 0V9z" clip-rule="evenodd" />
                        </svg>
                        <div id="customer_m2"></div>
                      </div>
                    </div>
                    <div class="w-full sm:w-1/2">
                      <div class="text-sm md:text-base font-semibold mb-1">Цена</div>
                      <div class="flex items-center py-1.5 px-2.5 shadow-lg border border-slate-100 rounded-md bg-blue-50">
                        <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mr-1.5 text-blue-300">
                          <path d="M10.464 8.746c.227-.18.497-.311.786-.394v2.795a2.252 2.252 0 01-.786-.393c-.394-.313-.546-.681-.546-1.004 0-.323.152-.691.546-1.004zM12.75 15.662v-2.824c.347.085.664.228.921.421.427.32.579.686.579.991 0 .305-.152.671-.579.991a2.534 2.534 0 01-.921.42z" />
                          <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v.816a3.836 3.836 0 00-1.72.756c-.712.566-1.112 1.35-1.112 2.178 0 .829.4 1.612 1.113 2.178.502.4 1.102.647 1.719.756v2.978a2.536 2.536 0 01-.921-.421l-.879-.66a.75.75 0 00-.9 1.2l.879.66c.533.4 1.169.645 1.821.75V18a.75.75 0 001.5 0v-.81a4.124 4.124 0 001.821-.749c.745-.559 1.179-1.344 1.179-2.191 0-.847-.434-1.632-1.179-2.191a4.122 4.122 0 00-1.821-.75V8.354c.29.082.559.213.786.393l.415.33a.75.75 0 00.933-1.175l-.415-.33a3.836 3.836 0 00-1.719-.755V6z" clip-rule="evenodd" />
                        </svg>
                        <div id="customer_price"></div>
                      </div>
                    </div>
                  </div>
                  <div class="w-full my-2.5">
                    <div class="text-sm md:text-base font-semibold mb-1">Адрес</div>
                    <div class="flex items-center py-1.5 px-2.5 shadow-lg border border-slate-100 rounded-md bg-blue-50">
                      <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mr-1.5 text-blue-300">
                        <path d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" />
                        <path d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z" />
                      </svg>
                      <div id="customer_address"></div>
                    </div>
                  </div>
                  <div class="w-full my-2.5">
                    <div class="text-sm md:text-base font-semibold mb-1">Допълнителна информация</div>
                    <div class="flex items-center py-1.5 px-2.5 shadow-lg border border-slate-100 rounded-md bg-blue-50">
                      <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mr-1.5 text-blue-300">
                        <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 01.67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 11-.671-1.34l.041-.022zM12 9a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                      </svg>
                      <div id="customer_information"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div id="delete-customer-img-modal" class="bg-gray-900 hidden bg-opacity-50 fixed inset-0 z-40">
        <div class="h-full w-full p-5 overflow-x-hidden overflow-y-auto flex justify-center items-center">
          <div class="relative w-full h-auto max-w-md animate__animated animate__zoomIn animate__faster">
            <div class="relative bg-white rounded-lg shadow mb-6">
              <div class="p-4 text-center">
                <div class="text-xl font-bold mb-3">Изтрий снимката</div>
                <h3 class="mb-5 text-sm text-gray-500">Сигурни ли сте, че искате да изтриете снимката ?</h3>
                <form id="delete-customer-img-form">
                  <input id="delete-img-id" type="hidden" name="imgId">
                  <div class="flex items-center mt-3">
                    <button type="button" class="flex-1 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 text-sm font-medium rounded-md active:scale-90 transition-all close-delete-customer-img-modal">
                      Откажи
                    </button>
                    <button type="submit" class="flex-1 px-4 py-2 ml-2.5 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md active:scale-90 transition-all">
                      Изтрий
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php } else { ?>
    <div class="min-w-screen min-h-screen bg-blue-100 flex items-center p-5 lg:p-20 overflow-hidden relative">
      <div class="flex-1 min-h-full min-w-full rounded-3xl bg-white shadow-xl p-10 lg:p-20 text-gray-800 relative md:flex items-center text-center md:text-left">
        <div class="w-full md:w-1/2">
          <div class="mb-8 md:mb-14 text-gray-600 font-light">
            <h1 class="font-black uppercase text-3xl lg:text-5xl text-blue-500 mb-10">Грешна страница!</h1>
            <p>Страницата, която търсите не е намерена.</p>
            <p>Върнете се към началната страница с бутона отдолу.</p>
          </div>
          <div class="mb-20 md:mb-0">
            <button onclick="location.replace('index')" class="text-lg font-light outline-none focus:outline-none transform transition-all hover:scale-110 text-blue-700 hover:text-blue-800 bg-blue-200 hover:bg-blue-300 py-1.5 px-2.5 rounded-xl">Към начало</button>
          </div>
        </div>
        <div class="w-full md:w-1/2 text-center">
          <svg viewBox="0 0 441.85 285.44" class="w-full max-w-lg lg:max-w-full mx-auto">
            <path class="st0" d="M0 0h500v500H0z" id="BACKGROUND" />
            <g id="OBJECTS">
              <path class="st1" d="M423.72 280.45c6.95 0 12.62-5.57 12.73-12.52.53-34.64 3.32-85.75-61.92-99.88-52.8-11.44-21.49-105.27-163.69-99.21-102.07 4.35-74.96 90.39-154.32 97.55-52.81 4.77-53.27 71.56-51.24 102.16.44 6.69 6 11.89 12.71 11.89h405.73z" />
              <path class="st2" d="M374.53 168.04c-52.8-11.44-21.49-105.27-163.69-99.21-24.28 1.03-41.24 6.7-54.07 14.81 4.32-.57 8.91-.97 13.8-1.17 142.19-6.06 110.89 87.77 163.69 99.21 64.55 13.98 62.51 64.15 61.94 98.76h27.52c6.95 0 12.62-5.57 12.73-12.52.53-34.64 3.32-85.74-61.92-99.88z" />
              <path class="st3" d="M311.43 64.84L144.49 45.35c-7.13-.83-13.59 4.28-14.43 11.41L117.6 163.52c-.83 7.13 4.28 13.59 11.41 14.43l166.95 19.49c7.13.83 13.59-4.28 14.43-11.41l12.46-106.75c.83-7.15-4.28-13.61-11.42-14.44z" />
              <path class="st4" d="M321.61 89.83l1.23-10.57c.83-7.13-4.28-13.59-11.41-14.43L144.49 45.35c-7.13-.83-13.59 4.28-14.43 11.41l-1.23 10.57 192.78 22.5z" />
              <path class="st5" d="M155.84 131.97L177 94.68a6.857 6.857 0 0 1 6.74-3.42c3.75.44 6.44 3.83 6 7.58l-4.4 37.72.19.02c2.6.3 4.46 2.66 4.16 5.25a4.74 4.74 0 0 1-5.25 4.16l-.19-.02-.8 6.87c-.33 2.81-2.87 4.82-5.67 4.49-2.81-.33-4.82-2.87-4.49-5.67l.8-6.87-15.24-1.78c-2.6-.3-4.47-2.66-4.16-5.26l.4-3.46c.09-.82.34-1.61.75-2.32zm19.4 2.79l2.73-23.39c.02-.16-.2-.23-.28-.09l-12.5 22.06c-.22.39.03.88.47.93l8.89 1.04c.34.04.65-.21.69-.55zM249.23 142.87l21.16-37.29a6.857 6.857 0 0 1 6.74-3.42c3.75.44 6.44 3.83 6 7.58l-4.4 37.72.19.02c2.6.3 4.46 2.66 4.16 5.25a4.74 4.74 0 0 1-5.25 4.16l-.19-.02-.8 6.87c-.33 2.81-2.87 4.82-5.67 4.49-2.81-.33-4.82-2.87-4.49-5.67l.8-6.87-15.24-1.78c-2.6-.3-4.47-2.66-4.16-5.26l.4-3.46c.09-.82.35-1.6.75-2.32zm19.41 2.79l2.73-23.39c.02-.16-.2-.23-.28-.09l-12.5 22.06c-.22.39.03.88.47.93l8.89 1.04c.34.04.65-.21.69-.55zM207.25 110.04c1.23-10.54 7.48-15.91 17.65-14.73 10.16 1.19 15.01 7.86 13.78 18.39l-4 34.25c-1.23 10.54-7.48 15.91-17.65 14.73-10.16-1.19-15.01-7.86-13.78-18.39l4-34.25zm6.27 36.11c-.55 4.7 1.31 6.73 4.61 7.12 3.29.38 5.57-1.16 6.12-5.87l4.15-35.57c.55-4.7-1.31-6.73-4.61-7.12-3.29-.38-5.57 1.16-6.12 5.87l-4.15 35.57z" />
              <path class="st0" d="M148.51 60.1a3.498 3.498 0 1 1-6.95-.81 3.498 3.498 0 0 1 3.88-3.07 3.51 3.51 0 0 1 3.07 3.88z" />
              <path class="st5" d="M165.25 62.06a3.498 3.498 0 1 1-6.95-.81 3.498 3.498 0 0 1 3.88-3.07 3.49 3.49 0 0 1 3.07 3.88z" />
              <path class="st6" d="M182.61 64.08a3.498 3.498 0 1 1-6.95-.81 3.498 3.498 0 0 1 3.88-3.07c1.92.23 3.3 1.97 3.07 3.88z" />
              <g>
                <path class="st7" d="M115.45 185.68s-2.26 10-1.88 20.22c.34 9.15-.75 69.31-.75 69.31h7.35s10.46-47.12 10.85-50.84c.39-3.72 5.65-40.93 5.65-40.93l-21.22 2.24z" />
                <path class="st4" d="M120.34 182.94s1.69 12.85 4.57 21.99c2.88 9.13 17.01 70.29 17.01 70.29h7.35s-1.35-47.12-1.86-50.84c-.51-3.72-4.23-40.93-4.23-40.93l-22.84-.51z" />
                <path class="st4" d="M142.51 275.2v5.13h13.99c.79 0 1.11-1.03.44-1.47-2.05-1.36-5.32-3.24-8.37-3.66h-6.06zM113.2 275.2v5.13h13.99c.79 0 1.11-1.03.44-1.47-2.05-1.36-5.32-3.24-8.37-3.66h-6.06z" />
                <path class="st7" d="M138.43 123.15s4.81-7.31-.71-8.02c-4.24-.55-5.99.72-5.99.72s-4.88-.54-7.56 1.78c-1.83 1.59-8.55 13.9 2.32 18.35s8.55-6.95 8.55-6.95l3.39-5.88z" />
                <path class="st8" d="M137.72 115.13c-4.24-.55-5.99.72-5.99.72s-4.88-.54-7.56 1.78c-1.83 1.59-8.55 13.9 2.32 18.35 5.11 2.09 7.3.68 8.2-1.4-10.31 2.9-11.43-9.53-9.73-13.06 1.73-3.59 5.87-1.94 5.87-1.94 1.62-4.08 6.91-3.64 9.09-3.32-.39-.57-1.08-.99-2.2-1.13z" />
                <path class="st9" d="M131.66 126.71s-1.43-1.43-2.49 0c-1.07 1.43-.36 4.63 1.43 4.81 0 0-.53 4.63-4.1 4.45v3.74h8.37v-2.85s5.17-2.14 4.99-6.41c-.18-4.28-1.43-7.31-1.43-7.31s-2.85 3.21-6.77 3.57z" />
                <path class="st10" d="M132.95 138.06c.83.35.68.87.72 1.65h1.2v-2.85s-2.03.64-5-1.05c0 .01 1.73 1.69 3.08 2.25z" />
                <path class="st9" d="M134.66 119.89s-4.34-1.73-4.85-.43c-.33.85.51 1.58 1.67 2.32l-1.02.17c-.23.04-.31.33-.13.47.28.23 1.07.38 2.71.44l1.62-2.97z" />
                <path class="st11" d="M108.84 166.97l5.82 18.74-.11-.95.11.95 1.96-27.3z" />
                <path class="st6" d="M165.66 130.76c-8.28-6.13-30.88-11.04-30.88-11.04l-1.86 3.39s20.52 7.95 19.17 9.14c-.8.7-10.82 5.29-14.22 6.84-.73.33-1.52.49-2.33.48l-10.39-.06s-7.5-.89-13.39 5.88c-5.27 6.07-14.23 20.12-14.23 20.12l15.1 22.2 1.67 2.45.01-.03-.01.21s.54.06 1.49.15c4.85.45 20.41 1.68 28.64-.07l.23-.05-.39-36.42c13.14-10.4 19.42-18.44 21.66-20.96.56-.67.45-1.69-.27-2.23zM115 180.43l-1.47-3.22-4.69-10.25 7.78-8.72-1.4 19.13-.22 3.06z" />
                <path class="st12" d="M113.53 177.21l1.47 3.22-.71 9.71-.02.03-1.67-2.45z" />
                <path class="st13" d="M140.72 152.65c-1.4 1.02-1.04 10.02-1.39 15.65-.58 9.43-1.14 17.59-.73 22.85 2.13-.14 4.11-.37 5.79-.73l.23-.05-.39-36.42c13.14-10.4 19.42-18.44 21.66-20.96.59-.67.48-1.69-.24-2.23.01 0-10.38 11.33-24.93 21.89z" />
                <path class="st7" d="M147.4 224.38c-.37-2.68-2.41-22.8-3.51-33.8l-5.28.58s7.7 63.33 8.21 84.06h2.44c0-.01-1.35-47.12-1.86-50.84z" />
                <g>
                  <path class="st4" d="M113.54 127.75l-1.59-2.85c.8-1.5 1.25-3.22 1.25-5.04 0-5.95-4.83-10.78-10.78-10.78s-10.78 4.83-10.78 10.78c0 5.95 4.83 10.78 10.78 10.78 3 0 5.71-1.23 7.66-3.2l3.46.31z" />
                  <path class="st0" d="M96.81 118.88h.42v1.5c0 .46.14.66.46.66.25 0 .43-.13.66-.41v-1.75h.41v2.46h-.34l-.04-.38h-.02c-.23.27-.47.45-.81.45-.52 0-.75-.33-.75-.96v-1.57zM100.52 121.55v.83h-.42v-3.5h.34l.03.28h.02c.22-.19.5-.34.78-.34.63 0 .97.49.97 1.25 0 .83-.5 1.33-1.06 1.33-.23 0-.46-.11-.68-.28l.02.43zm.6-.5c.4 0 .7-.37.7-.98 0-.54-.18-.91-.65-.91-.21 0-.42.12-.66.33v1.29c.23.2.45.27.61.27zM103.35 120.78c.21.17.43.29.72.29.32 0 .49-.17.49-.38 0-.25-.29-.36-.56-.47-.35-.13-.73-.29-.73-.71 0-.39.31-.7.84-.7.31 0 .58.13.76.28l-.2.26c-.17-.13-.34-.22-.56-.22-.31 0-.45.17-.45.35 0 .23.27.32.55.43.35.13.75.28.75.74 0 .4-.32.73-.9.73-.35 0-.68-.15-.92-.34l.21-.26zM106.26 120.76c.16 0 .3.13.3.32 0 .18-.14.31-.3.31-.17 0-.3-.13-.3-.31 0-.19.14-.32.3-.32zM108.03 120.76c.16 0 .3.13.3.32 0 .18-.14.31-.3.31-.17 0-.3-.13-.3-.31-.01-.19.13-.32.3-.32z" />
                </g>
              </g>
              <g>
                <path class="st5" d="M72.21 257.39s-2.26-2.12-.74-10.14c1.52-8.02 5.38-15.73 3.48-24.43-1.89-8.71-16.73-30.65-16.77-32.11-.05-1.46-4.58 25.53 3.09 36.17 7.67 10.63 8.59 14.32 8.25 19.92-.34 5.59.08 10.1.92 11.4l1.77-.81z" />
                <path class="st14" d="M70.8 241.25c-.89 3.58-1.43 12.55-.01 14.7.13.2.32.09.56-.28-.43-1.48-.72-4.08.1-8.42 1.52-8.02 5.38-15.73 3.48-24.43-1.89-8.71-16.73-30.65-16.77-32.11 0 0 2.24 18.29 9.76 30.87 5.4 9 3.77 16.09 2.88 19.67z" />
                <path class="st5" d="M74.91 256.83s-4.36-10.88 3.03-20.3c7.39-9.42 19.2-21.52 19.43-26.31 0 0 3.04 22.75-6.58 29.19-9.61 6.44-16.35 7.47-14.69 17.38l-1.19.04z" />
                <path class="st14" d="M85.29 234.84c-10.72 7.8-11.59 16.79-9.93 20.96.13.32.37.52.7.63-1.44-9.56 5.25-10.65 14.74-17.01 9.61-6.44 6.58-29.19 6.58-29.19S96 227.04 85.29 234.84z" />
                <g>
                  <path class="st5" d="M67.74 257.07s1.4-5.76.65-11.98c-.74-6.22-7.24-9.72-13.31-16.29-3.12-3.38-4.05-21.25-2.11-22.91 0 0-10.72 12.99-9.06 22.5 1.65 9.51 19.14 15.69 20.76 20.29 1.62 4.6 1.48 8.45 1.48 8.45l1.59-.06z" />
                  <path class="st14" d="M49.35 211c-3.54 9.59.09 21.21 11.86 28.43 8.66 5.31 5.9 16.36 5.9 16.36l1.42-4.36c.13-1.88.14-4.08-.13-6.34-.74-6.22-7.24-9.72-13.31-16.29-3.01-3.26-3.98-20-2.31-22.67-.49.62-1.88 2.42-3.43 4.87zM52.78 206.13l.19-.24c-.06.06-.13.14-.19.24z" />
                </g>
                <g>
                  <path class="st5" d="M77.15 256.35s2.51-9.32 8.73-10.58c6.21-1.25 13.35-10.44 13.73-12.24 0 .01-1.05 17.33-22.46 22.82z" />
                  <path class="st14" d="M85.52 248.86c-3.81 1.9-5.39 4.46-5.95 6.79 19.06-6.13 20.04-22.11 20.04-22.11-.08.36-.42 1.01-.97 1.82-1.87 3.28-6.39 10.14-13.12 13.5z" />
                </g>
                <path class="st6" d="M90.6 252.92H58.1l3.86 24.27c.29 1.84 1.88 3.2 3.74 3.2h17.29c1.86 0 3.45-1.35 3.74-3.2l3.87-24.27z" />
                <path class="st15" d="M89.96 256.94l.64-4.02H58.1l.64 4.02z" />
                <path class="st15" d="M82.73 252.92l-3.86 24.27a3.792 3.792 0 0 1-3.74 3.2H83c1.86 0 3.45-1.35 3.74-3.2l3.86-24.27h-7.87z" />
              </g>
              <g>
                <path class="st6" d="M167.86 209.64h146.86v29.86H167.86z" />
                <path class="st13" d="M167.86 209.64h146.86v7.25H167.86z" />
                <path class="st16" d="M180.63 209.64h13.41l-3.6 7.25h-13.41zM210.83 209.64h13.41l-3.6 7.25h-13.4zM241.03 209.64h13.4l-3.59 7.25h-13.4zM271.23 209.64h13.4l-3.6 7.25h-13.39zM314.73 209.64v.2l-3.5 7.05h-13.39l3.59-7.25z" />
                <path class="st5" d="M186.14 239.5h10.35v40.83h-10.35z" />
                <path class="st14" d="M194.15 239.5h2.35v40.83h-2.35z" />
                <path class="st5" d="M286.9 239.5h10.35v40.83H286.9z" />
                <path class="st14" d="M294.19 239.5h3.06v40.83h-3.06zM186.14 239.47h10.35v5.14h-10.35z" />
                <path class="st14" d="M286.9 239.47h10.35v5.14H286.9z" />
                <path class="st5" d="M186.14 204.97h10.35v4.64h-10.35z" />
                <path class="st14" d="M194.15 204.97h2.35v4.64h-2.35z" />
                <path class="st5" d="M286.9 204.97h10.35v4.64H286.9z" />
                <path class="st14" d="M294.19 204.97h3.06v4.64h-3.06zM186.14 209.03h10.35v.58h-10.35z" />
                <path class="st14" d="M286.9 209.03h10.35v.58H286.9z" />
                <path class="st4" d="M194.04 209.64l-14.81 29.86h-11.37v-4.12l12.77-25.74zM210.83 209.64l-14.81 29.86h13.4l14.82-29.86zM254.43 209.64l-14.81 29.86h-13.4l14.81-29.86zM284.63 209.64l-14.81 29.86h-13.4l14.81-29.86zM301.43 209.64l-14.81 29.86h13.4l14.71-29.66z" />
                <path class="st7" d="M194.04 209.64l-3.6 7.25h-13.41l3.6-7.25zM224.24 209.64l-3.6 7.25h-13.4l3.59-7.25zM254.43 209.64l-3.59 7.25h-13.4l3.59-7.25zM284.63 209.64l-3.6 7.25h-13.39l3.59-7.25zM314.73 209.84l-3.5 7.05h-13.39l3.59-7.25z" />
                <linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="242.075" y1="248.234" x2="242.075" y2="224.179">
                  <stop offset="0" stop-color="#fff" />
                  <stop offset="1" stop-color="#fff" stop-opacity="0" />
                </linearGradient>
                <path class="st17" d="M171.96 222.56H312.2v14.94H171.96z" />
                <ellipse transform="rotate(-9.249 191.082 198.565)" class="st6" cx="191.05" cy="198.49" rx="9.23" ry="9.23" />
                <path class="st4" d="M195.23 198.49c0-2.31-1.87-4.18-4.18-4.18-2.31 0-4.18 1.87-4.18 4.18 0 2.31 1.87 4.18 4.18 4.18 2.31.01 4.18-1.87 4.18-4.18z" />
                <ellipse transform="rotate(-9.249 292.07 198.575)" class="st6" cx="292.01" cy="198.49" rx="9.23" ry="9.23" />
                <path class="st4" d="M296.19 198.49c0-2.31-1.87-4.18-4.18-4.18-2.31 0-4.18 1.87-4.18 4.18 0 2.31 1.87 4.18 4.18 4.18 2.31.01 4.18-1.87 4.18-4.18z" />
              </g>
              <g>
                <path class="st6" d="M370.37 277.17H323.6l7.15-17.34v-.01l2.88-7 .79-1.92 1.29-3.12.26-.64 2.88-7 .53-1.27 5.1-12.38c.92-2.23 4.08-2.23 5 0l5.1 12.38.53 1.27 2.88 7 .26.64 1.29 3.12.79 1.92 2.88 7v.01l7.16 17.34z" />
                <path class="st13" d="M326.66 269.73l-3.07 7.43h46.78l-3.06-7.43z" />
                <path class="st5" d="M319.85 272.72h53.57v7.57h-53.57z" />
                <path class="st14" d="M361.85 272.72h11.57v7.57h-11.57z" />
                <path class="st13" d="M368.53 272.72h-6.62l-5.31-12.89v-.01l-2.88-7-.79-1.92-1.29-3.12-.26-.64-2.88-7-.53-1.27-4.29-10.42.8-1.96c.92-2.23 4.08-2.23 5 0l5.1 12.38.53 1.27 2.88 7 .26.64 1.29 3.12.79 1.92 2.88 7v.01l5.32 12.89z" />
                <path class="st4" d="M357.98 247.14h-22.01l2.88-7h16.26zM363.21 259.81v.01h-32.46v-.01l2.87-7h26.71z" />
                <path class="st7" d="M357.98 247.14h-6.61l-2.88-7h6.62zM363.21 259.81v.01h-6.62v-.01l-2.87-7h6.61z" />
              </g>
              <g>
                <path class="st3" d="M72.22 107.1c3.49 0 6.53-2.54 7.01-6 .08-.62.13-1.25.13-1.9 0-7.71-6.25-13.96-13.96-13.96-.32 0-.63.01-.94.03-.64-7.6-7.01-13.57-14.77-13.57-8.19 0-14.83 6.64-14.83 14.83 0 .36.02.72.04 1.08-2.32-1.3-5.03-1.99-7.91-1.86-7.45.34-13.57 6.3-14.1 13.74 0 .06-.01.12-.01.18-.24 4.04 3.03 7.44 7.08 7.44h52.26zM405.35 118.06c11.04 0 11.65-16.61.62-17.15-.3-.01-.6-.02-.91-.02-1.97 0-3.86.31-5.64.88-1.48-8.99-9.28-15.85-18.69-15.85-9.62 0-17.55 7.17-18.77 16.45a17.45 17.45 0 0 0-7.54-1.71c-1.51 0-2.97.19-4.37.55-9.65 2.49-7.63 16.85 2.34 16.85h52.96zM272.8 36.21c11.03 0 11.65-16.61.62-17.14-.3-.01-.6-.02-.91-.02-1.97 0-3.86.31-5.64.88-1.48-8.99-9.28-15.85-18.68-15.85-9.61 0-17.55 7.17-18.77 16.45a17.501 17.501 0 0 0-11.9-1.16c-9.65 2.48-7.62 16.84 2.34 16.84h52.94z" />
                <circle class="st6" cx="97.11" cy="40.45" r="26.45" />
                <path class="st15" d="M97.32 14c7.19 4.73 11.95 12.87 11.95 22.12 0 14.61-11.84 26.45-26.45 26.45-.07 0-.14 0-.22-.01 4.17 2.74 9.15 4.34 14.51 4.34 14.61 0 26.45-11.84 26.45-26.45 0-14.53-11.73-26.33-26.24-26.45z" />
              </g>
            </g>
          </svg>
        </div>
      </div>
    </div>
  <?php } ?>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
  <script src="js/main-vue.js"></script>
  <script src="js/main.js"></script>
  <script src="js/ajax.js"></script>
  <script src="js/print.js"></script>
  <script src="loader/siteLoader.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
</body>

</html>