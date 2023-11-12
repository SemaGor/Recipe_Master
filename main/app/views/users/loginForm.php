<div class=" p-8 rounded-lg shadow-md w-96">
    <h1 class="text-2xl font-bold mb-4">Connexion</h1>

    <form action="users/login/submit" method="post" class="text-gray-800">
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-300">Name</label>
            <input type="text" name="name" id="name" required class="mt-1 p-2 w-full border rounded-md">
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-300">Mot de passe</label>
            <input type="password" name="password" id="password" required class="mt-1 p-2 w-full border rounded-md">
        </div>

        <div class="mb-4">
            <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-white p-2 rounded-md">Se
                connecter</button>
        </div>
    </form>
</div>