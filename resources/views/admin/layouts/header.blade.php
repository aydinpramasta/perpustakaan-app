<header class="flex items-center justify-between px-6 py-4 bg-white border-b-4 border-indigo-600">
  <div class="flex items-center">
    <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
      <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
      </svg>
    </button>
  </div>

  <div class="flex items-center">
    <div x-data="{ dropdownOpen: false }" class="relative">
      <button @click="dropdownOpen = ! dropdownOpen" class="relative block focus:outline-none">
        {{ auth()->user()->name }}
      </button>

      <div x-cloak x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 z-10 w-full h-full"></div>

      <div x-cloak x-show="dropdownOpen"
        class="absolute right-0 z-10 w-48 mt-2 overflow-hidden bg-white rounded-md shadow-xl">
        <form onsubmit="return window.confirm('Yakin ingin keluar?')" action="{{ route('logout') }}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit"
            class="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-indigo-600 hover:text-white">Logout</button>
        </form>
      </div>
    </div>
  </div>
</header>
