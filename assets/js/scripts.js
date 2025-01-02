// 3rd party packages from NPM
import $ from 'jquery';

// Our modules/classes
import BackTop from "./modules/BackTop";
//import StickyMenu from './modules/StickyMenu';
import MobileNav from './modules/MobileNav';
import GOATCalculator from './modules/GOATCalculator';
import popupVideo from './modules/PopupVideo';




// Instantiate new objects
//new StickyMenu();
new MobileNav();
new BackTop();

// Instantiate GOATCalculator
document.addEventListener("DOMContentLoaded", () => {
    new GOATCalculator("#goat-calculator-form", "#goat-rankings");
});

// Initialize the popup for videos
popupVideo();