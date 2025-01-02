export default class MobileNav {
  constructor() {
    this.nav = document.querySelector(".slide-bar");
    this.navToggle = document.querySelector(".hamburger-menu");
    this.navToggleParent = this.navToggle?.parentElement; // Get the parent element of hamburger-menu
    this.closeButton = document.querySelector(".slide-bar-close");
    this.bgOverlay = document.querySelector(".anywere-home");

    this.isOpen = false; // Track menu state
    this.focusableElements = null; // Store focusable elements in the menu
    this.firstFocusableElement = null; // First focusable element inside the menu
    this.lastFocusableElement = null; // Last focusable element inside the menu
    this.events();
    this.setInitialState();
  }

  // Set initial state of the navigation
  setInitialState() {
    if (this.nav) {
      this.nav.classList.remove("show"); // Ensure navigation starts closed
    }
    if (this.bgOverlay) {
      this.bgOverlay.classList.remove("bgshow"); // Ensure overlay is not visible
    }
    if (this.navToggle) {
      this.navToggle.querySelector(".hamburger-menu-inner").classList.remove("active");
    }
    this.isOpen = false; // Reset state
  }

  events() {
    if (this.navToggle) {
      // Open/close menu when clicking the hamburger-menu
      this.navToggle.addEventListener("click", (e) => {
        e.preventDefault();
        this.toggleMenu(true);
      });
    }

    if (this.navToggleParent) {
      // Open/close menu when clicking the parent of hamburger-menu
      this.navToggleParent.addEventListener("click", (e) => {
        if (e.target !== this.navToggle) {
          e.preventDefault();
          this.toggleMenu(true);
        }
      });
    }

    if (this.closeButton) {
      // Close menu
      this.closeButton.addEventListener("click", (e) => {
        e.preventDefault();
        this.toggleMenu(false);
      });
    }

    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape" && this.isOpen) {
        this.toggleMenu(false);
      }

      // Trap focus inside the navigation menu
      if (this.isOpen && e.key === "Tab") {
        this.trapFocus(e);
      }
    });

    document.addEventListener("click", (e) => {
      // Close menu when clicking outside the .slide-bar or .hamburger-menu
      if (
        this.isOpen &&
        !this.nav.contains(e.target) &&
        !this.navToggle.contains(e.target) &&
        !this.navToggleParent.contains(e.target)
      ) {
        this.toggleMenu(false);
      }
    });
  }

  // Toggle the menu and manage focus
  toggleMenu(forceState = null) {
    const shouldOpen = forceState !== null ? forceState : !this.isOpen;

    if (this.nav) {
      this.nav.classList.toggle("show", shouldOpen);
    }
    if (this.bgOverlay) {
      this.bgOverlay.classList.toggle("bgshow", shouldOpen);
    }
    if (this.navToggle) {
      this.navToggle.querySelector(".hamburger-menu-inner").classList.toggle("active", shouldOpen);
    }

    this.isOpen = shouldOpen; // Update state

    if (shouldOpen) {
      this.manageFocus();
    }
  }

  // Manage focusable elements when the menu opens
  manageFocus() {
    // Get all focusable elements inside the navigation
    this.focusableElements = this.nav.querySelectorAll(
      'a, button, input, select, textarea, [tabindex]:not([tabindex="-1"])'
    );
    this.firstFocusableElement = this.focusableElements[0];
    this.lastFocusableElement = this.focusableElements[this.focusableElements.length - 1];

    // Focus the first focusable element
    if (this.firstFocusableElement) {
      this.firstFocusableElement.focus();
    }
  }

  // Trap focus inside the navigation menu
  trapFocus(e) {
    if (e.shiftKey && document.activeElement === this.firstFocusableElement) {
      // If Shift+Tab and focused on the first element, loop to the last element
      e.preventDefault();
      this.lastFocusableElement.focus();
    } else if (!e.shiftKey && document.activeElement === this.lastFocusableElement) {
      // If Tab and focused on the last element, loop to the first element
      e.preventDefault();
      this.firstFocusableElement.focus();
    }
  }
}