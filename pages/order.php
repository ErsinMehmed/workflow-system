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

  <title>Carpet Cleaning - Поръчка</title>
</head>

<body>
  <section>
    <!-- Page loader -->
    <div id="site-load" class="loader__wrap" role="alertdialog" aria-busy="true" aria-live="polite" aria-label="Loading…">
      <div class="loader" aria-hidden="true">
        <div class="loader__sq"></div>
        <div class="loader__sq"></div>
      </div>
    </div>
    <div id="app">
      <!--Scroll detector-->
      <div class="w-full h-1 rounded-r-full fixed z-40 top-0 left-0 bg-blue-400" :style="{ width: progress }"></div>

      <!--Scroll to top button-->
      <div class="fixed z-30 right-4 bottom-4 w-10 h-10 hidden bg-blue-500 hover:bg-blue-600 lg:flex rounded-full justify-center items-center cursor-pointer transition-all" style="
            box-shadow: rgb(0 0 0 / 25%) 0px 14px 28px,
              rgb(0 0 0 / 22%) 0px 10px 10px;
          " v-show="scY > 300" @click="goTop">
        <svg fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-7 h-7 rounded-full -mt-0.5 text-white">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
        </svg>
      </div>

      <!--Navbar section start-->
      <nav class="bg-white border-b border-slate-200 shadow-md sm:px-0 pt-3 md:py-3 top-0 sticky z-30">
        <div class="bg-white flex flex-wrap sm:px-5 md:px-6 lg:px-12 pb-3 md:pb-0 items-center justify-between">
          <a href="home" class="flex items-center pl-5 sm:pl-0">
            <img src="../images/main-logo.png" class="h-7 mr-3 md:h-12" alt="Main logo" />
          </a>
          <div class="flex items-center pr-5 sm:pr-0">
            <svg data-modal-toggle="authentication-modal" fill="none" viewBox="0 0 24 24" stroke-width="1.4" stroke="currentColor" class="w-8 h-8 text-slate-700 cursor-pointer hover:opacity-75 transition-all md:hidden">
              <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <img class="w-[26px] h-[25.5px] object-cover cursor-pointer hover:opacity-75 transition-all rounded-full md:hidden ml-2.5 mr-1" src="../images/britain-flag.png" alt="english" />
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
            <ul class="flex items-center flex-col -mb-3 md:-mb-0.5 p-4 mt-4 border border-gray-100 md:rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:text-lg md:font-semibold md:border-0 md:bg-white">
              <li>
                <a href="home" class="flex items-center py-2 pl-3 pr-4 text-gray-700 rounded-md hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 transition-all active:scale-90">
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
              <li data-modal-toggle="authentication-modal">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.4" stroke="currentColor" class="w-10 h-10 text-slate-700 cursor-pointer hover:opacity-75 transition-all -mr-3.5 hidden md:block active:scale-90">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
              </li>
              <li>
                <img class="w-8 h-8 object-cover cursor-pointer hover:opacity-75 transition-all rounded-full hidden md:block" src="../images/britain-flag.png" alt="english" />
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <!--Login modal-->
      <div id="authentication-modal" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
        <div class="relative w-full h-full max-w-md md:h-auto">
          <!-- Modal content -->
          <div class="relative rounded-lg shadow bg-gray-100">
            <button type="button" class="absolute top-3 right-2.5 text-slate-400 bg-transparent hover:bg-slate-200 hover:text-slate-700 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center transition-all" data-modal-toggle="authentication-modal">
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
                      <input id="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 cursor-pointer" />
                    </div>
                    <label for="remember" class="ml-1.5 text-sm font-medium group-hover:text-blue-500 transition-all cursor-pointer">
                      Запомни ме
                    </label>
                  </div>
                  <a href="#" class="text-sm hover:text-blue-500 transition-all font-semibold">
                    Забравена парола ?
                  </a>
                </div>
                <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-0 font-semibold rounded-md text-sm px-5 py-2.5 text-center transition-all active:scale-90">
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
                  <a data-modal-toggle="signUp-modal" href="#" class="text-slate-700 hover:hover:text-blue-500 font-semibold transition-all">
                    <span data-modal-toggle="authentication-modal">
                      Създаване на профил
                    </span>
                  </a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!--Sign up modal-->
      <div id="signUp-modal" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
        <div class="relative w-full h-full max-w-md md:h-auto md:mt-32">
          <!-- Modal content -->
          <div class="relative rounded-lg shadow bg-gray-100">
            <button type="button" class="absolute top-3 right-2.5 text-slate-400 bg-transparent hover:bg-slate-200 hover:text-slate-700 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center transition-all" data-modal-toggle="signUp-modal">
              <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
              </svg>
            </button>
            <div class="px-6 py-6 lg:px-8 text-slate-700">
              <h3 class="mb-4 text-xl font-semibold">Създайте профил</h3>
              <form id="sign-in-form" class="space-y-5">
                <div class="flex space-x-5">
                  <div>
                    <label for="first_name" class="block ml-1 mb-1 text-sm font-semibold text-slate-500">
                      Име
                    </label>
                    <input type="text" id="first_name" name="firstName" class="bg-white border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-0 focus:outline-none focus:border-gray-400 block w-full p-2.5" placeholder="Въведете име" minlength="2" />
                  </div>
                  <div>
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
                  <input type="email" id="email-signUp" name="email" class="bg-white border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-0 focus:outline-none focus:border-gray-400 block w-full p-2.5" placeholder="Въведете фамилия" minlength="5" />
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
                  <label for="password" class="block mb-1.5 text-sm font-semibold text-slate-500">
                    Вашата парола
                  </label>
                  <div class="relative">
                    <input :type="passwordReg ? 'password' : 'text'" name="password" id="password" class="bg-white border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-0 focus:outline-none focus:border-gray-400 block w-full pr-10 p-2.5" placeholder="••••••••" minlength="8" />
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
                  <label for="password" class="block mb-1.5 text-sm font-semibold text-slate-500">
                    Повтори парола
                  </label>
                  <div class="relative">
                    <input :type="passwordRegRep ? 'password' : 'text'" name="passwordRep" id="password" class="bg-white border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-0 focus:outline-none focus:border-gray-400 block w-full pr-10 p-2.5" placeholder="••••••••" minlength="8" />
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
                <button type="submit" class="w-full bg-gray-100 hover:bg-slate-200 border border-gray-300 text-slate-700 focus:outline-none focus:ring-0 font-semibold rounded-md text-sm px-5 py-2.5 flex justify-center items-center transition-all active:scale-90">
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

      <!--Form section-->
      <div class="h-auto w-full lg:w-[40rem] xl:w-[46rem] 2xl:w-[50rem] lg:rounded-lg shadow-xl lg:border border-slate-100 mx-auto lg:my-10">
        <form id="guest-order-form">
          <div class="w-full p-6 md:p-8 text-slate-700">
            <h1 class="font-bold text-2xl mb-6 md:mb-8 text-center sm:text-left">
              Направи поръчка
            </h1>
            <div class="font-semibold text-slate-500 text-sm md:text-base text-center sm:text-left">
              Направете вашата поръчка за почистване в няколко лесни стъпки
            </div>
            <hr class="w-full my-4" />
            <div class="sm:flex items-center sm:space-x-5 space-y-4 sm:space-y-0 mb-4">
              <div class="sm:w-1/2">
                <label for="name" class="block ml-1 mb-1 text-sm md:text-base font-semibold text-slate-700">
                  Име и фамилия
                </label>
                <input type="text" minlength="5" id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring-0 w-full p-2.5" placeholder="Въведете име" />
              </div>
              <div class="sm:w-1/2">
                <label for="phone-number" minlength="3" class="block ml-1 mb-1 text-sm md:text-base font-semibold text-slate-700">
                  Телефонен номер
                </label>
                <input type="text" id="phone-number" name="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring-0 focus:border-gray-400 w-full p-2.5" placeholder="Въведете телефон" />
              </div>
            </div>
            <div class="w-full mb-4">
              <label for="email" minlength="3" class="block ml-1 mb-1 text-sm md:text-base font-semibold text-slate-700">
                Имейл
              </label>
              <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring-0 focus:border-gray-400 w-full p-2.5" placeholder="Въведете имейл" />
            </div>
            <div class="block md:hidden ml-1 mb-1.5 font-semibold text-sm text-slate-700">
              Квадратура на обекта
            </div>
            <div class="block md:hidden mb-4">
              <input type="text" class="bg-slate-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 focus:outline-none focus:border-gray-400 block w-full p-2.5 account-m2" placeholder="m2" />
            </div>
            <div class="block ml-1 mb-1.5 font-semibold text-sm md:text-base text-slate-700">
              Изберете вид помещение
            </div>
            <ul class="flex flex-wrap gap-6 my-3.5">
              <li>
                <input class="sr-only peer building" type="radio" value="Къща" name="building" id="building-house" />
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
                <div class="relative">
                  <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-500">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                    </svg>
                  </div>
                  <input type="date" min="<?php echo date("Y-m-d", strtotime('+1 day', time())); ?>" value="<?php echo date("Y-m-d", strtotime('+1 day', time())); ?>" name="date" class="bg-gray-50 border border-gray-300
                    text-gray-900 text-sm rounded-lg focus:ring-0
                    focus:border-gray-400 focus:outline-none block w-full pl-10
                    p-2.5" placeholder="Изберете дата" />
                </div>
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
              <div id="tooltip-card-payment" role="tooltip" class="hidden text-center font-medium md:inline-block max-w-sm absolute invisible z-10 py-2 px-3 text-sm bg-white text-slate-700 rounded-lg opacity-0 transition-opacity duration-300 tooltip shadow-xl border border-slate-100">
                Не се притеснявайте ! Нашият екип ще носи POS терминал при
                посещението на имота Ви.
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
              Изберете град
            </div>
            <div class="flex flex-wrap items-center gap-3.5">
              <div v-for="city in cities">
                <input class="sr-only peer" type="radio" :value="city.name" name="city" :id="city.name" />
                <label class="flex justify-center items-center w-28 h-11 bg-white border border-gray-200 rounded-lg cursor-pointer focus:outline-none hover:bg-blue-50 hover:border-blue-200 peer-checked:border-blue-200 peer-checked:bg-blue-50" :for="city.name">
                  <div class="text-sm font-semibold text-slate-700 text-center flex">
                    <div>
                      <img class="object-fill w-5 h-5 rounded-full mr-1" :src="city.image" :alt="city.name" />
                    </div>
                    <div>{{city.name}}</div>
                  </div>
                </label>
              </div>
            </div>

            <label for="address" class="block ml-1 mb-1.5 mt-4 font-semibold text-sm md:text-base text-slate-700">
              Вашият адрес
            </label>
            <textarea @keyup="charCountAddress" id="address" v-model="address" name="address" minlength="5" rows="2" :class="{
                    'focus:border-red-500 border-red-500 bg-red-50': addressCount >= 200,
                }" class="block p-2.5 w-full text-sm text-gray-900 bg-slate-50 rounded-lg border border-gray-300 focus:ring-0 focus:outline-none focus:border-gray-400 resize-none md:resize-y" placeholder="Напишете адреса си тук..."></textarea>
            <div :class="{
                    'text-red-500 font-semibold': addressCount >= 200,
                }" class="w-full flex justify-end text-slate-600 text-sm -mb-1">
              {{ addressLength }}
            </div>

            <label for="address" class="block ml-1 mb-1.5 mt-4 font-semibold text-sm md:text-base text-slate-700">
              Допълнителна информация
            </label>
            <textarea @keyup="charCount" id="information" name="information" v-model="information" rows="2" :class="{
                    'focus:border-red-500 border-red-500 bg-red-50': informationCount >= 200,
                }" class="block p-2.5 w-full text-sm text-gray-900 bg-slate-50 rounded-lg border border-gray-300 focus:ring-0 focus:outline-none focus:border-gray-400 resize-none md:resize-y" placeholder="Пишете тук..."></textarea>
            <div :class="{
                    'text-red-500 font-semibold': informationCount >= 200,
                }" class="w-full flex justify-end text-slate-600 text-sm -mb-1">
              {{ informationLength }}
            </div>

            <!--Price toast-->
            <div class="fixed md:flex bottom-4 right-4 items-center justify-center p-3 w-24 md:w-32 text-slate-700 bg-white rounded-md shadow-2xl border border-slate-100" :class="{'lg:right-4': scY < 300, 'lg:right-16': scY > 300}">
              <div id="account-toast-price" class="font-semibold text-sm md:text-base">
                0 лв.
              </div>
              <input type="hidden" id="input-account-price" name="price" />
            </div>

            <div id="tooltip-m2" role="tooltip" class="hidden font-medium md:inline-block max-w-sm absolute invisible z-10 py-2 px-3 text-sm bg-white text-slate-700 rounded-lg opacity-0 transition-opacity duration-300 tooltip shadow-xl border border-slate-100">
              <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 -mt-1 mr-1 inline-flex">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              <span>Минимума е 10 квадратни метра.</span>
            </div>
            <!--М2 toast-->
            <div data-tooltip-target="tooltip-m2" data-tooltip-placement="left" class="hidden fixed md:flex bottom-20 right-4 items-center justify-center py-2 px-3 w-32 text-slate-700 bg-white rounded-md shadow-lg border border-slate-100" :class="{'lg:right-4': scY < 300, 'lg:right-16': scY > 300}">
              <div class="">
                <label for="account-m2" class="block mb-1.5 text-sm font-semibold text-slate-700 text-center">
                  Квадратура
                </label>
                <input type="text" id="account-m2" name="m2" class="bg-slate-50 border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-0 focus:outline-none focus:border-gray-300 block w-full p-1.5 text-center account-m2" minlength="2" maxlength="4" placeholder="m2" />
              </div>
            </div>

            <div class="sm:flex justify-start lg:justify-end mt-6">
              <button type="submit" class="w-full sm:w-auto text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-0 font-semibold rounded-lg text-sm px-5 py-2.5 transition-all active:scale-90">
                Направи поръчка
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
  <script src="../js/main-vue.js"></script>
  <script src="../js/main.js"></script>
  <script src="../js/ajax.js"></script>
  <script src="../loader/siteLoader.js"></script>
  <script src="https://unpkg.com/flowbite@1.5.5/dist/flowbite.js"></script>
</body>

</html>