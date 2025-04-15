import Glide, { Controls, Autoplay, Swipe, Breakpoints } from '@glidejs/glide/dist/glide.modular.esm'

class Sliders {
    /**
     * Create Sliders
     */
    constructor () {
        this.instances = []
        this.init()
    }

    /**
     * Generate the bullets for the slider.
     * @param el - The node on page
     * @param slider - The Glide instance
     */
    generateBullets (el, slider) {
        // Look for bullets container
        let bulletWrapper = el.querySelectorAll('.glide__bullets')[0]

        // Loop and create bullets
        for (let index = 0; index < el.querySelectorAll('.glide__slide').length; index++) {
            const button = document.createElement('button')
            button.className = 'glide__bullet'
            button.setAttribute('data-glide-dir', '=' + index)
            button.setAttribute('aria-label', 'Slide ' + (index + 1));
            bulletWrapper.appendChild(button)
        }
    }

    /**
     * Get the options for the slider.
     * @param slide - The node on page
     * @returns {{}}
     */
    getOptions (slide) {
        let options = {}

        // Check if we have any options set.
        if (slide.getAttribute('data-glide-options') && slide.getAttribute('data-glide-options').length < 1) {
            options = {}
        } else {
            eval('options=' + slide.getAttribute('data-glide-options'))
        }

        return options
    }

    /**
     * Init the sliders.
     */
    init () {
        // Prep vars
        let sliders = document.querySelectorAll('.glide')

        for (let slide of sliders) {
            // New up the slider
            let glide = new Glide(slide, this.getOptions(slide))

            // Check if we want bullets
            if (slide.getAttribute('data-glide-bullets') &&
                slide.getAttribute('data-glide-bullets') === 'true') {
                this.generateBullets(slide, glide)
            }

            // Do the mount
            glide.mount({Controls, Autoplay, Swipe, Breakpoints})

            this.instances.push(glide)
        }

        // Refresh sliders on load to resize them properly
        window.addEventListener('load', () => {
            this.instances.forEach(instance => instance.update()) // fixes any resizing bugs
        });
    }
}

export default new Sliders()

