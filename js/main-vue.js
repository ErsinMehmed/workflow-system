const { createApp } = Vue;

createApp({
  data() {
    return {
      scY: 0,
      startY: 0,
      progress: 0,
      direction: null,
      passwordReg: true,
      phoneCountry: 'BG',
      countryCode: '+359',
      hideScrollBtn: true,
      hamburgerIcon: true,
      passwordState: true,
      passwordRegRep: true,

    };
  },
  mounted() {
    window.addEventListener("scroll", this.handleScroll);
    window.addEventListener("scroll", this.updateProgressIndicator);
    window.addEventListener('scroll', this.scrollDetector);
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
    scrollDetector: function() {
      var scrollY = window.scrollY

      if (scrollY > this.startY) {
        this.direction = true;
      } else {
        this.direction = false;
      }

      this.startY = scrollY;
    },
  },
}).mount("#app");