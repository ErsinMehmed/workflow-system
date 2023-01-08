<?php
include '../action/dbconn.php';

date_default_timezone_set('Europe/Sofia');
$date = date("Y-m-d");
?>
<!DOCTYPE html>
<html lang="bg" class="overflow-x-hidden">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="shortcut icon" href="../images/title.png" />
  <link rel="stylesheet" href="../css/app.css" />
  <link rel="stylesheet" href="../css/alert.css" />

  <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>

  <title>Администраторски панел</title>
</head>

<body>
  <!-- Page loader -->
  <div id="load-dashboard" class="fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-50 overflow-hidden bg-slate-800 flex flex-col items-center justify-center">
    <div role="status">
      <svg aria-hidden="true" class="w-8 h-8 md:w-10 md:h-10 2xl:w-14 2xl:h-14 mb-2 md:mr-1 text-gray-100 animate-spin fill-blue-600" viewBox="0 0 100 101" fill="none">
        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
      </svg>
    </div>
    <h2 class="text-center text-gray-100 text-xl xl:text-2xl 2xl:text-3xl font-semibold">Зареждане...</h2>
  </div>
  <!-- Dashboard -->
  <div id="app">
    <div class="flex overflow-hidden">
      <Transition name="slide-fade">
        <aside v-show="toggleSidebar" class="fixed z-20 h-full top-0 left-0 flex lg:flex flex-shrink-0 flex-col w-14 lg:w-64 transition-width duration-75" aria-label="Sidebar">
          <div class="relative flex-1 flex flex-col min-h-0 border-r border-gray-200 bg-[#222e3c] pt-0">
            <div class="flex flex-col pt-5 pb-4 overflow-y-auto">
              <div class="bg-[#222e3c]">
                <div class="hidden lg:block text-xl font-bold text-white mb-8 ml-5">
                  Carpet Services
                </div>
                <ul class="pb-2 text-gray-400">
                  <div class="hidden lg:block mb-1.5 ml-5 text-xs text-gray-100">
                    Действия
                  </div>
                  <li @click="dashOrder = true; dashUser = false; dashTeam = false; dashWarehouse = false; dashSupplier = false; dashClient = false; dashSection = 'Заявки'" :class=" dashOrder ? 'text-white border-l-4 border-[#3b7ddd] bg-gradient-to-r from-[#3a4b5e] via-[#2f3c4b] to-[#2f3c4b] bg-opacity-50' : 'hover:text-gray-300'" class="text-base w-full flex items-center py-2.5 px-4 transition-all cursor-pointer mb-1">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-5 h-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 00-1.883 2.542l.857 6a2.25 2.25 0 002.227 1.932H19.05a2.25 2.25 0 002.227-1.932l.857-6a2.25 2.25 0 00-1.883-2.542m-16.5 0V6A2.25 2.25 0 016 3.75h3.879a1.5 1.5 0 011.06.44l2.122 2.12a1.5 1.5 0 001.06.44H18A2.25 2.25 0 0120.25 9v.776" />
                    </svg>
                    <span class="ml-2.5 hidden lg:block">Заявки</span>
                  </li>
                  <div class="hidden lg:block mb-1.5 mt-2 ml-5 text-xs text-gray-100">
                    Персонал
                  </div>
                  <li @click="dashUser = true; dashOrder = false; dashTeam = false; dashWarehouse = false; dashSupplier = false; dashClient = false; dashSection = 'Потребители'" :class=" dashUser ? 'text-white border-l-4 border-[#3b7ddd] bg-gradient-to-r from-[#3a4b5e] via-[#2f3c4b] to-[#2f3c4b]' : 'hover:text-gray-300'" class="text-base w-full flex items-center py-2.5 px-4 transition-all cursor-pointer mb-1">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-5 h-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                    <span class="ml-2.5 hidden lg:block">Потребители</span>
                  </li>
                  <li @click="dashTeam = true; dashOrder = false; dashUser = false; dashWarehouse = false; dashSupplier = false; dashClient = false; dashSection = 'Екипи'" :class=" dashTeam ? 'text-white border-l-4 border-[#3b7ddd] bg-gradient-to-r from-[#3a4b5e] via-[#2f3c4b] to-[#2f3c4b]' : 'hover:text-gray-300'" class="text-base w-full flex items-center py-2.5 px-4 transition-all cursor-pointer mb-1">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-5 h-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                    <span class="ml-2.5 hidden lg:block">Екипи</span>
                  </li>
                  <div class="hidden lg:block mb-1.5 mt-2 ml-5 text-xs text-gray-100">
                    Номенклатури
                  </div>
                  <li @click="dashWarehouse = true; dashOrder = false; dashUser = false; dashTeam = false; dashSupplier = false; dashClient = false; dashSection = 'Склад'" :class=" dashWarehouse ? 'text-white border-l-4 border-[#3b7ddd] bg-gradient-to-r from-[#3a4b5e] via-[#2f3c4b] to-[#2f3c4b]' : 'hover:text-gray-300'" class="text-base w-full flex items-center py-2.5 px-4 transition-all cursor-pointer mb-1">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-5 h-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                    </svg>
                    <span class="ml-2.5 hidden lg:block">Склад</span>
                  </li>
                  <li @click="dashSupplier = true; dashOrder = false; dashUser = false; dashTeam = false; dashWarehouse = false; dashClient = false; dashSection = 'Доставчици'" :class=" dashSupplier ? 'text-white border-l-4 border-[#3b7ddd] bg-gradient-to-r from-[#3a4b5e] via-[#2f3c4b] to-[#2f3c4b]' : 'hover:text-gray-300'" class="text-base w-full flex items-center py-2.5 px-4 transition-all cursor-pointer mb-1">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-5 h-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>
                    <span class="ml-2.5 hidden lg:block">Доставчици</span>
                  </li>
                  <li @click="dashClient = true; dashOrder = false; dashUser = false; dashTeam = false; dashWarehouse = false; dashSupplier = false; dashSection = 'Клиенти'" :class=" dashClient ? 'text-white border-l-4 border-[#3b7ddd] bg-gradient-to-r from-[#3a4b5e] via-[#2f3c4b] to-[#2f3c4b]' : 'hover:text-gray-300'" class="text-base w-full flex items-center py-2.5 px-4 transition-all cursor-pointer mb-1">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-5 h-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="ml-2.5 hidden lg:block">Клиенти</span>
                  </li>
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
                    {{dashSection}}
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
                  <div>
                    <img data-dropdown-toggle="profile-dropdown" class="w-8 h-8 rounded-full object-cover ml-5 mr-4 shadow cursor-pointer active:scale-90 hover:opacity-75 transition-all" src="../images/user.png" alt="" />
                    <div id="profile-dropdown" class="hidden z-10 w-44 bg-white rounded shadow-xl border border-slate-100">
                      <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefault">
                        <li class="flex items-center py-2 px-4 hover:bg-gray-100 cursor-pointer active:scale-90">
                          <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-slate-700 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                          </svg>
                          <span>Профил</span>
                        </li>
                        <li class="flex items-center py-2 px-4 hover:bg-gray-100 cursor-pointer active:scale-90">
                          <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-slate-700 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                          </svg>
                          <span>Помощ</span>
                        </li>
                        <hr class="bg-gray-400 w-full" />
                        <li class="flex items-center py-2 px-4 hover:bg-gray-100 cursor-pointer active:scale-90">
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

          <!-- Order section -->
          <main v-show="dashOrder">
            <div class="pt-6 px-4">
              <div class="w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 px-4">
                <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8">
                  <div class="flex items-center">
                    <div class="flex-shrink-0">
                      <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">2,340</span>
                      <h3 class="text-base font-normal text-gray-500">
                        New products this week
                      </h3>
                    </div>
                    <div class="ml-5 w-0 flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                      14.6%
                      <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                      </svg>
                    </div>
                  </div>
                </div>
                <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8">
                  <div class="flex items-center">
                    <div class="flex-shrink-0">
                      <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">5,355</span>
                      <h3 class="text-base font-normal text-gray-500">
                        Visitors this week
                      </h3>
                    </div>
                    <div class="ml-5 w-0 flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                      32.9%
                      <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                      </svg>
                    </div>
                  </div>
                </div>
                <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8">
                  <div class="flex items-center">
                    <div class="flex-shrink-0">
                      <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">385</span>
                      <h3 class="text-base font-normal text-gray-500">
                        User signups this week
                      </h3>
                    </div>
                    <div class="ml-5 w-0 flex items-center justify-end flex-1 text-red-500 text-base font-bold">
                      -2.7%
                      <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M14.707 12.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                      </svg>
                    </div>
                  </div>
                </div>
              </div>

              <div class="py-6 px-4">
                <div class="my-2 w-full sm:flex items-center justify-end space-y-4 sm:space-y-0 sm:space-x-3">
                  <div class="relative w-full sm:w-48">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                      <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                      </svg>
                    </div>
                    <input type="text" id="search-order" placeholder="По номер или име" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 focus:border-gray-400 focus:outline-none block w-full pl-10 p-2.5 " />
                  </div>
                  <div class="relative w-full sm:w-48">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                      <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                      </svg>
                    </div>
                    <input type="date" id="order-filter-date" value="<?php echo date("Y-m-d"); ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 focus:border-gray-400 focus:outline-none block w-full pl-10 p-2.5 " placeholder="Изберете дата" />
                  </div>
                  <div class="flex items-center space-x-3">
                    <button id="add-order-btn" type="button" class="w-10 h-10 bg-blue-500 hover:bg-blue-600 focus:outline-none active:scale-90 transition-all rounded-lg flex items-center justify-center shadow-lg">
                      <svg fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-7 h-7 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                      </svg>
                    </button>
                    <button type="button" class="w-10 h-10 bg-green-500 hover:bg-green-600 focus:outline-none active:scale-90 transition-all rounded-lg flex items-center justify-center shadow-lg">
                      <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                      </svg>
                    </button>
                  </div>
                </div>
                <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                  <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden">
                    <table id="order-table" class="min-w-full leading-normal">
                      <thead>
                        <tr>
                          <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
                            номер
                          </th>
                          <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
                            име на клиент
                          </th>
                          <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
                            помещение
                          </th>
                          <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
                            оферта
                          </th>
                          <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
                            статус
                          </th>
                          <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
                            квадратура
                          </th>
                          <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
                            цена
                          </th>
                          <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
                            фактура
                          </th>
                          <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
                            дата
                          </th>
                          <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
                            действия
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $query = "SELECT * FROM orders WHERE date = '$date'";
                        $query_run = mysqli_query($con, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                          while ($rows = mysqli_fetch_array($query_run)) {
                        ?>
                            <tr>
                              <td class="px-4 py-5 border-b border-gray-200 bg-white text-sm text-center"><?= $rows["id"] ?></td>
                              <td class="px-4 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                <button type="button" value="<?= $rows["email"] ?>" class="text-gray-900 whitespace-no-wrap hover:underline cursor-pointer transition-all show-customer">
                                  <?= $rows["customer_name"] ?>
                                </button>
                              </td>
                              <td class="px-4 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                <p class="text-gray-900 whitespace-no-wrap">
                                  <?= $rows["room"] ?>
                                </p>
                              </td>
                              <td class="px-4 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                <p class="text-gray-900 whitespace-no-wrap">
                                  <?= $rows["offer"] ?>
                                </p>
                              </td>
                              <td class="px-4 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                <?php if ($rows["status"] == 'Назначи') {
                                ?>
                                  <span class="relative inline-block px-3 py-1 font-semibold text-blue-900 leading-tight">
                                    <span aria-hidden class="absolute inset-0 bg-blue-200 opacity-50 rounded-full"></span>
                                    <span class="relative"><?= $rows["status"] ?></span>
                                  </span>
                                <?php
                                } else if ($rows["status"] == 'Назначена') {
                                ?>
                                  <span class="relative inline-block px-3 py-1 font-semibold text-indigo-900 leading-tight">
                                    <span aria-hidden class="absolute inset-0 bg-indigo-200 opacity-50 rounded-full"></span>
                                    <span class="relative"><?= $rows["status"] ?></span>
                                  </span>
                                <?php
                                } else if ($rows["status"] == 'В процес') {
                                ?>
                                  <span class="relative inline-block px-3 py-1 font-semibold text-orange-900 leading-tight">
                                    <span aria-hidden class="absolute inset-0 bg-orange-200 opacity-50 rounded-full"></span>
                                    <span class="relative"><?= $rows["status"] ?></span>
                                  </span>
                                <?php
                                } else if ($rows["status"] == 'Приключена') {
                                ?>
                                  <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                    <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                    <span class="relative"><?= $rows["status"] ?></span>
                                  </span>
                                <?php } else if ($rows["status"] == 'Отказана') { ?>
                                  <span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                    <span aria-hidden class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                    <span class="relative"><?= $rows["status"] ?></span>
                                  </span>
                                <?php } else if ($rows["status"] == 'Изтекла') { ?>
                                  <span class="relative inline-block px-3 py-1 font-semibold text-gray-900 leading-tight">
                                    <span aria-hidden class="absolute inset-0 bg-gray-200 opacity-50 rounded-full"></span>
                                    <span class="relative"><?= $rows["status"] ?></span>
                                  </span>
                                <?php } ?>
                              </td>
                              <td class="px-4 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                <?= $rows["m2"] . " m2" ?>
                              </td>
                              <td class="px-4 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                <?= $rows["price"] . " лв." ?>
                              </td>
                              <td class="px-4 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                <?php if ($rows["invoice"] == "Да") { ?>
                                  <span class="w-8 h-8 rounded-full bg-green-200 flex items-center justify-center mx-auto">
                                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-green-500">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                    </svg>
                                  </span>
                                <?php
                                } else { ?>
                                  <span class="w-8 h-8 rounded-full bg-red-200 flex items-center justify-center mx-auto">
                                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-red-500">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                  </span>
                                <?php } ?>
                              </td>
                              <td class="px-4 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                <?= date("d.m.Y", strtotime($rows['date'])) ?>
                              </td>
                              <td class="px-4 py-5 flex items-center justify-center border-b border-gray-200 bg-white text-sm text-center space-x-1.5">
                                <?php if ($rows["status"] == "Назначи") { ?>
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
                              </td>
                            <?php }
                        } else { ?>
                            <tr>
                              <td colspan="10" class="px-4 py-6 border-b border-gray-200 bg-white text-sm text-center font-semibold">Не са намерени данни</td>
                            </tr>
                          <?php } ?>
                          </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <!-- Add order modal -->
            <div id="add-order-modal" class="bg-gray-900 hidden bg-opacity-50 fixed inset-0 z-40">
              <div class="h-full w-full p-4 overflow-x-hidden overflow-y-auto flex justify-center">
                <div class="relative w-full h-full max-w-lg">
                  <div class="relative bg-white rounded-lg shadow mb-6">
                    <div class="flex items-center justify-between px-5 py-4 border-b border-gray-200">
                      <div class=" text-slate-700 font-bold text-xl">Добави заявка</div>
                      <button type="button" class=" absolute top-2 right-2 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center close-add-order-modal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                      </button>
                    </div>
                    <!-- Modal body -->
                    <form id="add-order-form">
                      <div class="px-5 py-4 space-y-6 text-slate-700">
                        <div class="sm:flex items-center w-full space-y-4 sm:space-y-0 sm:space-x-5 xl:space-x-6">
                          <div class="w-full">
                            <label for="customer-name" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                              Име и фамилия
                            </label>
                            <input type="text" minlength="2" id="customer-name" name="customerName" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none focus:ring-0 focus:border-gray-400 w-full p-2.5" placeholder="Въведи име" />
                            <label for="customer-phone" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                              Телефон
                            </label>
                            <input type="text" minlength="2" id="customer-phone" name="customerPhone" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none focus:ring-0 focus:border-gray-400 w-full p-2.5" placeholder="Въведи телефон" />
                            <label for="customer-email" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                              Имейл
                            </label>
                            <input type="email" minlength="2" id="customer-email" name="customerEmail" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none focus:ring-0 focus:border-gray-400 w-full p-2.5" placeholder="Въведи имейл" />
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
                            <input type="text" minlength="2" id="customer-m2" name="m2" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none focus:ring-0 focus:border-gray-400 w-full p-2.5" placeholder="Въведи квадратура" />
                            <label for="pick-date" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">Изберете дата</label>
                            <input type="date" id="pick-date" name="pickDate" value="<?php echo date("Y-m-d"); ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 focus:border-gray-400 focus:outline-none block w-full p-2.5 mb-5" placeholder="Изберете дата" />
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
                            <label for="infomation" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">Допълнителна информация</label>
                            <textarea id="infomation" rows="2" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:border-gray-400 mb-4" placeholder="Пишете тук..."></textarea>
                            <label class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                              Цена
                            </label>
                            <input type="text" name="customerPrice" class="bg-gray-50 border border-gray-300 text-gray-900 mb-2 text-sm rounded-lg focus:outline-none focus:ring-0 focus:border-gray-300 w-full p-2.5" placeholder="Цена" />
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

            <!-- Edit order modal -->
            <div id="order-modal" class="bg-gray-900 hidden bg-opacity-50 fixed inset-0 z-40">
              <div class="h-full w-full p-4 overflow-x-hidden overflow-y-auto flex 2xl:items-center justify-center">
                <div class="relative w-full h-full max-w-lg mt-10">
                  <div class="relative bg-white rounded-lg shadow mb-6">
                    <div class="flex items-center justify-between px-5 py-4 border-b border-gray-200">
                      <div class=" text-slate-700 font-bold text-xl">Редактиране заявката</div>
                      <button type="button" class=" absolute top-2 right-2 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center close-order-modal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                      </button>
                    </div>
                    <!-- Modal body -->
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
                            <input type="text" minlength="2" id="customer-phone-edit" name="customerPhone" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none focus:ring-0 focus:border-gray-400 w-full p-2.5" placeholder="Въведи телефон" />
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
                            <input type="text" minlength="2" id="customer-m2-edit" name="m2" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none focus:ring-0 focus:border-gray-400 w-full p-2.5" placeholder="Въведи квадратура" />
                            <label for="pick-date-edit" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">Изберете дата</label>
                            <input type="date" id="pick-date-edit" name="pickDate" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 focus:border-gray-400 focus:outline-none block w-full p-2.5 mb-5" placeholder="Изберете дата" />
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
                            <label for="infomation-edit" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">Допълнителна информация</label>
                            <textarea id="infomation-edit" rows="2" name="information" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:border-gray-400 mb-4" placeholder="Пишете тук..."></textarea>
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

            <!-- Custoemer order information modal -->
            <div id="customer-order-modal" class="bg-gray-900 hidden bg-opacity-50 fixed inset-0 z-40">
              <div class="h-full p-4 overflow-x-hidden overflow-y-auto flex items-center justify-center">
                <div class="relative w-full max-w-lg h-auto">
                  <div class="relative bg-white rounded-lg shadow">
                    <div class="flex items-center justify-between px-5 py-4 border-b border-gray-200">
                      <div class=" text-slate-700 font-bold text-xl">Клиент</div>
                      <button type="button" class=" absolute top-2 right-2 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center customer-order-modal-close">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                      </button>
                    </div>
                    <!-- Modal body -->
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
                          <label for="customer-address-show" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">Адрес</label>
                          <textarea id="customer-address-show" readonly rows="2" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:border-gray-300 mb-1"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Set order modal -->
            <div id="set-order-modal" class="bg-gray-900 hidden bg-opacity-50 fixed inset-0 z-40">
              <div class="h-full w-full p-4 overflow-x-hidden overflow-y-auto flex justify-center">
                <div class="relative w-full h-full max-w-lg">
                  <div class="relative bg-white rounded-lg shadow mb-6">
                    <div class="flex items-center justify-between px-5 py-4 border-b border-gray-200">
                      <div class=" text-slate-700 font-bold text-xl">Назначи заявка</div>
                      <button type="button" class=" absolute top-2 right-2 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center close-set-order-modal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                      </button>
                    </div>
                    <!-- Modal body -->
                    <form id="set-order-form">
                      <div class="px-5 py-4 space-y-6 text-slate-700">
                        <div class="sm:flex items-center w-full space-y-4 sm:space-y-0 sm:space-x-5 xl:space-x-6">
                          <div class="w-full">
                            <input type="hidden" id="order-date" name="orderDate">
                            <input type="hidden" id="team-id-set" name="teamId">
                            <input type="hidden" id="order-id-set" name="orderId">
                            <input type="hidden" id="team-name" name="teamName">
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
          </main>

          <!-- User section -->
          <main v-show="dashUser">
            <div class="py-6 px-8">
              <div class="my-2 w-full sm:flex items-center justify-end space-y-4 sm:space-y-0 sm:space-x-3">
                <div class="relative w-full sm:w-auto">
                  <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-500">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                  </div>
                  <input type="text" id="search-user" placeholder="По име или пид" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 focus:border-gray-400 focus:outline-none block w-full pl-10 p-2.5" />
                </div>
                <div class="relative w-full sm:w-48">
                  <select id="select-position" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:border-gray-400 block w-full p-2.5">
                    <option value="Всички">Всички</option>
                    <option value="Хигиенист">Хигиенист</option>
                    <option value="Шофьор">Шофьор</option>
                  </select>
                </div>
                <div class="relative w-full sm:w-48">
                  <select id="select-status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:border-gray-400 block w-full p-2.5">
                    <option value="3">Всички</option>
                    <option value="1">Активен</option>
                    <option value="0">Напуснал</option>
                  </select>
                </div>
                <div class="flex items-center space-x-3">
                  <button id="add-user-btn" type="button" class="w-10 h-10 bg-blue-500 hover:bg-blue-600 focus:outline-none active:scale-90 transition-all rounded-lg flex items-center justify-center shadow-lg">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-7 h-7 text-white">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                  </button>
                </div>
              </div>
              <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden">
                  <table id="user-table" class="min-w-full leading-normal">
                    <thead>
                      <tr>
                        <th class="pr-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
                          снимка
                        </th>
                        <th class="pr-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
                          име
                        </th>
                        <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
                          пид
                        </th>
                        <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
                          длъжност
                        </th>
                        <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
                          статус
                        </th>
                        <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
                          екип
                        </th>
                        <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
                          назначен
                        </th>
                        <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
                          действия
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $query = "SELECT * FROM users WHERE status = '1'";
                      $query_run = mysqli_query($con, $query);

                      if (mysqli_num_rows($query_run) > 0) {
                        while ($rows = mysqli_fetch_array($query_run)) {
                      ?>
                          <tr>
                            <td class="bg-white border-b border-gray-200 px-2 py-5"><img src="../uploaded-files/user-images/<?= $rows["image"] ?>" alt="" class="w-10 h-10 rounded-full object-cover mx-auto" /></td>
                            <td class="pr-4 py-5 border-b border-gray-200 bg-white text-sm text-center">
                              <?= $rows["name"] ?>
                            </td>
                            <td class="px-4 py-5 border-b border-gray-200 bg-white text-sm text-center">
                              <p class="text-gray-900 whitespace-no-wrap">
                                <?= $rows["pid"] ?>
                              </p>
                            </td>
                            <td class="px-4 py-5 border-b border-gray-200 bg-white text-sm text-center">
                              <?= $rows["position"] ?>
                            </td>
                            <td class="px-4 py-5 border-b border-gray-200 bg-white text-sm">
                              <?php if ($rows["status"] == 1) { ?>
                                <span class="w-8 h-8 rounded-full bg-green-200 flex items-center justify-center mx-auto">
                                  <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-green-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                  </svg>
                                </span>
                              <?php
                              } else { ?>
                                <span class="w-8 h-8 rounded-full bg-red-200 flex items-center justify-center mx-auto">
                                  <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-red-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                  </svg>
                                </span>
                              <?php } ?>
                            </td>
                            <td class="px-4 py-5 border-b border-gray-200 bg-white text-sm text-center">
                              <?php if ($rows["team_name"] != '') {
                                echo $rows["team_name"];
                              } else { ?>
                                Няма
                              <?php } ?>
                            </td>
                            <td class="px-4 py-5 border-b border-gray-200 bg-white text-sm text-center">
                              <?= date("d.m.Y", strtotime($rows['in_date'])) ?>
                            </td>
                            <td class="px-4 py-5 border-b border-gray-200 bg-white text-sm text-center space-x-1.5">
                              <?php if ($rows["status"] != 0) { ?>
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
                              <?php } ?>
                            </td>
                          </tr>
                        <?php }
                      } else { ?>
                        <tr>
                          <td colspan="9" class="px-4 py-6 border-b border-gray-200 bg-white text-sm text-center font-semibold">Не са намерени данни</td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <!-- Add user modal -->
            <div id="add-user-modal" class="bg-gray-900 hidden bg-opacity-50 fixed inset-0 z-40">
              <div class="h-full w-full p-4 overflow-x-hidden overflow-y-auto flex justify-center">
                <div class="relative w-full h-full max-w-lg">
                  <div class="relative bg-white rounded-lg shadow mb-6">
                    <div class="flex items-center justify-between px-5 py-4 border-b border-gray-200">
                      <div class=" text-slate-700 font-bold text-xl">Добави потребител</div>
                      <button type="button" class=" absolute top-2 right-2 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center close-add-user-modal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                      </button>
                    </div>
                    <!-- Modal body -->
                    <form id="add-user-form">
                      <div class="px-5 py-4 space-y-6 text-slate-700">
                        <div class="sm:flex items-center w-full space-y-4 sm:space-y-0 sm:space-x-5 xl:space-x-6">
                          <div class="w-full">
                            <label for="user-name" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                              Име и фамилия
                            </label>
                            <input type="text" minlength="2" id="user-name" name="userName" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none focus:ring-0 focus:border-gray-400 w-full p-2.5" placeholder="Въведи име" />
                            <label for="user-egn" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                              ЕГН
                            </label>
                            <input type="text" minlength="10" maxlength="10" id="user-egn" name="userEgn" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none focus:ring-0 focus:border-gray-400 w-full p-2.5" placeholder="Въведи ЕГН" />
                            <label class="block ml-1 mb-1 text-sm font-semibold text-slate-700">Изберете дата на раждане</label>
                            <input type="date" name="user-dob" value="<?php echo date("Y-m-d"); ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 focus:border-gray-400 focus:outline-none block w-full p-2.5 mb-5" />
                            <label for="user-pid" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                              ПИД
                            </label>
                            <input type="text" minlength="5" maxlength="5" id="user-pid" name="userPid" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none focus:ring-0 focus:border-gray-400 w-full p-2.5" placeholder="Въведи ПИД" />
                            <label for="user-phone" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                              Телефон
                            </label>
                            <input type="text" minlength="2" id="user-phone" name="userPhone" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none focus:ring-0 focus:border-gray-400 w-full p-2.5" placeholder="Въведи телефон" />
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

            <!-- Edit user modal -->
            <div id="edit-user-modal" class="bg-gray-900 hidden bg-opacity-50 fixed inset-0 z-40">
              <div class="h-full w-full p-4 overflow-x-hidden overflow-y-auto flex justify-center">
                <div class="relative w-full h-full max-w-lg">
                  <div class="relative bg-white rounded-lg shadow mb-6">
                    <div class="flex items-center justify-between px-5 py-4 border-b border-gray-200">
                      <div class=" text-slate-700 font-bold text-xl">Редактиране потребител</div>
                      <button type="button" class=" absolute top-2 right-2 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center close-edit-user-modal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                      </button>
                    </div>
                    <!-- Modal body -->
                    <form id="edit-user-form">
                      <div class="px-5 py-4 space-y-6 text-slate-700">
                        <div class="sm:flex items-center w-full space-y-4 sm:space-y-0 sm:space-x-5 xl:space-x-6">
                          <div class="w-full">
                            <input type="hidden" id="user-id" name="id" />
                            <label for="user-name-edit" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                              Име и фамилия
                            </label>
                            <input type="text" minlength="2" id="user-name-edit" name="userName" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none focus:ring-0 focus:border-gray-400 w-full p-2.5" placeholder="Въведи име" />
                            <label for="user-egn-edit" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                              ЕГН
                            </label>
                            <input type="text" minlength="10" maxlength="10" id="user-egn-edit" name="userEgn" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none focus:ring-0 focus:border-gray-400 w-full p-2.5" placeholder="Въведи ЕГН" />
                            <label class="block ml-1 mb-1 text-sm font-semibold text-slate-700">Дата на раждане</label>
                            <input type="date" id="user-dob-edit" name="userDob" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 focus:border-gray-400 focus:outline-none block w-full p-2.5 mb-5" />
                            <label for="user-phone-edit" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                              Телефон
                            </label>
                            <input type="text" minlength="2" id="user-phone-edit" name="userPhone" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none focus:ring-0 focus:border-gray-400 w-full p-2.5" placeholder="Въведи телефон" />
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

            <!-- Edit user passowrd modal -->
            <div id="user-password-modal" class="bg-gray-900 hidden bg-opacity-50 fixed inset-0 z-40">
              <div class="h-full w-full p-4 overflow-x-hidden overflow-y-auto flex justify-center">
                <div class="relative w-full h-full max-w-lg">
                  <div class="relative bg-white rounded-lg shadow mb-6">
                    <div class="flex items-center justify-between px-5 py-4 border-b border-gray-200">
                      <div class=" text-slate-700 font-bold text-xl">Задаване на парола</div>
                      <button type="button" class=" absolute top-2 right-2 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center close-user-password-modal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                      </button>
                    </div>
                    <!-- Modal body -->
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
                            <input type="password" minlength="2" id="user-passowrd" name="userPassword" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none focus:ring-0 focus:border-gray-400 w-full p-2.5" placeholder="Въведи парола" />
                            <label for="user-passowrd-rep" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                              Повтори парола
                            </label>
                            <input type="password" minlength="2" id="user-passowrd-rep" name="userPassowrdRep" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none focus:ring-0 focus:border-gray-400 w-full p-2.5" placeholder="Повтори парола" />
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
          </main>

          <!-- Team section -->
          <main v-show="dashTeam">
            <div class="py-6 px-8">
              <div class="my-2 w-full sm:flex items-center justify-end space-y-4 sm:space-y-0 sm:space-x-3">
                <div class="relative w-full sm:w-auto">
                  <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-500">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                  </div>
                  <input type="text" id="search-team" placeholder="По номер или име" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 focus:border-gray-400 focus:outline-none block w-full pl-10 p-2.5" />
                </div>
                <div class="flex items-center space-x-3">
                  <button id="add-team-btn" type="button" class="w-10 h-10 bg-blue-500 hover:bg-blue-600 focus:outline-none active:scale-90 transition-all rounded-lg flex items-center justify-center shadow-lg">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-7 h-7 text-white">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                  </button>
                </div>
              </div>
              <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden">
                  <table id="team-table" class="min-w-full leading-normal">
                    <thead>
                      <tr>
                        <th class="pr-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
                          номер
                        </th>
                        <th class="pr-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
                          име на екип
                        </th>
                        <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
                          статус
                        </th>
                        <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
                          служител 1
                        </th>
                        <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
                          служител 2
                        </th>
                        <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
                          назначени задачи
                        </th>
                        <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
                          действия
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $query = "SELECT * FROM teams WHERE  	delete_team  != 'yes'";
                      $query_run = mysqli_query($con, $query);

                      if (mysqli_num_rows($query_run) > 0) {
                        while ($rows = mysqli_fetch_array($query_run)) {
                      ?>
                          <tr>
                            <td class="pr-4 py-5 border-b border-gray-200 bg-white text-sm text-center">
                              <?= $rows["id"] ?>
                            </td>
                            <td class="px-4 py-5 border-b border-gray-200 bg-white text-sm text-center">
                              <p class="text-gray-900 whitespace-no-wrap">
                                <?= $rows["name"] ?>
                              </p>
                            </td>
                            <td class="px-4 py-5 border-b border-gray-200 bg-white text-sm">
                              <?php if ($rows["status"] == "Yes") { ?>
                                <span class="w-8 h-8 rounded-full bg-green-200 flex items-center justify-center mx-auto">
                                  <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-green-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                  </svg>
                                </span>
                              <?php
                              } else { ?>
                                <span class="w-8 h-8 rounded-full bg-red-200 flex items-center justify-center mx-auto">
                                  <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-red-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                  </svg>
                                </span>
                              <?php } ?>
                            </td>
                            <td class="px-4 py-5 border-b border-gray-200 bg-white text-sm text-center">
                              <?= $rows["user1_name"] ?>
                            </td>
                            <td class="px-4 py-5 border-b border-gray-200 bg-white text-sm text-center">
                              <?= $rows["user2_name"] ?>
                            </td>
                            <td class="px-4 py-5 border-b border-gray-200 bg-white text-sm text-center">
                              <button type="button" value="<?= $rows['id']; ?>" class="h-8 w-8 bg-blue-100 hover:bg-blue-200 text-blue-800 focus:outline-none text-xs font-semibold rounded-md active:scale-90 transition-all prevOrd">
                                <?php
                                $id = $rows['id'];

                                $queryy = "SELECT * FROM orders WHERE team_id = '$id' AND date >= '$date'";
                                $query_runn = mysqli_query($con, $queryy);

                                if (mysqli_num_rows($query_runn) > 0) {
                                  echo mysqli_num_rows($query_runn);
                                } else {
                                ?>
                                  0
                                <?php } ?>
                              </button>
                            </td>
                            <td class="px-4 py-5 border-b border-gray-200 bg-white text-sm text-center space-x-1.5">
                              <button type="button" value="<?= $rows["id"] ?>" class="bg-red-500 hover:bg-red-600 p-2 rounded-md transition-all focus:outline-none active:scale-90 delete-team">
                                <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-white">
                                  <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                                </svg>
                              </button>
                            </td>
                          </tr>
                        <?php }
                      } else { ?>
                        <tr>
                          <td colspan="9" class="px-4 py-6 border-b border-gray-200 bg-white text-sm text-center font-semibold">Не са намерени данни</td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <!-- Add team modal -->
            <div id="add-team-modal" class="bg-gray-900 hidden bg-opacity-50 fixed inset-0 z-40">
              <div class="h-full w-full p-4 overflow-x-hidden overflow-y-auto flex justify-center">
                <div class="relative w-full h-full max-w-lg">
                  <div class="relative bg-white rounded-lg shadow mb-6">
                    <div class="flex items-center justify-between px-5 py-4 border-b border-gray-200">
                      <div class="text-slate-700 font-bold text-xl">Добави екип</div>
                      <button type="button" class=" absolute top-2 right-2 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center close-add-team-modal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                      </button>
                    </div>
                    <!-- Modal body -->
                    <form id="add-team-form">
                      <div class="px-5 py-4 space-y-6 text-slate-700">
                        <div class="sm:flex items-center w-full space-y-4 sm:space-y-0 sm:space-x-5 xl:space-x-6">
                          <div class="w-full">
                            <label for="team-name" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                              Име на екип
                            </label>
                            <input type="text" id="team-name" name="teamName" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:outline-none focus:ring-0 focus:border-gray-400 w-full p-2.5" placeholder="Въведи име на екип" />
                            <div class="mb-4">
                              <label for="team-user1" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                Служител 1
                              </label>
                              <input type="text" id="team-user1" name="teamUser1" autocomplete="off" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring-0 focus:border-gray-400 w-full p-2.5" placeholder="Въведи име" />
                              <input type="hidden" id="team-user1-pid" name="teamUser1Pid">
                              <input type="hidden" id="team-user1-id" name="teamUser1Id">
                              <div id="user-name1-dropdown" class="hidden absolute w-[90.5%] sm:w-[92.2%] bg-gray-50 border border-gray-400 border-t-0 shadow-lg rounded-b-lg -mt-1 z-50"></div>
                            </div>
                            <div class="mb-4">
                              <label for="team-user2" class="block ml-1 mb-1 text-sm font-semibold text-slate-700">
                                Служител 2
                              </label>
                              <input type="text" minlength="2" id="team-user2" name="teamUser2" autocomplete="off" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring-0 focus:border-gray-400 w-full p-2.5" placeholder="Въведи име" />
                              <input type="hidden" id="team-user2-pid" name="teamUser2Pid">
                              <input type="hidden" id="team-user2-id" name="teamUser2Id">
                              <div id="user-name2-dropdown" class="hidden absolute w-[90.5%] sm:w-[92.2%] bg-gray-50 border border-gray-400 border-t-0 shadow-lg rounded-b-lg -mt-1 z-50"></div>
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
          </main>
        </div>
      </Transition>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
  <script src="../js/main-vue.js"></script>
  <script src="../js/main.js"></script>
  <script src="../js/ajax.js"></script>
  <script src="../loader/dashLoader.js"></script>
  <script src="https://unpkg.com/flowbite@1.5.5/dist/flowbite.js"></script>
</body>

</html>