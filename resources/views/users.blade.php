<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="./output.css" rel="stylesheet" />
    <title>Sign Up</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap"
      rel="stylesheet"
    />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
        <link rel="icon" type="image/png" href="/img/fire.png" />
  </head>

  <body class="flex font-poppins items-center justify-center">
    <div class="h-screen w-screen flex justify-center items-center dark:bg-orange-950">
      <div class="grid gap-8">
        <div id="back-div" class="bg-gradient-to-r from-orange-400/60 to-red-500/60 rounded-[26px] m-4">
          <div class="border-[20px] border-transparent rounded-[20px] bg-gradient-to-br from-orange-100 via-red-100 to-yellow-100 shadow-lg xl:p-10 2xl:p-10 lg:p-10 md:p-10 sm:p-2 m-2">
            <h1 class="font-bold text-orange-950 text-3xl text-center cursor-default flex flex-col items-center">
              <img src="/img/fire.png" alt="fire icon" class="w-40 h-40" />
            </h1>

            <form id="signupForm" class="space-y-2">
              <div>
                <label for="displayName" class="mb-2 text-gray-400 text-lg">Nama Lengkap</label>
                <input
                  id="displayName"
                  name="displayName"
                  class="border p-3 bg-white dark:bg-gray-100 dark:text-gray-400 dark:border-gray-700 shadow-md placeholder:text-base focus:scale-105 focus:ring-2 focus:ring-red-400 ease-in-out duration-300 border-gray-300 rounded-lg w-full"
                  type="text"
                  placeholder="Nama Lengkap"
                  required
                />
              </div>

              <div>
                <label for="email" class="mb-2 text-gray-400 text-lg">Email</label>
                <input
                  id="email"
                  name="email"
                  class="border p-3 bg-white dark:bg-gray-100 dark:text-gray-400 dark:border-gray-700 shadow-md placeholder:text-base focus:scale-105 focus:ring-2 focus:ring-red-400 ease-in-out duration-300 border-gray-300 rounded-lg w-full"
                  type="email"
                  placeholder="Email"
                  required
                />
              </div>

              <div>
                <label for="password" class="mb-2 text-gray-400 text-lg">Password</label>
                <input
                  id="password"
                  name="password"
                  class="border p-3 bg-white dark:bg-gray-100 dark:text-gray-400 dark:border-gray-700 shadow-md placeholder:text-base focus:scale-105 focus:ring-2 focus:ring-red-400 ease-in-out duration-300 border-gray-300 rounded-lg w-full"
                  type="password"
                  placeholder="Password"
                  required
                />
              </div>

              <button
                class="mb-2 bg-gradient-to-r from-red-500 via-orange-500 to-yellow-400 shadow-lg mt-3 p-2 text-white rounded-lg w-full hover:scale-105 hover:from-yellow-500 hover:to-red-500 transition duration-300 ease-in-out"
                type="submit"
              >
                SIGN UP
              </button>
            </form>

            <a class="group text-gray-500 transition-all duration-100 ease-in-out" href="/">
              Already have an account? 
              <span class="text-red-400 bg-left-bottom bg-gradient-to-r from-red-400 to-red-400 bg-[length:0%_2px] bg-no-repeat group-hover:bg-[length:100%_2px] transition-all duration-500 ease-out">
                login here
              </span>
            </a>
          </div>
        </div>
      </div>
    </div>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script type="module">
import { initializeApp } from "https://www.gstatic.com/firebasejs/11.6.0/firebase-app.js";
import { getAuth, createUserWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/11.6.0/firebase-auth.js";
import { getDatabase, ref, set } from "https://www.gstatic.com/firebasejs/11.6.0/firebase-database.js";

const firebaseConfig = {
  apiKey: "AIzaSyCPcA9PrXIV-9eH84APA8gbCYk9y3b8FfA",
  authDomain: "apps-1ca7f.firebaseapp.com",
  projectId: "apps-1ca7f",
  storageBucket: "apps-1ca7f.appspot.com",
  messagingSenderId: "522627139650",
  appId: "1:522627139650:web:81e6bbc25998fbe5a105db",
  measurementId: "G-QQH7TPZSYG",
  databaseURL: "https://apps-1ca7f-default-rtdb.asia-southeast1.firebasedatabase.app"
};

const app = initializeApp(firebaseConfig);
const auth = getAuth(app);
const db = getDatabase(app);

document.getElementById('signupForm').addEventListener('submit', async (e) => {
  e.preventDefault();
  const name = document.getElementById('displayName').value.trim();
  const email = document.getElementById('email').value;
  const password = document.getElementById('password').value;

  try {
    const userCredential = await createUserWithEmailAndPassword(auth, email, password);
    const user = userCredential.user;
    const uid = user.uid;

    await set(ref(db, 'users/' + uid), {
      uid: uid,
      name: name,
      email: email,
      role: 'user'
    });

    await fetch('/store-session', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      body: JSON.stringify({ displayName: name })
    });

    alert("Akun berhasil dibuat! Selamat datang, " + name);
    window.location.href = '/userDashboard';
  } catch (error) {
    alert("Gagal membuat akun: " + error.message);
    console.error(error);
  }
});
</script>
  </body>
</html>
