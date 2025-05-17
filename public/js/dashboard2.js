
function data() {
  
    return {
       
        isSideMenuOpen: false,
        toggleSideMenu() {
            this.isSideMenuOpen = !this.isSideMenuOpen
        },
        closeSideMenu() {
            this.isSideMenuOpen = false
        },
        isNotificationsMenuOpen: false,
        toggleNotificationsMenu() {
            this.isNotificationsMenuOpen = !this.isNotificationsMenuOpen
        },
        closeNotificationsMenu() {
            this.isNotificationsMenuOpen = false
        },
        isProfileMenuOpen: false,
        toggleProfileMenu() {
            this.isProfileMenuOpen = !this.isProfileMenuOpen
        },
        closeProfileMenu() {
            this.isProfileMenuOpen = false
        },
        isPagesMenuOpen: false,
        togglePagesMenu() {
            this.isPagesMenuOpen = !this.isPagesMenuOpen
        },
       
    }
}

// Setelah halaman dimuat, ambil gambar profil dari localStorage
window.onload = function() {
    const profileImage = localStorage.getItem("profileImage");
    if (profileImage) {
      const img = document.getElementById("userProfileImage");
      if (img) {
        img.src = profileImage;
        img.classList.remove("hidden");
      }
    }
  };


  
