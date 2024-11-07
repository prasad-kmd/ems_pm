// This will change the document title as required
function changeTitle() {
    const titles = [
        "Rathna Events - The Event Management Company",
        "Rathna Events - The Event Management Company",
        "Rathna Events - The Event Management Company",
        "රත්න Events - The Event Management Company",
        "Effortless Event Scheduling",
        "Client and Booking Management",
        "Real-Time Communication",
        "රත්න Events - The Event Management Company",
        // Add more titles as needed
    ];

    let index = 0;
    let isFocused = true;

    const intervalId = setInterval(() => {
        if (isFocused) {
            document.title = titles[index];
            index = (index + 1) % titles.length;
        }
    }, 2500);

    window.addEventListener('blur', () => {
        isFocused = false;
        document.title = '✨🎉Event Management System⌚⌛';
    });

    window.addEventListener('focus', () => {
        isFocused = true;
        document.title = titles[index];
    });
}

changeTitle();