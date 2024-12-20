import './bootstrap';




import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

// Register ScrollTrigger if needed
gsap.registerPlugin(ScrollTrigger);

// Animate stat cards
gsap.from('.stat-card', {
    duration: 0.90,
    opacity: 0,
    y: 50,
    stagger: 0.3, // Add delay between each animation
    ease: 'power3.out',
});

// Animate the table rows
gsap.from('.table-row', {
    duration: 0.90,
    opacity: 0,
    x: -50,
    stagger: 0.2,
    ease: 'power3.out',
});

// Hover animation for cards
document.querySelectorAll('.hover-card').forEach(card => {
    card.addEventListener('mouseenter', () => {
        gsap.to(card, { scale: 1.05, duration: 0.3, ease: 'power1.out' });
    });
    card.addEventListener('mouseleave', () => {
        gsap.to(card, { scale: 1, duration: 0.3, ease: 'power1.out' });
    });
});




