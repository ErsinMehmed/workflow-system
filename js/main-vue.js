const { createApp } = Vue;

createApp({
  data() {
    return {
      scY: 0,
      startY: 0,
      progress: 0,
      direction: null,
      passwordReg: true,
      phoneCountry: "BG",
      countryCode: "+359",
      hideScrollBtn: true,
      hamburgerIcon: true,
      passwordState: true,
      passwordRegRep: true,
      accountSection: true,
      passowrdSection: false,
      historySection: false,
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
      cities: [
        {
          name: "Бургас",
          image: ["../images/burgas.png"],
        },
        {
          name: "Варна",
          image: ["../images/varna-logo.png"],
        },
        {
          name: "Плевен",
          image: ["../images/logo_pleven.jpg"],
        },
        {
          name: "Пловдив",
          image: ["../images/Plovdiv.png"],
        },
        {
          name: "Русе",
          image: ["../images/ruse.png"],
        },
        {
          name: "София",
          image: ["../images/sofia.png"],
        },
        {
          name: "Шумен",
          image: ["../images/shumen.png"],
        },
      ],
      services: [
        "Основно почистване",
        "Пофесионални препарати ",
        "Почистване на прозорци ",
        "Пръскане за вредители",
        "Цялостно почистване ",
        "Почистване на общи части ",
        "Ароматизиране ",
      ],
    };
  },

  mounted() {
    window.addEventListener("scroll", this.handleScroll);
    window.addEventListener("scroll", this.updateProgressIndicator);
    window.addEventListener("scroll", this.scrollDetector);
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

    scrollDetector: function () {
      var scrollY = window.scrollY;

      if (scrollY > this.startY) {
        this.direction = true;
      } else {
        this.direction = false;
      }

      this.startY = scrollY;
    },

    onFileChange(e) {
      const fileData = e.target.files[0];
      this.imagePreview = URL.createObjectURL(fileData);
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
  },
}).mount("#app");
