<?php
session_start();
error_reporting(0);
date_default_timezone_set('Europe/Sofia');

include 'action/dbconn.php';

$adminEmail = $_SESSION['adminEmail'];
$date = date("Y-m-d"); ?>
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

  <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>

  <title>Администраторски панел</title>
</head>

<body>
  <div id="load-dashboard" class="fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-50 overflow-hidden bg-slate-800 flex flex-col items-center justify-center">
    <div role="status">
      <svg aria-hidden="true" class="w-8 h-8 md:w-10 md:h-10 2xl:w-14 2xl:h-14 mb-2 md:mr-1 text-gray-100 animate-spin fill-blue-600" viewBox="0 0 100 101" fill="none">
        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
      </svg>
    </div>
    <h2 class="text-center text-gray-100 text-xl xl:text-2xl 2xl:text-3xl font-semibold">Зареждане...</h2>
  </div>

  <div id="app">
    <?php if ($adminEmail) {
      $query = "SELECT * FROM admins WHERE email = '$adminEmail'";
      $execute = mysqli_query($con, $query);

      while ($roles = mysqli_fetch_array($execute)) {
    ?>
        <div class="flex overflow-hidden">
          <Transition name="slide-fade">
            <aside v-show="toggleSidebar" class="fixed z-20 h-full top-0 left-0 flex lg:flex flex-shrink-0 flex-col w-14 lg:w-64 transition-width duration-75" aria-label="Sidebar">
              <div class="relative flex-1 flex flex-col min-h-0 border-r border-gray-200 bg-[#222e3c] pt-0">
                <div class="flex flex-col pt-5 pb-4 overflow-y-auto">
                  <div class="bg-[#222e3c]">
                    <div class="lg:w-[66px] lg:h-[66px] text-center flex items-center justify-center rounded-full mb-2 lg:bg-blue-700 text-white font-bold text-3xl mx-auto">
                      CS
                    </div>
                    <div class="hidden lg:block text-xl text-center font-bold text-white mb-5">
                      Carpet Services
                    </div>
                    <ul class="pb-2 text-gray-400">
                      <div class="hidden lg:block mb-1.5 ml-5 text-xs text-gray-100">
                        Действия
                      </div>
                      <li @click="dashOrder = true; dashUser = false; dashTeam = false; dashWarehouse = false; dashSupplier = false; dashClient = false; productOrder = false; dashProfile = false; dashSection = 'Заявки'" :class="dashOrder ? 'text-white border-l-4 border-[#3b7ddd] bg-gradient-to-r from-[#3a4b5e] via-[#2f3c4b] to-[#2f3c4b] bg-opacity-50' : 'hover:text-gray-300'" class="text-base w-full flex items-center py-2.5 px-4 transition-all cursor-pointer mb-1">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-5 h-5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 00-1.883 2.542l.857 6a2.25 2.25 0 002.227 1.932H19.05a2.25 2.25 0 002.227-1.932l.857-6a2.25 2.25 0 00-1.883-2.542m-16.5 0V6A2.25 2.25 0 016 3.75h3.879a1.5 1.5 0 011.06.44l2.122 2.12a1.5 1.5 0 001.06.44H18A2.25 2.25 0 0120.25 9v.776" />
                        </svg>
                        <span class="ml-2.5 hidden lg:block">Заявки</span>
                      </li>
                      <?php if ($roles["personal_view"] == 1) { ?>
                        <div class="hidden lg:block mb-1.5 mt-2 ml-5 text-xs text-gray-100">
                          Персонал
                        </div>
                        <li @click="dashUser = true; dashOrder = false; dashTeam = false; dashWarehouse = false; dashSupplier = false; dashClient = false; productOrder = false; dashProfile = false; dashSection = 'Потребители'" :class="dashUser ? 'text-white border-l-4 border-[#3b7ddd] bg-gradient-to-r from-[#3a4b5e] via-[#2f3c4b] to-[#2f3c4b]' : 'hover:text-gray-300'" class="text-base w-full flex items-center py-2.5 px-4 transition-all cursor-pointer mb-1">
                          <svg fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                          </svg>
                          <span class="ml-2.5 hidden lg:block">Потребители</span>
                        </li>
                        <li @click="dashTeam = true; dashOrder = false; dashUser = false; dashWarehouse = false; dashSupplier = false; dashClient = false; productOrder = false; dashProfile = false; dashSection = 'Екипи'" :class="dashTeam ? 'text-white border-l-4 border-[#3b7ddd] bg-gradient-to-r from-[#3a4b5e] via-[#2f3c4b] to-[#2f3c4b]' : 'hover:text-gray-300'" class="text-base w-full flex items-center py-2.5 px-4 transition-all cursor-pointer mb-1 reload-team-table">
                          <svg fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                          </svg>
                          <span class="ml-2.5 hidden lg:block">Екипи</span>
                        </li>
                      <?php }
                      if ($roles["nomenclature_view"] == 1) { ?>
                        <div class="hidden lg:block mb-1.5 mt-2 ml-5 text-xs text-gray-100">
                          Номенклатури
                        </div>
                        <li @click="dashWarehouse = true; dashOrder = false; dashUser = false; dashTeam = false; dashSupplier = false; dashClient = false; productOrder = false; dashProfile = false; dashSection = 'Склад'" :class="dashWarehouse ? 'text-white border-l-4 border-[#3b7ddd] bg-gradient-to-r from-[#3a4b5e] via-[#2f3c4b] to-[#2f3c4b]' : 'hover:text-gray-300'" class="text-base w-full flex items-center py-2.5 px-4 transition-all cursor-pointer mb-1">
                          <svg fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                          </svg>
                          <span class="ml-2.5 hidden lg:block">Склад</span>
                        </li>
                        <li @click="productOrder = true; dashOrder = false; dashUser = false; dashTeam = false; dashWarehouse = false; dashClient = false; dashSupplier = false; dashProfile = false; dashSection = 'Поръчки'" :class="productOrder ? 'text-white border-l-4 border-[#3b7ddd] bg-gradient-to-r from-[#3a4b5e] via-[#2f3c4b] to-[#2f3c4b]' : 'hover:text-gray-300'" class="text-base w-full flex items-center py-2.5 px-4 transition-all cursor-pointer mb-1">
                          <svg fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                          </svg>
                          <span class="ml-2.5 hidden lg:block">Поръчки</span>
                        </li>
                        <li @click="dashSupplier = true; dashOrder = false; dashUser = false; dashTeam = false; dashWarehouse = false; dashClient = false; productOrder = false; dashProfile = false; dashSection = 'Доставчици'" :class="dashSupplier ? 'text-white border-l-4 border-[#3b7ddd] bg-gradient-to-r from-[#3a4b5e] via-[#2f3c4b] to-[#2f3c4b]' : 'hover:text-gray-300'" class="text-base w-full flex items-center py-2.5 px-4 transition-all cursor-pointer mb-1">
                          <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                          </svg>
                          <span class="ml-2.5 hidden lg:block">Доставчици</span>
                        </li>
                      <?php } ?>
                    </ul>
                  </div>
                </div>
              </div>
            </aside>
          </Transition>
          <Transition name="fade">
            <div id="main-section" :class="toggleSidebar ? 'ml-14 lg:ml-64' : 'ml-0'" class="h-screen w-full bg-gray-100 relative overflow-y-auto">
              <nav class="bg-white border-b border-gray-200 w-full z-30 w-full">
                <div class="px-3 py-3 lg:px-5 lg:pl-3">
                  <div class="flex items-center justify-between">
                    <div class="flex items-center justify-start">
                      <button id="hamburger-btn" @click="toggleSidebar = !toggleSidebar" aria-expanded="true" aria-controls="sidebar" class="mr-2 text-gray-600 hover:text-gray-900 p-1.5 hover:bg-gray-100 rounded-md transition-all active:scale-90">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="2.1" stroke="currentColor" class="w-7 h-7">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                      </button>
                      <div class="text-slate-700 font-semibold text-xl">
                        {{ dashSection }}
                      </div>
                    </div>
                    <div class="flex items-center">
                      <div>
                        <button data-dropdown-toggle="notification-dropdown" type="button" class="inline-flex mt-1.5 relative items-center px-1.5 pt-1.5 text-sm font-medium text-center text-white bg-transparent rounded-lg focus:outline-none group active:scale-90 transition-all">
                          <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-slate-500 hover:text-slate-700">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                          </svg>
                          <div class="inline-flex group-hover:-top-1.5 absolute -top-0.5 -right-0.5 justify-center p-2 items-center w-5 h-5 text-xs font-bold text-white bg-[#3b7ddd] rounded-full transition-all duration-700">
                            20
                          </div>
                        </button>
                        <div id="notification-dropdown" class="hidden z-10 w-72 bg-white rounded shadow-xl border border-slate-100">
                          <ul class=" text-sm text-gray-700" aria-labelledby="dropdownDefault">
                            <li class="block px-4 py-2 font-semibold text-base text-center text-gray-700 bg-gray-50">
                              Известия
                            </li>
                          </ul>
                        </div>
                      </div>
                      <div class="pl-4 pr-2 text-right text-xs font-semibold">
                        <div class="text-slate-700"><?= $roles["name"] ?></div>
                        <div class="text-slate-500"><?= $roles["position"] ?></div>
                      </div>
                      <div>
                        <span data-dropdown-toggle="profile-dropdown" data-dropdown-toggle="profile-dropdown" class="inline-flex mt-1.5 relative items-center active:scale-90 hover:opacity-75 transition-all cursor-pointer ">
                          <span id="admin-photo">
                            <?php
                            if ($roles["image"] != "") { ?>
                              <img src="uploaded-files/admin-images/<?= $roles["image"] ?>" alt="<?= $roles["image"] ?>" class="w-8 h-8 rounded-lg object-cover mr-4 shadow">
                              <div class=" absolute -top-0.5 right-3 justify-center p-1 bg-green-500 rounded-full"></div>
                            <?php } else { ?>
                              <img src="images/user.png" alt="user" class="w-8 h-8 rounded-full object-cover mr-4 shadow" />
                            <?php } ?>
                          </span>
                        </span>
                        <div id="profile-dropdown" class="hidden z-10 w-44 bg-white rounded shadow-xl border border-slate-100">
                          <ul class="text-sm text-gray-700" aria-labelledby="dropdownDefault">
                            <li @click="dashProfile = true; dashOrder = false; dashUser = false; dashTeam = false; dashWarehouse = false; dashClient = false; productOrder = false; dashSupplier = false; dashSection = 'Профил'" :class="dashProfile ? 'bg-gray-100' : 'bg-white hover:bg-gray-100'" class="flex items-center py-2 px-4 cursor-pointer active:scale-90 transition-all">
                              <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-slate-700 mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                              </svg>
                              <span>Профил</span>
                            </li>
                            <li class="flex items-center py-2 px-4 hover:bg-gray-100 cursor-pointer active:scale-90 transition-all">
                              <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-slate-700 mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                              </svg>
                              <span>Помощ</span>
                            </li>
                            <hr class="bg-gray-400 w-full" />
                            <li id="admin-logout" class="flex items-center py-2 px-4 hover:bg-gray-100 cursor-pointer active:scale-90 transition-all">
                              <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-slate-700 mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                              </svg>
                              <span>Изход</span>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </nav>

              <section class="animate__animated animate__fadeIn animate__faster" v-show="dashOrder">
                <div class="py-6 px-8">
                  <div class="my-2 w-full sm:flex items-center justify-end space-y-4 sm:space-y-0 sm:space-x-3">
                    <div class="relative w-full sm:w-48">
                      <div class="absolute inset-y-0 left-0 flex items-center pl-2.5 pointer-events-none">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-500">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                      </div>
                      <input type="text" id="search-order" placeholder="По номер или име" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:border-gray-400 focus:outline-none block w-full pl-9 p-2.5" />
                    </div>
                    <div class="relative w-full sm:w-48">
                      <div id="date-prev" class="absolute inset-y-0 left-0 flex items-center px-0.5 cursor-pointer hover:bg-slate-200 transition-all text-gray-500 hover:text-slate-800 bg-slate-100 rounded-l-lg border border-r-0 border-gray-300">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="2.4" stroke="currentColor" class="w-5 h-5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                      </div>
                      <input id="order-filter-date" type="date" value="<?php echo date("Y-m-d"); ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none block w-full px-7 p-2.5" placeholder="Изберете дата" />
                      <div id="date-next" class="absolute inset-y-0 right-0 flex items-center px-0.5 cursor-pointer hover:bg-slate-200 transition-all text-gray-500 hover:text-slate-800 bg-slate-100 rounded-r-lg border border-l-0 border-gray-300">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="2.4" stroke="currentColor" class="w-5 h-5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                      </div>
                    </div>
                    <div class="flex items-center space-x-3">
                      <?php if ($roles["create_role"] == 1 || $roles["full_role"] == 1) { ?>
                        <button id="add-order-btn" type="button" class="w-10 h-10 bg-blue-500 hover:bg-blue-600 focus:outline-none active:scale-90 transition-all rounded-lg flex items-center justify-center shadow-lg">
                          <svg fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-7 h-7 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                          </svg>
                        </button>
                      <?php } ?>
                      <button id="reload-order-table" type="button" class="w-10 h-10 bg-green-500 hover:bg-green-600 focus:outline-none active:scale-90 transition-all rounded-lg flex items-center justify-center shadow-lg">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7 text-white">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                        </svg>
                      </button>
                    </div>
                  </div>
                  <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                    <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden">
                      <table id="order-table" class="min-w-full leading-normal bg-white">
                        <thead>
                          <tr class="border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
                            <th class="px-4 py-3">номер</th>
                            <th class="px-4 py-3">име на клиент</th>
                            <th class="px-4 py-3">помещение</th>
                            <th class="px-4 py-3">оферта</th>
                            <th class="px-4 py-3">статус</th>
                            <th class="px-4 py-3">квадратура</th>
                            <th class="px-4 py-3">цена</th>
                            <th class="px-4 py-3">фактура</th>
                            <th class="px-4 py-3">дата</th>
                            <th class="px-4 py-3">действия</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $query = "SELECT * FROM orders WHERE date = '$date'";
                          $query_run = mysqli_query($con, $query);

                          if (mysqli_num_rows($query_run) > 0) {
                            while ($rows = mysqli_fetch_array($query_run)) { ?>
                              <tr class="bg-white hover:bg-slate-50 transition-all border-b border-gray-200 text-sm">
                                <td class="px-4 py-5 text-center"><?= $rows["id"] ?></td>
                                <td class="px-4 py-5 text-center">
                                  <button type="button" value="<?= $rows["email"] ?>" class="text-gray-900 whitespace-no-wrap hover:underline cursor-pointer transition-all show-customer">
                                    <?= $rows["customer_name"] ?>
                                  </button>
                                </td>
                                <td class="px-4 py-5 text-center"><?= $rows["room"] ?></td>
                                <td class="px-4 py-5 text-center"><?= $rows["offer"] ?></td>
                                <td class="px-4 py-5 text-center">
                                  <?php $statusColors = array(
                                    "Назначи" => array("color" => "blue", "class" => "text-blue-900"),
                                    "Назначена" => array("color" => "indigo", "class" => "text-indigo-900"),
                                    "В процес" => array("color" => "orange", "class" => "text-orange-900"),
                                    "Приключена" => array("color" => "green", "class" => "text-green-900"),
                                    "Отказана" => array("color" => "red", "class" => "text-red-900"),
                                    "Изтекла" => array("color" => "gray", "class" => "text-gray-900")
                                  );

                                  $status = $rows["status"];
                                  if (array_key_exists($status, $statusColors)) {
                                    $color = $statusColors[$status]["color"];
                                    $class = $statusColors[$status]["class"];

                                    if ($status == "Отказана") { ?>
                                      <button value="<?= $rows["id"] ?>" class="relative inline-block px-3 py-1 group font-semibold <?= $class ?> leading-tight focus:outline-none show-cancel-dashboard">
                                        <span aria-hidden class="absolute inset-0 bg-<?= $color ?>-200 group-hover:bg-<?= $color ?>-300 transition-all opacity-50 rounded-full"></span>
                                        <span class="group-hover:underline transition-all relative"><?= $status ?></span>
                                      </button>
                                    <?php } else { ?>
                                      <span class="relative inline-block px-3 py-1 font-semibold <?= $class ?> leading-tight">
                                        <span aria-hidden class="absolute inset-0 bg-<?= $color ?>-200 opacity-50 rounded-full"></span>
                                        <span class="relative"><?= $status ?></span>
                                      </span>
                                  <?php }
                                  } ?>
                                </td>
                                <td class="px-4 py-5 text-center"><?= $rows["m2"] . " m2" ?></td>
                                <td class="px-4 py-5 text-center"><?= $rows["price"] . " лв." ?></td>
                                <td class="px-4 py-5 text-center">
                                  <?php if ($rows["invoice"] == "Да") { ?>
                                    <span class="w-8 h-8 rounded-full bg-green-200 flex items-center justify-center mx-auto">
                                      <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-green-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                      </svg>
                                    </span>
                                  <?php } else { ?>
                                    <span class="w-8 h-8 rounded-full bg-red-200 flex items-center justify-center mx-auto">
                                      <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-red-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                      </svg>
                                    </span>
                                  <?php } ?>
                                </td>
                                <td class="px-4 py-5 text-center"><?= date("d.m.Y", strtotime($rows['date'])) ?></td>
                                <td class="px-4 py-5 flex items-center justify-center text-center space-x-2">
                                  <?php if ($roles["edit_role"] == 1 || $roles["full_role"] == 1) {
                                    if ($rows["status"] == "Назначи") { ?>
                                      <button value="<?= $rows["id"] ?>" type="button" class="bg-blue-500 hover:bg-blue-600 p-2 rounded-md transition-all focus:outline-none active:scale-90 edit-order">
                                        <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-white">
                                          <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                                        </svg>
                                      </button>
                                    <?php } ?>
                                    <button value="<?= $rows["id"] ?>" type="button" class="bg-green-500 hover:bg-green-600 p-2 rounded-md transition-all focus:outline-none active:scale-90 set-order">
                                      <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-white">
                                        <path d="M4.5 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM14.25 8.625a3.375 3.375 0 116.75 0 3.375 3.375 0 01-6.75 0zM1.5 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM17.25 19.128l-.001.144a2.25 2.25 0 01-.233.96 10.088 10.088 0 005.06-1.01.75.75 0 00.42-.643 4.875 4.875 0 00-6.957-4.611 8.586 8.586 0 011.71 5.157v.003z" />
                                      </svg>
                                    </button>
                                    <?php if ($rows["status"] == "Приключена" && $rows["invoice_document"] == "" && $rows["invoice"] == "Да") { ?>
                                      <button value="<?= $rows["id"] ?>" type="button" class="bg-amber-500 hover:bg-amber-600 p-2 rounded-md transition-all focus:outline-none active:scale-90 send-invoice">
                                        <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-white">
                                          <path d="M7.5 3.375c0-1.036.84-1.875 1.875-1.875h.375a3.75 3.75 0 013.75 3.75v1.875C13.5 8.161 14.34 9 15.375 9h1.875A3.75 3.75 0 0121 12.75v3.375C21 17.16 20.16 18 19.125 18h-9.75A1.875 1.875 0 017.5 16.125V3.375z" />
                                          <path d="M15 5.25a5.23 5.23 0 00-1.279-3.434 9.768 9.768 0 016.963 6.963A5.23 5.23 0 0017.25 7.5h-1.875A.375.375 0 0115 7.125V5.25zM4.875 6H6v10.125A3.375 3.375 0 009.375 19.5H16.5v1.125c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 013 20.625V7.875C3 6.839 3.84 6 4.875 6z" />
                                        </svg>
                                      </button>
                                    <?php }
                                    if ($rows["status"] == "Приключена" && $rows["customer_opinion"] != "") { ?>
                                      <button value="<?= $rows["id"] ?>" type="button" class="bg-indigo-500 hover:bg-indigo-600 p-2 rounded-md transition-all focus:outline-none active:scale-90 view-customer-opinion">
                                        <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-white">
                                          <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                                        </svg>
                                      </button>
                                    <?php } ?>
                                </td>
                            <?php }
                                }
                              } else { ?>
                              <tr>
                                <td colspan="10" class="px-4 py-6 border-b border-gray-200 bg-white text-sm text-center font-semibold">Не са намерени данни</td>
                              </tr>
                            <?php } ?>
                            </tr>
                        </tbody>
                        <tfoot>
                          <tr>
                            <td colspan="10">
                              <div class="flex justify-end py-2.5 px-4 w-full">
                                <ul class="inline-flex items-center -space-x-px">
                                  <li>
                                    <a href="#" class="block px-2 pt-[9px] pb-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 transition-all">
                                      <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                      </svg>
                                    </a>
                                  </li>
                                  <li>
                                    <a href="#" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 transition-all">1</a>
                                  </li>
                                  <li>
                                    <a href="#" class="block px-2 pt-[9px] pb-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 transition-all">
                                      <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                      </svg>
                                    </a>
                                  </li>
                                </ul>
                              </div>
                            </td>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                </div>

                <div id="add-order-modal" class="bg-gray-900 hidden bg-opacity-50 fixed inset-0 z-40">
                  <div class="h-full w-full p-4 overflow-x-hidden overflow-y-auto flex justify-center">
                    <div class="relative w-full h-full max-w-lg animate__animated animate__zoomIn animate__fast">
                      <div class="relative bg-white rounded-lg shadow mb-6">
                        <div class="flex items-center justify-between px-5 py-3.5 border-b border-gray-200">
                          <div class=" text-slate-700 font-bold text-xl">Добави заявка</div>
                          <button type="button" class="absolute top-1.5 right-1.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center close-add-order-modal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                          </button>
                        </div>
                        <form id="add-order-form">
                          <div class="px-5 py-4 space-y-6 text-slate-700">
                            <div class="sm:flex items-center w-full space-y-4 sm:space-y-0 sm:space-x-5 xl:space-x-6">
                              <div class="w-full">
                                <label for="customer-name" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                  Име и фамилия
                                </label>
                                <input type="text" minlength="2" id="customer-name" name="customerName" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none focus:border-gray-400 w-full p-2.5" placeholder="Въведи име" />
                                <label for="customer-phone" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                  Телефон
                                </label>
                                <input type="text" minlength="9" id="customer-phone" name="customerPhone" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none focus:border-gray-400 w-full p-2.5" placeholder="Въведи телефон" />
                                <label for="customer-email" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                  Имейл
                                </label>
                                <input type="email" minlength="2" id="customer-email" name="customerEmail" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none focus:border-gray-400 w-full p-2.5" placeholder="Въведи имейл" />
                                <label for="room" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">Изберете помещение</label>
                                <select id="room" name="room" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:border-gray-400 block w-full p-2.5 mb-4">
                                  <option value="Къща">Къща</option>
                                  <option value="Офис">Офис</option>
                                  <option value="Салон">Салон</option>
                                </select>
                                <label for="offer" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">Изберете вид оферта</label>
                                <select id="offer" name="offer" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:border-gray-400 block w-full p-2.5 mb-4">
                                  <option value="Основна">Основна</option>
                                  <option value="Премиум">Премиум</option>
                                  <option value="Вип">Вип</option>
                                </select>
                                <label for="customer-m2" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                  Квадратура
                                </label>
                                <input type="text" minlength="2" maxlength="4" id="customer-m2" name="m2" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none focus:border-gray-400 w-full p-2.5" placeholder="Въведи квадратура" />
                                <label for="pick-date" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">Изберете дата</label>
                                <input type="date" id="pick-date" name="pickDate" min="<?php echo date("Y-m-d"); ?>" value="<?php echo date("Y-m-d"); ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 focus:border-gray-400 focus:outline-none block w-full p-2.5 mb-5" placeholder="Изберете дата" />
                                <label for="time" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">Изберете час</label>
                                <select id="time" name="time" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:border-gray-400 block w-full p-2.5 mb-4">
                                  <option value="Преди 13:00">Преди 13:00</option>
                                  <option value="След 13:00">След 13:00</option>
                                </select>
                                <label for="pay" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">Изберете начин на плащане</label>
                                <select id="pay" name="payment" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:border-gray-400 block w-full p-2.5 mb-4">
                                  <option value="В брой">В брой</option>
                                  <option value="С карата">С карата</option>
                                </select>
                                <label for="address" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">Адрес</label>
                                <textarea id="address" name="address" rows="2" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:border-gray-400 mb-4" placeholder="Пишете тук..."></textarea>
                                <label for="information" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">Допълнителна информация</label>
                                <textarea id="information" name="information" rows="2" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:border-gray-400 mb-4" placeholder="Пишете тук..."></textarea>
                                <label class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                  Цена
                                </label>
                                <input readonly id="customer-price" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 mb-2 text-sm rounded-lg focus:outline-none focus:ring-0 focus:border-gray-300 w-full p-2.5" />
                                <input id="customer-price-hidden" type="hidden" name="customerPrice" />
                              </div>
                            </div>
                          </div>
                          <div class="w-full border-t border-gray-200 p-3 flex justify-end items-center">
                            <button type="button" class="text-slate-700 border border-slate-400 bg-transparent hover:bg-gray-100 font-semibold rounded-lg text-sm px-4 py-1.5 ml-2 focus:outline-none transition-all active:scale-90 close-add-order-modal">Откажи</button>
                            <button type="submit" class="text-white bg-blue-700 border border-blue-700 hover:bg-blue-800 font-semibold rounded-lg text-sm px-4 py-1.5 ml-2 focus:outline-none transition-all active:scale-90">Запази</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                <div id="cancel-order-reason-modal" class="bg-gray-900 hidden bg-opacity-50 fixed inset-0 z-40">
                  <div class="h-full w-full p-4 overflow-x-hidden overflow-y-auto flex items-center justify-center">
                    <div class="relative w-full h-auto max-w-lg animate__animated animate__zoomIn animate__fast">
                      <div class="relative bg-white rounded-lg shadow mb-6">
                        <div class="flex items-center justify-between px-5 py-3.5 border-b border-gray-200">
                          <div class=" text-slate-700 font-bold text-xl">Причина за отказа</div>
                          <button type="button" class=" absolute top-1.5 right-1.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center cancel-order-reason-modal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                          </button>
                        </div>
                        <div class="px-5 py-4">
                          <textarea id="cancel-reason-textarea" readonly rows="3" class="block p-2.5 w-full text-sm text-slate-700 rounded border border-slate-300 focus:outline-none resize-none"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div id="order-modal" class="bg-gray-900 hidden bg-opacity-50 fixed inset-0 z-40">
                  <div class="h-full w-full p-4 overflow-x-hidden overflow-y-auto flex 2xl:items-center justify-center">
                    <div class="relative w-full h-full max-w-lg mt-10 animate__animated animate__zoomIn animate__fast">
                      <div class="relative bg-white rounded-lg shadow mb-6">
                        <div class="flex items-center justify-between px-5 py-3.5 border-b border-gray-200">
                          <div class=" text-slate-700 font-bold text-xl">Редактиране заявката</div>
                          <button type="button" class=" absolute top-1.5 right-1.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center close-order-modal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                          </button>
                        </div>
                        <form id="update-order-form">
                          <div class="px-5 py-4 space-y-6 text-slate-700">
                            <div class="sm:flex items-center w-full space-y-4 sm:space-y-0 sm:space-x-5 xl:space-x-6">
                              <div class="w-full">
                                <input type="hidden" id="order-id" name="id">
                                <label class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                  Име и фамилия
                                </label>
                                <input type="text" id="customer-name-edit" readonly class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none focus:ring-0 focus:border-gray-300 w-full p-2.5" placeholder="Въведи име" />
                                <label for="customer-phone-edit" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                  Телефон
                                </label>
                                <input type="text" minlength="2" id="customer-phone-edit" name="customerPhone" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none focus:border-gray-400 w-full p-2.5" placeholder="Въведи телефон" />
                                <label for="room-edit" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">Изберете помещение</label>
                                <select id="room-edit" name="room" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:border-gray-400 block w-full p-2.5 mb-4">
                                  <option value="Къща">Къща</option>
                                  <option value="Офис">Офис</option>
                                  <option value="Салон">Салон</option>
                                </select>
                                <label for="offer-edit" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">Изберете вид оферта</label>
                                <select id="offer-edit" name="offer" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:border-gray-400 block w-full p-2.5 mb-4">
                                  <option value="Основна">Основна</option>
                                  <option value="Премиум">Премиум</option>
                                  <option value="Вип">Вип</option>
                                </select>
                                <label for="customer-m2-edit" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                  Квадратура
                                </label>
                                <input type="text" minlength="2" id="customer-m2-edit" name="m2" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none focus:border-gray-400 w-full p-2.5" placeholder="Въведи квадратура" />
                                <label for="pick-date-edit" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">Изберете дата</label>
                                <input type="date" id="pick-date-edit" min="<?php echo date("Y-m-d"); ?>" name="pickDate" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 focus:border-gray-400 focus:outline-none block w-full p-2.5 mb-5" placeholder="Изберете дата" />
                                <label for="time-edit" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">Изберете час</label>
                                <select id="time-edit" name="time" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:border-gray-400 block w-full p-2.5 mb-4">
                                  <option value="Преди 13:00">Преди 13:00</option>
                                  <option value="След 13:00">След 13:00</option>
                                </select>
                                <label for="pay-edit" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">Изберете начин на плащане</label>
                                <select id="pay-edit" name="payment" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:border-gray-400 block w-full p-2.5 mb-4">
                                  <option value="В брой">В брой</option>
                                  <option value="С карта">С карата</option>
                                </select>
                                <label for="address-edit" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">Адрес</label>
                                <textarea id="address-edit" name="address" rows="2" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:border-gray-400 mb-4" placeholder="Пишете тук..."></textarea>
                                <label for="information-edit" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">Допълнителна информация</label>
                                <textarea id="information-edit" rows="2" name="information" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:border-gray-400 mb-4" placeholder="Пишете тук..."></textarea>
                                <label class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                  Цена
                                </label>
                                <input type="text" id="customer-price-edit" name="customerPrice" class="bg-gray-50 border border-gray-300 text-gray-900 mb-2 text-sm rounded-lg focus:outline-none focus:ring-0 focus:border-gray-300 w-full p-2.5" placeholder="Цена" />
                              </div>
                            </div>
                          </div>
                          <div class="w-full border-t border-gray-200 p-3 flex justify-end items-center">
                            <button type="button" class="text-slate-700 border border-slate-400 bg-transparent hover:bg-gray-100 font-semibold rounded-lg text-sm px-4 py-1.5 ml-2 focus:outline-none transition-all active:scale-90 close-order-modal">Откажи</button>
                            <button type="submit" class="text-white bg-blue-700 border border-blue-700 hover:bg-blue-800 font-semibold rounded-lg text-sm px-4 py-1.5 ml-2 focus:outline-none transition-all active:scale-90">Запази</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                <div id="customer-order-modal" class="bg-gray-900 hidden bg-opacity-50 fixed inset-0 z-40">
                  <div class="h-full p-4 overflow-x-hidden overflow-y-auto flex items-center justify-center">
                    <div class="relative w-full max-w-lg h-auto animate__animated animate__zoomIn animate__fast">
                      <div class="relative bg-white rounded-lg shadow">
                        <div class="flex items-center justify-between px-5 py-3.5 border-b border-gray-200">
                          <div class=" text-slate-700 font-bold text-xl">Клиент</div>
                          <button type="button" class=" absolute top-1.5 right-1.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center customer-order-modal-close">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                          </button>
                        </div>
                        <div class="px-5 py-4 space-y-6 text-slate-700">
                          <div class="sm:flex items-center w-full space-y-4 sm:space-y-0 sm:space-x-5 xl:space-x-6">
                            <div class="w-full">
                              <label class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                Име и фамилия
                              </label>
                              <input type="text" id="customer-name-show" readonly class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none focus:ring-0 focus:border-gray-300 w-full p-2.5" />
                              <label for="customer-phone-edit" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                Телефон
                              </label>
                              <input type="text" readonly id="customer-phone-show" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none focus:ring-0 focus:border-gray-300 w-full p-2.5" />
                              <label for="customer-email-show" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                Имейл
                              </label>
                              <input type="text" readonly id="customer-email-show" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none focus:ring-0 focus:border-gray-300 w-full p-2.5" />
                              <label for="customer-created" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                Регистриран на
                              </label>
                              <input type="text" readonly id="customer-created" class="bg-gray-50 border border-gray-300 text-gray-900 mb-2 text-sm rounded-lg focus:outline-none focus:ring-0 focus:border-gray-300 w-full p-2.5" />
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div id="set-order-modal" class="bg-gray-900 hidden bg-opacity-50 fixed inset-0 z-40">
                  <div class="h-full w-full p-4 overflow-x-hidden overflow-y-auto flex justify-center items-center">
                    <div class="relative w-full h-auto max-w-lg animate__animated animate__zoomIn animate__fast">
                      <div class="relative bg-white rounded-lg shadow mb-6">
                        <div class="flex items-center justify-between px-5 py-3.5 border-b border-gray-200">
                          <div class=" text-slate-700 font-bold text-xl">Назначи заявка</div>
                          <button type="button" class=" absolute top-1.5 right-1.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center close-set-order-modal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                          </button>
                        </div>
                        <form id="set-order-form">
                          <div class="px-5 py-4 space-y-6 text-slate-700">
                            <div class="sm:flex items-center w-full space-y-4 sm:space-y-0 sm:space-x-5 xl:space-x-6">
                              <div class="w-full">
                                <input type="hidden" id="order-date" name="orderDate">
                                <input type="hidden" id="team-id-set" name="teamId">
                                <input type="hidden" id="order-id-set" name="orderId">
                                <input type="hidden" id="team-name-set" name="teamName">
                                <label for="select-team" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">Изберете екип</label>
                                <select id="select-team" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:border-gray-400 block w-full p-2.5 mb-4"></select>
                                <label for="user1-set-order" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                  Служител 1
                                </label>
                                <input type="text" readonly id="user1-set-order" name="userName1" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none focus:ring-0 focus:border-gray-300 w-full p-2.5" />
                                <input type="hidden" id="user1-id-set-order" name="userID1">
                                <label for="user2-set-order" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                  Служител 2
                                </label>
                                <input type="text" readonly id="user2-set-order" name="userName2" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none focus:ring-0 focus:border-gray-300 w-full p-2.5" />
                                <input type="hidden" id="user2-id-set-order" name="userID2">
                              </div>
                            </div>
                          </div>
                          <div id="hide-set-order-btn" class="w-full border-t border-gray-200 p-3 flex justify-end items-center">
                            <button type="button" class="text-slate-700 border border-slate-400 bg-transparent hover:bg-gray-100 font-semibold rounded-lg text-sm px-4 py-1.5 ml-2 focus:outline-none transition-all active:scale-90 close-set-order-modal">Откажи</button>
                            <button type="submit" class="text-white bg-blue-700 border border-blue-700 hover:bg-blue-800 font-semibold rounded-lg text-sm px-4 py-1.5 ml-2 focus:outline-none transition-all active:scale-90">Запази</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                <div id="customer-opinion-modal" class="bg-gray-900 hidden bg-opacity-50 fixed inset-0 z-40">
                  <div class="h-full w-full p-4 overflow-x-hidden overflow-y-auto flex justify-center items-center">
                    <div class="relative w-full h-auto max-w-lg animate__animated animate__zoomIn animate__fast">
                      <div class="relative bg-white rounded-lg shadow mb-6">
                        <div class="flex items-center justify-between px-5 py-3.5 border-b border-gray-200">
                          <div class=" text-slate-700 font-bold text-xl">Мнение</div>
                          <button type="button" class=" absolute top-1.5 right-1.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center close-customer-opinion-modal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                          </button>
                        </div>
                        <div class="px-5 py-4 space-y-6 text-slate-700">
                          <textarea rows="3" id="customer-opinion-orders" name="text" readonly class="block bg-gray-50 p-3 w-full text-sm text-slate-900 rounded-lg border border-gray-300 focus:outline-none resize-none"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>

              <section class="animate__animated animate__fadeIn animate__faster" v-show="dashUser">
                <div class="py-6 px-8">
                  <div class="my-2 w-full sm:flex items-center justify-end space-y-4 sm:space-y-0 sm:space-x-3">
                    <div class="relative w-full sm:w-48">
                      <div class="absolute inset-y-0 left-0 flex items-center pl-2.5 pointer-events-none">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-500">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                      </div>
                      <input type="text" id="search-user" placeholder="По име или пид" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 focus:border-gray-400 focus:outline-none block w-full pl-9 p-2.5" />
                    </div>
                    <div class="relative w-full sm:w-48">
                      <select id="select-position" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:border-gray-400 block w-full p-2.5 cursor-pointer">
                        <option value="Всички">Всички</option>
                        <option value="Хигиенист">Хигиенист</option>
                        <option value="Шофьор">Шофьор</option>
                      </select>
                    </div>
                    <div class="relative w-full sm:w-48">
                      <select id="select-status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:border-gray-400 block w-full p-2.5 cursor-pointer">
                        <option value="3">Всички</option>
                        <option value="1">Активен</option>
                        <option value="0">Напуснал</option>
                      </select>
                    </div>
                    <div class="flex items-center space-x-3">
                      <?php if ($roles["create_role"] == 1 || $roles["full_role"] == 1) { ?>
                        <button id="add-user-btn" type="button" class="w-10 h-10 bg-blue-500 hover:bg-blue-600 focus:outline-none active:scale-90 transition-all rounded-lg flex items-center justify-center shadow-lg">
                          <svg fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-7 h-7 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                          </svg>
                        </button>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                    <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden">
                      <table id="user-table" class="min-w-full leading-normal bg-white">
                        <thead>
                          <tr class="border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
                            <th class="pr-4 py-3">снимка</th>
                            <th class="pr-4 py-3">име</th>
                            <th class="px-4 py-3">пид</th>
                            <th class="px-4 py-3">длъжност</th>
                            <th class="px-4 py-3">статус</th>
                            <th class="px-4 py-3">екип</th>
                            <th class="px-4 py-3">назначен</th>
                            <th class="px-4 py-3">действия</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $query = "SELECT * FROM users WHERE status = '1'";
                          $query_run = mysqli_query($con, $query);

                          if (mysqli_num_rows($query_run) > 0) {
                            while ($rows = mysqli_fetch_array($query_run)) {
                          ?>
                              <tr class="bg-white hover:bg-slate-50 transition-all border-b border-gray-200 text-sm">
                                <td class="px-2 py-5"><img src="uploaded-files/user-images/<?= $rows["image"] ?>" alt="<?= $rows["image"] ?>" class="w-10 h-10 rounded-full object-cover mx-auto" /></td>
                                <td class="pr-4 py-5 text-center"><?= $rows["name"] ?></td>
                                <td class="px-4 py-5 text-center"><?= $rows["pid"] ?></td>
                                <td class="px-4 py-5 text-center"><?= $rows["position"] ?></td>
                                <td class="px-4 py-5">
                                  <span class="w-8 h-8 rounded-full bg-<?= ($rows["status"] == 1) ? 'green-200' : 'red-200' ?> flex items-center justify-center mx-auto">
                                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-<?= ($rows["status"] == 1) ? 'green-500' : 'red-500' ?>">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="<?= ($rows["status"] == 1) ? 'M4.5 12.75l6 6 9-13.5' : 'M6 18L18 6M6 6l12 12' ?>" />
                                    </svg>
                                  </span>
                                </td>
                                <td class="px-4 py-5 text-center">
                                  <?= ($rows["team_name"] != '') ? $rows["team_name"] : 'Няма' ?>
                                </td>
                                <td class="px-4 py-5 text-center"><?= date("d.m.Y", strtotime($rows['in_date'])) ?></td>
                                <td class="px-4 py-5 flex justify-center space-x-2">
                                  <?php if ($roles["edit_role"] == 1 || $roles["full_role"] == 1) {
                                    if ($rows["status"] != 0) { ?>
                                      <button value="<?= $rows["id"] ?>" type="button" class="bg-blue-500 hover:bg-blue-600 p-2 rounded-md transition-all focus:outline-none active:scale-90 edit-user">
                                        <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-white">
                                          <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                                        </svg>
                                      </button>
                                      <button value="<?= $rows["id"] ?>" type="button" class="bg-green-500 hover:bg-green-600 p-2 rounded-md transition-all focus:outline-none active:scale-90 edit-user-password">
                                        <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-white">
                                          <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z" clip-rule="evenodd" />
                                        </svg>
                                      </button>
                                  <?php }
                                  } ?>
                                </td>
                              </tr>
                            <?php }
                          } else { ?>
                            <tr>
                              <td colspan="9" class="px-4 py-6 border-b border-gray-200 bg-white text-sm text-center font-semibold">Не са намерени данни</td>
                            </tr>
                          <?php } ?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <td colspan="9">
                              <div class="flex justify-end py-2.5 px-4 w-full">
                                <ul class="inline-flex items-center -space-x-px">
                                  <li>
                                    <a href="#" class="block px-2 pt-[9px] pb-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 transition-all">
                                      <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                      </svg>
                                    </a>
                                  </li>
                                  <li>
                                    <a href="#" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 transition-all">1</a>
                                  </li>
                                  <li>
                                    <a href="#" class="block px-2 pt-[9px] pb-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 transition-all">
                                      <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                      </svg>
                                    </a>
                                  </li>
                                </ul>
                              </div>
                            </td>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                </div>

                <div id="add-user-modal" class="bg-gray-900 hidden bg-opacity-50 fixed inset-0 z-40">
                  <div class="h-full w-full p-4 overflow-x-hidden overflow-y-auto flex justify-center">
                    <div class="relative w-full h-full max-w-lg animate__animated animate__zoomIn animate__fast">
                      <div class="relative bg-white rounded-lg shadow mb-6">
                        <div class="flex items-center justify-between px-5 py-3.5 border-b border-gray-200">
                          <div class=" text-slate-700 font-bold text-xl">Добави потребител</div>
                          <button type="button" class=" absolute top-1.5 right-1.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center close-add-user-modal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                          </button>
                        </div>
                        <form id="add-user-form">
                          <div class="px-5 py-4 space-y-6 text-slate-700">
                            <div class="sm:flex items-center w-full space-y-4 sm:space-y-0 sm:space-x-5 xl:space-x-6">
                              <div class="w-full">
                                <label for="user-name" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                  Име и фамилия
                                </label>
                                <input type="text" minlength="2" id="user-name" name="userName" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none focus:border-gray-400 w-full p-2.5" placeholder="Въведи име" />
                                <label for="user-egn" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                  ЕГН
                                </label>
                                <input type="text" minlength="10" maxlength="10" id="user-egn" name="userEgn" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none focus:border-gray-400 w-full p-2.5" placeholder="Въведи ЕГН" />
                                <label class="block ml-1 mb-1 text-sm font-semibold text-slate-700">Изберете дата на раждане</label>
                                <input type="date" name="user-dob" value="<?php echo date("Y-m-d"); ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 focus:border-gray-400 focus:outline-none block w-full p-2.5 mb-5" />
                                <label for="user-pid" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                  ПИД
                                </label>
                                <input type="text" minlength="5" maxlength="5" id="user-pid" name="userPid" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none focus:border-gray-400 w-full p-2.5" placeholder="Въведи ПИД" />
                                <label for="user-phone" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                  Телефон
                                </label>
                                <input type="text" minlength="2" id="user-phone" name="userPhone" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none focus:border-gray-400 w-full p-2.5" placeholder="Въведи телефон" />
                                <label for="user-img" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                  Снимка
                                </label>
                                <input id="user-img" name="userImg" accept="image/png, image/jpg, image/jpeg" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer py-2 bg-gray-50 focus:outline-none mb-4" type="file">
                                <label for="user-position" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">Изберете длъжност</label>
                                <select id="user-position" name="userPosition" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:border-gray-400 block w-full p-2.5 mb-4">
                                  <option value="Хигиенист">Хигиенист</option>
                                  <option value="Шофьор">Шофьор</option>
                                </select>
                                <label class="block ml-1 mb-1 text-sm font-semibold text-slate-700">Изберете дата на назначаване</label>
                                <input type="date" name="userPickDate" value="<?php echo date("Y-m-d"); ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 focus:border-gray-400 focus:outline-none block w-full p-2.5 mb-5" />
                                <label for="user-address" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">Адрес</label>
                                <textarea id="user-address" name="userAddress" rows="2" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:border-gray-400 mb-4" placeholder="Пишете тук..."></textarea>
                              </div>
                            </div>
                          </div>
                          <div class="w-full border-t border-gray-200 p-3 flex justify-end items-center">
                            <button type="button" class="text-slate-700 border border-slate-400 bg-transparent hover:bg-gray-100 font-semibold rounded-lg text-sm px-4 py-1.5 ml-2 focus:outline-none transition-all active:scale-90 close-add-user-modal">Откажи</button>
                            <button type="submit" class="text-white bg-blue-700 border border-blue-700 hover:bg-blue-800 font-semibold rounded-lg text-sm px-4 py-1.5 ml-2 focus:outline-none transition-all active:scale-90">Запази</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                <div id="edit-user-modal" class="bg-gray-900 hidden bg-opacity-50 fixed inset-0 z-40">
                  <div class="h-full w-full p-4 overflow-x-hidden overflow-y-auto flex justify-center">
                    <div class="relative w-full h-full max-w-lg animate__animated animate__zoomIn animate__fast">
                      <div class="relative bg-white rounded-lg shadow mb-6">
                        <div class="flex items-center justify-between px-5 py-3.5 border-b border-gray-200">
                          <div class=" text-slate-700 font-bold text-xl">Редактиране потребител</div>
                          <button type="button" class=" absolute top-1.5 right-1.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center close-edit-user-modal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                          </button>
                        </div>
                        <form id="edit-user-form">
                          <div class="px-5 py-4 space-y-6 text-slate-700">
                            <div class="sm:flex items-center w-full space-y-4 sm:space-y-0 sm:space-x-5 xl:space-x-6">
                              <div class="w-full">
                                <input type="hidden" id="user-id" name="id" />
                                <label for="user-name-edit" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                  Име и фамилия
                                </label>
                                <input type="text" minlength="2" id="user-name-edit" name="userName" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none focus:border-gray-400 w-full p-2.5" placeholder="Въведи име" />
                                <label for="user-egn-edit" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                  ЕГН
                                </label>
                                <input type="text" minlength="10" maxlength="10" id="user-egn-edit" name="userEgn" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none focus:border-gray-400 w-full p-2.5" placeholder="Въведи ЕГН" />
                                <label class="block ml-1 mb-1 text-sm font-semibold text-slate-700">Дата на раждане</label>
                                <input type="date" id="user-dob-edit" name="userDob" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 focus:border-gray-400 focus:outline-none block w-full p-2.5 mb-5" />
                                <label for="user-phone-edit" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                  Телефон
                                </label>
                                <input type="text" minlength="2" id="user-phone-edit" name="userPhone" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none focus:border-gray-400 w-full p-2.5" placeholder="Въведи телефон" />
                                <label for="user-img-edit" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                  Снимка
                                </label>
                                <input id="user-img-edit" name="userImg" accept="image/png, image/jpg, image/jpeg" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer py-2 bg-gray-50 focus:outline-none mb-4" type="file">
                                <label for="user-position-edit" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">Длъжност</label>
                                <select id="user-position-edit" name="userPosition" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:border-gray-400 block w-full p-2.5 mb-4">
                                  <option value="Хигиенист">Хигиенист</option>
                                  <option value="Шофьор">Шофьор</option>
                                </select>
                                <label for="user-status" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">Статус</label>
                                <select id="user-status" name="userStatus" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:border-gray-400 block w-full p-2.5 mb-4">
                                  <option value="1">Активен</option>
                                  <option value="0">Напуснал</option>
                                </select>
                                <div id="hidden-out-date-input" class="hidden">
                                  <label class="block ml-1 mb-1 text-sm font-semibold text-slate-700">Изберете дата на напускане</label>
                                  <input type="date" name="userOutDate" min="<?php echo date("Y-m-d"); ?>" value="<?php echo date("Y-m-d"); ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 focus:border-gray-400 focus:outline-none block w-full p-2.5 mb-5" />
                                </div>
                                <label for="user-address-edit" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">Адрес</label>
                                <textarea id="user-address-edit" name="userAddress" rows="2" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:border-gray-400 mb-4" placeholder="Пишете тук..."></textarea>
                              </div>
                            </div>
                          </div>
                          <div class="w-full border-t border-gray-200 p-3 flex justify-end items-center">
                            <button type="button" class="text-slate-700 border border-slate-400 bg-transparent hover:bg-gray-100 font-semibold rounded-lg text-sm px-4 py-1.5 ml-2 focus:outline-none transition-all active:scale-90 close-edit-user-modal">Откажи</button>
                            <button type="submit" class="text-white bg-blue-700 border border-blue-700 hover:bg-blue-800 font-semibold rounded-lg text-sm px-4 py-1.5 ml-2 focus:outline-none transition-all active:scale-90">Запази</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                <div id="user-password-modal" class="bg-gray-900 hidden bg-opacity-50 fixed inset-0 z-40">
                  <div class="h-full w-full p-4 overflow-x-hidden overflow-y-auto flex justify-center items-center">
                    <div class="relative w-full h-auto max-w-lg animate__animated animate__zoomIn animate__fast">
                      <div class="relative bg-white rounded-lg shadow mb-6">
                        <div class="flex items-center justify-between px-5 py-3.5 border-b border-gray-200">
                          <div class=" text-slate-700 font-bold text-xl">Задаване на парола</div>
                          <button type="button" class=" absolute top-1.5 right-1.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center close-user-password-modal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                          </button>
                        </div>
                        <form id="user-password-form">
                          <div class="px-5 py-4 space-y-6 text-slate-700">
                            <div class="sm:flex items-center w-full space-y-4 sm:space-y-0 sm:space-x-5 xl:space-x-6">
                              <div class="w-full">
                                <input type="hidden" id="user-pass-id" name="userID">
                                <label for="user-username" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                  Потребителско име
                                </label>
                                <input type="text" readonly id="user-username" name="userUsername" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none focus:ring-0 focus:border-gray-300 w-full p-2.5" />
                                <label for="user-passowrd" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                  Парола
                                </label>
                                <input type="password" minlength="5" autocomplete="off" id="user-passowrd" name="userPassword" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none focus:border-gray-400 w-full p-2.5" placeholder="Въведи парола" />
                                <label for="user-passowrd-rep" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                  Повтори парола
                                </label>
                                <input type="password" minlength="5" autocomplete="off" id="user-passowrd-rep" name="userPassowrdRep" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none focus:border-gray-400 w-full p-2.5" placeholder="Повтори парола" />
                              </div>
                            </div>
                          </div>
                          <div class="w-full border-t border-gray-200 p-3 flex justify-end items-center">
                            <button type="button" class="text-slate-700 border border-slate-400 bg-transparent hover:bg-gray-100 font-semibold rounded-lg text-sm px-4 py-1.5 ml-2 focus:outline-none transition-all active:scale-90 close-user-password-modal">Откажи</button>
                            <button type="submit" class="text-white bg-blue-700 border border-blue-700 hover:bg-blue-800 font-semibold rounded-lg text-sm px-4 py-1.5 ml-2 focus:outline-none transition-all active:scale-90">Запази</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </section>

              <section class="animate__animated animate__fadeIn animate__faster" v-show="dashTeam">
                <div class="py-6 px-8">
                  <div class="my-2 w-full sm:flex items-center justify-end space-y-4 sm:space-y-0 sm:space-x-3">
                    <div class="relative w-full sm:w-48">
                      <div class="absolute inset-y-0 left-0 flex items-center pl-2.5 pointer-events-none">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-500">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                      </div>
                      <input type="text" id="search-team" placeholder="По номер или име" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 focus:border-gray-400 focus:outline-none block w-full pl-9 p-2.5" />
                    </div>
                    <div class="flex items-center space-x-3">
                      <?php if ($roles["create_role"] == 1 || $roles["full_role"] == 1) { ?>
                        <button id="add-team-btn" type="button" class="w-10 h-10 bg-blue-500 hover:bg-blue-600 focus:outline-none active:scale-90 transition-all rounded-lg flex items-center justify-center shadow-lg">
                          <svg fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-7 h-7 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                          </svg>
                        </button>
                      <?php } ?>
                      <button type="button" class="w-10 h-10 bg-green-500 hover:bg-green-600 focus:outline-none active:scale-90 transition-all rounded-lg flex items-center justify-center shadow-lg reload-team-table">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7 text-white">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                        </svg>
                      </button>
                    </div>
                  </div>
                  <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                    <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden">
                      <table id="team-table" class="min-w-full leading-normal bg-white">
                        <thead>
                          <tr class="border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
                            <th class="pr-4 py-3">номер</th>
                            <th class="pr-4 py-3">име на екип</th>
                            <th class="px-4 py-3">статус</th>
                            <th class="px-4 py-3">служител 1</th>
                            <th class="px-4 py-3">служител 2</th>
                            <th class="px-4 py-3">назначени задачи</th>
                            <th class="px-4 py-3">средна оценка</th>
                            <th class="px-4 py-3">действия</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $query = "SELECT * FROM teams WHERE delete_team != 'yes'";
                          $query_run = mysqli_query($con, $query);

                          if (mysqli_num_rows($query_run) > 0) {
                            while ($rows = mysqli_fetch_array($query_run)) { ?>
                              <tr class="bg-white hover:bg-slate-50 transition-all border-b border-gray-200 text-sm">
                                <td class="pr-4 py-5 text-center"><?= $rows["id"] ?></td>
                                <td class="px-4 py-5 text-center"><?= $rows["name"] ?></td>
                                <td class="px-4 py-5">
                                  <span class="w-8 h-8 rounded-full bg-<?= $rows['status'] === 'Yes' ? 'green' : 'red' ?>-200 flex items-center justify-center mx-auto">
                                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-<?= $rows['status'] === 'Yes' ? 'green' : 'red' ?>-500">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="<?= $rows['status'] === 'Yes' ? 'M4.5 12.75l6 6 9-13.5' : 'M6 18L18 6M6 6l12 12' ?>" />
                                    </svg>
                                  </span>
                                </td>
                                <td class="px-4 py-5 text-center"><?= $rows["user1_name"] ?></td>
                                <td class="px-4 py-5 text-center"><?= $rows["user2_name"] ?></td>
                                <td class="px-4 py-5 text-center">
                                  <button type="button" value="<?= $rows['id']; ?>" class="h-8 w-8 bg-blue-100 text-blue-800 focus:outline-none text-xs font-semibold rounded-md <?= mysqli_num_rows(mysqli_query($con, "SELECT * FROM orders WHERE team_id = '{$rows['id']}' AND date >= '$date'")) > 0 ? 'hover:bg-blue-200 active:scale-90 prevOrd' : 'cursor-default'; ?> transition-all">
                                    <?= mysqli_num_rows(mysqli_query($con, "SELECT * FROM orders WHERE team_id = '{$rows['id']}' AND date >= '$date'")) ?: 0; ?>
                                  </button>
                                </td>
                                <td class="px-4 py-5 flex justify-center">
                                  <div class="h-8 w-8 bg-blue-100 text-blue-800 text-xs font-semibold rounded-md flex items-center justify-center">
                                    <?php $id = $rows['id'];
                                    $row = mysqli_fetch_array($con->query("SELECT CAST(AVG(rating) AS DECIMAL(10,1)) AS rating FROM team_ratings WHERE team_id = '$id'"));
                                    echo $row['rating'] ?: "0.0"; ?>
                                  </div>
                                </td>
                                <td class="px-4 py-5 text-center">
                                  <?php if ($roles["edit_role"] == 1 || $roles["full_role"] == 1) { ?>
                                    <button type="button" value="<?= $rows["id"] ?>" class="bg-red-500 hover:bg-red-600 p-2 rounded-md transition-all focus:outline-none active:scale-90 delete-team">
                                      <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-white">
                                        <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                                      </svg>
                                    </button>
                                  <?php } ?>
                                </td>
                              </tr>
                            <?php }
                          } else { ?>
                            <tr>
                              <td colspan="8" class="px-4 py-6 border-b border-gray-200 bg-white text-sm text-center font-semibold">Не са намерени данни</td>
                            </tr>
                          <?php } ?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <td colspan="8">
                              <div class="flex justify-end py-2.5 px-4 w-full">
                                <ul class="inline-flex items-center -space-x-px">
                                  <li>
                                    <a href="#" class="block px-2 pt-[9px] pb-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 transition-all">
                                      <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                      </svg>
                                    </a>
                                  </li>
                                  <li>
                                    <a href="#" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 transition-all">1</a>
                                  </li>
                                  <li>
                                    <a href="#" class="block px-2 pt-[9px] pb-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 transition-all">
                                      <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                      </svg>
                                    </a>
                                  </li>
                                </ul>
                              </div>
                            </td>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                </div>

                <div id="add-team-modal" class="bg-gray-900 hidden bg-opacity-50 fixed inset-0 z-40">
                  <div class="h-full w-full p-4 overflow-x-hidden overflow-y-auto flex justify-center items-center">
                    <div class="relative w-full h-auto max-w-lg animate__animated animate__zoomIn animate__fast">
                      <div class="relative bg-white rounded-lg shadow mb-6">
                        <div class="flex items-center justify-between px-5 py-3.5 border-b border-gray-200">
                          <div class="text-slate-700 font-bold text-xl">Добави екип</div>
                          <button type="button" class=" absolute top-1.5 right-1.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center close-add-team-modal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                          </button>
                        </div>
                        <form id="add-team-form">
                          <div class="px-5 py-4 space-y-6 text-slate-700">
                            <div class="sm:flex items-center w-full space-y-4 sm:space-y-0 sm:space-x-5 xl:space-x-6">
                              <div class="w-full">
                                <label for="team-name" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                  Име на екип
                                </label>
                                <input type="text" id="team-name" minlength="3" name="teamName" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none focus:border-gray-400 w-full p-2.5" placeholder="Въведи име на екип" />
                                <div class="mb-4">
                                  <label for="team-user1" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                    Служител 1
                                  </label>
                                  <input type="text" id="team-user1" name="teamUser1" autocomplete="off" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring-0 focus:border-gray-400 w-full p-2.5" placeholder="Въведи име" />
                                  <input type="hidden" id="team-user1-pid" name="teamUser1Pid">
                                  <input type="hidden" id="team-user1-id" name="teamUser1Id">
                                  <div id="user-name1-dropdown" class="hidden absolute w-[90.5%] sm:w-[92.2%] bg-gray-50 border border-gray-400 border-t-0 shadow-lg rounded-b-lg -mt-1 2xl:-mt-[5px] z-50"></div>
                                </div>
                                <div class="mb-4">
                                  <label for="team-user2" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                    Служител 2
                                  </label>
                                  <input type="text" minlength="2" id="team-user2" name="teamUser2" autocomplete="off" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring-0 focus:border-gray-400 w-full p-2.5" placeholder="Въведи име" />
                                  <input type="hidden" id="team-user2-pid" name="teamUser2Pid">
                                  <input type="hidden" id="team-user2-id" name="teamUser2Id">
                                  <div id="user-name2-dropdown" class="hidden absolute w-[90.5%] sm:w-[92.2%] bg-gray-50 border border-gray-400 border-t-0 shadow-lg rounded-b-lg -mt-1 2xl:-mt-[5px] z-50"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="w-full border-t border-gray-200 p-3 flex justify-end items-center">
                            <button type="button" class="text-slate-700 border border-slate-400 bg-transparent hover:bg-gray-100 font-semibold rounded-lg text-sm px-4 py-1.5 ml-2 focus:outline-none transition-all active:scale-90 close-add-team-modal">Откажи</button>
                            <button type="submit" class="text-white bg-blue-700 border border-blue-700 hover:bg-blue-800 font-semibold rounded-lg text-sm px-4 py-1.5 ml-2 focus:outline-none transition-all active:scale-90">Запази</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                <div id="team-order-modal" class="bg-gray-900 hidden bg-opacity-50 fixed inset-0 z-40">
                  <div class="h-full w-full p-4 overflow-x-hidden overflow-y-auto flex justify-center items-center">
                    <div class="relative w-full h-auto max-w-lg animate__animated animate__zoomIn animate__fast">
                      <div class="relative bg-white rounded-lg shadow mb-6">
                        <div class="flex items-center justify-between px-5 py-3.5 border-b border-gray-200">
                          <div class="text-slate-700 font-bold text-xl">Заявки</div>
                          <button type="button" class="absolute top-1.5 right-1.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center close-team-order-modal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                          </button>
                        </div>
                        <div class="px-5 py-4 space-y-6 text-slate-700">
                          <div id="team-orders" class="sm:flex flex-wrap items-center w-full gap-y-4 sm:gap-x-4"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div id="delete-team-modal" class="bg-gray-900 hidden bg-opacity-50 fixed inset-0 z-40">
                  <div class="h-full w-full p-5 overflow-x-hidden overflow-y-auto flex justify-center items-center">
                    <div class="relative w-full h-auto max-w-md animate__animated animate__zoomIn animate__fast">
                      <div class="relative bg-white rounded-lg shadow mb-6">
                        <div class="p-4 text-center">
                          <div class="text-xl font-bold mb-3">Изтрий екипа</div>
                          <h3 class="mb-5 text-sm text-gray-500">Сигурни ли сте, че искате да изтриете екипа? Информацията от приключените задачи на екипа ще се запазят.</h3>
                          <form id="delete-team-form">
                            <input id="delete-team-id" type="hidden" name="teamId">
                            <div class="flex items-center mt-3">
                              <button type="button" class="flex-1 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 text-sm font-medium rounded-md active:scale-90 transition-all close-delete-team-modal">
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

              <section class="animate__animated animate__fadeIn animate__faster" v-show="dashWarehouse">
                <div class="py-6 px-8">
                  <div class="my-2 w-full sm:flex items-center justify-end space-y-4 sm:space-y-0 sm:space-x-3">
                    <div class="relative w-full sm:w-auto">
                      <div class="absolute inset-y-0 left-0 flex items-center pl-2.5 pointer-events-none">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-500">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                      </div>
                      <input type="text" id="search-product" placeholder="По номер или име" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 focus:border-gray-400 focus:outline-none block w-full pl-9 p-2.5 sm:w-48" />
                    </div>
                    <div class="relative w-full sm:w-48">
                      <select id="select-product-kind" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:border-gray-400 block w-full p-2.5 cursor-pointer">
                        <option value="Всички">Всички</option>
                        <option value="Препарати">Препарати</option>
                        <option value="Техника">Техника</option>
                        <option value="Екипировка">Екипировка</option>
                        <option value="Пособия за чистене">Пособия за чистене</option>
                      </select>
                    </div>
                    <div class="flex items-center space-x-3">
                      <?php if ($roles["create_role"] == 1 || $roles["full_role"] == 1) { ?>
                        <button id="add-product-btn" type="button" class="w-10 h-10 bg-blue-500 hover:bg-blue-600 focus:outline-none active:scale-90 transition-all rounded-lg flex items-center justify-center shadow-lg">
                          <svg fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-7 h-7 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                          </svg>
                        </button>
                        <button id="set-product" type="button" class="w-10 h-10 bg-yellow-500 hover:bg-yellow-600 focus:outline-none active:scale-90 transition-all rounded-lg flex items-center justify-center shadow-lg">
                          <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-7 h-7 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                          </svg>
                        </button>
                      <?php } ?>
                      <button id="reload-product-table" type="button" class="w-10 h-10 bg-green-500 hover:bg-green-600 focus:outline-none active:scale-90 transition-all rounded-lg flex items-center justify-center shadow-lg">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7 text-white">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                        </svg>
                      </button>
                      <button id="view-product-history" type="button" class="w-10 h-10 bg-cyan-500 hover:bg-cyan-600 focus:outline-none active:scale-90 transition-all rounded-lg flex items-center justify-center shadow-lg">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7 text-white">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                      </button>
                    </div>
                  </div>
                  <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                    <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden">
                      <table id="product-table" class="min-w-full leading-normal bg-white">
                        <thead>
                          <tr class="border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
                            <th class="pr-4 py-3">номер</th>
                            <th class="pr-4 py-3">продукт</th>
                            <th class="px-4 py-3">наличност</th>
                            <th class="px-4 py-3">вид</th>
                            <th class="px-4 py-3">действия</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $query = "SELECT * FROM stocks";
                          $query_run = mysqli_query($con, $query);

                          if (mysqli_num_rows($query_run) > 0) {
                            while ($rows = mysqli_fetch_array($query_run)) { ?>
                              <tr class="bg-white hover:bg-slate-50 transition-all border-b border-gray-200 text-sm">
                                <td class="pr-4 py-5 text-center"><?= $rows["id"] ?></td>
                                <td class="px-4 py-5 text-center"><?= $rows["name"] ?></td>
                                <td class="px-4 py-5">
                                  <div class="h-8 w-8 mx-auto bg-blue-100 text-blue-800 text-xs font-semibold rounded-md flex items-center justify-center">
                                    <?= $rows["quantity"] ?>
                                  </div>
                                </td>
                                <td class="px-4 py-5 text-center"><?= $rows["kind"] ?></td>
                                <td class="px-4 py-5 flex justify-center items-center space-x-2">
                                  <?php if ($roles["edit_role"] == 1 || $roles["full_role"] == 1) { ?>
                                    <button value="<?= $rows["id"] ?>" type="button" class="bg-blue-500 hover:bg-blue-600 p-2 rounded-md transition-all focus:outline-none active:scale-90 edit-product">
                                      <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-white">
                                        <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                                      </svg>
                                    </button>
                                    <button type="button" value="<?= $rows["id"] ?>" class="bg-red-500 hover:bg-red-600 p-2 rounded-md transition-all focus:outline-none active:scale-90 delete-product">
                                      <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-white">
                                        <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                                      </svg>
                                    </button>
                                  <?php } ?>
                                </td>
                              </tr>
                            <?php }
                          } else { ?>
                            <tr>
                              <td colspan="5" class="px-4 py-6 border-b border-gray-200 bg-white text-sm text-center font-semibold">Не са намерени данни</td>
                            </tr>
                          <?php } ?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <td colspan="5">
                              <div class="flex justify-end py-2.5 px-4 w-full">
                                <ul class="inline-flex items-center -space-x-px">
                                  <li>
                                    <a href="#" class="block px-2 pt-[9px] pb-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 transition-all">
                                      <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                      </svg>
                                    </a>
                                  </li>
                                  <li>
                                    <a href="#" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 transition-all">1</a>
                                  </li>
                                  <li>
                                    <a href="#" class="block px-2 pt-[9px] pb-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 transition-all">
                                      <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                      </svg>
                                    </a>
                                  </li>
                                </ul>
                              </div>
                            </td>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                </div>

                <div id="add-product-modal" class="bg-gray-900 hidden bg-opacity-50 fixed inset-0 z-40">
                  <div class="h-full w-full p-4 overflow-x-hidden overflow-y-auto flex justify-center items-center">
                    <div class="relative w-full h-auto max-w-lg animate__animated animate__zoomIn animate__fast">
                      <div class="relative bg-white rounded-lg shadow mb-6">
                        <div class="flex items-center justify-between px-5 py-3.5 border-b border-gray-200">
                          <div class="text-slate-700 font-bold text-xl">Добави продукт</div>
                          <button type="button" class=" absolute top-1.5 right-1.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center close-add-product-modal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                          </button>
                        </div>
                        <form id="add-product-form">
                          <div class="px-5 py-4 space-y-6 text-slate-700">
                            <div class="sm:flex items-center w-full space-y-4 sm:space-y-0 sm:space-x-5 xl:space-x-6">
                              <div class="w-full">
                                <label for="product-name" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                  Име на продукт
                                </label>
                                <input type="text" id="product-name" minlength="2" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none focus:border-gray-400 w-full p-2.5" placeholder="Въведи име" />
                                <label for="product-kind" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                  Избери вид на продукта
                                </label>
                                <select id="product-kind" name="kind" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:border-gray-400 block w-full p-2.5 mb-4">
                                  <option value="Препарати">Препарати</option>
                                  <option value="Техника">Техника</option>
                                  <option value="Екипировка">Екипировка</option>
                                  <option value="Пособия за чистене">Пособия за чистене</option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="w-full border-t border-gray-200 p-3 flex justify-end items-center">
                            <button type="button" class="text-slate-700 border border-slate-400 bg-transparent hover:bg-gray-100 font-semibold rounded-lg text-sm px-4 py-1.5 ml-2 focus:outline-none transition-all active:scale-90 close-add-product-modal">Откажи</button>
                            <button type="submit" class="text-white bg-blue-700 border border-blue-700 hover:bg-blue-800 font-semibold rounded-lg text-sm px-4 py-1.5 ml-2 focus:outline-none transition-all active:scale-90">Запази</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                <div id="edit-product-modal" class="bg-gray-900 hidden bg-opacity-50 fixed inset-0 z-40">
                  <div class="h-full w-full p-4 overflow-x-hidden overflow-y-auto flex justify-center items-center">
                    <div class="relative w-full h-auto max-w-lg animate__animated animate__zoomIn animate__fast">
                      <div class="relative bg-white rounded-lg shadow mb-6">
                        <div class="flex items-center justify-between px-5 py-3.5 border-b border-gray-200">
                          <div class="text-slate-700 font-bold text-xl">Редактиране на продукта</div>
                          <button type="button" class=" absolute top-1.5 right-1.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center close-edit-product-modal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                          </button>
                        </div>
                        <form id="edit-product-form">
                          <div class="px-5 py-4 space-y-6 text-slate-700">
                            <div class="sm:flex items-center w-full space-y-4 sm:space-y-0 sm:space-x-5 xl:space-x-6">
                              <div class="w-full">
                                <input type="hidden" id="product-id-edit" name="id">
                                <label for="product-name-edit" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                  Име на продукт
                                </label>
                                <input type="text" id="product-name-edit" minlength="2" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none focus:border-gray-400 w-full p-2.5" placeholder="Въведи име" />
                                <label for="product-kind-edit" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                  Избери вид на продукта
                                </label>
                                <select id="product-kind-edit" name="kind" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:border-gray-400 block w-full p-2.5 mb-4">
                                  <option value="Препарати">Препарати</option>
                                  <option value="Техника">Техника</option>
                                  <option value="Екипировка">Екипировка</option>
                                  <option value="Пособия за чистене">Пособия за чистене</option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="w-full border-t border-gray-200 p-3 flex justify-end items-center">
                            <button type="button" class="text-slate-700 border border-slate-400 bg-transparent hover:bg-gray-100 font-semibold rounded-lg text-sm px-4 py-1.5 ml-2 focus:outline-none transition-all active:scale-90 close-edit-product-modal">Откажи</button>
                            <button type="submit" class="text-white bg-blue-700 border border-blue-700 hover:bg-blue-800 font-semibold rounded-lg text-sm px-4 py-1.5 ml-2 focus:outline-none transition-all active:scale-90">Запази</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                <div id="set-product-modal" class="bg-gray-900 hidden bg-opacity-50 fixed inset-0 z-40">
                  <div class="h-full w-full p-4 overflow-x-hidden overflow-y-auto flex justify-center items-center">
                    <div class="relative w-full h-auto max-w-lg animate__animated animate__zoomIn animate__fast">
                      <div class="relative bg-white rounded-lg shadow mb-6">
                        <div class="flex items-center justify-between px-5 py-3.5 border-b border-gray-200">
                          <div class="text-slate-700 font-bold text-xl">Добавяне на продукт към екип</div>
                          <button type="button" class=" absolute top-1.5 right-1.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center close-set-product-modal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                          </button>
                        </div>
                        <form id="set-product-form">
                          <div class="px-5 py-4 space-y-4 text-slate-700">
                            <div class="w-full">
                              <label for="select-team-product" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">Изберете екип</label>
                              <select id="select-team-product" name="team" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:border-gray-400 block w-full p-2.5 mb-4"></select>
                            </div>
                            <div class="mb-4">
                              <label for="set-product-name" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                Име на продукт
                              </label>
                              <input type="text" id="set-product-name" name="name" autocomplete="off" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring-0 focus:border-gray-400 w-full p-2.5" placeholder="Въведи име" />
                              <div id="set-product-name-dropdown" class="hidden absolute w-[90.5%] sm:w-[92.2%] bg-gray-50 border border-gray-400 border-t-0 shadow-lg rounded-b-lg -mt-1 2xl:-mt-[5px] z-50"></div>
                            </div>
                            <div>
                              <label for="set-product-quantity" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                Количество
                              </label>
                              <input type="text" id="set-product-quantity" minlength="1" name="quantity" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none focus:border-gray-400 w-full p-2.5" placeholder="Въведи количество" />
                            </div>
                          </div>
                          <div class="w-full border-t border-gray-200 p-3 flex justify-end items-center">
                            <button type="button" class="text-slate-700 border border-slate-400 bg-transparent hover:bg-gray-100 font-semibold rounded-lg text-sm px-4 py-1.5 ml-2 focus:outline-none transition-all active:scale-90 close-set-product-modal">Откажи</button>
                            <button type="submit" class="text-white bg-blue-700 border border-blue-700 hover:bg-blue-800 font-semibold rounded-lg text-sm px-4 py-1.5 ml-2 focus:outline-none transition-all active:scale-90">Запази</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                <div id="history-set-product-modal" class="bg-gray-900 hidden bg-opacity-50 fixed inset-0 z-40">
                  <div class="h-full w-full p-4 overflow-x-hidden overflow-y-auto flex justify-center items-center">
                    <div class="relative w-full h-auto max-w-md animate__animated animate__zoomIn animate__fast">
                      <div class="relative bg-white rounded-lg shadow mb-6">
                        <div class="flex items-center justify-between px-5 py-3.5 border-b border-gray-200">
                          <div class="text-slate-700 font-bold text-xl">История</div>
                          <button type="button" class=" absolute top-1.5 right-1.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center close-history-product-modal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                          </button>
                        </div>
                        <div class="px-5 py-4 space-y-4 text-slate-700">
                          <div class="flex items-center w-full font-semibold text-slate-700 text-sm">
                            <div id="seted-product-history-btn" class="w-1/2 rounded-l-lg border border-gray-300 border-r-0 py-[9px] flex justify-center cursor-pointer bg-gray-50 hover:bg-gray-200 transition-all">Назначени продукти</div>
                            <div id="returned-product-history-btn" class="w-1/2 rounded-r-lg border border-gray-300 py-[9px] flex justify-center cursor-pointer bg-gray-50 hover:bg-gray-200 transition-all">Върнати продукти</div>
                          </div>
                          <input type="hidden" id="kind-search" value="0" />
                          <input type="text" id="product-name-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:border-gray-400 w-full p-2.5" placeholder="Въведи име на продукт" />
                          <input type="date" id="product-history-date" value="<?php echo date("Y-m-d"); ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 focus:border-gray-400 focus:outline-none block w-full p-2.5 mb-5" placeholder="Изберете дата" />
                          <div id="history-search-result" class="flex flex-wrap w-full gap-x-4 gap-y-4"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div id="delete-product-modal" class="bg-gray-900 hidden bg-opacity-50 fixed inset-0 z-40">
                  <div class="h-full w-full p-5 overflow-x-hidden overflow-y-auto flex justify-center items-center">
                    <div class="relative w-full h-auto max-w-md animate__animated animate__zoomIn animate__fast">
                      <div class="relative bg-white rounded-lg shadow mb-6">
                        <div class="p-4 text-center">
                          <div class="text-xl font-bold mb-3">Изтрий продукта</div>
                          <h3 class="mb-5 text-sm text-gray-500">Сигурни ли сте, че искате да изтриете продукта?</h3>
                          <form id="delete-product-form">
                            <input id="delete-product-id" type="hidden" name="id">
                            <div class="flex items-center mt-3">
                              <button type="button" class="flex-1 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 text-sm font-medium rounded-md active:scale-90 transition-all close-delete-product-modal">
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

              <section class="animate__animated animate__fadeIn animate__faster" v-show="productOrder">
                <div class="py-6 px-8">
                  <div class="my-2 w-full sm:flex items-center justify-end space-y-4 sm:space-y-0 sm:space-x-3">
                    <div class="relative w-full sm:w-auto">
                      <div class="absolute inset-y-0 left-0 flex items-center pl-2.5 pointer-events-none">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-500">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                      </div>
                      <input type="text" id="search-order-product" placeholder="По име или доставчик" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 focus:border-gray-400 focus:outline-none block w-full pl-9 p-2.5 sm:w-48" />
                    </div>
                    <div class="relative w-full sm:w-48">
                      <select id="select-order-product-kind" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:border-gray-400 block w-full p-2.5 cursor-pointer">
                        <option value="Всички">Всички</option>
                        <option value="Препарати">Препарати</option>
                        <option value="Техника">Техника</option>
                        <option value="Екипировка">Екипировка</option>
                        <option value="Пособия за чистене">Пособия за чистене</option>
                      </select>
                    </div>
                    <div class="flex items-center space-x-3">
                      <?php if ($roles["create_role"] == 1 || $roles["full_role"] == 1) { ?>
                        <button id="add-product-order-btn" type="button" class="w-10 h-10 bg-blue-500 hover:bg-blue-600 focus:outline-none active:scale-90 transition-all rounded-lg flex items-center justify-center shadow-lg">
                          <svg fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-7 h-7 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                          </svg>
                        </button>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                    <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden">
                      <table id="product-order-table" class="min-w-full leading-normal bg-white">
                        <thead>
                          <tr class="border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
                            <th class="pr-4 py-3">номер</th>
                            <th class="pr-4 py-3">продукт</th>
                            <th class="px-4 py-3">количество</th>
                            <th class="px-4 py-3">вид</th>
                            <th class="px-4 py-3">доставчик</th>
                            <th class="px-4 py-3">производител</th>
                            <th class="px-4 py-3">ед. цена</th>
                            <th class="px-4 py-3">цена</th>
                            <th class="px-4 py-3">дата</th>
                            <th class="px-4 py-3">действия</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $query = "SELECT * FROM product_orders";
                          $query_run = mysqli_query($con, $query);

                          if (mysqli_num_rows($query_run) > 0) {
                            while ($rows = mysqli_fetch_array($query_run)) { ?>
                              <tr class="bg-white hover:bg-slate-50 transition-all border-b border-gray-200 text-sm">
                                <td class="pr-4 py-5 text-center"><?= $rows["id"] ?></td>
                                <td class="px-4 py-5 text-center"><?= $rows["name"] ?></td>
                                <td class="px-4 py-5">
                                  <div class="h-8 w-8 mx-auto bg-blue-100 text-blue-800 text-xs font-semibold rounded-md flex items-center justify-center">
                                    <?= $rows["quantity"] ?>
                                  </div>
                                </td>
                                <td class="px-4 py-5 text-center"><?= $rows["kind"] ?></td>
                                <td class="px-4 py-5 text-center"><?= $rows["supplier"] ?></td>
                                <td class="px-4 py-5 text-center"><?= $rows["manufacturer"] ?></td>
                                <td class="px-4 py-5 text-center"><?= $rows["price_per_one"] . " лв." ?></td>
                                <td class="px-4 py-5 text-center"><?= $rows["total_price"] . " лв." ?></td>
                                <td class="px-4 py-5 text-center"><?= date("d.m.Y", strtotime($rows['date'])) ?></td>
                                <td class="px-4 py-5 flex justify-center">
                                  <?php if ($roles["edit_role"] == 1 || $roles["full_role"] == 1) { ?>
                                    <button type="button" value="<?= $rows["id"] ?>" class="bg-red-500 hover:bg-red-600 p-2 rounded-md transition-all focus:outline-none active:scale-90 delete-product-order">
                                      <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-white">
                                        <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                                      </svg>
                                    </button>
                                  <?php } ?>
                                </td>
                              </tr>
                            <?php }
                          } else { ?>
                            <tr>
                              <td colspan="10" class="px-4 py-6 border-b border-gray-200 bg-white text-sm text-center font-semibold">Не са намерени данни</td>
                            </tr>
                          <?php } ?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <td colspan="10">
                              <div class="flex justify-end py-2.5 px-4 w-full">
                                <ul class="inline-flex items-center -space-x-px">
                                  <li>
                                    <a href="#" class="block px-2 pt-[9px] pb-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 transition-all">
                                      <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                      </svg>
                                    </a>
                                  </li>
                                  <li>
                                    <a href="#" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 transition-all">1</a>
                                  </li>
                                  <li>
                                    <a href="#" class="block px-2 pt-[9px] pb-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 transition-all">
                                      <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                      </svg>
                                    </a>
                                  </li>
                                </ul>
                              </div>
                            </td>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                </div>

                <div id="add-order-product-modal" class="bg-gray-900 hidden bg-opacity-50 fixed inset-0 z-40">
                  <div class="h-full w-full p-4 overflow-x-hidden overflow-y-auto flex justify-center">
                    <div class="relative w-full h-full max-w-lg animate__animated animate__zoomIn animate__fast">
                      <div class="relative bg-white rounded-lg shadow mb-6">
                        <div class="flex items-center justify-between px-5 py-3.5 border-b border-gray-200">
                          <div class="text-slate-700 font-bold text-xl">Добави поръка</div>
                          <button type="button" class=" absolute top-1.5 right-1.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center close-order-product-modal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                          </button>
                        </div>
                        <form id="add-product-order-form">
                          <div class="px-5 py-4 space-y-6 text-slate-700">
                            <div class="sm:flex items-center w-full space-y-4 sm:space-y-0 sm:space-x-5 xl:space-x-6">
                              <div class="w-full">
                                <div class="mb-4">
                                  <label for="product-order-name" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                    Име на продукт
                                  </label>
                                  <input type="text" id="product-order-name" minlength="3" name="name" autocomplete="off" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring-0 focus:border-gray-400 w-full p-2.5" placeholder="Въведи име" />
                                  <div id="product-name-dropdown" class="hidden absolute w-[90.5%] sm:w-[92.2%] bg-gray-50 border border-gray-400 border-t-0 shadow-lg rounded-b-lg -mt-1 2xl:-mt-[5px] z-50"></div>
                                </div>
                                <label for="product-order-quantity" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                  Количество
                                </label>
                                <input type="text" id="product-order-quantity" minlength="1" name="quantity" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none focus:border-gray-400 w-full p-2.5 price-calculate" placeholder="Въведи количество" />
                                <label for="product-order-kind" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                  Избери вид на продукта
                                </label>
                                <select id="product-order-kind" name="kind" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:border-gray-400 block w-full p-2.5 mb-4">
                                  <option value="Препарати">Препарати</option>
                                  <option value="Техника">Техника</option>
                                  <option value="Екипировка">Екипировка</option>
                                  <option value="Пособия за чистене">Пособия за чистене</option>
                                </select>
                                <div class="mb-4">
                                  <label for="product-order-supplier" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                    Доставчик
                                  </label>
                                  <input type="text" id="product-order-supplier" minlength="2" name="supplier" autocomplete="off" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring-0 focus:border-gray-400 w-full p-2.5" placeholder="Въведи доставчик" />
                                  <div id="supplier-name-dropdown" class="hidden absolute w-[90.5%] sm:w-[92.2%] bg-gray-50 border border-gray-400 border-t-0 shadow-lg rounded-b-lg -mt-1 2xl:-mt-[5px] z-50"></div>
                                </div>
                                <label for="product-order-manufacturer" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                  Производител
                                </label>
                                <input type="text" id="product-order-manufacturer" minlength="2" name="manufacturer" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none  focus:border-gray-400 w-full p-2.5" placeholder="Въведи производител" />
                                <label for="product-order-one-price" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                  Единична цена
                                </label>
                                <input type="text" id="product-order-one-price" minlength="1" name="onePrice" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none  focus:border-gray-400 w-full p-2.5 price-calculate" placeholder="Въведи единична цена" />
                                <label for="product-order-price" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                  Обща цена
                                </label>
                                <input readonly type="text" id="product-order-price" value="0.00 лв." name="price" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none w-full p-2.5" />
                              </div>
                            </div>
                          </div>
                          <div class="w-full border-t border-gray-200 p-3 flex justify-end items-center">
                            <button type="button" class="text-slate-700 border border-slate-400 bg-transparent hover:bg-gray-100 font-semibold rounded-lg text-sm px-4 py-1.5 ml-2 focus:outline-none transition-all active:scale-90 close-order-product-modal">Откажи</button>
                            <button type="submit" class="text-white bg-blue-700 border border-blue-700 hover:bg-blue-800 font-semibold rounded-lg text-sm px-4 py-1.5 ml-2 focus:outline-none transition-all active:scale-90">Запази</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                <div id="delete-product-order-modal" class="bg-gray-900 hidden bg-opacity-50 fixed inset-0 z-40">
                  <div class="h-full w-full p-5 overflow-x-hidden overflow-y-auto flex justify-center items-center">
                    <div class="relative w-full h-auto max-w-md animate__animated animate__zoomIn animate__fast">
                      <div class="relative bg-white rounded-lg shadow mb-6">
                        <div class="p-4 text-center">
                          <div class="text-xl font-bold mb-3">Изтрий поръчката</div>
                          <h3 class="mb-5 text-sm text-gray-500">Сигурни ли сте, че искате да изтриете поръчката?</h3>
                          <form id="delete-product-order-form">
                            <input id="delete-product-order-id" type="hidden" name="id">
                            <div class="flex items-center mt-3">
                              <button type="button" class="flex-1 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 text-sm font-medium rounded-md active:scale-90 transition-all close-delete-product-order-modal">
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

              <section class="animate__animated animate__fadeIn animate__faster" v-show="dashSupplier">
                <div class="py-6 px-8">
                  <div class="my-2 w-full sm:flex items-center justify-end space-y-4 sm:space-y-0 sm:space-x-3">
                    <div class="relative w-full sm:w-auto">
                      <div class="absolute inset-y-0 left-0 flex items-center pl-2.5 pointer-events-none">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-500">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                      </div>
                      <input type="text" id="search-supplier" placeholder="По име" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 focus:border-gray-400 focus:outline-none block w-full pl-9 p-2.5 sm:w-48" />
                    </div>
                    <div class="flex items-center space-x-3">
                      <?php if ($roles["create_role"] == 1 || $roles["full_role"] == 1) { ?>
                        <button id="add-supplier-btn" type="button" class="w-10 h-10 bg-blue-500 hover:bg-blue-600 focus:outline-none active:scale-90 transition-all rounded-lg flex items-center justify-center shadow-lg">
                          <svg fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-7 h-7 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                          </svg>
                        </button>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                    <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden">
                      <table id="supplier-table" class="min-w-full leading-normal bg-white">
                        <thead>
                          <tr class="border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase text-center tracking-wider">
                            <th class="pr-4 py-3">номер</th>
                            <th class="pr-4 py-3">име</th>
                            <th class="px-4 py-3">телефон</th>
                            <th class="px-4 py-3">адрес</th>
                            <th class="px-4 py-3">банкова сметка</th>
                            <th class="px-4 py-3">доставки</th>
                            <th class="px-4 py-3">действия</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $query = "SELECT * FROM suppliers";
                          $query_run = mysqli_query($con, $query);

                          if (mysqli_num_rows($query_run) > 0) {
                            while ($rows = mysqli_fetch_array($query_run)) { ?>
                              <tr class="bg-white hover:bg-slate-50 transition-all border-b border-gray-200 text-sm">
                                <td class="pr-4 py-5 text-center"><?= $rows["id"] ?></td>
                                <td class="px-4 py-5 text-center"><?= $rows["name"] ?></td>
                                <td class="px-4 py-5 text-center"><?= $rows["phone"] ?></td>
                                <td class="px-4 py-5 text-center"><?= $rows["address"] ?></td>
                                <td class="px-4 py-5 text-center"><?= $rows["iban"] ?></td>
                                <td class="px-4 py-5">
                                  <?php
                                  $supplier = $rows["name"];
                                  $queryy = "SELECT * FROM product_orders WHERE supplier = '$supplier'";
                                  $query_runn = mysqli_query($con, $queryy);

                                  if (mysqli_num_rows($query_runn) >= 1) { ?>
                                    <button value="<?= $rows["name"] ?>" class="h-8 w-8 mx-auto bg-blue-100 text-blue-800 text-xs font-semibold rounded-md flex items-center justify-center focus:outline-none active:scale-90 transition-all supplier-order-view">
                                      <?php echo mysqli_num_rows($query_runn); ?>
                                    </button>
                                  <?php } else { ?>
                                    <div class="h-8 w-8 mx-auto bg-blue-100 text-blue-800 text-xs font-semibold rounded-md flex items-center justify-center">
                                      0
                                    </div>
                                  <?php } ?>
                                </td>
                                <td class="px-4 py-5 flex justify-center space-x-2">
                                  <?php if ($roles["edit_role"] == 1 || $roles["full_role"] == 1) { ?>
                                    <button value="<?= $rows["id"] ?>" type="button" class="bg-blue-500 hover:bg-blue-600 p-2 rounded-md transition-all focus:outline-none active:scale-90 edit-supplier">
                                      <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-white">
                                        <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                                      </svg>
                                    </button>
                                    <button type="button" value="<?= $rows["id"] ?>" class="bg-red-500 hover:bg-red-600 p-2 rounded-md transition-all focus:outline-none active:scale-90 delete-supplier">
                                      <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-white">
                                        <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                                      </svg>
                                    </button>
                                  <?php } ?>
                                </td>
                              </tr>
                            <?php }
                          } else { ?>
                            <tr>
                              <td colspan="7" class="px-4 py-6 border-b border-gray-200 bg-white text-sm text-center font-semibold">Не са намерени данни</td>
                            </tr>
                          <?php } ?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <td colspan="7">
                              <div class="flex justify-end py-2.5 px-4 w-full">
                                <ul class="inline-flex items-center -space-x-px">
                                  <li>
                                    <a href="#" class="block px-2 pt-[9px] pb-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 transition-all">
                                      <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                      </svg>
                                    </a>
                                  </li>
                                  <li>
                                    <a href="#" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 transition-all">1</a>
                                  </li>
                                  <li>
                                    <a href="#" class="block px-2 pt-[9px] pb-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 transition-all">
                                      <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                      </svg>
                                    </a>
                                  </li>
                                </ul>
                              </div>
                            </td>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                </div>

                <div id="supplier-order-view-modal" class="bg-gray-900 hidden bg-opacity-50 fixed inset-0 z-40">
                  <div class="h-full w-full p-4 overflow-x-hidden overflow-y-auto flex justify-center items-center">
                    <div class="relative w-full h-auto max-w-lg animate__animated animate__zoomIn animate__fast">
                      <div class="relative bg-white rounded-lg shadow mb-6">
                        <div class="flex items-center justify-between px-5 py-3.5 border-b border-gray-200">
                          <div class="text-slate-700 font-bold text-xl">Поръчки</div>
                          <button type="button" class="absolute top-1.5 right-1.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center close-supplier-order-view-modal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                          </button>
                        </div>
                        <div class="px-5 py-4 space-y-6 text-slate-700">
                          <div id="supplier-orders" class="sm:flex flex-wrap items-center w-full gap-y-4 sm:gap-x-4"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div id="add-supplier-modal" class="bg-gray-900 hidden bg-opacity-50 fixed inset-0 z-40">
                  <div class="h-full w-full p-4 overflow-x-hidden overflow-y-auto flex justify-center">
                    <div class="relative w-full h-full max-w-lg animate__animated animate__zoomIn animate__fast">
                      <div class="relative bg-white rounded-lg shadow mb-6">
                        <div class="flex items-center justify-between px-5 py-3.5 border-b border-gray-200">
                          <div class="text-slate-700 font-bold text-xl">Добави доставчик</div>
                          <button type="button" class=" absolute top-1.5 right-1.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center close-supplier-modal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                          </button>
                        </div>
                        <form id="add-supplier-form">
                          <div class="px-5 py-4 space-y-6 text-slate-700">
                            <div class="sm:flex items-center w-full space-y-4 sm:space-y-0 sm:space-x-5 xl:space-x-6">
                              <div class="w-full">
                                <label for="supplier-name" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                  Име
                                </label>
                                <input type="text" id="supplier-name" minlength="2" name="supplierName" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none focus:border-gray-400 w-full p-2.5 price-calculate" placeholder="Въведи име" />
                                <label for="supplier-phone" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                  Телефон
                                </label>
                                <input type="text" id="supplier-phone" minlength="9" name="phone" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none  focus:border-gray-400 w-full p-2.5" placeholder="Въведи телефон" />
                                <label for="supplier-address" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                  Адрес
                                </label>
                                <input type="text" id="supplier-address" minlength="5" name="address" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none  focus:border-gray-400 w-full p-2.5 price-calculate" placeholder="Въведи адрес" />
                                <label for="supplier-iban" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                  Банкова сметка
                                </label>
                                <input type="text" id="supplier-iban" minlength="10" name="iban" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none w-full p-2.5" placeholder="Въведи банкова сметка" />
                              </div>
                            </div>
                          </div>
                          <div class="w-full border-t border-gray-200 p-3 flex justify-end items-center">
                            <button type="button" class="text-slate-700 border border-slate-400 bg-transparent hover:bg-gray-100 font-semibold rounded-lg text-sm px-4 py-1.5 ml-2 focus:outline-none transition-all active:scale-90 close-supplier-modal">Откажи</button>
                            <button type="submit" class="text-white bg-blue-700 border border-blue-700 hover:bg-blue-800 font-semibold rounded-lg text-sm px-4 py-1.5 ml-2 focus:outline-none transition-all active:scale-90">Запази</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                <div id="supplier-edit-modal" class="bg-gray-900 hidden bg-opacity-50 fixed inset-0 z-40">
                  <div class="h-full w-full p-4 overflow-x-hidden overflow-y-auto flex justify-center">
                    <div class="relative w-full h-full max-w-lg animate__animated animate__zoomIn animate__fast">
                      <div class="relative bg-white rounded-lg shadow mb-6">
                        <div class="flex items-center justify-between px-5 py-3.5 border-b border-gray-200">
                          <div class="text-slate-700 font-bold text-xl">Редактиране на доставчика</div>
                          <button type="button" class=" absolute top-1.5 right-1.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center close-supplier-edit-modal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                          </button>
                        </div>
                        <form id="supplier-edit-form">
                          <div class="px-5 py-4 space-y-6 text-slate-700">
                            <div class="sm:flex items-center w-full space-y-4 sm:space-y-0 sm:space-x-5 xl:space-x-6">
                              <div class="w-full">
                                <input type="hidden" id="supplier-id" name="id">
                                <label class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                  Име
                                </label>
                                <input readonly type="text" id="supplier-name-edit" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none w-full p-2.5 price-calculate" placeholder="Въведи име" />
                                <label for="supplier-phone-edit" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                  Телефон
                                </label>
                                <input type="text" id="supplier-phone-edit" minlength="9" name="phone" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none  focus:border-gray-400 w-full p-2.5" placeholder="Въведи телефон" />
                                <label for="supplier-address-edit" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                  Адрес
                                </label>
                                <input type="text" id="supplier-address-edit" minlength="5" name="address" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none  focus:border-gray-400 w-full p-2.5 price-calculate" placeholder="Въведи адрес" />
                                <label for="supplier-iban-edit" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                  Банкова сметка
                                </label>
                                <input type="text" id="supplier-iban-edit" minlength="10" name="iban" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none w-full p-2.5" placeholder="Въведи банкова сметка" />
                              </div>
                            </div>
                          </div>
                          <div class="w-full border-t border-gray-200 p-3 flex justify-end items-center">
                            <button type="button" class="text-slate-700 border border-slate-400 bg-transparent hover:bg-gray-100 font-semibold rounded-lg text-sm px-4 py-1.5 ml-2 focus:outline-none transition-all active:scale-90 close-supplier-edit-modal">Откажи</button>
                            <button type="submit" class="text-white bg-blue-700 border border-blue-700 hover:bg-blue-800 font-semibold rounded-lg text-sm px-4 py-1.5 ml-2 focus:outline-none transition-all active:scale-90">Запази</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                <div id="delete-supplier-modal" class="bg-gray-900 hidden bg-opacity-50 fixed inset-0 z-40">
                  <div class="h-full w-full p-5 overflow-x-hidden overflow-y-auto flex justify-center items-center">
                    <div class="relative w-full h-auto max-w-md animate__animated animate__zoomIn animate__fast">
                      <div class="relative bg-white rounded-lg shadow mb-6">
                        <div class="p-4 text-center">
                          <div class="text-xl font-bold mb-3">Изтрий доставчика</div>
                          <h3 class="mb-5 text-sm text-gray-500">Сигурни ли сте, че искате да изтриете доставчика?</h3>
                          <form id="delete-supplier-form">
                            <input id="delete-supplier-id" type="hidden" name="id">
                            <div class="flex items-center mt-3">
                              <button type="button" class="flex-1 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 text-sm font-medium rounded-md active:scale-90 transition-all close-delete-supplier-modal">
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

              <section class="animate__animated animate__fadeIn animate__faster" v-show="dashProfile">
                <div class="py-6 px-8 w-full">
                  <div class="md:flex w-full h-[27.5rem] gap-x-5 space-y-4 md:space-y-0">
                    <div class="w-full h-full md:w-1/2 rounded-md shadow-xl border border-slate-100 bg-white p-4">
                      <label class="block ml-1 mb-1 text-lg font-semibold text-slate-700">
                        Снимка
                      </label>
                      <form id="admin-image-form">
                        <div class="flex items-center justify-center w-full">
                          <label @dragover="dragOver" @dragleave="dragFile = false" @drop="fileDropped" for="photo-file" :class="dragFile ? 'bg-blue-50 border-blue-200' : 'bg-gray-50 border-gray-300'" class="flex flex-col items-center justify-center group w-full h-44 border-2 hover:border-blue-200 border-dashed rounded-lg cursor-pointer hover:bg-blue-50 transition-all">
                            <div v-show="imagePreview == null" class="flex flex-col items-center justify-center pt-5 pb-6">
                              <svg aria-hidden="true" :class="dragFile ? 'text-blue-300' : 'text-gray-400'" class="w-10 h-10 mb-2 group-hover:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                              </svg>
                              <p :class="dragFile ? 'text-blue-400' : 'text-gray-500'" class="mb-2 text-sm group-hover:text-blue-400">
                                <span v-show="!dragFile" class="font-semibold text-center">
                                  Натиснете или провлачете за да добавите снимка
                                </span>
                                <span v-show="dragFile" class="font-semibold">
                                  Пуснете файла тук
                                </span>
                              </p>
                              <p :class="dragFile ? 'text-blue-400' : 'text-gray-500'" class="text-xs group-hover:text-blue-400">
                                PNG, JPG или JPEG (MAX 2MB)
                              </p>
                            </div>
                            <div v-show="imagePreview != null" class="w-full h-full rounded-lg">
                              <img class="h-44 w-full object-cover rounded-lg" :src="imagePreview" />
                            </div>
                            <input id="photo-file" @change="onFileChange" type="file" name="photo" class="hidden" accept="image/png, image/jpg, image/jpeg" />
                          </label>
                        </div>
                        <div v-show="imagePreview != null" class="w-full flex justify-start mt-2 space-x-3">
                          <button @click="imagePreview = null" type="submit" class="bg-blue-500 text-white hover:bg-blue-600 shadow-lg border border-blue-500 font-semibold px-4 py-1 active:scale-90 transition-all rounded-md">Запази</button>
                          <button @click="imagePreview = null" type="button" class="bg-white text-slate-700 hover:bg-slate-50 shadow-lg border border-slate-100 font-semibold px-4 py-1 active:scale-90 transition-all rounded-md">Откажи</button>
                        </div>
                      </form>

                      <label class="block ml-1 mb-1 text-lg font-semibold text-slate-700 mt-2.5">
                        Админски права
                      </label>
                      <div class="flex flex-wrap items-center gap-x-3.5 gap-y-3 mt-1.5">
                        <?php $permissions = [];

                        if ($roles["full_role"] == 1) {
                          $permissions = ['Четене', 'Добавяне', 'Редактиране', 'Изтриване',];
                        }
                        if ($roles["edit_role"] == 1) {
                          $permissions = ['Четене', 'Редактиране', 'Изтриване',];
                        }
                        if ($roles["create_role"] == 1) {
                          $permissions = ['Четене', 'Добавяне'];
                        }

                        foreach ($permissions as $permission) {
                          echo '<div class="shadow-lg bg-white py-1 px-2 rounded-xl border border-slate-100 text-slate-700 font-semibold">' . $permission . '</div>';
                        } ?>
                      </div>

                      <label class="block ml-1 mb-1 text-lg font-semibold text-slate-700 mt-2.5">
                        Изгледи
                      </label>
                      <div class="flex flex-wrap items-center gap-x-3.5 gap-y-3 mt-1.5">
                        <div class="shadow-lg bg-white py-1 px-2 rounded-xl border border-slate-100 text-slate-700 font-semibold">
                          <?php $views = ['Заявки'];

                          if ($roles["nomenclature_view"] == 1) {
                            $views[] = 'Номенклатури';
                          }
                          if ($roles["personal_view"] == 1) {
                            $views[] = 'Персонал';
                          }
                          if (count($views) == 3) {
                            echo 'Всички';
                          } else {
                            echo implode('</div><div class="shadow-lg bg-white py-1 px-2 rounded-xl border border-slate-100 text-slate-700 font-semibold">', $views);
                          } ?>
                        </div>
                      </div>
                    </div>
                    <form id="admin-information-form" class="w-full h-full md:w-1/2 rounded-md shadow-xl border border-slate-100 bg-white px-4 py-5">
                      <div class="w-full">
                        <div class="relative z-0 w-full mb-5 group">
                          <input type="text" readonly value="<?= $roles["name"] ?>" class="block py-2.5 pr-8 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none" placeholder=" " />
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                          <input type="text" value="<?= $roles["phone"] ?>" minlength="9" name="phone" class="block py-2.5 pr-8 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none" placeholder=" " />
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                          <input id="first-pass" :type="mobileCurrPassword ? 'text':'password'" name="oldPassword" autocomplete="off" class="block py-2.5 pr-8 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-500 peer" placeholder=" " />
                          <label for="first-pass" class="peer-focus:font-medium absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Текуща парола</label>
                          <div @click="mobileCurrPassword = !mobileCurrPassword" class="absolute inset-y-0 right-1.5 flex items-center pl-3 cursor-pointer">
                            <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-gray-400 active:scale-90 transition-all">
                              <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                              <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" clip-rule="evenodd" />
                            </svg>
                          </div>
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                          <input id="second-pass" :type="mobileNewPassword ? 'text':'password'" minlength="8" name="newPassword" autocomplete="off" minlength="5" class="block pr-8 py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-500 peer" placeholder=" " />
                          <label for="second-pass" class="peer-focus:font-medium absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Нова парола</label>
                          <div @click="mobileNewPassword = !mobileNewPassword" class="absolute inset-y-0 right-1.5 flex items-center pl-3 cursor-pointer">
                            <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-gray-400 active:scale-90 transition-all">
                              <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                              <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" clip-rule="evenodd" />
                            </svg>
                          </div>
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                          <input id="third-pass" :type="mobileRepPassword ? 'text':'password'" minlength="8" name="passwordRep" autocomplete="off" minlength="5" class="block pr-8 py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-500 peer" placeholder=" " />
                          <label for="third-pass" class="peer-focus:font-medium absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Потвърдете паролата</label>
                          <div @click="mobileRepPassword = !mobileRepPassword" class="absolute inset-y-0 right-1.5 flex items-center pl-3 cursor-pointer">
                            <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-gray-400 active:scale-90 transition-all">
                              <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                              <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" clip-rule="evenodd" />
                            </svg>
                          </div>
                        </div>
                      </div>
                      <div class="w-full flex justify-end">
                        <button type="submit" class="bg-blue-500 text-white hover:bg-blue-600 font-semibold px-4 py-1.5 active:scale-90 transition-all rounded-md mt-2.5">Запази</button>
                      </div>
                    </form>
                  </div>
                </div>
              </section>
            </div>
          </Transition>
        </div>
      <?php }
    } else { ?>
      <div class="fixed inset-0">
        <div class="h-full w-full flex justify-center items-center">
          <div class="w-[30rem] relative h-auto">
            <form id="dashboard-login-form" class="mt-6 mb-0 space-y-4 rounded-lg p-8 shadow-2xl text-slate-700">
              <p class="text-xl text-center font-bold">Carpet Services</p>
              <div>
                <label for="email" class="ml-1 text-sm font-semibold">Имейл</label>
                <div class="relative mt-1">
                  <input id="email" type="email" name="email" class="w-full rounded-lg border border-slate-50 p-2.5 pr-12 text-sm shadow-sm focus:border-slate-100 focus:outline-none" placeholder="Въведи имейл" />
                  <span class="absolute inset-y-0 right-4 inline-flex items-center">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                    </svg>
                  </span>
                </div>
              </div>
              <div>
                <label for="password" class="ml-1 text-sm font-semibold">Парола</label>
                <div class="relative mt-1">
                  <input type="password" id="password" name="password" class="w-full rounded-lg border border-slate-50 p-2.5 pr-12 text-sm shadow-sm focus:border-slate-100 focus:outline-none" placeholder="Въведи парола" />
                  <span class="absolute inset-y-0 right-4 inline-flex items-center">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                  </span>
                </div>
              </div>
              <button type="submit" class="block w-full rounded-lg bg-blue-500 px-5 py-2.5 hover:bg-blue-600 transition-all text-sm font-semibold text-white active:scale-90">
                Вход
              </button>
            </form>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
  <script src="js/main-vue.js"></script>
  <script src="js/main.js"></script>
  <script src="js/ajax.js"></script>
  <script src="loader/dashLoader.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
</body>

</html>