// JavaScript to handle automatic status update and form submission
document.addEventListener('DOMContentLoaded', function () {
    const statusForms = document.querySelectorAll('.status-form');

    statusForms.forEach(form => {
        const userId = form.getAttribute('data-user-id');
        const dropdown = form.querySelector('.status-dropdown');

        dropdown.addEventListener('change', function () {
            form.action = `/admin-magang-dinkopdag/update/${userId}`;
            form.submit();
        });
    });
});
