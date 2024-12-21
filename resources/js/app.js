



import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

gsap.from('.stat-card', {
    duration: 0.90,
    opacity: 0,
    y: 50,
    ease: 'power3.out',
});

gsap.from('.table-row', {
    duration: 0.90,
    opacity: 0,
    x: -50,
    stagger: 0.2,
    ease: 'power3.out',
});

document.querySelectorAll('.hover-card').forEach(card => {
    card.addEventListener('mouseenter', () => {
        gsap.to(card, { scale: 1.05, duration: 0.3, ease: 'power1.out' });
    });
    card.addEventListener('mouseleave', () => {
        gsap.to(card, { scale: 1, duration: 0.3, ease: 'power1.out' });
    });
});



document.querySelectorAll('.active-link, .inactive-link').forEach(link => {
    // Hover in
    link.addEventListener('mouseenter', () => {
        gsap.to(link, {
            scale: 1.03, // Slightly enlarge
            duration: 0.2, // Quicker animation
            ease: 'power2.out', // Smooth easing
            backgroundColor: 'rgba(240, 240, 240, 0.8)', // Subtle background color change
        });
    });

    // Hover out
    link.addEventListener('mouseleave', () => {
        gsap.to(link, {
            scale: 1, // Reset to original size
            duration: 0.2, // Quicker animation
            ease: 'power2.in', // Smooth easing
            backgroundColor: '', // Reset background
        });
    });
});