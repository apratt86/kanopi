import { createRoot } from '@wordpress/element';

// Define your React component
const KanopiFancyDate = () => {
    const currentDate = new Date();
	const formattedDate = currentDate.toLocaleDateString('en-US', {
		year: 'numeric',
		month: 'long',
		day: 'numeric'
	});
    return (
        <p>{formattedDate}</p>
    );
};

// Function to render the React component
const renderBlock = (domElement) => {
    const root = createRoot(domElement);
    root.render(<KanopiFancyDate/>);
};

// Find all instances of your block on the front end and render them
document.addEventListener('DOMContentLoaded', () => {
    const blockElements = document.querySelectorAll('.wp-block-kanopi-fancy-date');
    blockElements.forEach(renderBlock);
});
