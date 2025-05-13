<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="./output.css" rel="stylesheet" />
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap"
      rel="stylesheet"
    />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  </head>

  <body class="flex font-poppins items-center justify-center">
    <div class="h-screen w-screen flex justify-center items-center dark:bg-orange-950">
      <div class="grid gap-8">
        <div id="back-div" class="bg-gradient-to-r from-orange-400/60 to-red-500/60 rounded-[26px] m-4">
          <div class="border-[20px] border-transparent rounded-[20px] bg-gradient-to-br from-orange-100 via-red-100 to-yellow-100 shadow-lg xl:p-10 2xl:p-10 lg:p-10 md:p-10 sm:p-2 m-2">
            <h1 class=" pb-2 font-bold text-orange-950 dark:text-orange-950 text-3xl text-center cursor-default flex flex-col items-center">
              <img src="/img/fire.png" alt="fire icon" class="w-25 h-30 mb-1" />
              Fire Detector
            </h1>

            <form id="loginForm" class="space-y-2">
            <div>
              <label for="email" class="mb-2 text-red-600 dark:text-gray-400 text-lg">Email</label>
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
              <label for="password" class="mb-2 text-red-600 dark:text-gray-400 text-lg">Password</label>
              <input
                id="password"
                name="password"
                class="border p-3 bg-white dark:bg-gray-100 dark:text-gray-400 dark:border-gray-700 shadow-md placeholder:text-base focus:scale-105 focus:ring-2 focus:ring-red-400 ease-in-out duration-300 border-gray-300 rounded-lg w-full"
                type="password"
                placeholder="Password"
                required
              />
            </div>

            <!-- Optional: Only needed if user belum pernah login sebelumnya -->
            <div>
              <label for="displayName" class="mb-2 text-red-600 dark:text-gray-400 text-lg">Nama Lengkap</label>
              <input
                id="displayName"
                name="displayName"
                class="border p-3 bg-white dark:bg-gray-100 dark:text-gray-400 dark:border-gray-700 shadow-md placeholder:text-base focus:scale-105 focus:ring-2 focus:ring-red-400 ease-in-out duration-300 border-gray-300 rounded-lg w-full"
                type="text"
                placeholder="Nama Lengkap"
              />
            </div>

            <a class="group text-red-400 transition-all duration-100 ease-in-out" href="#">
              <span class="bg-left-bottom bg-gradient-to-r from-red-400 to-red-400 bg-[length:0%_2px] bg-no-repeat group-hover:bg-[length:100%_2px] transition-all duration-500 ease-out">
                Forget your password?
              </span>
            </a>

            <button
              class="bg-gradient-to-r from-red-500 via-orange-500 to-yellow-400 shadow-lg mt-6 p-2 text-white rounded-lg w-full hover:scale-105 hover:from-yellow-500 hover:to-red-500 transition duration-300 ease-in-out"
              type="submit"
            >
              LOG IN
            </button>
          </form>


            <!-- Third Party Authentication Options -->
            <div id="third-party-auth" class="flex items-center justify-center mt-5 flex-wrap">
              <button id="signinGoogle" class="hover:scale-105 ease-in-out duration-300 shadow-lg p-2 rounded-lg m-1">
                <img class="max-w-[25px]" src="https://ucarecdn.com/8f25a2ba-bdcf-4ff1-b596-088f330416ef/" alt="Google" />
              </button>
            </div>

            <div class="text-gray-500 flex text-center flex-col mt-4 items-center text-sm">
              <p class="cursor-default">
                By signing in, you agree to our
                <a class="group text-red-400 transition-all duration-100 ease-in-out" href="#">
                  <span class="cursor-pointer bg-left-bottom bg-gradient-to-r from-red-400 to-red-400 bg-[length:0%_2px] bg-no-repeat group-hover:bg-[length:100%_2px] transition-all duration-500 ease-out">
                    Terms
                  </span>
                </a>
                and
                <a class="group text-red-400 transition-all duration-100 ease-in-out" href="#">
                  <span class="cursor-pointer bg-left-bottom bg-gradient-to-r from-red-400 to-red-400 bg-[length:0%_2px] bg-no-repeat group-hover:bg-[length:100%_2px] transition-all duration-500 ease-out">
                    Privacy Policy
                  </span>
                </a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script type="module">
import { initializeApp } from "https://www.gstatic.com/firebasejs/11.6.0/firebase-app.js";
import { getAuth, signInWithPopup, GoogleAuthProvider, signInWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/11.6.0/firebase-auth.js";
import { getDatabase, ref, set, get } from "https://www.gstatic.com/firebasejs/11.6.0/firebase-database.js";

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
const provider = new GoogleAuthProvider();
const db = getDatabase(app);

window.addEventListener('DOMContentLoaded', () => {
  const form = document.querySelector('form');

  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const nameInput = document.getElementById('displayName').value;

    try {
      const userCredential = await signInWithEmailAndPassword(auth, email, password);
      const user = userCredential.user;
      const uid = user.uid;

      const userRef = ref(db, 'users/' + uid);
      const snapshot = await get(userRef);

      let displayName = "";

      if (!snapshot.exists()) {
        displayName = nameInput.trim() || email.split("@")[0]; // fallback kalau nama kosong
        await set(userRef, {
          uid: uid,
          email: email,
          name: displayName,
          role: "user"
        });
      } else {
        const userData = snapshot.val();
        displayName = userData.name || email.split("@")[0];
      }

      // Kirim displayName ke Laravel backend
      await fetch('/store-session', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ displayName: displayName })
      });

      const userData = (await get(userRef)).val();
      const role = userData.role || 'user';

      alert("Login sebagai " + role);
      window.location.href = role === 'admin' ? '/dashboard2' : '/userDashboard';

    } catch (error) {
      alert("Login gagal: " + error.message);
      console.error(error);
    }
  });
});
document.getElementById("signinGoogle").addEventListener("click", async function (e) {
        e.preventDefault();

        try {
          const result = await signInWithPopup(auth, provider);
          const user = result.user;
          const uid = user.uid;
          const email = user.email;
          const displayName = user.displayName;
          const photoURL = user.photoURL;

          const userRef = ref(db, 'users/' + uid);
          const snapshot = await get(userRef);

          if (!snapshot.exists()) {
            await set(userRef, {
              uid: uid,
              email: email,
              name: displayName,
              photoURL: photoURL,
              role: "user"
            });
          }

          const userData = (await get(userRef)).val();
          const role = userData.role || 'user';

          // Kirim displayName ke backend Laravel
          await fetch('/store-session', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ displayName: displayName })
          });

          alert("Login sebagai " + role);
          window.location.href = role === 'admin' ? '/dashboard2' : '/userDashboard';
        } catch (error) {
          alert("Login gagal: " + error.message);
          console.error(error);
        }
        
      });
</script>

  </body>
</html>
