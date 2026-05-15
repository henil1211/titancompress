import './bootstrap';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import Alpine from 'alpinejs';
import { initViewer } from './modules/viewer3d';

window.Alpine = Alpine;
gsap.registerPlugin(ScrollTrigger);

// Initialize animations and 3D
document.addEventListener('DOMContentLoaded', () => {
    // 3D Viewer
    initViewer('compressor-viewer');

    // Animations
    gsap.to('.animate-reveal', {
        opacity: 1,
        y: 0,
        duration: 1,
        stagger: 0.2,
        ease: 'power3.out',
        scrollTrigger: {
            trigger: '.animate-reveal',
            start: 'top 80%',
        }
    });
});

Alpine.start();
