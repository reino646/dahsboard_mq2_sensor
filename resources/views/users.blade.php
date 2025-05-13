<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Users Table</title>
  <link rel="stylesheet" href="{{ asset('css/user.css') }}">

  <!-- jQuery CDN -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body>
    <div class="custom-container">
    <div class="flex-row">
        <h1 class="title-no-margin">Users</h1>
        <button class="custom-btn btn-primary" id="addUser">Add User</button>
    </div>

    <table class="custom-table" id="userData">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <!-- Data will be loaded here -->
        </tbody>
    </table>
    </div>

    <!-- Modal -->
    <div class="custom-modal" id="userModal">
        <div class="custom-modal-dialog">
            <form id="userForm" class="custom-modal-content" method="post">
            <div class="custom-modal-header">
                <h5 class="modal-title">Add New User</h5>
                <button type="button" class="btn-close-x" onclick="hideModal()">&times;</button>
            </div>
            <div class="custom-modal-body">
                <label for="userName" class="label-input">Name</label>
                <input type="text" class="input-control" id="userName" required>

                <label for="userEmail" class="label-input">Email</label>
                <input type="email" class="input-control" id="userEmail" required>

                <label for="userPassword" class="label-input">Password</label>
                <input type="password" class="input-control" id="userPassword" required>
            </div>
            <div class="custom-modal-footer">
                <button type="submit" class="custom-btn btn-primary">Save User</button>
            </div>
            </form>
        </div>
    </div>

  <script src="{{ asset('js/user.js') }}"></script>

</body>
</html>
