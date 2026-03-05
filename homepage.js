class Slideshow {
    constructor() {
        this.slides = document.querySelectorAll('.slide');
        this.dots = document.querySelectorAll('.dot');
        this.prevBtn = document.querySelector('.left');
        this.nextBtn = document.querySelector('.right');
        this.currentSlide = 0;
        this.slideInterval = null;
        this.slideDuration = 5000;

        this.showSlide(this.currentSlide);
        
        this.init();
    }

    init() {
        this.prevBtn.addEventListener('click', () => this.prevSlide());
        this.nextBtn.addEventListener('click', () => this.nextSlide());
        
        this.dots.forEach((dot, index) => {
            dot.addEventListener('click', () => this.goToSlide(index));
        });

        this.startAutoPlay();

        const slidebox = document.querySelector('.slidebox');
        slidebox.addEventListener('mouseenter', () => this.stopAutoPlay());
        slidebox.addEventListener('mouseleave', () => this.startAutoPlay());
    }

    showSlide(index) {  
        this.slides.forEach(slide => slide.classList.remove('slideactive'));
        this.dots.forEach(dot => dot.classList.remove('active'));

        this.slides[index].classList.add('slideactive');
        this.dots[index].classList.add('active');
        this.currentSlide = index;
    }

    nextSlide() {
        let nextIndex = (this.currentSlide + 1) % this.slides.length;
        this.showSlide(nextIndex);
    }

    prevSlide() {
        let prevIndex = (this.currentSlide - 1 + this.slides.length) % this.slides.length;
        this.showSlide(prevIndex);
    }

    goToSlide(index) {
        this.showSlide(index);
    }

    startAutoPlay() {
        this.stopAutoPlay();
        this.slideInterval = setInterval(() => this.nextSlide(), this.slideDuration);
    }

    stopAutoPlay() {
        if (this.slideInterval) {
            clearInterval(this.slideInterval);
        }
    }
}

// Initialize slideshow when page loads
document.addEventListener('DOMContentLoaded', () => {
    new Slideshow();
});