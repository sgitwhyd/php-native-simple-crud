<nav class="navbar navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand">
            Dashboard
        </a>
        <div class="dropdown">
            <p class="dropdown-toggle mt-3 users" type="p" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                aria-expanded="false">
                <?=$_SESSION["username"]; ?>
            </p>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                <li> <a href="logout.php" class="dropdown-item">logout</a></li>
            </ul>
        </div>
    </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
</script>