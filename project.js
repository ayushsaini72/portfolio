alert("Hi there!")

    const contactForm = document.getElementById('contactForm');
    contactForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const userConfirmed = confirm("Are you sure you want to submit the form?");
        if (userConfirmed) {
            contactForm.submit();
        }
    });
;


