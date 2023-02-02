<?php
session_start();
error_reporting(0);
date_default_timezone_set('Europe/Sofia');

include 'action/dbconn.php';

$pid = $_SESSION['pid'];
$date_now = date("Y-m-d"); ?>

<!DOCTYPE html>
<html lang="bg">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="shortcut icon" href="images/title.png" />
  <link rel="stylesheet" href="css/app.css" />
  <link rel="stylesheet" href="css/alert.css" />
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
  <title>Carpet Cleaning</title>
</head>

<body>
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
    <?php if ($pid) { ?>
      <div id="mobile-app">
        <aside class="w-28 fixed" aria-label="Sidebar">
          <div class="px-3 py-4 overflow-y-auto bg-[#f8f8f8] h-screen">
            <ul class="flex-col space-y-4 text-slate-600">
              <li id="profile-btn" @click="mobProfile = true; mobOrder = false; mobWarehouse = false">
                <div class="flex items-center justify-center w-16 h-16 mx-auto rounded-full border-4 border-white bg-[#cde8f8] cursor-pointer mt-2 transition-all active:scale-90 shadow-xl ring-1 ring-slate-200"><img class="object-cover h-12 w-12" src="images/title.png" alt="" /></div>
                <div class="text-[12.4px] font-bold text-center mt-1.5 text-slate-600">Carpet Services</div>
              </li>
              <li id="order-btn" @click="mobOrder = true; mobWarehouse = false; mobProfile = false" :class="mobOrder ? 'bg-blue-50':'bg-white'" class="h-[88px] w-[88px] rounded-md shadow-xl border border-slate-100 flex items-center justify-center cursor-pointer transition-all active:scale-90">
                <div>
                  <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-auto fill-slate-50">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                  </svg>
                  <span class="whitespace-nowrap text-center font-semibold">
                    Задачи
                  </span>
                </div>
              </li>
              <li id="warehouse-btn" @click="mobWarehouse = true; mobOrder = false; mobProfile = false" :class="mobWarehouse ? 'bg-blue-50':'bg-white'" class="h-[88px] w-[88px] rounded-md shadow-xl border border-slate-100 flex items-center justify-center cursor-pointer transition-all active:scale-90">
                <div>
                  <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-auto fill-slate-50">
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
            <li id="mobile-log-out" class="h-[88px] w-[88px] bg-white rounded-md shadow-xl border border-slate-100 flex items-center justify-center cursor-pointer transition-all active:scale-90 text-slate-600 mt-[269px]">
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

        <section>
          <div class="ml-28">
            <div v-show="mobProfile">
              <div class="flex items-center justify-end bg-[#f8f8f8] w-full h-14 border-b-2 border-slate-200"></div>
              <div class="flex p-4 space-x-5">
                <div class="w-[40%] shadow-xl border border-slate-100 flex items-center justify-center py-[82px] text-slate-600 rounded-md">
                  <?php
                  $query = "SELECT * FROM users WHERE pid = '$pid'";
                  $query_run = mysqli_query($con, $query);

                  while ($rows = mysqli_fetch_array($query_run)) { ?>
                    <div>
                      <svg viewBox="0 0 24 24" fill="currentColor" class="w-36 h-36 mx-auto text-[#407cb2]">
                        <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                      </svg>
                      <div class="text-2xl uppercase font-bold mt-3 text-center"><?= $rows['name'] ?></div>
                      <div class="text-xl text-center font-semibold"><?= $rows['position'] ?></div>
                      <div class="text-xl text-center font-semibold"><?= $rows['pid'] ?></div>
                      <div class="text-lg mt-28 text-center">IP ADDRESS: 10.192.217.58</div>
                      <div class="text-xl uppercase text-center font-bold">Carpet Services Desk</div>
                      <div class="text-2xl font-bold text-[#407cb2] text-center">052 349 743</div>
                      <div class="text-center text-sm font-bold mb-20">ver 1.13 &copy; 12.01.2023</div>
                    </div>
                  <?php } ?>
                </div>
                <div class="w-[60%] space-y-5">
                  <div class="px-5 py-10 rounded-md shadow-xl border border-slate-100">
                    <form id="update-password-mobile-form">
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
                        <input id="second-pass" :type="mobileNewPassword ? 'text':'password'" name="newPassword" autocomplete="off" minlength="5" class="block pr-8 py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-500 peer" placeholder=" " />
                        <label for="second-pass" class="peer-focus:font-medium absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Нова парола</label>
                        <div @click="mobileNewPassword = !mobileNewPassword" class="absolute inset-y-0 right-1.5 flex items-center pl-3 cursor-pointer">
                          <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-gray-400 active:scale-90 transition-all">
                            <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                            <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" clip-rule="evenodd" />
                          </svg>
                        </div>
                      </div>
                      <div class="relative z-0 w-full mb-5 group">
                        <input id="third-pass" :type="mobileRepPassword ? 'text':'password'" name="passwordRep" autocomplete="off" minlength="5" class="block pr-8 py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-500 peer" placeholder=" " />
                        <label for="third-pass" class="peer-focus:font-medium absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Потвърдете паролата</label>
                        <div @click="mobileRepPassword = !mobileRepPassword" class="absolute inset-y-0 right-1.5 flex items-center pl-3 cursor-pointer">
                          <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-gray-400 active:scale-90 transition-all">
                            <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                            <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" clip-rule="evenodd" />
                          </svg>
                        </div>
                      </div>
                      <div class="flex justify-end w-full">
                        <button type="submit" class="px-2.5 py-1.5 text-sm font-semibold uppercase bg-white border border-[#407cb2] text-[#407cb2] focus:outline-none transition-all active:scale-90 rounded">Потвърди</button>
                      </div>
                    </form>
                  </div>
                  <div class="px-5 py-[65px] rounded-md shadow-xl border border-slate-100">
                    <canvas id="orders-chart"></canvas>
                  </div>
                </div>
              </div>
            </div>

            <div v-show="mobOrder" id="mobOrder">
              <div class="flex items-center justify-end bg-[#f8f8f8] w-full h-14 border-b-2 border-slate-200 px-5">
                <div class="flex space-x-3.5">
                  <input type="text" id="search-mobile-order" :class="showSearchInput ? 'block' : 'hidden'" class="bg-white border border-blue-200 text-slate-800 text-sm rounded focus:bg-slate-50 focus:outline-none h-7 w-44 p-0.5 px-2 animate__animated animate__slideInDown" placeholder="Търсене" />
                  <svg @click="showSearchInput = true" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" :class="showSearchInput ? 'hidden' : 'block'" class="w-7 h-7 text-blue-400 hover:text-blue-300 active:scale-90 transition-all cursor-pointer">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                  </svg>
                  <svg id="sort-btn" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor" class="w-7 h-7 text-blue-400 hover:text-blue-300 active:scale-90 transition-all cursor-pointer">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                  </svg>
                </div>
              </div>
              <div class="w-full flex items-center text-slate-600">
                <div id="1" @click="activeOrder = true; finishedOrder = false" :class="activeOrder ? 'bg-slate-50 text-blue-400 border-b-2 border-blue-400':'bg-white'" class="w-1/2 flex items-center justify-center py-2.5 border-b-2 border-slate-100 box-border cursor-pointer text-sm font-semibold order-state-btn">
                  <div>Неприключени</div>
                  <div id="active-order" :class="activeOrder ? 'border-blue-300':'border-slate-200'" class="rounded-full border ml-2 h-7 w-7 flex items-center justify-center"></div>
                </div>
                <div id="2" @click="finishedOrder = true; activeOrder = false" :class="finishedOrder ? 'bg-slate-50 text-blue-400 border-b-2 border-blue-400':'bg-white'" class="w-1/2 flex items-center justify-center py-2.5 border-b-2 border-slate-100 box-border cursor-pointer text-sm font-semibold order-state-btn">
                  <div>Приключени</div>
                  <div id="finished-order" :class="finishedOrder ? 'border-blue-300':'border-slate-200'" class="rounded-full ml-2 h-7 w-7 border flex items-center justify-center"></div>
                </div>
                <input type="hidden" id="active-btn" value="1" />
              </div>
              <div v-show="activeOrder" id="active-order-section" class="px-4 space-y-4">
                <?php
                $query = "SELECT * FROM users WHERE pid = '$pid'";
                $query_run = mysqli_query($con, $query);

                while ($rows = mysqli_fetch_array($query_run)) {
                  $teamID = $rows['team_id'];

                  $query = "SELECT * FROM orders WHERE team_id = '$teamID' AND (status = 'Назначена' OR status = 'В процес') AND date = '$date_now'";
                  $query_run = mysqli_query($con, $query);
                  $num = mysqli_num_rows($query_run);

                  if ($num > 0) {
                    while ($rows = mysqli_fetch_array($query_run)) { ?>
                      <input class="active-order-count" type="hidden" value="<?= $num ?>" />
                      <button class="w-full focus:outline-none get-order-data" type="button" value="<?= $rows['id'] ?>">
                        <div class="flex items-center justify-between w-full rounded border border-slate-100 shadow-lg p-3 cursor-pointer active:scale-95 transition-all">
                          <div class="flex items-center w-full">
                            <div class="h-10 w-10 bg-blue-300 shadow-lg rounded-full flex items-center justify-center">
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
                            <div class="text-slate-700 space-y-[1px] w-3/12 ml-5">
                              <div class="text-left uppercase font-bold text-sm">Почистване на: <?= $rows['room'] ?></div>
                              <div class="flex items-center text-sm">
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 mr-1">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span>Клиент: <span class="font-semibold"><?= $rows['customer_name'] ?></span></span>
                              </div>
                            </div>
                            <div class="text-slate-700 space-y-[1px] w-3/12">
                              <div class="flex items-center text-sm">
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 mr-1 text-gray-500">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 00-1.883 2.542l.857 6a2.25 2.25 0 002.227 1.932H19.05a2.25 2.25 0 002.227-1.932l.857-6a2.25 2.25 0 00-1.883-2.542m-16.5 0V6A2.25 2.25 0 016 3.75h3.879a1.5 1.5 0 011.06.44l2.122 2.12a1.5 1.5 0 001.06.44H18A2.25 2.25 0 0120.25 9v.776" />
                                </svg>
                                <span>Заявка номер: <span class="font-semibold"><?= $rows['id'] ?></span></span>
                              </div>
                              <div class="flex items-center text-sm">
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 mr-1 text-green-500">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Час: <span class="font-semibold"><?= $rows['time'] ?></span></span>
                              </div>
                              <div class="flex items-center text-sm">
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 mr-1 text-red-500">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                </svg>
                                <span>Дата: <span class="font-semibold"><?= date("d.m.Y", strtotime($rows['date'])) ?></span></span>
                              </div>
                            </div>
                            <div class="text-slate-700 space-y-[1px] w-1/5">
                              <div class="text-sm text-center">Начин на плащане</div>
                              <div class="text-sm text-center"><b><?= $rows['pay'] ?></b></div>
                            </div>
                            <div class="w-3/12 flex justify-center mr-5">
                              <div class="text-<?= $rows['status'] == "Назначена" ? "blue-400" : "yellow-500" ?> border border-<?= $rows['status'] == "Назначена" ? "blue-400" : "yellow-500" ?> py-1.5 px-3.5 text-sm font-semibold rounded-full ml-20 w-fit"><?= $rows['status'] ?></div>
                            </div>
                          </div>
                          <div>
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-10 h-10 text-blue-400">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                          </div>
                        </div>
                      </button>
                    <?php }
                  } else { ?>
                    <input class="active-order-count" type="hidden" value="<?= $num ?>" />
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-lg font-semibold text-slate-700">Няма назначени задачи</div>
                <?php }
                } ?>
              </div>

              <div v-show="finishedOrder" id="finished-order-section" class="px-4">
                <?php
                $query = "SELECT * FROM users WHERE pid = '$pid'";
                $query_run = mysqli_query($con, $query);

                while ($rows = mysqli_fetch_array($query_run)) {
                  $teamID = $rows['team_id'];

                  $query = "SELECT * FROM orders WHERE team_id = '$teamID' AND (status = 'Приключена' OR status = 'Отказана') AND date = '$date_now'";
                  $query_run = mysqli_query($con, $query);
                  $num = mysqli_num_rows($query_run);

                  if ($num > 0) {
                    while ($rows = mysqli_fetch_array($query_run)) { ?>
                      <input class="finished-order-count" type="hidden" value="<?= $num ?>" />
                      <button class="w-full focus:outline-none mt-4 get-order-data" type="button" value="<?= $rows['id'] ?>">
                        <div class="flex items-center justify-between w-full rounded-sm border border-slate-100 shadow-lg p-3 cursor-pointer active:scale-95 transition-all">
                          <div class="flex items-center w-full">
                            <div class="h-10 w-10 bg-blue-300 shadow-lg rounded-full flex items-center justify-center">
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
                            <div class="text-slate-700 space-y-[1px] w-3/12 ml-5">
                              <div class="text-left uppercase font-bold text-sm">Почистване на: <?= $rows['room'] ?></div>
                              <div class="flex items-center text-sm">
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 mr-1">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span>Клиент: <span class="font-semibold"><?= $rows['customer_name'] ?></span></span>
                              </div>
                            </div>
                            <div class="text-slate-700 space-y-[1px] w-3/12">
                              <div class="flex items-center text-sm">
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 mr-1 text-gray-500">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 00-1.883 2.542l.857 6a2.25 2.25 0 002.227 1.932H19.05a2.25 2.25 0 002.227-1.932l.857-6a2.25 2.25 0 00-1.883-2.542m-16.5 0V6A2.25 2.25 0 016 3.75h3.879a1.5 1.5 0 011.06.44l2.122 2.12a1.5 1.5 0 001.06.44H18A2.25 2.25 0 0120.25 9v.776" />
                                </svg>
                                <span>Заявка номер: <span class="font-semibold"><?= $rows['id'] ?></span></span>
                              </div>
                              <div class="flex items-center text-sm">
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 mr-1 text-green-500">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Час: <span class="font-semibold"><?= $rows['time'] ?></span></span>
                              </div>
                              <div class="flex items-center text-sm">
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 mr-1 text-red-500">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                </svg>
                                <span>Дата: <span class="font-semibold"><?= date("d.m.Y", strtotime($rows['date'])) ?></span></span>
                              </div>
                            </div>
                            <div class="text-slate-700 space-y-[1px] w-1/5">
                              <div class="text-sm text-center">Начин на плащане</div>
                              <div class="text-sm text-center"><b><?= $rows['pay'] ?></b></div>
                            </div>
                            <div class="w-3/12 flex justify-center mr-5">
                              <div class="text-<?= $rows['status'] == "Приключена" ? "green-400" : "red-400" ?> border border-<?= $rows['status'] == "Приключена" ? "green-400" : "red-400" ?> py-1.5 px-3.5 text-sm font-semibold rounded-full ml-20 w-fit"><?= $rows['status'] ?></div>
                            </div>
                          </div>
                          <div>
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-10 h-10 text-blue-400">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                          </div>
                        </div>
                      </button>
                    <?php }
                  } else { ?>
                    <input class="finished-order-count" type="hidden" value="<?= $num ?>" />
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-lg font-semibold text-slate-700">Няма приключени задачи</div>
                <?php }
                } ?>
              </div>
            </div>

            <div id="order-not-started" class="hidden">
              <div class="flex items-center justify-end bg-[#f8f8f8] w-full h-14 border-b-2 border-slate-200"></div>
              <div class="p-4">
                <div class="hidden bg-white absolute left-28 top-14 inset-0 z-40 order-start-loader">
                  <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                    <div role="status">
                      <svg aria-hidden="true" class="w-12 h-12 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600 mx-auto" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                      </svg>
                      <div class="mt-1.5 text-slate-700 font-semibold text-lg">Зареждане</div>
                    </div>
                  </div>
                </div>
                <div class="text-2xl font-bold text-blue-400 border-b-2 border-slate-100 pl-5 pb-3 mb-5">Почистване на Къща</div>
                <div class="flex w-full space-x-2">
                  <div class="w-1/2">
                    <div class="flex items-center w-full mb-5">
                      <div class="w-[15%] flex justify-center">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" class="w-12 h-12 text-gray-400 fill-slate-50">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                      </div>
                      <div class="ml-1.5 w-[85%] border-b-2 border-slate-100 pb-2">
                        <div class="text-slate-700 font-bold">Клиент</div>
                        <div id="customer-name-mobile" class="text-slate-500 uppercase"></div>
                      </div>
                    </div>
                    <div class="flex items-center w-full mb-5">
                      <div class="w-[15%] flex justify-center">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" class="w-12 h-12 text-gray-400 fill-slate-50">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1m1.5.5l-1.5-.5M6.75 7.364V3h-3v18m3-13.636l10.5-3.819" />
                        </svg>
                      </div>
                      <div class="ml-1.5 w-[85%] border-b-2 border-slate-100 pb-2">
                        <div class="text-slate-700 font-bold">Адрес</div>
                        <div id="address-mobile" class="text-slate-500 uppercase"></div>
                      </div>
                    </div>
                    <div class="flex items-center w-full mb-5">
                      <div class="w-[15%] flex justify-center">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" class="w-12 h-12 text-gray-400 fill-slate-50">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                        </svg>
                      </div>
                      <div class="ml-1.5 w-[85%] border-b-2 border-slate-100 pb-2">
                        <div class="text-slate-700 font-bold">Начин на плащане</div>
                        <div id="pay-mobile" class="text-slate-500 uppercase"></div>
                      </div>
                    </div>
                    <div class="flex items-center w-full mb-5">
                      <div class="w-[15%] flex justify-center">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" class="w-12 h-12 text-gray-400 fill-slate-50">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                        </svg>
                      </div>
                      <div class="ml-1.5 w-[85%] border-b-2 border-slate-100 pb-2">
                        <div class="text-slate-700 font-bold">Вид оферта</div>
                        <div id="offer-mobile" class="text-slate-500 uppercase"></div>
                      </div>
                    </div>
                  </div>
                  <div class="w-1/2">
                    <div class="flex items-center w-full mb-5">
                      <div class="w-[15%] flex justify-center">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" class="w-12 h-12 text-gray-400 fill-slate-50">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                        </svg>
                      </div>
                      <div class="ml-1.5 w-[85%] border-b-2 border-slate-100 pb-2">
                        <div class="text-slate-700 font-bold">Дата и час</div>
                        <div id="date-time-mobile" class="text-slate-500 uppercase"></div>
                      </div>
                    </div>
                    <div class="flex items-center w-full mb-5">
                      <div class="w-[15%] flex justify-center">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" class="w-12 h-12 text-gray-400 fill-slate-50">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 15.75V18m-7.5-6.75h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V13.5zm0 2.25h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V18zm2.498-6.75h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V13.5zm0 2.25h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V18zm2.504-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zm0 2.25h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V18zm2.498-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zM8.25 6h7.5v2.25h-7.5V6zM12 2.25c-1.892 0-3.758.11-5.593.322C5.307 2.7 4.5 3.65 4.5 4.757V19.5a2.25 2.25 0 002.25 2.25h10.5a2.25 2.25 0 002.25-2.25V4.757c0-1.108-.806-2.057-1.907-2.185A48.507 48.507 0 0012 2.25z" />
                        </svg>
                      </div>
                      <div class="ml-1.5 w-[85%] border-b-2 border-slate-100 pb-2">
                        <div class="text-slate-700 font-bold">Квадратура</div>
                        <div id="m2-mobile" class="text-slate-500 uppercase"></div>
                      </div>
                    </div>
                    <div class="flex items-center w-full mb-5">
                      <div class="w-[15%] flex justify-center">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" class="w-12 h-12 text-gray-400 fill-slate-50">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                      </div>
                      <div class="ml-1.5 w-[85%] border-b-2 border-slate-100 pb-2">
                        <div class="text-slate-700 font-bold">Цена</div>
                        <div id="price-mobile" class="text-slate-500 uppercase"></div>
                      </div>
                    </div>
                    <div class="flex items-center w-full mb-5">
                      <div class="w-[15%] flex justify-center">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-gray-400 fill-slate-50">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                        </svg>
                      </div>
                      <div class="ml-1.5 w-[85%] border-b-2 border-slate-100 pb-2">
                        <div class="text-slate-700 font-bold">Телефон</div>
                        <div id="phone-mobile" class="text-slate-500 uppercase"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="flex items-center w-full">
                  <div class="w-[7.5%] flex justify-center">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-gray-400 fill-slate-50">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                    </svg>
                  </div>
                  <div class="w-[92.5%] ml-1.5 border-b-2 border-slate-100 pb-2">
                    <div class="text-slate-700 font-bold">Допънителна информация</div>
                    <div id="information-mobile" class="text-slate-500 uppercase"></div>
                  </div>
                </div>
                <div id="order-start-btn" class="flex items-center justify-end space-x-4 mt-[238px]">
                  <button type="button" class="px-4 py-2 bg-red-500 text-white font-semibold rounded active:scale-90 transition-all w-52 open-cancel-modal">
                    Откажи
                  </button>
                  <button type="button" class="px-4 py-2 bg-amber-500 text-white font-semibold rounded active:scale-90 transition-all w-52 open-photo-modal">
                    Снимки
                  </button>
                  <button type="button" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded active:scale-90 transition-all w-52 start-order-btn">
                    Старт
                  </button>
                </div>
              </div>
            </div>
            <div id="order-is-started" class="hidden">
              <div class="flex items-center justify-end bg-[#f8f8f8] w-full h-14 border-b-2 border-slate-200"></div>
              <div class="p-4">
                <img class="h-[30rem] w-[30rem] object-cover absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded-full opacity-[0.16]" :src="orderImg[orderStateStep]">
                <div class="p-6 mt-12 relative z-50">
                  <h1 class="text-2xl font-bold text-blue-400 mb-1">{{ orderState[orderStateStep] }}</h1>
                  <div class="mb-6">
                    <span class="inline-block w-40 h-[3px] bg-blue-400 rounded-full"></span>
                    <span class="inline-block w-3 h-[3px] ml-1 bg-blue-400 rounded-full"></span>
                    <span class="inline-block w-1 h-[3px] ml-1 bg-blue-400 rounded-full"></span>
                  </div>
                  <div class="w-full mt-2">
                    <div class="flex flex-wrap">
                      <div class="w-full md:w-6/12">
                        <div class="relative flex flex-col mr-6 mb-6">
                          <div :class="{'animate-pulse': orderStateStep == 0}" class="bg-white border border-slate-100 rounded-md shadow-xl py-2.5 px-4 opacity-75 flex-auto">
                            <div :class="{'bg-green-50 border-green-100': orderStateStep >= 1}" class="p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-xl border border-slate-50 rounded-full bg-white">
                              <svg v-show="orderStateStep == 0" fill="none" viewBox="0 0 24 24" stroke-width="1.4" stroke="currentColor" class="w-6 h-6 text-slate-700">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 01-1.125-1.125v-3.75zM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-8.25zM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-2.25z" />
                              </svg>
                              <svg v-show="orderStateStep >= 1" fill="none" viewBox="0 0 24 24" stroke-width="1.4" stroke="currentColor" class="w-6 h-6 text-green-300">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                              </svg>
                            </div>
                            <h6 :class="{'text-green-600': orderStateStep >= 1}" class="mb-1 font-bold">1. Почистване на повърхности</h6>
                            <p :class="{'text-green-600': orderStateStep >= 1}" class="mb-4 text-blueGray-500 text-sm font-semibold">
                              Почистване на всички мебели и техника с микрофибърна кърпа и препарат за повърхности.
                            </p>
                          </div>
                        </div>
                        <div class="relative flex flex-col min-w-0 mt-6 mr-6">
                          <div :class="{'animate-pulse': orderStateStep == 1}" class="bg-white border border-slate-100 rounded-md shadow-xl py-2.5 px-4 opacity-75 flex-auto">
                            <div :class="{'bg-green-50 border-green-100': orderStateStep >= 2}" class="p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-white">
                              <svg :class="{'hidden': orderStateStep >= 2}" fill="none" viewBox="0 0 24 24" stroke-width="1.4" stroke="currentColor" class="w-6 h-6 text-slate-700">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8.25V18a2.25 2.25 0 002.25 2.25h13.5A2.25 2.25 0 0021 18V8.25m-18 0V6a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 6v2.25m-18 0h18M5.25 6h.008v.008H5.25V6zM7.5 6h.008v.008H7.5V6zm2.25 0h.008v.008H9.75V6z" />
                              </svg>
                              <svg v-show="orderStateStep >= 2" fill="none" viewBox="0 0 24 24" stroke-width="1.4" stroke="currentColor" class="w-6 h-6 text-green-300">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                              </svg>
                            </div>
                            <h6 :class="{'text-green-600': orderStateStep >= 2}" class="mb-1 font-bold">
                              2. Почистване на стъклени повърхности
                            </h6>
                            <p :class="{'text-green-600': orderStateStep >= 2}" class="mb-4 text-blueGray-500 text-sm font-semibold">
                              Почистване на всички стъклени повърхности с микрофибърна кърпа и препарат за стъкла.
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="w-full md:w-6/12">
                        <div class="relative flex flex-col min-w-0 mb-6">
                          <div :class="{'animate-pulse': orderStateStep == 2}" class="bg-white border border-slate-100 rounded-md shadow-xl py-2.5 px-4 opacity-75 flex-auto">
                            <div :class="{'bg-green-50 border-green-100': orderStateStep >= 3}" class="p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-white">
                              <svg :class="{'hidden': orderStateStep >= 3}" fill="none" viewBox="0 0 24 24" stroke-width="1.4" stroke="currentColor" class="w-6 h-6 text-slate-700">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-2.25-1.313M21 7.5v2.25m0-2.25l-2.25 1.313M3 7.5l2.25-1.313M3 7.5l2.25 1.313M3 7.5v2.25m9 3l2.25-1.313M12 12.75l-2.25-1.313M12 12.75V15m0 6.75l2.25-1.313M12 21.75V19.5m0 2.25l-2.25-1.313m0-16.875L12 2.25l2.25 1.313M21 14.25v2.25l-2.25 1.313m-13.5 0L3 16.5v-2.25" />
                              </svg>
                              <svg v-show="orderStateStep >= 3" fill="none" viewBox="0 0 24 24" stroke-width="1.4" stroke="currentColor" class="w-6 h-6 text-green-300">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                              </svg>
                            </div>
                            <h6 :class="{'text-green-600': orderStateStep >= 3}" class=" mb-1 font-bold">3. Почистване на общи части</h6>
                            <p :class="{'text-green-600': orderStateStep >= 3}" class=" mb-4 text-blueGray-500 text-sm font-semibold">
                              Почистване на всички бани, тоалетни, килери градински пространства с прахосмукачка и препарати.
                            </p>
                          </div>
                        </div>
                        <div class="relative flex flex-col min-w-0 mt-6">
                          <div :class="{'animate-pulse': orderStateStep == 3}" class="bg-white border border-slate-100 rounded-md shadow-xl py-2.5 px-4 opacity-75 flex-auto">
                            <div :class="{'bg-green-50 border-green-100': orderStateStep == 4}" class="p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-white">
                              <svg :class="{'hidden': orderStateStep == 4}" fill="none" viewBox="0 0 24 24" stroke-width="1.4" stroke="currentColor" class="w-6 h-6 text-slate-700">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23-.693L5 14.5m14.8.8l1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0112 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5" />
                              </svg>
                              <svg v-show="orderStateStep == 4" fill="none" viewBox="0 0 24 24" stroke-width="1.4" stroke="currentColor" class="w-6 h-6 text-green-300">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                              </svg>
                            </div>
                            <h6 :class="{'text-green-600': orderStateStep == 4}" class="mb-1 font-bold">4. Почистване на под</h6>
                            <p :class="{'text-green-600': orderStateStep == 4}" class="mb-4 text-blueGray-500 text-sm font-semibold">
                              Почистване на пода с прахосмукачка и моп с препарат за под и дървени повърхности.
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="w-full flex justify-end mt-6">
                        <button :value="orderStateStep" v-show="orderStateStep < 4" type="button" @click="orderStateStep++" class="bg-blue-500 py-2 rounded text-white font-semibold focus:outline-none active:scale-90 transition-all w-52 next-step-mobile">Напред</button>
                        <button id="end-order" v-show="orderStateStep == 4" type="button" class="bg-blue-500 p-2 rounded text-white font-semibold focus:outline-none active:scale-90 transition-all w-52 end-order">Край</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>

      <?php
      $query = "SELECT * FROM orders WHERE team_id = '$teamID' AND date = '$date_now'";
      $query_run = mysqli_query($con, $query);
      $num = mysqli_num_rows($query_run); ?>
      <input type="hidden" value="<?= $num ?>" id="order-count">

      <div v-show="mobWarehouse">
        <div class="flex items-center justify-end bg-[#f8f8f8] w-full h-14 border-b-2 border-slate-200 px-5 ">
          <div class="flex space-x-3.5">
            <svg id="make-order-btn" fill="none" viewBox="0 0 24 24" stroke-width="1.4" stroke="currentColor" class="w-7 h-7 text-blue-400 hover:text-blue-300 active:scale-90 transition-all cursor-pointer">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <svg id="show-product-btn" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 text-blue-400 hover:text-blue-300 active:scale-90 transition-all cursor-pointer">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
            </svg>
          </div>
        </div>
        <div id="mobile-warehouse-section">
          <div class="ml-28 px-4 space-y-4 my-4">
            <?php
            $query = "SELECT *, SUM(set_products.quantity) as quantity_sum FROM users LEFT JOIN set_products ON users.team_id = set_products.team_id
            WHERE users.pid = ? GROUP BY set_products.product_name, users.team_id";

            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, "s", $pid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            while ($rows = mysqli_fetch_array($result)) {
              $quantity = $rows['quantity_sum'];

              if ($quantity != 0) { ?>
                <div class="flex items-center justify-between w-full rounded-sm border border-slate-100 shadow-lg px-3 py-3.5 transition-all">
                  <div class="flex items-center w-full">
                    <div class="h-10 w-10 bg-blue-300 shadow-lg rounded-full flex items-center justify-center">
                      <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-6 h-6 text-slate-100">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                      </svg>
                    </div>
                    <div class="text-slate-700 space-y-[1px] w-2/5 ml-5">
                      <div class="text-left uppercase font-semibold text-sm">Тип продукт: <span class="font-bold"><?= $rows['product_name'] ?></span></div>
                      <div class="flex items-center text-sm">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-4 h-4 mr-1">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                        </svg>
                        <span>Вид на продукт: <span class="font-semibold"><?= $rows['kind'] ?></span></span>
                      </div>
                    </div>
                    <div class="text-slate-700 space-y-[1px] w-2/5">
                      <div class="text-sm flex items-center justify-center">
                        <div class="uppercase font-bold">Количество</div>
                        <div class="w-6 h-6 ml-1.5 bg-blue-300 rounded font-semibold flex items-center justify-center text-white font-semibold">
                          <?= $quantity ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <input id="get-team-id-mobile" type="hidden" value="<?= $rows['team_id'] ?>" />
                  <div class="flex items-center space-x-2">
                    <button id="remove-product-btn" value="<?= $rows['product_name'] ?>" class="bg-red-500 h-9 w-9 flex items-center justify-center text-white rounded-sm active:scale-90 transition-all">
                      <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                      </svg>
                    </button>
                    <button id="return-product-btn" value="<?= $rows['product_name'] ?>" class="bg-blue-600 h-9 w-9 flex items-center justify-center text-white rounded-sm active:scale-90 transition-all">
                      <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                      </svg>
                    </button>
                  </div>
                </div>
              <?php } else { ?>
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-lg font-semibold text-slate-700">Няма назначени продукти</div>
            <?php }
            } ?>
          </div>
        </div>
      </div>
  </div>
  </section>

  <div id="return-product-modal" class="bg-gray-800 hidden bg-opacity-50 fixed inset-0 z-40">
    <div class="h-full w-full p-5 overflow-x-hidden overflow-y-auto flex justify-center items-center">
      <div class="relative w-full h-auto max-w-md animate__animated animate__zoomIn animate__fast">
        <div class="relative bg-white rounded shadow mb-6">
          <div class="text-xl font-bold text-white bg-red-500 py-2 rounded-t text-center">
            Връщане на продуктите
          </div>
          <input type="hidden" id="get-product-name-return" />
          <div class="w-full text-center font-semibold pb-2 pt-6 text-lg text-slate-700 px-4">
            Сигурни ли сте, че искате да върнете тези продукти ?
          </div>
          <div class="flex items-center p-4">
            <button type="button" class="flex-1 px-4 py-1.5 bg-red-500 text-white text-sm font-semibold rounded active:scale-90 transition-all close-return-product-modal">
              Затвори
            </button>
            <button type="button" class="flex-1 px-4 py-1.5 bg-blue-500 text-white text-sm font-semibold rounded active:scale-90 transition-all ml-3 return-all-product">
              Върни
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="sort-order-modal" class="bg-gray-800 hidden bg-opacity-50 fixed inset-0 z-40">
    <div class="h-full w-full p-5 overflow-x-hidden overflow-y-auto flex justify-center items-center">
      <div class="relative w-full h-auto max-w-md animate__animated animate__zoomIn animate__fast">
        <div class="relative bg-white rounded shadow mb-6">
          <div class="text-xl font-bold text-white bg-blue-500 py-2 rounded-t text-center">
            Сортиране
          </div>
          <div class="p-4 text-center">
            <form id="sort-order-form">
              <div class="flex gap-x-5 w-full mt-1 mb-5">
                <div class="w-full">
                  <input class="sr-only peer" checked type="radio" value="id" name="sort" id="first" />
                  <label class="flex items-center justify-center text-slate-600 p-3 peer-checked:bg-blue-50 bg-white border border-blue-100 rounded-md cursor-pointer focus:outline-none peer-checked:border-blue-200" for="first">
                    <div>
                      <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-auto">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                      </svg>
                      <div class="font-semibold">Номер</div>
                    </div>
                  </label>
                </div>
                <div class="w-full">
                  <input class="sr-only peer" type="radio" value="customer_name" name="sort" id="second" />
                  <label class="flex items-center justify-center text-slate-600 p-3 peer-checked:bg-blue-50 bg-white border border-blue-100 rounded-md cursor-pointer focus:outline-none peer-checked:border-blue-200" for="second">
                    <div>
                      <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 mx-auto">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                      </svg>
                      <div class="font-semibold">Име</div>
                    </div>
                  </label>
                </div>
                <div class="w-full">
                  <input class="sr-only peer" type="radio" value="address" name="sort" id="third" />
                  <label class="flex items-center justify-center text-slate-600 p-3 peer-checked:bg-blue-50 bg-white border border-blue-100 rounded-md cursor-pointer focus:outline-none peer-checked:border-blue-200" for="third">
                    <div>
                      <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-auto">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1m1.5.5l-1.5-.5M6.75 7.364V3h-3v18m3-13.636l10.5-3.819" />
                      </svg>
                      <div class="font-semibold">Адрес</div>
                    </div>
                  </label>
                </div>
              </div>
              <div class="flex items-center mt-3">
                <button type="button" class="flex-1 px-4 py-1.5 bg-red-500 text-white text-sm font-semibold rounded active:scale-90 transition-all close-sort-order-modal">
                  Откажи
                </button>
                <button type="button" class="flex-1 px-4 py-1.5 bg-blue-500 text-white text-sm font-semibold rounded active:scale-90 transition-all ml-3 close-sort-order-modal">
                  Запази
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

  <div id="order-photo-modal" class="bg-gray-800 hidden bg-opacity-50 fixed inset-0 z-40">
    <div class="h-full w-full p-5 overflow-x-hidden overflow-y-auto flex justify-center items-center">
      <div class="relative w-full h-auto animate__animated animate__zoomIn animate__fast image-modal">
        <div class="relative bg-white rounded shadow mb-6">
          <div class="text-xl font-bold text-white bg-blue-500 py-2 rounded-t text-center">
            Снимки на обекта
          </div>
          <div class="p-4 text-center flex items-center justify-center space-x-4">
            <img id="first_img" class="w-[202px] h-[202px] object-cover rounded">
            <img id="second_img" class="w-[202px] h-[202px] object-cover rounded">
            <img id="third_img" class="w-[202px] h-[202px] object-cover rounded">
          </div>
          <div class="flex items-center pt-3 p-4">
            <button type="button" class="flex-1 px-4 py-1.5 bg-slate-100 border border-slate-200 text-slate-700 text-sm font-semibold rounded active:scale-90 transition-all close-order-photo-modal">
              Затвори
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="product-order-modal" class="bg-gray-800 hidden bg-opacity-50 fixed inset-0 z-40">
    <div class="h-full w-full p-5 overflow-x-hidden overflow-y-auto flex justify-center items-center">
      <div class="relative w-full h-auto max-w-md animate__animated animate__zoomIn animate__fast">
        <div class="relative bg-white rounded shadow mb-6">
          <div class="text-xl font-bold text-white bg-blue-500 py-2 rounded-t text-center">
            Заявка за продукт
          </div>
          <?php
          $query = "SELECT * FROM users WHERE pid = '$pid'";
          $query_run = mysqli_query($con, $query);

          while ($rows = mysqli_fetch_assoc($query_run)) { ?>
            <form id="product-request-form">
              <div class="p-4 text-center">
                <select id="get-product-kind" class="bg-white mb-5 border border-gray-300 text-slate-700 text-sm rounded focus:outline-none block w-full p-2.5 w-[248px] text-center mx-auto">
                  <option hidden selected>Изберете вид продукт</option>
                  <option value="Екипировка">Екипировка</option>
                  <option value="Препарати">Препарати</option>
                  <option value="Пособия за чистене">Пособия за чистене</option>
                  <option value="Техника">Техника</option>
                </select>
                <select id="all-product" name="product" class="bg-white mb-5 border border-gray-300 text-slate-700 text-sm rounded focus:outline-none hidden w-full p-2.5 w-[248px] text-center mx-auto"></select>
                <div class="flex items-center justify-center space-x-5">
                  <div id="add-one-product" class="w-10 h-10 rounded border border-gray-300 shadow-xl flex items-center justify-center active:scale-90 transition-all cursor-pointer">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-slate-700">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                    </svg>
                  </div>
                  <input id="product-count-mobile" type="text" value="1" name="quantity" class="bg-white border border-gray-300 text-slate-700 text-sm rounded focus:outline-none block w-32 p-2.5 text-center">
                  <input type="hidden" value="<?= $rows["team_id"] ?>" name="teamId">
                  <div id="remove-one-product" class="w-10 h-10 rounded border border-gray-300 shadow-xl flex items-center justify-center active:scale-90 transition-all cursor-pointer">
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
          <?php } ?>
        </div>
      </div>
    </div>
  </div>

  <div id="product-show-modal" class="bg-gray-800 hidden bg-opacity-50 fixed inset-0 z-40">
    <div class="h-full w-full p-5 overflow-x-hidden overflow-y-auto flex justify-center">
      <div class="relative w-full h-full max-w-xs animate__animated animate__zoomIn animate__fast">
        <div class="relative bg-white rounded shadow mb-6">
          <div class="text-xl font-bold text-white bg-blue-500 py-2 rounded-t text-center">
            Код на продуктите
          </div>
          <div class="p-5">
            <?php
            $query = "SELECT * FROM stocks";
            $query_run = mysqli_query($con, $query);

            while ($rows = mysqli_fetch_assoc($query_run)) { ?>
              <ul>
                <li class="mb-0.5"><?= $rows["id"] ?>. <?= $rows["name"] ?></li>
              </ul>
            <?php } ?>
          </div>
          <div class="flex items-center pt-0 p-4">
            <button type="button" class="flex-1 px-4 py-1.5 bg-slate-100 border border-slate-200 text-slate-700 text-sm font-semibold rounded active:scale-90 transition-all close-show-product-modal">
              Затвори
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="cancel-order-modal" class="bg-gray-800 hidden bg-opacity-50 fixed inset-0 z-40">
    <div class="h-full w-full p-5 overflow-x-hidden overflow-y-auto flex justify-center items-center">
      <div class="relative w-full h-auto max-w-md animate__animated animate__zoomIn animate__fast">
        <div class="relative bg-white rounded shadow mb-6">
          <div class="text-xl font-bold text-white bg-red-500 py-2 rounded-t text-center">
            Приключавне на заявката
          </div>
          <form id="order-cancel-form">
            <div class="px-4 py-2 text-center">
              <input type="hidden" id="order-id-cancel" name="id">
              <textarea rows="4" name="text" class="block p-2.5 w-full text-sm text-slate-700 rounded border border-slate-300 focus:outline-none mt-4 resize-none" placeholder="Напишете каква е причината за отказа..."></textarea>
            </div>
            <div class="flex items-center p-4">
              <button type="button" class="flex-1 px-4 py-1.5 bg-red-500 text-white text-sm font-semibold rounded active:scale-90 transition-all close-cancel-order-modal">
                Затвори
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
<?php } else { ?>
  <div id="mobile-login" class="fixed inset-0 block">
    <div class="h-full w-full flex justify-center items-center">
      <div class="w-[30rem] relative h-auto">
        <form id="mobile-login-form" class="mt-6 mb-0 space-y-4 rounded-lg p-8 shadow-2xl text-slate-700">
          <p class="text-xl text-center font-bold">Carpet Services</p>
          <div>
            <label for="login-pid" class="ml-1 text-sm font-semibold">ПИД</label>
            <div class="relative mt-1">
              <input type="text" id="login-pid" name="pid" class="w-full rounded-lg border border-slate-50 p-2.5 text-sm shadow-sm focus:border-slate-100 focus:outline-none" placeholder="Въведи пид" />
            </div>
          </div>
          <div>
            <label for="login-password" class="ml-1 text-sm font-semibold">Парола</label>
            <div class="relative mt-1">
              <input :type="mobileLoginPass ? 'text' : 'password'" id="login-password" name="password" class="w-full rounded-lg border border-slate-50 p-2.5 pr-12 text-sm shadow-sm focus:border-slate-100 focus:outline-none" placeholder="Въведи парола" />
              <span class="absolute inset-y-0 right-4 inline-flex items-center">
                <svg @click="mobileLoginPass = !mobileLoginPass" class="h-5 w-5 text-gray-400 transition-all active:scale-90" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
              </span>
            </div>
          </div>
          <button type="submit" class="block w-full rounded-lg bg-blue-500 px-5 py-2.5 transition-all text-sm font-semibold text-white active:scale-95">
            Вход
          </button>
        </form>
      </div>
    </div>
  </div>
<?php } ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0/chartjs-plugin-datalabels.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script src="js/main-vue.js"></script>
<script src="js/main.js"></script>
<script src="js/ajax.js"></script>
<script src="js/mobileChart.js"></script>
<script src="loader/mobLoader.js"></script>
</body>

</html>