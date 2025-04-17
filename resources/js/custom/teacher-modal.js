$(document).ready(function () {
    $('a[data-modal-toggle="#teacher-modal"]').click(function (e) {
        e.preventDefault();

        const teacherId = $(this).data('id');
        const last_name = $(this).data('last_name');
        const first_name = $(this).data('first_name');
        const email = $(this).data('email');

        console.log('Filling fields with:', {
            last_name,
            first_name,
            email
        });

        // Set the form action URL with the teacher's ID
        const formAction = `/teacher/${teacherId}/update`;
        $('#teacherUpdateForm').data('action', formAction);

        // Populate the modal with the teacher's data
        setTimeout(() => {
            $('#last_name').val(last_name);
            $('#first_name').val(first_name);
            $('#email').val(email);
        }, 100);

        // Show the modal
        $('#teacher-modal').css('display', 'flex');
    });

    // Close the modal when clicking outside of the modal content
    $('#teacher-modal').click(function (e) {
        if ($(e.target).is('#teacher-modal')) {
            $('#teacher-modal').css('display', 'none');
        }
    });

    // Handle the form submission (AJAX)
    $('#teacherUpdateForm').on('submit', function (e) {
        e.preventDefault();

        const data = {
            last_name: $('#last_name').val(),
            first_name: $('#first_name').val(),
            email: $('#email').val(),
            _method: 'PUT',  // Laravel's way to simulate PUT requests in forms
            _token: $('input[name="_token"]').val()  // CSRF Token
        };

        $.ajax({
            url: $(this).data('action'),
            type: 'POST',
            data: data,
            success: function (response) {
                alert(response.success);
                $('#teacher-modal').css('display', 'none');  // Hide the modal
            },
            error: function (xhr) {
                // If error, handle it
                let errorMessage = 'An error occurred.';
                if (xhr.responseJSON && xhr.responseJSON.error) {
                    errorMessage = xhr.responseJSON.error;
                }
                alert(errorMessage);  // Show the error message
            }
        });
    });
});
