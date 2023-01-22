<?php
include '../dbconn.php';

//Select orders by date and offer
if (isset($_POST['date'])) {

    $date = $_POST['date'];
    $offer = $_POST['offer'];

    $query = "SELECT * FROM orders WHERE date = '$date' AND offer = '$offer'";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $rows) {
?>
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
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <p><?= date("d.m.Y", strtotime($rows['date'])) ?></p>
                    </div>
                    <div class="border-t-2"></div>
                    <button type="button" value="<?= $rows['id'] ?>" class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-0 font-semibold rounded-xl w-full text-sm px-5 py-2 mt-2.5 focus:outline-none transition-all history-view">Виж повече</button>
                </div>
            </div>
        <?php }
    } else {
        ?>
        <div class="font-semibold">Няма намерени резултати</div>
<?php
    }
}
?>