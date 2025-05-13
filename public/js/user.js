    // Fungsi untuk menampilkan modal
    function showModal() {
        $('#userModal').addClass('show');
    }

    // Fungsi untuk menyembunyikan modal
    function hideModal() {
        $('#userModal').removeClass('show');
        $('#userForm')[0].reset();
        currentUserId = null;
    }
$(document).ready(function () {
    let url = 'https://apps-1ca7f-default-rtdb.asia-southeast1.firebasedatabase.app/users';
    let currentUserId = null;

    function loadUsers() {
        $.ajax(url + '.json', {
            method: 'GET',
            dataType: 'json',
            beforeSend: function () {
                $('#userData tbody').html('<tr><td colspan="5">Loading...</td></tr>');
            },
            success: function(data) {
                let tableBody = $('#userData tbody');
                tableBody.empty();

                if (data) {
                    let index = 1;
                    Object.entries(data).forEach(([key, user]) => {
                        let row = `<tr data-id="${key}">
                            <td>${index}</td>
                            <td>${user.name}</td>
                            <td>${user.email}</td>
                            <td>${user.password}</td>
                            <td>
                                <button class="btn btn-sm btn-warning edit">Edit</button>
                                <button class="btn btn-sm btn-danger delete">Delete</button>
                            </td>
                        </tr>`;
                        tableBody.append(row);
                        index++;
                    });
                } else {
                    tableBody.html('<tr><td colspan="5">No users found</td></tr>');
                }
            },
            error: function(xhr, status, error) {
                $('#userData tbody').html('<tr><td colspan="5">Error loading data</td></tr>');
                console.error('Error fetching data:', error);
            }
        });
    }

    loadUsers();


    // Tombol add user
    $('#addUser').on('click', function () {
        currentUserId = null;
        $('#userForm')[0].reset();
        showModal();
    });

    // Form submit
    $('#userForm').on('submit', function (e) {
        e.preventDefault();

        let name = $('#userName').val().trim();
        let email = $('#userEmail').val().trim();
        let password = $('#userPassword').val().trim();

        if (!name || !email || !password) return;

        let newUser = { name, email, password };

        if (currentUserId) {
            $.ajax({
                url: `${url}/${currentUserId}.json`,
                method: 'PUT',
                contentType: 'application/json',
                data: JSON.stringify(newUser),
                success: function () {
                    hideModal();
                    loadUsers();
                },
                error: function (xhr, status, error) {
                    alert("Failed to update user.");
                    console.error(error);
                }
            });
        } else {
            $.ajax({
                url: url + '.json',
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify(newUser),
                success: function () {
                    hideModal();
                    loadUsers();
                },
                error: function (xhr, status, error) {
                    alert("Failed to add user.");
                    console.error(error);
                }
            });
        }
    });

    // Delete user
    $('#userData').on('click', '.delete', function () {
        let row = $(this).closest('tr');
        let userId = row.attr('data-id');

        if (confirm('Are you sure you want to delete this user?')) {
            $.ajax({
                url: `${url}/${userId}.json`,
                method: 'DELETE',
                success: function () {
                    alert('User deleted successfully!');
                    loadUsers();
                },
                error: function (xhr, status, error) {
                    console.error('Error deleting user:', error);
                    alert('Error deleting user. Please try again.');
                }
            });
        }
    });

    // Edit user
    $('#userData').on('click', '.edit', function () {
        let row = $(this).closest('tr');
        currentUserId = row.attr('data-id');

        $('#userName').val(row.find('td').eq(1).text());
        $('#userEmail').val(row.find('td').eq(2).text());
        $('#userPassword').val(row.find('td').eq(3).text());

        showModal();
    });

    // Tutup modal jika klik tombol close (di HTML ada `onclick="hideModal()"`)
    // atau tombol Escape (sudah ada di HTML script juga)
});