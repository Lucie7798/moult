/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';

// Tailwind Elements
import { 
    Collapse, 
    Dropdown, 
    Ripple, 
    initTE 
} from 'tw-elements';

initTE({ Collapse, Dropdown, Ripple });

// enable the interactive UI components from Flowbite
import 'flowbite';

// enable the custom scripts
import './custom';


  

  


