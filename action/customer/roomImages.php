<?php
session_start();

include '../dbconn.php';

$email = $_SESSION['email'];

if (isset($_POST['action'])) {
    $query = "SELECT * FROM customer WHERE email = '$email' AND (image_room1 != '' OR image_room2 != '' OR image_room3 != '')";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) > 0) {
        while ($rows = mysqli_fetch_array($query_run)) {
?>
            <div class="w-full my-4">
                <div class="ml-1 font-semibold text-sm md:text-base">Вашите снимки</div>
                <div class="ml-1 mb-3 text-xs md:text-sm font-semibold text-slate-500">(Натиснете върху снимката за да я премахнете)</div>
                <div class="flex flex-wrap items-center gap-5">
                    <?php
                    if ($rows["image_room1"] != '') {
                    ?>
                        <Transition>
                            <div id="1" class="w-36 h-36 md:w-44 md:h-44 rounded-lg border border-slate-100 hover:brightness-90 room-img group cursor-pointer shadow-lg">
                                <img class="w-full h-full rounded-lg object-cover" src="../uploaded-files/room-images/<?= $rows["image_room1"] ?>" alt="">
                                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-12 h-12 hidden group-hover:flex items-center justify-center bg-blue-300 border border-blue-400 rounded-full transition-all active:scale-90">
                                    <svg viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-white ">
                                        <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </Transition>
                    <?php
                    }
                    if ($rows["image_room2"] != '') {
                    ?>
                        <Transition>
                            <div id="2" class="w-36 h-36 md:w-44 md:h-44 rounded-lg border border-slate-100 hover:brightness-90 room-img group cursor-pointer shadow-lg">
                                <img class="w-full h-full rounded-lg object-cover" src="../uploaded-files/room-images/<?= $rows["image_room2"] ?>" alt="">
                                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-12 h-12 hidden group-hover:flex items-center justify-center bg-blue-300 border border-blue-400 rounded-full transition-all active:scale-90">
                                    <svg viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-white">
                                        <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </Transition>
                    <?php
                    }
                    if ($rows["image_room3"] != '') {
                    ?>
                        <Transition>
                            <div id="3" class="w-36 h-36 md:w-44 md:h-44 rounded-lg border border-slate-100 hover:brightness-90 group room-img cursor-pointer shadow-lg">
                                <img class="w-full h-full rounded-lg object-cover" src="../uploaded-files/room-images/<?= $rows["image_room3"] ?>" alt="">
                                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-12 h-12 hidden group-hover:flex items-center justify-center bg-blue-300 border border-blue-400 rounded-full transition-all active:scale-90">
                                    <svg viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-white ">
                                        <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </Transition>
                    <?php
                    }
                    ?>
                </div>
            </div>
<?php
        }
    }
}
