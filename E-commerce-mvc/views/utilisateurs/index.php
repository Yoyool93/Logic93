<main class="content">
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Email</th>
            <th scope="col">Nom</th>
            <th scope="col">Prenom</th>
           <!-- <th scope="col">Mot de passe</th>-->
        </tr>
        </thead>
        <tbody>
        <?php foreach($users as $user): ?>
            <tr>
                 <td><?= $user['email'] ?></td>
                <td><?= $user['nom'] ?></td>
               <td><?=$user['prenom']?></td>
                <td>
                 <!--   <input type="password" value="<?= $user['mdp'] ?>" disabled id="password-<?= $user['email'] ?>"
                    <i class="fa-solid fa-eye" data-password-id="<?= $user['email'] ?>"></i> 
                </td>
            </tr> -->
        <?php endforeach ?>
        </tbody>
    </table>
</main>

<script>
    const eyeIcons = document.querySelectorAll('.fa-eye');
    eyeIcons.forEach(icon => {
        icon.addEventListener('click', () => {
            const passwordId = icon.getAttribute('data-password-id');
            const passwordInput = document.getElementById(`password-${passwordId}`);

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        });
    });
</script>