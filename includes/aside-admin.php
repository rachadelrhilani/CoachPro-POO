<button id="toggleAdmin"
  class="lg:hidden fixed top-4 left-4 z-50 bg-gray-900 text-white p-3 rounded-xl shadow-lg">
  ☰
</button>

<aside id="asideAdmin"
  class="fixed inset-y-0 left-0 w-72 bg-gradient-to-b from-gray-900 to-gray-800
         text-white transform -translate-x-full lg:translate-x-0
         transition-transform duration-300 z-40 shadow-2xl">

  <!-- Profil -->
  <div class="p-6 border-b border-gray-700/40">
    <div class="flex items-center gap-3">
      <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center text-xl">
        🛡️
      </div>
      <div>
        <h3 class="font-semibold">Admin</h3>
        <p class="text-sm text-gray-400">Administration</p>
      </div>
    </div>
  </div>

  <!-- Menu -->
  <nav class="p-4 space-y-1">
    <a href="/admin/dashboard" class="menu-item active">
      📊 Dashboard
    </a>

    <a href="/admin/coachs" class="menu-item">
      🏋️ Coachs
    </a>

    <a href="/admin/sportifs" class="menu-item">
      🧍 Sportifs
    </a>

    <a href="/admin/seances" class="menu-item">
      🗓️ Séances
    </a>

    <a href="/admin/reservations" class="menu-item">
      📌 Réservations
    </a>

    <a href="/logout" class="menu-item logout">
      🚪 Déconnexion
    </a>
  </nav>
</aside>

<style>
.menu-item{
  display:flex;
  gap:10px;
  padding:12px 16px;
  border-radius:14px;
  transition:all .25s;
}
.menu-item:hover{
  background:rgba(255,255,255,.15);
  transform:translateX(4px);
}
.menu-item.active{
  background:rgba(255,255,255,.25);
  font-weight:600;
}
.menu-item.logout:hover{
  background:rgba(255,0,0,.25);
}
</style>
<script src="https://cdn.tailwindcss.com"></script>
<script>
toggleAdmin.onclick = () =>
  asideAdmin.classList.toggle('-translate-x-full');
</script>
