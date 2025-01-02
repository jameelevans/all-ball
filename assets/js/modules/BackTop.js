export default class BackTop {
  constructor() {
    this.scrollTopButton = document.querySelector(".scroll-top-btn");
    this.scrollDistance = 10 * 16; // 10rem converted to pixels (assuming 1rem = 16px)

    if (this.scrollTopButton) {
      this.initScrollListener();
    }
  }

  initScrollListener() {
    window.addEventListener("scroll", () => {
      if (window.scrollY > this.scrollDistance) {
        this.scrollTopButton.classList.add("jumpTop");
      } else {
        this.scrollTopButton.classList.remove("jumpTop");
      }
    });
  }
}