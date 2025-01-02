import $ from 'jquery';
import waypoints from 'waypoints/lib/noframework.waypoints';

class StickyMenu {
    constructor() {
        this.navbarTop = document.querySelector('.navbar__top');
        this.navbarBottom = document.querySelector('.navbar__bottom');
        this.addStickyClass();
    }

    addStickyClass() {
        if (this.navbarTop && this.navbarBottom) {
            new Waypoint({
                element: this.navbarTop,
                handler: (direction) => {
                    if (direction === 'down') {
                        console.log('Adding sticky-menu class'); // Debugging log
                        this.navbarBottom.classList.add('sticky-menu');
                    } else {
                        console.log('Removing sticky-menu class'); // Debugging log
                        this.navbarBottom.classList.remove('sticky-menu');
                    }
                },
                offset: '-10%', // Adjust to trigger slightly before the element is fully out of view
            });
        } else {
            console.warn('StickyMenu: Navbar elements not found');
        }
    }
}

export default StickyMenu;