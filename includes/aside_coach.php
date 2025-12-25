<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<button id="toggleCoach"
  class="lg:hidden fixed top-4 right-4 z-50 bg-indigo-600 text-white p-3 rounded-xl shadow-lg">
  ☰
</button>

<aside id="asideCoach"
  class="fixed inset-y-0 left-0 w-72 bg-gradient-to-b from-indigo-700 to-indigo-600
         text-white transform -translate-x-full lg:translate-x-0
         transition-transform duration-300 z-40 shadow-2xl">

  <div class="p-6 border-b border-indigo-500/30">
    <div class="flex items-center gap-3">
      <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center text-xl">
        🏋️
      </div>
      <div>
        <h3 class="font-semibold"><?= $_SESSION['user_name'] ?? 'Coach' ?></h3>
        <p class="text-sm text-indigo-200"><?= $_SESSION['role'] ?></p>
      </div>
    </div>
  </div>

  <nav class="p-4 space-y-1">
    <a href="../coach/dashboard.php"
      class="menu-item <?= $currentPage == 'dashboard.php' ? 'active' : '' ?>">
      Dashboard
    </a>

    <a href="../coach/edit_profile.php"
      class="menu-item <?= $currentPage == 'edit_profile.php' ? 'active' : '' ?>">
      Mon profil
    </a>

    <a href="../coach/mes_seances.php"
      class="menu-item <?= $currentPage == 'mes_seances.php' ? 'active' : '' ?>">
      Mes séances
    </a>

    <a href="../coach/ajouter_seance.php"
      class="menu-item <?= $currentPage == 'ajouter_seance.php' ? 'active' : '' ?>">
      Ajouter séance
    </a>
    
    <a href="../auth/logout.php" class="menu-item logout">
      Déconnexion
    </a>
  </nav>
</aside>

<style>
  .menu-item {
    display: flex;
    gap: 10px;
    padding: 12px 16px;
    border-radius: 14px;
    transition: all .25s;
  }

  .menu-item:hover {
    background: rgba(255, 255, 255, .15);
    transform: translateX(4px);
  }

  .menu-item.active {
    background: rgba(255, 255, 255, .25);
    font-weight: 600;
  }

  .menu-item.logout:hover {
    background: rgba(255, 0, 0, .2);
  }
</style>

<script src="https://cdn.tailwindcss.com"></script>
<script>
  toggleCoach.onclick = () =>
    asideCoach.classList.toggle('-translate-x-full');
</script>