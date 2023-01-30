const getJson = async (id) => {
  const url = `action/AdminOrders.php?id=${id}`;
  const { data } = await (await fetch(url)).json();
  return data;
};

$(".print-invoice").on("click", async function () {
  const id = $(this).val();
  const myData = await getJson(id);
  await print(myData);
});

async function print(jsonData) {
  const preparePrint = () => {
    const winPrint = window.open(
      "",
      "",
      "left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0"
    );

    winPrint.document.write(
      `<!DOCTYPE html>
		<html>
			<head>
				<script src="https:cdn.tailwindcss.com"></script>
				<title>Фактура-${jsonData.customer_name}-${jsonData.date}</title>

				<style>
				@media print {
					@page {
						margin-top: 0;
						margin-bottom: 0;
					}
					body {
						padding-top: 72px;
						padding-bottom: 72px ;
					}
				}
				</style>
			</head>
		<body>
			<div class="text-blue-700 font-bold text-4xl mt-16">${
        jsonData.company_name
      }</div>
			<div class="text-blue-500 mt-1 text-2xl font-semibold">${jsonData.date
        .replaceAll("-", ".")
        .split(".")
        .reverse()
        .join(".")}</div>
      <div class="text-blue-700 text-2xl font-semibold mt-16">ФАКТУРА №${
        jsonData.id
      }</div>
      <div class="w-full flex mt-3 text-slate-700">
        <div class="w-1/2">
            <div class="p-2.5 text-center text-xl bg-blue-100 font-semibold border border-blue-600">Клиентски данни</div>
             <div class="p-2.5 border border-t-0 border-blue-600">
                <div class="flex items-center">
                  <span class="font-semibold mr-2">Име:</span><span>${
                    jsonData.customer_name
                  }</span>
                </div>
                <div class="flex items-center mt-1.5">
                  <span class="font-semibold mr-2">Телефон:</span><span>${
                    jsonData.phone
                  }</span>
                </div>
                <div class="flex items-center mt-1.5">
                  <span class="font-semibold mr-2">Адрес:</span><span>${
                    jsonData.city + ", " + jsonData.address
                  }</span>
                </div>
            </div>
        </div>
        <div class="w-1/2">
            <div class="p-2.5 text-center text-xl bg-blue-100 font-semibold border border-l-0 border-blue-600">Фирмени данни</div>
            <div class="p-2.5 border border-t-0 border-l-0 border-blue-600">
                <div class="flex items-center">
                  <span class="font-semibold mr-2">Име:</span><span>${
                    jsonData.company_name
                  }</span>
                </div>
                <div class="flex items-center mt-1.5">
                  <span class="font-semibold mr-2">ЕИК:</span><span>${
                    jsonData.company_eik
                  }</span>
                </div>
                <div class="flex items-center mt-1.5">
                  <span class="font-semibold mr-2">Адрес:</span><span>${
                    jsonData.city + ", " + jsonData.address
                  }</span>
                </div>
            </div>
        </div>
      </div>
      <div class="mt-5">
        <div class="flex text-slate-700">
          <div class="p-2.5 w-[20%] text-center text-xl bg-blue-100 font-semibold border border-blue-600">
            Номер
          </div>
          <div class="p-2.5 w-[20%] text-center text-xl bg-blue-100 font-semibold border border-l-0 border-blue-600">
            Услуга
          </div>
          <div class="p-2.5 w-[20%] text-center text-xl bg-blue-100 font-semibold border border-l-0 border-blue-600">
            Оферта
          </div>
          <div class="p-2.5 w-[20%] text-center text-xl bg-blue-100 font-semibold border border-l-0 border-blue-600">
            ДДС
          </div>
          <div class="p-2.5 w-[20%] text-center text-xl bg-blue-100 font-semibold border border-l-0 border-blue-600">
            Крайна цена
          </div>
        </div>
        <div class="flex text-slate-700">
          <div class="p-2.5 w-[20%] text-center text-xl bg-blue-100 border-t-0 border border-blue-600">
            ${jsonData.id}
          </div>
          <div class="p-2.5 w-[20%] text-center text-xl bg-blue-100 border border-t-0 border-l-0 border-blue-600">
            Почистване
          </div>
          <div class="p-2.5 w-[20%] text-center text-xl bg-blue-100 border border-t-0 border-l-0 border-blue-600">
           ${jsonData.offer}
          </div>
           <div class="p-2.5 w-[20%] text-center text-xl bg-blue-100 border border-t-0 border-l-0 border-blue-600">
           ${(jsonData.price * 1.2 - jsonData.price).toFixed(2)} лв.
          </div>
          <div class="p-2.5 w-[20%] text-center text-xl bg-blue-100 border border-t-0 border-l-0 border-blue-600">
            ${jsonData.price} лв.
          </div>
        </div>
      </div>
      <div class="text-blue-700 text-xl font-semibold mt-4">Благодарим Ви, че избрахте нас !</div>
      <div class="text-slate-700 text-xl font-semibold">Carpet Services</div>
      <div class="text-slate-700 mt-13">Варна, ул. Васил Гергов 26</div>
		</body>
		</html>`
    );

    return winPrint;
  };

  const printeEl = preparePrint(jsonData);
  setTimeout(() => {
    printeEl.print();
  }, 100);
}
