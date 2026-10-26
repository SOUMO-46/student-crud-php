document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.delete-form').forEach((form) => {
        form.addEventListener('submit', (event) => {
            if (!window.confirm('Are you sure you want to delete this student?')) {
                event.preventDefault();
            }
        });
    });

    const form = document.querySelector('[data-student-form]');
    if (!form) return;

    const fields = ['name', 'email', 'phone', 'city'];

    const showError = (name, message) => {
        const input = form.elements[name];
        const error = form.querySelector(`[data-error-for="${name}"]`);
        input.classList.toggle('input-error', Boolean(message));
        if (error) error.textContent = message || '';
    };

    const validate = () => {
        let valid = true;
        const name = form.elements.name.value.trim();
        const email = form.elements.email.value.trim();
        const phone = form.elements.phone.value.trim();
        const city = form.elements.city.value.trim();

        showError('name', name.length < 2 ? 'Name must contain at least 2 characters.' : '');
        showError('email', !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email) ? 'Enter a valid email address.' : '');
        showError('phone', !/^[0-9+()\-\s]{7,20}$/.test(phone) ? 'Enter a valid phone number.' : '');
        showError('city', city.length === 0 ? 'City is required.' : '');

        fields.forEach((field) => {
            const error = form.querySelector(`[data-error-for="${field}"]`);
            if (error && error.textContent) valid = false;
        });

        return valid;
    };

    form.addEventListener('submit', (event) => {
        if (!validate()) event.preventDefault();
    });

    fields.forEach((field) => {
        form.elements[field].addEventListener('input', () => showError(field, ''));
    });
});
