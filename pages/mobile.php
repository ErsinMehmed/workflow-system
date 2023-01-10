<!DOCTYPE html>
<html lang="bg">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="shortcut icon" href="../images/title.png" />
  <link rel="stylesheet" href="../css/app.css" />
  <link rel="stylesheet" href="../css/alert.css" />
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

  <title>Carpet Cleaning</title>
</head>

<body>
  <!-- Page loader -->
  <div id="load-mobile" class="fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-50 overflow-hidden bg-slate-800 flex flex-col items-center justify-center">
    <div role="status">
      <svg aria-hidden="true" class="w-8 h-8 md:w-10 md:h-10 2xl:w-14 2xl:h-14 mb-2 md:mr-1 text-gray-100 animate-spin fill-blue-600" viewBox="0 0 100 101" fill="none">
        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
      </svg>
    </div>
    <h2 class="text-center text-gray-100 text-xl xl:text-2xl 2xl:text-3xl font-semibold">Зареждане...</h2>
  </div>
  <div id="app">
    <!-- Sidebar -->
    <aside class="w-28 fixed" aria-label="Sidebar">
      <div class="px-3 py-4 overflow-y-auto bg-[#f8f8f8] h-screen">
        <ul class="flex-col space-y-3.5 text-slate-600">
          <li @click="mobProfile = true; mobOrder = false; mobWarehouse = false" class="flex items-center justify-center w-16 h-16 mx-auto rounded-full border-4 border-white bg-[#cde8f8] cursor-pointer mt-1 transition-all active:scale-90 shadow-xl ring-1 ring-slate-200">
            <img class="object-cover h-12 w-12" src="../images/title.png" alt="" />
          </li>
          <li @click="mobOrder = true; mobWarehouse = false; mobProfile = false" :class="mobOrder ? 'bg-blue-50':'bg-white'" class="h-[88px] w-[88px] rounded-md shadow-xl border border-slate-100 flex items-center justify-center cursor-pointer transition-all active:scale-90">
            <div>
              <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-auto">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
              </svg>
              <span class="whitespace-nowrap text-center font-semibold">
                Заявки
              </span>
            </div>
          </li>
          <li @click="mobWarehouse = true; mobOrder = false; mobProfile = false" :class="mobWarehouse ? 'bg-blue-50':'bg-white'" class="h-[88px] w-[88px] rounded-md shadow-xl border border-slate-100 flex items-center justify-center cursor-pointer transition-all active:scale-90">
            <div>
              <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-auto">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
              <span class="whitespace-nowrap text-center font-semibold">
                Склад
              </span>
            </div>
          </li>
          <li onClick="window.location.reload();" class="h-[88px] w-[88px] bg-white rounded-md shadow-xl border border-slate-100 flex items-center justify-center cursor-pointer transition-all active:scale-90">
            <div>
              <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-auto">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
              </svg>
              <span class="whitespace-nowrap text-center font-semibold">
                Обнови
              </span>
            </div>
          </li>
        </ul>
        <li class="h-[88px] w-[88px] bg-white rounded-md shadow-xl border border-slate-100 flex items-center justify-center cursor-pointer transition-all active:scale-90 text-slate-600 mt-[304px]">
          <div>
            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-auto">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
            </svg>
            <span class="whitespace-nowrap text-center font-semibold">
              Изход
            </span>
          </div>
        </li>
      </div>
    </aside>

    <!-- Main section -->
    <section>
      <div class="ml-28">
        <!-- Order section -->
        <div v-show="mobProfile">
          <div class="flex items-center justify-end bg-[#f8f8f8] w-full h-14 border-b-2 border-slate-200"></div>
          <div class="flex p-4 space-x-6">
            <div class="w-[40%] shadow-xl border border-slate-100 flex items-center justify-center py-24 text-slate-600 rounded-md">
              <div>
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-36 h-36 mx-auto text-blue-400">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
                <div class="text-2xl uppercase font-bold mt-3 text-center">ersin mehmed</div>
                <div class="text-xl text-center font-semibold">Шофьор</div>
                <div class="text-lg mt-28 text-center">IP ADDRESS: 10.192.217.58</div>
                <div class="text-xl uppercase text-center font-bold">Carpet Services Desk</div>
                <div class="text-2xl font-bold text-[#407cb2] text-center">052 349 743</div>
                <div class="text-center text-sm font-bold mb-20">ver 1.13 &copy; 12.01.2023</div>
              </div>
            </div>
            <div class="w-[60%] space-y-6">
              <div class="px-5 py-10 rounded-md shadow-xl border border-slate-100">
                <form>
                  <div class="relative z-0 w-full mb-5 group">
                    <input :type="mobileCurrPassword ? 'text':'password'" name="oldPassword" autocomplete="off" id="first-pass" class="block py-2.5 pr-8 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-500 peer" placeholder=" " required />
                    <label for="first-pass" class="peer-focus:font-medium absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Текуща парола</label>
                    <div @click="mobileCurrPassword = !mobileCurrPassword" class="absolute inset-y-0 right-1.5 flex items-center pl-3 cursor-pointer">
                      <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-gray-400 active:scale-90 transition-all">
                        <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                        <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" clip-rule="evenodd" />
                      </svg>
                    </div>
                  </div>
                  <div class="relative z-0 w-full mb-5 group">
                    <input :type="mobileNewPassword ? 'text':'password'" name="newPassword" autocomplete="off" id="second-pass" class="block pr-8 py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-500 peer" placeholder=" " required />
                    <label for="second-pass" class="peer-focus:font-medium absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Нова парола</label>
                    <div @click="mobileNewPassword = !mobileNewPassword" class="absolute inset-y-0 right-1.5 flex items-center pl-3 cursor-pointer">
                      <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-gray-400 active:scale-90 transition-all">
                        <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                        <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" clip-rule="evenodd" />
                      </svg>
                    </div>
                  </div>
                  <div class="relative z-0 w-full mb-5 group">
                    <input :type="mobileRepPassword ? 'text':'password'" name="passwordRep" autocomplete="off" id="third-pass" class="block pr-8 py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-500 peer" placeholder=" " required />
                    <label for="third-pass" class="peer-focus:font-medium absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Потвърдете паролата</label>
                    <div @click="mobileRepPassword = !mobileRepPassword" class="absolute inset-y-0 right-1.5 flex items-center pl-3 cursor-pointer">
                      <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-gray-400 active:scale-90 transition-all">
                        <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                        <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" clip-rule="evenodd" />
                      </svg>
                    </div>
                  </div>
                  <div class="flex justify-end w-full">
                    <button type="submit" class="px-2.5 py-1.5 text-sm font-bold uppercase bg-white border border-blue-400 text-blue-400 focus:outline-none transition-all active:scale-90 rounded">Потвърди</button>
                  </div>
                </form>
              </div>
              <div class="px-5 py-10 rounded-md shadow-xl border border-slate-100">
                ersin
              </div>
            </div>
          </div>
        </div>

        <!-- Order section -->
        <div v-show="mobOrder">
          <div class="flex items-center justify-end bg-[#f8f8f8] w-full h-14 border-b-2 border-slate-200 px-5">
            <div class="flex space-x-3.5">
              <input type="text" id="search-mobile-order" :class="showSearchInput ? 'block' : 'hidden'" class="bg-white border border-blue-200 text-slate-800 text-sm rounded focus:bg-slate-50 focus:outline-none h-7 w-40 p-0.5 px-2" />
              <svg @click="showSearchInput = true" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" :class="showSearchInput ? 'hidden' : 'block'" class="w-7 h-7 text-blue-400 hover:text-blue-300 active:scale-90 transition-all cursor-pointer">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
              </svg>
              <svg id="sort-btn" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor" class="w-7 h-7 text-blue-400 hover:text-blue-300 active:scale-90 transition-all cursor-pointer">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
              </svg>
            </div>
          </div>
          <div class="w-full flex items-center text-slate-600">
            <div @click="activeOrder = true; finishedOrder = false" :class="activeOrder ? 'bg-slate-50 text-blue-400 border-b-2 border-blue-400':'bg-white'" class="w-1/2 flex items-center justify-center py-2.5 border-b-2 border-slate-100 box-border cursor-pointer text-sm font-semibold">
              <div>Неприключени</div>
              <div :class="activeOrder ? 'border-blue-300':'border-slate-200'" class="rounded-full border ml-2 h-7 w-7 flex items-center justify-center">23</div>
            </div>
            <div @click="finishedOrder = true; activeOrder = false" :class="finishedOrder ? 'bg-slate-50 text-blue-400 border-b-2 border-blue-400':'bg-white'" class="w-1/2 flex items-center justify-center py-2.5 border-b-2 border-slate-100 box-border cursor-pointer text-sm font-semibold">
              <div>Приключени</div>
              <div :class="finishedOrder ? 'border-blue-300':'border-slate-200'" class="rounded-full ml-2 h-7 w-7 border flex items-center justify-center">0</div>
            </div>
          </div>
          <div class="p-4">
            <div class="flex items-center w-full rounded-sm border border-slate-100 shadow-xl p-3 cursor-pointer active:scale-95 transition-all">
              <div class="h-10 w-10 bg-blue-400 shadow-lg rounded-full flex items-center justify-center">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-slate-100">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
              </div>
              <div class="">

              </div>
              <div>
                <svg fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-7 h-7 text-blue-400">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
              </div>
            </div>
          </div>
        </div>

        <!-- Warehouse section -->
        <div v-show="mobWarehouse">
          <div class="flex items-center justify-end bg-[#f8f8f8] w-full h-14 border-b-2 border-slate-200 px-5">
            <div class="flex space-x-3.5">
              <svg id="make-order-btn" fill="none" viewBox="0 0 24 24" stroke-width="1.4" stroke="currentColor" class="w-7 h-7 text-blue-400 hover:text-blue-300 active:scale-90 transition-all cursor-pointer">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              <svg id="show-product-btn" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 text-blue-400 hover:text-blue-300 active:scale-90 transition-all cursor-pointer">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
              </svg>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Sort order modal -->
    <div id="sort-order-modal" class="bg-gray-800 hidden bg-opacity-50 fixed inset-0 z-40">
      <div class="h-full w-full p-5 overflow-x-hidden overflow-y-auto flex justify-center items-center">
        <div class="relative w-full h-auto max-w-md">
          <div class="relative bg-white rounded shadow mb-6">
            <!-- Modal body -->
            <div class="text-xl font-bold text-white bg-blue-500 py-2 rounded-t text-center">
              Сортиране
            </div>
            <div class="p-4 text-center">
              <form id="sort-order-form">
                <div class="flex gap-x-5 w-full mt-1 mb-5">
                  <div class="w-full">
                    <input class="sr-only peer" checked type="radio" value="yes" name="sort" id="first" />
                    <label class="flex items-center justify-center text-slate-600 p-3 peer-checked:bg-blue-100 bg-white border border-blue-100 rounded-md cursor-pointer focus:outline-none peer-checked:border-blue-200" for="first">
                      <div>
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 mx-auto">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                        <div class="font-semibold">Име</div>
                      </div>
                    </label>
                  </div>
                  <div class="w-full">
                    <input class="sr-only peer" type="radio" value="yes" name="sort" id="second" />
                    <label class="flex items-center justify-center text-slate-600 p-3 peer-checked:bg-blue-100 bg-white border border-blue-100 rounded-md cursor-pointer focus:outline-none peer-checked:border-blue-200" for="second">
                      <div>
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 mx-auto">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                        <div class="font-semibold">Номер</div>
                      </div>
                    </label>
                  </div>
                  <div class="w-full">
                    <input class="sr-only peer" type="radio" value="yes" name="sort" id="third" />
                    <label class="flex items-center justify-center text-slate-600 p-3 peer-checked:bg-blue-100 bg-white border border-blue-100 rounded-md cursor-pointer focus:outline-none peer-checked:border-blue-200" for="third">
                      <div>
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 mx-auto">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                        <div class="font-semibold">Час</div>
                      </div>
                    </label>
                  </div>
                </div>
                <div class="flex items-center mt-3">
                  <button type="button" class="flex-1 px-4 py-1.5 bg-red-600 text-white text-sm font-semibold rounded active:scale-90 transition-all close-sort-order-modal">
                    Откажи
                  </button>
                  <button type="submit" class="flex-1 px-4 py-1.5 bg-blue-500 text-white text-sm font-semibold rounded active:scale-90 transition-all ml-3">
                    Запази
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Product order modal -->
    <div id="product-order-modal" class="bg-gray-800 hidden bg-opacity-50 fixed inset-0 z-40">
      <div class="h-full w-full p-5 overflow-x-hidden overflow-y-auto flex justify-center items-center">
        <div class="relative w-full h-auto max-w-md">
          <div class="relative bg-white rounded shadow mb-6">
            <!-- Modal body -->
            <div class="text-xl font-bold text-white bg-blue-500 py-2 rounded-t text-center">
              Заявка за продукт
            </div>
            <form id="order-product-form">
              <div class="p-4 text-center">
                <select class="bg-white mb-5 border border-blue-200 text-slate-700 text-sm rounded-md focus:outline-none block w-full p-2.5 w-[248px] text-center mx-auto">
                  <option>Choose a country</option>
                </select>
                <select class="bg-white mb-5 border border-blue-200 text-slate-700 text-sm rounded-md focus:outline-none hidden w-full p-2.5 w-[248px] text-center mx-auto">
                  <option>Choose a country</option>
                </select>
                <div class="flex items-center justify-center space-x-5">
                  <div @click="productCount--" class="w-10 h-10 rounded-md border border-blue-200 shadow-xl flex items-center justify-center active:scale-90 transition-all cursor-pointer">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-slate-700">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                    </svg>
                  </div>
                  <input :value="productCount" type="text" name="productCount" class="bg-white border border-blue-200 text-slate-700 text-sm rounded-md focus:outline-none block w-32 p-2.5 text-center">
                  <div @click="productCount++" class="w-10 h-10 rounded-md border border-blue-200 shadow-xl flex items-center justify-center active:scale-90 transition-all cursor-pointer">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-slate-700">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                  </div>
                </div>
              </div>
              <div class="flex items-center p-4">
                <button type="button" class="flex-1 px-4 py-1.5 bg-slate-100 border border-slate-200 text-slate-700 text-sm font-semibold rounded active:scale-90 transition-all close-product-order-modal">
                  Откажи
                </button>
                <button type="submit" class="flex-1 px-4 py-1.5 bg-blue-500 text-white text-sm font-semibold rounded active:scale-90 transition-all ml-3">
                  Запази
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Product modal -->
    <div id="product-show-modal" class="bg-gray-800 hidden bg-opacity-50 fixed inset-0 z-40">
      <div class="h-full w-full p-5 overflow-x-hidden overflow-y-auto flex justify-center items-center">
        <div class="relative w-full h-auto max-w-md">
          <div class="relative bg-white rounded shadow mb-6">
            <!-- Modal body -->
            <div class="text-xl font-bold text-white bg-blue-500 py-2 rounded-t text-center">
              Код на продуктите
            </div>
            <div class="p-4 text-center">

            </div>
            <div class="flex items-center mt-3 p-4">
              <button type="button" class="flex-1 px-4 py-1.5 bg-slate-100 border border-slate-200 text-slate-700 text-sm font-semibold rounded active:scale-90 transition-all close-show-product-modal">
                Затвори
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
  <script src="../js/main-vue.js"></script>
  <script src="../js/main.js"></script>
  <script src="../js/ajax.js"></script>
  <script src="../loader/mobLoader.js"></script>
</body>

</html>