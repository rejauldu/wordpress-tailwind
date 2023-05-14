// Import the main style file
import '../styles/main.scss';
// Import 3rd party libraries
import gsap from 'gsap';

window.gsap = gsap as GSAP;

import Accordion from './modules/accordion';
import Faq from './modules/faq';
import Navbar from './modules/navbar';

// Initiate the modules
new Navbar();
//new Accordion();
//new Faq();
