import { registerWidget } from "../lib/utils";

class OEW_ImageGallery extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                imageGallery: ".oew-image-gallery",
                galleryItemLink: "a.oew-gallery-item-inner",
                galleryMasonry: ".oew-image-gallery.oew-masonry",
                photoSwipe: ".pswp",
                body: "body",
            },
        };
    }

    getDefaultElements() {
        const element = this.$element.get(0);
        const selectors = this.getSettings("selectors");

        return {
            imageGallery: element.querySelector(selectors.imageGallery),
            galleryItemLinks: element.querySelectorAll(selectors.galleryItemLink),
            galleryMasonry: element.querySelector(selectors.galleryMasonry),
            photoSwipe: document.querySelector(selectors.photoSwipe),
            body: document.body,
        };
    }

    onInit(...args) {
        super.onInit(...args);

        this.addPhotoSwipeToDOM();
        this.initLightbox();

        if (this.isMasonry()) {
            this.initMasonry();
        }
    }

    initLightbox() {
        this.elements.galleryItemLinks?.forEach((galleryItemLink) => {
            galleryItemLink.addEventListener("click", this.openLightbox.bind(this));
        });
    }

    openLightbox(event) {
        event.preventDefault();
        event.stopPropagation();

        const galleryItemLink = event.currentTarget;

        const images = Array.from(this.elements.galleryItemLinks).reduce((acc, _galleryItemLink) => {
            const src = _galleryItemLink.getAttribute("href");
            const width = _galleryItemLink.dataset.width;
            const height = _galleryItemLink.dataset.height;

            acc.push({
                src: src,
                w: width,
                h: height,
            });

            return acc;
        }, []);

        const photoSwipe = new PhotoSwipe(this.elements.photoSwipe, PhotoSwipeUI_Default, images, {
            index: this.getGalleryItemIndex(galleryItemLink),
            bgOpacity: 0.75,
            showHideOpacity: true,
        });

        photoSwipe.init();
    }

    getGalleryItemIndex(galleryItemLink) {
        for (let index = 0; index < this.elements.galleryItemLinks.length; index++) {
            if (this.elements.galleryItemLinks[index] == galleryItemLink) {
                return index;
            }
        }

        return 0;
    }

    initMasonry() {
        if (this.isEdit) {
            salvattore.init();
        }
    }

    isMasonry() {
        if (document.body.classList.contains("no-isotope")) {
            return false;
        }

        return !!this.elements.galleryMasonry;
    }

    addPhotoSwipeToDOM() {
        if (!!this.elements.photoSwipe) {
            return;
        }

        this.elements.body.insertAdjacentHTML(
            "beforeend",
            `<!-- Root element of PhotoSwipe. Must have class pswp. -->
            <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
                <!-- Background of PhotoSwipe. 
                    It's a separate element as animating opacity is faster than rgba(). -->
                <div class="pswp__bg"></div>

                <!-- Slides wrapper with overflow:hidden. -->
                <div class="pswp__scroll-wrap">
                    <!-- Container that holds slides. 
                        PhotoSwipe keeps only 3 of them in the DOM to save memory.
                        Don't modify these 3 pswp__item elements, data is added later on. -->
                    <div class="pswp__container">
                        <div class="pswp__item"></div>
                        <div class="pswp__item"></div>
                        <div class="pswp__item"></div>
                    </div>

                    <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
                    <div class="pswp__ui pswp__ui--hidden">
                        <div class="pswp__top-bar">
                            <!--  Controls are self-explanatory. Order can be changed. -->
                            <div class="pswp__counter"></div>

                            <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                            <button class="pswp__button pswp__button--share" title="Share"></button>
                            <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                            <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                            <!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR -->
                            <!-- element will get class pswp__preloader--active when preloader is running -->
                            <div class="pswp__preloader">
                                <div class="pswp__preloader__icn">
                                <div class="pswp__preloader__cut">
                                    <div class="pswp__preloader__donut"></div>
                                </div>
                                </div>
                            </div>
                        </div>

                        <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                            <div class="pswp__share-tooltip"></div> 
                        </div>

                        <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
                        </button>

                        <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
                        </button>

                        <div class="pswp__caption">
                            <div class="pswp__caption__center"></div>
                        </div>
                    </div>
                </div>
            </div>`
        );

        this.elements.photoSwipe = document.querySelector(this.getSettings("selectors.photoSwipe"));
    }
}

registerWidget(OEW_ImageGallery, "oew-image-gallery");
