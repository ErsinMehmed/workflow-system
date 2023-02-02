const { createApp } = Vue;

createApp({
  data() {
    return {
      selectedFile: null,
      dragFile: false,
      scY: 0,
      progress: 0,
      passwordReg: true,
      phoneCountry: "BG",
      countryCode: "+359",
      hideScrollBtn: true,
      hamburgerIcon: true,
      passwordState: true,
      passwordRegRep: true,
      accountSection: true,
      passwordSection: false,
      historySection: false,
      rateSection: false,
      documentSection: false,
      imagePreview: null,
      profileImgPreview: null,
      orderSection: false,
      information: null,
      informationLength: "0/200",
      informationCount: 0,
      address: null,
      addressLength: "0/200",
      addressCount: 0,
      dashOrder: true,
      dashUser: false,
      dashTeam: false,
      dashWarehouse: false,
      productOrder: false,
      dashSupplier: false,
      dashProfile: false,
      dashClient: false,
      dashSection: "Заявки",
      toggleSidebar: true,
      showFilter: false,
      mobOrder: true,
      mobWarehouse: false,
      mobProfile: false,
      showSearchInput: false,
      activeOrder: true,
      activeOrders: false,
      finishedOrder: false,
      mobileCurrPassword: false,
      mobileNewPassword: false,
      mobileRepPassword: false,
      mobileLoginPass: false,
      orderStateStep: 0,
      invoiceState: false,
      settedProduct: true,
      returnedProduct: false,
      ourClientTab: true,
      processTab: false,
      communicationTab: false,
      dashSectionOwner: "Статистика",
      dashOwnerStatistic: true,
      dashOwnerAdmin: false,
      orderState: [
        "Почистване на повърхности",
        "Почистване на стъклени повърхности",
        "Почистване на общи части",
        "Почистване на под",
        "Приключване на задачата",
      ],
      orderImg: [
        "images/overCleaning.jpg",
        "images/windowCleaning.jpg",
        "images/bathroomCleaning.jpg",
        "images/floorCleaning.png",
        "images/doneCleaning.png",
      ],
      countries: [
        {
          name: "Австрия",
          image: ["images/austria-flag.png"],
          countryCode: "AT",
          code: "+43",
        },
        {
          name: "Белгия",
          image: ["images/belgium-flag.png"],
          countryCode: "BE",
          code: "+32",
        },
        {
          name: "България",
          image: ["images/bulgaria-flag.png"],
          countryCode: "BG",
          code: "+359",
        },
        {
          name: "Великобритания",
          image: ["images/britain-flag.png"],
          countryCode: "UK",
          code: "+44",
        },
        {
          name: "Германия",
          image: ["images/germany-flag.png"],
          countryCode: "DE",
          code: "+49",
        },
        {
          name: "Дания",
          image: ["images/denmark-flag.png"],
          countryCode: "DK",
          code: "+45",
        },
        {
          name: "Испания",
          image: ["images/spain-flag.png"],
          countryCode: "ES",
          code: "+34",
        },
        {
          name: "Италия",
          image: ["images/italy-flag.png"],
          countryCode: "IT",
          code: "+39",
        },
        {
          name: "Нидерландия",
          image: ["images/netherland-flag.png"],
          countryCode: "NL",
          code: "+31",
        },
        {
          name: "Полша",
          image: ["images/poland-flag.png"],
          countryCode: "PL",
          code: "+48",
        },
        {
          name: "Португалия",
          image: ["images/portugal-flag.png"],
          countryCode: "PT",
          code: "+351",
        },
        {
          name: "Финландия",
          image: ["images/finland-flag.png"],
          countryCode: "FI",
          code: "+358",
        },
        {
          name: "Франция",
          image: ["images/france-flag.png"],
          countryCode: "FR",
          code: "+33",
        },
        {
          name: "Чехия",
          image: ["images/check-flag.png"],
          countryCode: "CZ",
          code: "+420",
        },
        {
          name: "Швеция",
          image: ["images/sweden-flag.png"],
          countryCode: "SE",
          code: "+46",
        },
      ],
      cities: [
        {
          name: "Благоевград",
          image: ["images/blagoevgrad.png"],
        },
        {
          name: "Бургас",
          image: ["images/burgas.png"],
        },
        {
          name: "Варна",
          image: ["images/varna-logo.png"],
        },
        {
          name: "Плевен",
          image: ["images/logo_pleven.jpg"],
        },
        {
          name: "Пловдив",
          image: ["images/Plovdiv.png"],
        },
        {
          name: "Русе",
          image: ["images/ruse.png"],
        },
        {
          name: "София",
          image: ["images/sofia.png"],
        },
        {
          name: "Шумен",
          image: ["images/shumen.png"],
        },
      ],
      services: [
        "Основно почистване",
        "Пофесионални препарати",
        "Почистване на прозорци",
        "Пръскане за вредители",
        "Цялостно почистване",
        "Почистване на общи части",
        "Ароматизиране",
      ],
    };
  },

  mounted() {
    window.addEventListener("scroll", this.handleScroll);
    window.addEventListener("scroll", this.updateProgressIndicator);
  },

  methods: {
    handleScroll: function () {
      this.scY = window.scrollY;
    },

    goTop: function () {
      window.scrollTo({
        top: 0,
        behavior: "smooth",
      });
    },

    updateProgressIndicator() {
      const { documentElement, body } = document;
      let windowScroll = body.scrollTop || documentElement.scrollTop;
      let height = documentElement.scrollHeight - documentElement.clientHeight;
      this.progress = (windowScroll / height) * 100 + "%";
    },

    goTo(refName) {
      var element = this.$refs[refName];
      var top = element.offsetTop;
      window.scrollTo(0, top);
      this.hideScrollBtn = false;
    },

    profilePhotoUpdate(e) {
      const fileData = e.target.files[0];
      this.profileImgPreview = URL.createObjectURL(fileData);
    },

    charCount() {
      const char = this.information.length;
      this.informationCount = this.information.length;

      if (char >= 200) {
        this.information = this.information.substr(0, 200);
        this.informationLength = "200/200";
      } else {
        this.informationLength = char + "/" + 200;
      }
    },

    charCountAddress() {
      const char = this.address.length;
      this.addressCount = this.address.length;

      if (char >= 200) {
        this.address = this.address.substr(0, 200);
        this.addressLength = "200/200";
      } else {
        this.addressLength = char + "/" + 200;
      }
    },

    onFileChange(event) {
      const fileData = event.target.files[0];
      this.imagePreview = URL.createObjectURL(fileData);
    },

    dragOver(event) {
      event.preventDefault();
      this.dragFile = true;
    },

    fileDropped(event) {
      event.preventDefault();
      file = event.dataTransfer.files[0];
      this.selectedFile = file;
      this.imagePreview = URL.createObjectURL(file);
    },
  },
}).mount("#app");
