<template>
  <Head :title="pageTitle" />

  <div class="flex h-screen bg-slate-50 font-sans overflow-hidden relative">

    <!-- Mobile Sidebar Overlay -->
    <div v-if="isMobileMenuOpen" class="fixed inset-0 bg-gray-900/50 z-40 lg:hidden" @click="isMobileMenuOpen = false"></div>

    <!-- Sidebar -->
    <aside
      :class="[
        'fixed inset-y-0 left-0 z-50 w-64 bg-white flex flex-col border-r border-gray-100 shrink-0 transition-transform duration-300 lg:relative lg:translate-x-0',
        isMobileMenuOpen ? 'translate-x-0' : '-translate-x-full'
      ]"
    >
      <div class="p-6 flex items-center justify-between">
        <div class="flex items-center gap-3">
          <div class="text-green-500 text-3xl">🌱</div>
          <div>
            <h1 class="text-xl font-extrabold text-[#10B981] leading-none">LesGo</h1>
            <p class="text-[9px] text-gray-400 font-medium">Digital Tutoring Ecosystem</p>
          </div>
        </div>
        <button @click="isMobileMenuOpen = false" class="lg:hidden text-gray-400 hover:text-gray-600 rounded-lg p-1">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
      </div>

      <nav class="flex-1 px-4 py-4 space-y-1 overflow-y-auto">
        <button
          v-for="item in sideNav" :key="item.id" type="button"
          class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-left transition-all duration-200 outline-none"
          :class="activeSection === item.id
            ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold shadow-md shadow-blue-500/20'
            : 'text-gray-500 hover:bg-gray-50 font-medium hover:translate-x-1'"
          @click="goNav(item.id); isMobileMenuOpen = false"
        >
          <span class="text-lg leading-none w-6 text-center shrink-0">{{ item.icon }}</span>
          <span>{{ item.name }}</span>
        </button>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col overflow-hidden w-full relative">

      <!-- Header -->
      <header class="sticky top-0 z-40 bg-white/80 backdrop-blur-md px-4 lg:px-8 py-4 flex items-center justify-between border-b border-gray-100/50">
        <div class="flex items-center gap-4 flex-1">
          <button @click="isMobileMenuOpen = true" class="lg:hidden text-gray-500 hover:text-gray-700 rounded-lg p-1 shrink-0">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
          </button>
          <div class="flex-1 max-w-2xl relative hidden sm:block">
            <span class="absolute inset-y-0 left-4 flex items-center text-gray-400">🔍</span>
            <input type="text" placeholder="Cari siswa" class="w-full bg-[#F3F4F6] border-none rounded-xl py-3 pl-12 pr-4 text-sm focus:ring-2 focus:ring-blue-100 outline-none">
          </div>
        </div>
        <div class="flex items-center gap-3 ml-4 lg:ml-6 shrink-0">
          <div class="text-right hidden sm:block">
            <p class="text-sm font-bold text-gray-900">Isyana Randini</p>
            <p class="text-[10px] text-gray-500 font-medium uppercase tracking-wider">Tutor</p>
          </div>
          <div class="w-10 h-10 bg-blue-100 rounded-full ring-4 ring-white shadow-sm overflow-hidden flex items-center justify-center shrink-0">
            <img src="https://ui-avatars.com/api/?name=Isyana+Randini&background=dbeafe&color=2563eb" alt="Avatar" class="w-full h-full object-cover">
          </div>
        </div>
      </header>

      <!-- Content Area -->
      <div class="flex-1 overflow-y-auto p-4 lg:p-8 space-y-6">

        <!-- ——— Beranda ——— -->
        <template v-if="activeSection === 'beranda'">

          <!-- Row 1: Hero + Notifikasi -->
          <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <!-- Hero Banner -->
            <div class="lg:col-span-8 bg-gradient-to-r from-[#0EA5E9] to-[#3B82F6] rounded-[32px] p-8 lg:p-10 flex justify-between items-center text-white relative overflow-hidden animate-fade-in">
              <div class="hero-orb-1"></div>
              <div class="hero-orb-2"></div>
              <div class="z-10 max-w-md">
                <h2 class="text-3xl lg:text-4xl font-black mb-3">Selamat datang, Isyana!<br>Siap mengajar?</h2>
                <p class="text-blue-50 font-medium mb-8 text-sm opacity-90">Temukan siswa di sekitarmu.</p>
                <button type="button" @click="goNav('cari_siswa')" class="group bg-white text-blue-600 hover:bg-blue-50 px-8 py-3 rounded-xl font-bold text-sm inline-flex items-center gap-2 transition-all duration-300 hover:shadow-lg active:scale-95">
                  🔍 Cari Siswa
                  <span class="group-hover:translate-x-1 transition-transform">→</span>
                </button>
              </div>
              <div class="absolute right-6 lg:right-10 bottom-0 w-40 h-40 lg:w-48 lg:h-48 opacity-90 hidden sm:block animate-float">
                <span class="text-[110px]">👨🏻‍🏫</span>
              </div>
            </div>

            <!-- Notifikasi -->
            <div class="lg:col-span-4 bg-white rounded-[32px] p-6 border border-gray-100 shadow-sm flex flex-col hover:-translate-y-1 hover:shadow-xl hover:shadow-blue-500/10 transition-all duration-300 animate-fade-in-delay-1">
              <div class="flex justify-between items-center mb-6">
                <h3 class="font-bold text-gray-900 flex items-center gap-2">🔔 Notifikasi</h3>
                <a href="#" class="text-xs text-gray-400 font-bold hover:text-blue-600 transition">Lihat Semua</a>
              </div>
              <div class="space-y-5">
                <div v-for="n in notifikasi" :key="n.id" class="flex gap-4 items-start">
                  <div class="w-10 h-10 bg-gradient-to-br from-blue-50 to-indigo-50 shadow-inner text-blue-600 rounded-xl flex items-center justify-center text-lg shrink-0">{{ n.icon }}</div>
                  <div>
                    <p class="text-[13px] font-bold text-gray-800 leading-tight">{{ n.title }}</p>
                    <p class="text-[11px] text-gray-500 mt-1">{{ n.desc }}</p>
                    <p class="text-[10px] text-blue-500 font-bold mt-1">{{ n.time }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Row 2: Siswa Terdekat + Jadwal Mengajar + Penghasilan -->
          <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <!-- Siswa Terdekat -->
            <div class="lg:col-span-4 bg-white rounded-[32px] p-6 border border-gray-100 shadow-sm flex flex-col hover:-translate-y-1 hover:shadow-xl hover:shadow-blue-500/10 transition-all duration-300 animate-slide-up">
              <div class="flex justify-between items-center mb-5">
                <h3 class="font-bold text-gray-900 flex items-center gap-2">📍 Siswa Terdekat</h3>
                <a href="#" class="text-xs text-gray-400 font-bold hover:text-blue-600 transition">Lihat Semua</a>
              </div>
              <div class="space-y-4">
                <div v-for="s in siswaDekat" :key="s.id" class="flex items-center justify-between gap-3">
                  <div class="flex items-center gap-3 min-w-0">
                    <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-lg shrink-0 overflow-hidden">
                      <img :src="`https://ui-avatars.com/api/?name=${s.name.replace(' ','+')}&background=f3f4f6&color=4b5563&size=80`" class="w-full h-full object-cover">
                    </div>
                    <div class="min-w-0">
                      <h4 class="text-[13px] font-bold text-gray-800 leading-none truncate">{{ s.name }}</h4>
                      <p class="text-[10px] text-gray-400 mt-1">{{ s.distance }} dari alamatmu</p>
                      <p class="text-[10px] text-gray-400">{{ s.schedule }}</p>
                    </div>
                  </div>
                  <button type="button" class="shrink-0 px-3 py-1.5 rounded-lg text-[11px] font-bold bg-[#3B82F6] text-white hover:bg-blue-700 transition shadow-sm">
                    Ambil Siswa
                  </button>
                </div>
              </div>
            </div>

            <!-- Jadwal Mengajar -->
            <div class="lg:col-span-4 bg-white rounded-[32px] p-6 border border-gray-100 shadow-sm flex flex-col hover:-translate-y-1 hover:shadow-xl hover:shadow-blue-500/10 transition-all duration-300 animate-slide-up-delay-1">
              <div class="flex justify-between items-center mb-5">
                <h3 class="font-bold text-gray-900 flex items-center gap-2">📅 Jadwal Mengajar</h3>
                <a href="#" class="text-xs text-gray-400 font-bold hover:text-blue-600 transition">Lihat Semua</a>
              </div>
              <div class="space-y-4">
                <div v-for="j in jadwalMengajar" :key="j.id" class="flex items-center gap-3">
                  <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-lg shrink-0 overflow-hidden">
                    <img :src="`https://ui-avatars.com/api/?name=${j.siswa.replace(' ','+')}&background=f3f4f6&color=4b5563&size=80`" class="w-full h-full object-cover">
                  </div>
                  <div>
                    <h4 class="text-[13px] font-bold text-[#3B82F6] leading-none">{{ j.siswa }}</h4>
                    <p class="text-[10px] text-gray-500 font-medium mt-1">{{ j.mapel }}</p>
                    <p class="text-[10px] text-gray-400 mt-0.5">{{ j.waktu }}</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Penghasilan -->
            <div class="lg:col-span-4 bg-white rounded-[32px] p-6 border border-gray-100 shadow-sm flex flex-col hover:-translate-y-1 hover:shadow-xl hover:shadow-blue-500/10 transition-all duration-300 animate-slide-up-delay-2">
              <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-gray-900 flex items-center gap-2">💰 Penghasilan</h3>
                <a href="#" class="text-xs text-gray-400 font-bold hover:text-blue-600 transition">Lihat Semua</a>
              </div>
              <div class="mb-3">
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Satu 2023</p>
                <div class="flex items-end gap-2 mt-1">
                  <span class="text-2xl font-black text-gray-900">$12.7k</span>
                  <span class="text-[11px] font-bold text-emerald-500 mb-1">🔺 1.2%</span>
                </div>
              </div>
              <div class="flex items-center gap-2 mb-3">
                <div class="bg-blue-100 text-blue-700 text-[10px] font-bold px-2.5 py-1 rounded-lg">1,343 sales</div>
              </div>
              <!-- Inline SVG Chart -->
              <div class="flex-1 min-h-[100px] relative">
                <svg viewBox="0 0 280 100" class="w-full h-full" preserveAspectRatio="none">
                  <defs>
                    <linearGradient id="chartGrad" x1="0%" y1="0%" x2="0%" y2="100%">
                      <stop offset="0%" style="stop-color:#3B82F6;stop-opacity:0.15" />
                      <stop offset="100%" style="stop-color:#3B82F6;stop-opacity:0" />
                    </linearGradient>
                  </defs>
                  <path d="M0,70 Q20,65 40,60 T80,50 T120,55 T160,35 T200,45 T240,25 T280,30 L280,100 L0,100 Z" fill="url(#chartGrad)" />
                  <polyline fill="none" stroke="#3B82F6" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" points="0,70 40,60 80,50 120,55 160,35 200,45 240,25 280,30" />
                  <circle cx="240" cy="25" r="4" fill="#3B82F6" stroke="white" stroke-width="2" />
                </svg>
                <div class="flex justify-between text-[9px] text-gray-400 font-bold mt-1 px-1">
                  <span>J</span><span>F</span><span>M</span><span>A</span><span>M</span><span>J</span><span>J</span><span>A</span><span>S</span><span>O</span><span>N</span><span>D</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Row 3: Performa Siswa -->
          <section class="bg-white rounded-[32px] p-6 border border-gray-100 shadow-sm hover:shadow-xl hover:shadow-blue-500/10 transition-all duration-300 animate-fade-in-delay-3">
            <div class="flex justify-between items-center mb-6">
              <h3 class="font-bold text-gray-900 flex items-center gap-2">📊 Performa Siswa</h3>
              <a href="#" class="text-xs text-gray-400 font-bold hover:text-blue-600 transition">Lihat Semua</a>
            </div>
            <div class="space-y-4">
              <div v-for="p in performaSiswa" :key="p.id" class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-full overflow-hidden shrink-0 bg-gray-100">
                  <img :src="`https://ui-avatars.com/api/?name=${p.name.replace(' ','+')}&background=f3f4f6&color=4b5563&size=80`" class="w-full h-full object-cover">
                </div>
                <div class="min-w-0 flex-1">
                  <div class="flex items-center justify-between mb-1">
                    <div>
                      <h4 class="text-[13px] font-bold text-[#3B82F6] leading-none">{{ p.name }}</h4>
                      <p class="text-[10px] text-gray-400 mt-0.5">{{ p.mapel }}</p>
                    </div>
                    <span class="text-[12px] font-bold text-gray-600">{{ p.percent }}%</span>
                  </div>
                  <div class="h-2 rounded-full bg-gray-100 overflow-hidden">
                    <div class="h-full rounded-full bg-gradient-to-r from-[#3B82F6] to-[#0EA5E9] progress-shine transition-all" :style="{ width: `${p.percent}%` }"></div>
                  </div>
                </div>
              </div>
            </div>
          </section>

        </template>

        <!-- ——— Cari Siswa ——— -->
        <template v-else-if="activeSection === 'cari_siswa'">
          <div class="max-w-6xl mx-auto w-full space-y-6 animate-fade-in">

            <!-- === View: Semua === -->
            <template v-if="cariSiswaView === 'semua'">
              <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                  <h2 class="text-3xl font-black text-gray-900 mb-2">Cari Siswa</h2>
                  <p class="text-gray-500 font-medium text-sm">Cari siswa terdekat dan mulai mengajar.</p>
                  <p class="text-gray-500 font-medium text-sm">Lihat profil siswa dan mulai les mengajarnya.</p>
                </div>
                <button @click="cariSiswaView = 'terdekat'" type="button" class="bg-[#2563EB] text-white px-6 py-3 rounded-xl font-bold text-sm inline-flex items-center gap-2 shadow-sm hover:bg-blue-700 transition">
                  📍 Cari Siswa Terdekat
                </button>
              </div>

              <div class="flex items-center gap-2">
                <div class="flex items-center rounded-xl bg-white border border-gray-200 p-1 overflow-x-auto">
                  <button v-for="cat in cariSiswaCategories" :key="cat" type="button"
                    class="px-5 py-2.5 rounded-lg text-sm font-bold whitespace-nowrap transition"
                    :class="cariSiswaFilter === cat ? 'bg-[#2563EB] text-white shadow-sm' : 'text-gray-600 hover:text-gray-800'"
                    @click="cariSiswaFilter = cat"
                  >{{ cat }}</button>
                </div>
                <button type="button" class="w-11 h-11 shrink-0 rounded-xl border border-gray-200 bg-white text-gray-500 hover:bg-gray-50 flex items-center justify-center shadow-sm">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                </button>
              </div>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <article v-for="siswa in filteredCariSiswa" :key="siswa.id" class="bg-white rounded-[24px] border border-gray-200 shadow-sm p-6 flex flex-col hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                  <div class="flex items-start gap-5 mb-4">
                    <div class="w-16 h-16 rounded-full bg-blue-50 shrink-0 overflow-hidden border border-gray-100 shadow-inner">
                      <img :src="`https://ui-avatars.com/api/?name=${siswa.name.replace(' ','+')}&background=eff6ff&color=2563eb&size=128`" :alt="siswa.name" class="w-full h-full object-cover">
                    </div>
                    <div>
                      <h3 class="text-lg font-black text-[#2563EB] leading-tight">{{ siswa.name }}</h3>
                      <p class="text-xs font-bold text-gray-500 mt-0.5">{{ siswa.mapel }}</p>
                      <div class="flex flex-wrap items-center gap-3 mt-1.5 text-[11px] text-gray-400 font-semibold">
                        <span class="flex items-center gap-1">🎓 {{ siswa.jenjang }}</span>
                        <span class="flex items-center gap-1">📍 {{ siswa.lokasi }}</span>
                      </div>
                    </div>
                  </div>
                  <p class="text-xs text-gray-500 leading-relaxed line-clamp-2 mb-6">{{ siswa.deskripsi }}</p>
                  <div class="mt-auto">
                    <button @click="openSiswaProfil(siswa)" type="button" class="w-full py-2.5 rounded-xl text-sm font-bold bg-[#2563EB] text-white hover:bg-blue-700 transition shadow-sm">Ambil Siswa</button>
                  </div>
                </article>
              </div>

              <div class="flex justify-center items-center gap-2 mt-4 pb-4">
                <button class="w-9 h-9 rounded-lg flex items-center justify-center bg-[#2563EB] text-white font-bold shadow-sm">1</button>
                <button class="w-9 h-9 rounded-lg flex items-center justify-center bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 font-medium">2</button>
                <button class="w-9 h-9 rounded-lg flex items-center justify-center bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 font-medium">3</button>
                <button class="w-9 h-9 rounded-lg flex items-center justify-center bg-white border border-gray-200 text-gray-500 hover:bg-gray-50">›</button>
              </div>
            </template>

            <!-- === View: Terdekat (Map) === -->
            <template v-else-if="cariSiswaView === 'terdekat'">
              <div class="mb-4">
                <button @click="cariSiswaView = 'semua'" type="button" class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-lg font-bold text-sm inline-flex items-center gap-2 hover:bg-gray-50 transition shadow-sm">
                  <span>←</span> Kembali
                </button>
              </div>

              <h2 class="text-3xl font-black text-gray-900 mb-1">Siswa Terdekat di Sekitar Kamu.</h2>
              <p class="text-gray-500 font-medium mb-4">Ditemukan {{ siswaTerdekatList.length }} siswa terdekat dalam 2 km</p>

              <div class="bg-white rounded-[24px] border border-gray-200 shadow-sm overflow-hidden">
                <!-- Map -->
                <div class="relative w-full h-[380px] bg-gray-100 overflow-hidden">
                  <iframe class="absolute inset-0 w-full h-full" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=115.18%2C-8.72%2C115.28%2C-8.62&amp;layer=mapnik&amp;marker=-8.670%2C115.230"></iframe>
                  <div class="absolute inset-0 pointer-events-none">
                    <!-- Center pin -->
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex items-center justify-center">
                      <div class="absolute w-[150px] h-[150px] rounded-full border-2 border-blue-300 bg-blue-100/20"></div>
                      <div class="absolute w-[250px] h-[250px] rounded-full border-2 border-blue-200 bg-blue-50/10"></div>
                      <svg class="w-12 h-12 text-red-600 drop-shadow-md transform -translate-y-4" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                      </svg>
                      <span class="absolute mt-8 bg-white px-2 py-0.5 rounded-full text-[10px] font-bold text-gray-600 shadow">15 Mitutp</span>
                    </div>
                    <!-- Floating student tags -->
                    <div class="absolute top-[18%] left-[25%] bg-white rounded-full p-1 pr-3 flex items-center gap-2 shadow-lg border border-gray-100">
                      <img src="https://ui-avatars.com/api/?name=Iqbal&background=eff6ff&color=2563eb" class="w-8 h-8 rounded-full">
                      <p class="text-xs font-black text-gray-900">Iqbal</p>
                    </div>
                    <div class="absolute top-[25%] right-[15%] bg-white rounded-full p-1 pr-3 flex items-center gap-2 shadow-lg border border-gray-100">
                      <img src="https://ui-avatars.com/api/?name=Isyana&background=eff6ff&color=2563eb" class="w-8 h-8 rounded-full">
                      <p class="text-xs font-black text-gray-900">Isyana</p>
                    </div>
                    <div class="absolute bottom-[30%] left-[30%] bg-white rounded-full p-1 pr-3 flex items-center gap-2 shadow-lg border border-gray-100">
                      <img src="https://ui-avatars.com/api/?name=Aldi&background=eff6ff&color=2563eb" class="w-8 h-8 rounded-full">
                      <p class="text-xs font-black text-gray-900">Aldi</p>
                    </div>
                    <div class="absolute bottom-[20%] right-[20%] bg-white rounded-full p-1 pr-3 flex items-center gap-2 shadow-lg border border-gray-100">
                      <img src="https://ui-avatars.com/api/?name=Maya&background=eff6ff&color=2563eb" class="w-8 h-8 rounded-full">
                      <p class="text-xs font-black text-gray-900">Maya</p>
                    </div>
                  </div>
                </div>

                <!-- Student List Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 bg-white">
                  <div v-for="(s, i) in siswaTerdekatList" :key="s.id"
                    class="flex items-center justify-between p-4 border-b border-gray-200 hover:bg-gray-50 cursor-pointer transition"
                    :class="{ 'md:border-r': i % 2 === 0 }"
                    @click="openSiswaProfil(s)"
                  >
                    <div class="flex items-center gap-3">
                      <img :src="`https://ui-avatars.com/api/?name=${s.name.replace(' ','+')}&background=eff6ff&color=2563eb`" class="w-12 h-12 rounded-full">
                      <div>
                        <h4 class="text-sm font-black text-gray-900">{{ s.name }}</h4>
                        <div class="flex items-center gap-2 text-[10px] text-gray-500 font-semibold mt-0.5">
                          <span>🎓 {{ s.jenjang }}</span>
                        </div>
                        <p class="text-[10px] text-gray-400 mt-0.5">📍 {{ s.alamat }}</p>
                      </div>
                    </div>
                    <div class="text-xs font-bold text-gray-500 flex items-center gap-1 shrink-0">
                      <span class="text-gray-400">◎</span> {{ s.jarak }}
                    </div>
                  </div>
                </div>
              </div>
            </template>

            <!-- === View: Profil Siswa === -->
            <template v-else-if="cariSiswaView === 'profil'">
              <div class="mb-4">
                <button @click="cariSiswaView = previousCariView" type="button" class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-lg font-bold text-sm inline-flex items-center gap-2 hover:bg-gray-50 transition shadow-sm">
                  <span>←</span> Kembali
                </button>
              </div>

              <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left: Profile Details -->
                <div class="lg:col-span-2 bg-white rounded-[24px] border border-gray-200 p-8 shadow-sm">
                  <div class="flex flex-col md:flex-row gap-6 items-start">
                    <div class="w-28 h-28 rounded-full overflow-hidden bg-blue-50 shrink-0 border-4 border-white shadow-md">
                      <img :src="`https://ui-avatars.com/api/?name=${selectedSiswa?.name?.replace(' ','+')}&background=eff6ff&color=2563eb&size=256`" class="w-full h-full object-cover">
                    </div>
                    <div class="pt-1">
                      <h2 class="text-3xl font-black text-gray-900 mb-2">{{ selectedSiswa?.name }}</h2>
                      <div class="space-y-1.5">
                        <p class="flex items-center gap-2 text-sm font-bold text-gray-500"><span class="text-lg">📚</span> {{ selectedSiswa?.mapel || 'Matematika' }}</p>
                        <p class="flex items-center gap-2 text-sm font-bold text-gray-500"><span class="text-lg">📍</span> {{ selectedSiswa?.lokasi || selectedSiswa?.alamat || 'Denpasar Selatan' }}</p>
                      </div>
                    </div>
                  </div>

                  <!-- Motivasi Belajar -->
                  <div class="mt-6 bg-[#F5F7FF] rounded-2xl p-5">
                    <p class="text-sm font-black text-gray-800 italic mb-1">Motivasi Belajar</p>
                    <p class="text-sm text-gray-600 leading-relaxed font-medium">Saya ingin lebih memahami pelajaran matematika dan meningkatkan nilai saya di sekolah saya.</p>
                  </div>

                  <!-- Accepted Banner -->
                  <div v-if="siswaAccepted" class="mt-4 flex items-center gap-2 px-4 py-3 bg-emerald-50 border border-emerald-200 rounded-xl">
                    <span class="text-emerald-500 text-lg">✅</span>
                    <p class="text-sm font-bold text-emerald-700">Anda sudah mengambil siswa ini</p>
                  </div>

                  <!-- Details -->
                  <div class="mt-8 space-y-6">
                    <div>
                      <h4 class="flex items-center gap-2 text-base font-bold text-gray-900 mb-2">
                        <span class="text-emerald-500 text-xl">☑</span> Jenjang
                      </h4>
                      <p class="ml-7 flex items-center gap-2 text-sm font-bold text-gray-500"><span class="text-gray-400">🎓</span> {{ selectedSiswa?.jenjang || 'SD' }}-SMA</p>
                    </div>
                    <div>
                      <h4 class="flex items-center gap-2 text-base font-bold text-gray-900 mb-2">
                        <span class="text-emerald-500 text-xl">☑</span> Mata Pelajaran
                      </h4>
                      <p class="ml-7 flex items-center gap-2 text-sm font-bold text-gray-500"><span class="text-gray-400">📚</span> {{ selectedSiswa?.mapel || 'Matematika' }}</p>
                    </div>
                    <div>
                      <h4 class="flex items-center gap-2 text-base font-bold text-gray-900 mb-2">
                        <span class="text-emerald-500 text-xl">☑</span> Metode Pelajaran
                      </h4>
                      <p class="ml-7 flex items-center gap-2 text-sm font-bold text-gray-500"><span class="text-gray-400">🏠</span> Datangi rumah siswa sekitar Denpasar Selatan</p>
                    </div>
                  </div>

                  <!-- Pricing -->
                  <div class="mt-8 flex items-end justify-end">
                    <div class="text-right">
                      <p class="text-sm font-bold text-gray-500">4x Pertemuan</p>
                      <p class="text-3xl font-black text-gray-900">Rp400.000</p>
                    </div>
                  </div>
                </div>

                <!-- Right: Map + CTA -->
                <div class="space-y-6">
                  <!-- Map Card -->
                  <div class="bg-white rounded-[24px] border border-gray-200 p-4 shadow-sm">
                    <div class="relative w-full h-48 rounded-xl overflow-hidden bg-gray-100 mb-4 border border-gray-100">
                      <iframe class="absolute inset-0 w-full h-full" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=115.18%2C-8.72%2C115.28%2C-8.62&amp;layer=mapnik&amp;marker=-8.670%2C115.230"></iframe>
                      <div class="absolute inset-0 pointer-events-none flex items-center justify-center">
                        <svg class="w-10 h-10 text-red-600 drop-shadow-md transform -translate-y-2" viewBox="0 0 24 24" fill="currentColor">
                          <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                        </svg>
                      </div>
                      <button @click="cariSiswaView = 'lokasi'" type="button" class="absolute bottom-3 right-3 bg-[#2563EB] text-white px-4 py-2 rounded-xl text-xs font-bold shadow-md hover:bg-blue-700 transition flex items-center gap-1">
                        📍 Lihat Lokasi
                      </button>
                    </div>
                    <p class="text-sm font-bold text-gray-700 flex items-center gap-2 px-2">
                      <span class="text-gray-400 text-lg">⏳</span> Sekitar 2 km dari rumah Anda
                    </p>
                  </div>

                  <!-- CTA Card: Before Accept -->
                  <div v-if="!siswaAccepted" class="bg-white rounded-[24px] border border-gray-200 p-6 shadow-sm">
                    <div class="flex items-start gap-3 mb-5">
                      <span class="text-3xl">👋</span>
                      <div>
                        <p class="text-sm font-black text-gray-900">Siap jadi tutor {{ selectedSiswa?.name }}?</p>
                        <p class="text-sm font-bold text-gray-900">Yuk ambil siswa sekarang!</p>
                      </div>
                    </div>
                    <div class="flex gap-3">
                      <button type="button" class="flex-1 py-3 rounded-xl text-sm font-bold border-2 border-red-500 text-red-500 hover:bg-red-50 transition text-center">Tolak Siswa</button>
                      <button @click="siswaAccepted = true" type="button" class="flex-1 py-3 rounded-xl text-sm font-bold bg-[#2563EB] text-white hover:bg-blue-700 transition shadow-sm text-center">Ambil Siswa</button>
                    </div>
                  </div>

                  <!-- CTA Card: After Accept -->
                  <div v-else class="bg-white rounded-[24px] border border-gray-200 p-6 shadow-sm">
                    <div class="flex items-start gap-3 mb-5">
                      <span class="text-3xl">📅</span>
                      <div>
                        <p class="text-lg font-black text-gray-900">Atur jadwal</p>
                      </div>
                    </div>
                    <button type="button" class="w-full py-3 rounded-xl text-sm font-bold bg-[#2563EB] text-white hover:bg-blue-700 transition shadow-sm text-center">Chat Siswa</button>
                  </div>
                </div>
              </div>
            </template>

            <!-- === View: Lokasi Siswa === -->
            <template v-else-if="cariSiswaView === 'lokasi'">
              <div class="mb-4">
                <button @click="cariSiswaView = 'profil'" type="button" class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-lg font-bold text-sm inline-flex items-center gap-2 hover:bg-gray-50 transition shadow-sm">
                  <span>←</span> Kembali
                </button>
              </div>
              <h2 class="text-3xl font-black mb-6 text-gray-900">Lokasi Siswa</h2>

              <!-- Map -->
              <div class="relative w-full h-[400px] rounded-2xl overflow-hidden border border-gray-200 shadow-sm bg-gray-100">
                <iframe class="absolute inset-0 w-full h-full" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=115.18%2C-8.72%2C115.28%2C-8.62&amp;layer=mapnik&amp;marker=-8.670%2C115.230"></iframe>
                <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                  <div class="w-64 h-64 rounded-full border-[6px] border-white shadow-[0_0_0_9999px_rgba(255,255,255,0.4)] flex items-center justify-center relative overflow-hidden">
                    <svg class="w-20 h-20 text-red-600 drop-shadow-xl absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-full" viewBox="0 0 24 24" fill="currentColor">
                      <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                    </svg>
                  </div>
                </div>
                <div class="absolute bottom-6 right-6 flex flex-col gap-3">
                  <button type="button" class="bg-[#2563EB] text-white px-5 py-2.5 rounded-xl font-bold text-sm shadow-lg flex items-center gap-2 hover:bg-blue-700 transition">📍 Buka di Google Maps</button>
                  <button type="button" class="bg-white text-blue-600 px-5 py-2.5 rounded-xl font-bold text-sm shadow-lg flex items-center gap-2 hover:bg-gray-50 transition">🔺 Rute ke Lokasi</button>
                </div>
              </div>

              <!-- Details below map -->
              <div class="bg-white rounded-b-3xl border-x border-b border-gray-200 shadow-sm p-8 relative -mt-4 z-10 mx-2">
                <!-- Floating Student Card -->
                <div class="md:absolute md:-top-12 md:right-8 bg-white rounded-2xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.08)] p-5 flex gap-5 md:w-80 w-full mb-6 md:mb-0">
                  <div class="w-16 h-16 rounded-full bg-blue-50 overflow-hidden shrink-0 border border-blue-100">
                    <img :src="`https://ui-avatars.com/api/?name=${selectedSiswa?.name?.replace(' ','+')}&background=eff6ff&color=2563eb`" class="w-full h-full object-cover">
                  </div>
                  <div>
                    <h4 class="text-xl font-black text-[#2563EB] leading-tight">{{ selectedSiswa?.name }}</h4>
                    <p class="text-xs font-bold text-gray-500 mt-1">{{ selectedSiswa?.mapel || 'Matematika' }}</p>
                    <p class="text-[10px] text-gray-400 mt-1 font-semibold">🎓 Siswa {{ selectedSiswa?.jenjang || 'SMP' }}</p>
                    <p class="text-[10px] text-gray-400 mt-0.5 font-semibold">📍 {{ selectedSiswa?.lokasi || selectedSiswa?.alamat || 'Denpasar Selatan' }}</p>
                  </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                  <div class="space-y-6">
                    <div class="space-y-3">
                      <div class="flex items-center gap-3 text-sm font-bold text-gray-700">
                        <span class="text-gray-400 text-lg w-5 text-center">📍</span> Denpasar Selatan
                      </div>
                      <div class="flex items-center gap-3 text-sm font-bold text-gray-700">
                        <span class="text-gray-400 text-lg w-5 text-center">◎</span> Sekitar 2km dari rumah kamu
                      </div>
                    </div>
                    <div>
                      <h3 class="font-black text-gray-900 mb-4 text-lg">Pilih Metode Belajar</h3>
                      <div class="space-y-4">
                        <div class="flex items-start gap-4">
                          <span class="text-gray-400 text-xl w-5 text-center mt-0.5">🏠</span>
                          <div>
                            <p class="text-sm font-bold text-gray-800">Datangi ke rumah kamu</p>
                            <p class="text-xs font-bold text-[#2563EB] mt-1">Area: Denpasar Selatan</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="flex flex-col justify-end items-end gap-3 md:pt-20">
                    <div class="flex flex-wrap gap-3 justify-end w-full">
                      <button type="button" class="bg-[#2563EB] text-white px-6 py-3 rounded-xl font-bold text-sm shadow-sm flex items-center gap-2 hover:bg-blue-700 transition">📞 Hubungi Siswa</button>
                      <button type="button" class="bg-[#2563EB] text-white px-6 py-3 rounded-xl font-bold text-sm shadow-sm flex items-center gap-2 hover:bg-blue-700 transition">✅ Ambil Siswa</button>
                    </div>
                  </div>
                </div>
              </div>
            </template>

          </div>
        </template>

        <!-- ——— Siswa Saya ——— -->
        <template v-else-if="activeSection === 'siswa_saya'">
          <div class="max-w-6xl mx-auto w-full space-y-6 animate-fade-in">
            <div>
              <h2 class="text-3xl font-black text-gray-900 mb-2">Siswa Saya</h2>
              <p class="text-gray-500 font-medium text-sm">Lihat siswa yang sudah mengkonfirmasi dan chat siswa.</p>
            </div>

            <!-- Tabs -->
            <div class="flex items-center rounded-xl bg-white border border-gray-200 p-1 w-fit">
              <button v-for="tab in siswaSayaTabs" :key="tab.id" type="button"
                class="px-6 py-2.5 rounded-lg text-sm font-bold transition"
                :class="siswaSayaFilter === tab.id ? 'bg-[#2563EB] text-white shadow-sm' : 'text-gray-600 hover:text-gray-800'"
                @click="siswaSayaFilter = tab.id"
              >{{ tab.label }}</button>
            </div>

            <!-- Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <article v-for="s in filteredSiswaSaya" :key="s.id" class="bg-white rounded-[24px] border border-gray-200 shadow-sm p-6 hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                <div class="flex items-start gap-4 mb-4">
                  <div class="w-14 h-14 rounded-full bg-blue-50 overflow-hidden shrink-0 border border-gray-100 shadow-inner">
                    <img :src="`https://ui-avatars.com/api/?name=${s.name.replace(' ','+')}&background=eff6ff&color=2563eb&size=128`" class="w-full h-full object-cover">
                  </div>
                  <div class="flex-1 min-w-0">
                    <h3 class="text-base font-black text-[#2563EB] leading-tight">{{ s.name }}</h3>
                    <p class="text-xs font-bold text-gray-500 mt-0.5">{{ s.mapel }}</p>
                    <div class="flex flex-wrap gap-x-4 gap-y-1 mt-1.5 text-[10px] text-gray-400 font-semibold">
                      <span>🎓 {{ s.jenjang }}</span>
                      <span>📍 {{ s.lokasi }}</span>
                      <span>📅 {{ s.jadwal }}</span>
                    </div>
                  </div>
                </div>

                <!-- Confirmed: progress + Chat/Detail -->
                <template v-if="s.status === 'confirmed'">
                  <div class="mb-4">
                    <div class="flex justify-between text-[11px] font-bold mb-1.5">
                      <span class="text-gray-500">Progress</span>
                      <span class="text-gray-600">{{ s.progress }}/4</span>
                    </div>
                    <div class="h-2 rounded-full bg-gray-100 overflow-hidden">
                      <div class="h-full rounded-full bg-gradient-to-r from-[#3B82F6] to-[#0EA5E9] progress-shine transition-all" :style="{ width: `${(s.progress / 4) * 100}%` }"></div>
                    </div>
                  </div>
                  <div class="flex gap-3">
                    <button type="button" class="flex-1 py-2.5 rounded-xl text-sm font-bold border-2 border-[#2563EB] text-[#2563EB] hover:bg-blue-50 transition text-center">Chat</button>
                    <button type="button" class="flex-1 py-2.5 rounded-xl text-sm font-bold bg-[#2563EB] text-white hover:bg-blue-700 transition shadow-sm text-center">Detail</button>
                  </div>
                </template>

                <!-- Pending: expiry warning + Terima/Tolak -->
                <template v-else>
                  <div class="flex items-center gap-2 mb-4 px-3 py-2 bg-red-50 border border-red-100 rounded-xl">
                    <span class="text-red-500 text-base">⚠️</span>
                    <p class="text-[11px] text-red-600 font-bold">Permintaan : konfirmasikan sebelum {{ s.expiry || '24 menit' }}</p>
                  </div>
                  <div class="flex gap-3">
                    <button type="button" class="flex-1 py-2.5 rounded-xl text-sm font-bold bg-[#10B981] text-white hover:bg-emerald-600 transition shadow-sm text-center">Terima</button>
                    <button type="button" class="flex-1 py-2.5 rounded-xl text-sm font-bold bg-red-500 text-white hover:bg-red-600 transition shadow-sm text-center">Tolak</button>
                  </div>
                </template>
              </article>
            </div>
          </div>
        </template>

        <!-- ——— Kelas Saya ——— -->
        <template v-else-if="activeSection === 'kelas_saya'">
          <div class="max-w-6xl mx-auto w-full space-y-6 animate-fade-in">

            <!-- List View -->
            <template v-if="kelasView === 'list'">
              <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                  <h2 class="text-3xl font-black text-gray-900 mb-2">Kelas Saya</h2>
                  <p class="text-gray-500 font-medium text-sm">Kelola kelas dan siswa kamu.</p>
                  <p class="text-gray-500 font-medium text-sm">Buat dan kelola kelas berdasarkan mata pelajaran.</p>
                </div>
                <button type="button" class="bg-[#2563EB] text-white px-6 py-3 rounded-xl font-bold text-sm inline-flex items-center gap-2 shadow-sm hover:bg-blue-700 transition">➕ Buat Kelas Baru</button>
              </div>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <article v-for="k in kelasSayaItems" :key="k.id" class="bg-white rounded-[24px] border border-gray-200 shadow-sm p-6 hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                  <div class="flex items-start gap-4 mb-4">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-2xl shrink-0 shadow-inner" :class="k.bgColor">{{ k.icon }}</div>
                    <div class="flex-1 min-w-0">
                      <h3 class="text-lg font-black text-gray-900 leading-tight">{{ k.subject }}</h3>
                      <p class="text-xs font-bold text-blue-500 mt-0.5">{{ k.level }}</p>
                      <div class="flex flex-wrap gap-x-4 gap-y-1 mt-2 text-[11px] text-gray-400 font-semibold">
                        <span>👥 {{ k.siswaCount }} Siswa</span>
                        <span>📅 {{ k.jadwal }}</span>
                      </div>
                    </div>
                  </div>
                  <div class="flex items-center justify-between">
                    <div class="flex -space-x-2">
                      <div v-for="(a, ai) in k.avatars" :key="ai" class="w-8 h-8 rounded-full border-2 border-white overflow-hidden shadow-sm">
                        <img :src="`https://ui-avatars.com/api/?name=${a.replace(' ','+')}&background=${['dbeafe','fce7f3','d1fae5','fef3c7'][ai % 4]}&color=${['2563eb','db2777','059669','d97706'][ai % 4]}&size=64`" class="w-full h-full object-cover">
                      </div>
                      <div v-if="k.siswaCount > k.avatars.length" class="w-8 h-8 rounded-full border-2 border-white bg-gray-100 flex items-center justify-center text-[10px] font-bold text-gray-500 shadow-sm">+{{ k.siswaCount - k.avatars.length }}</div>
                    </div>
                    <button @click="openKelasDetail(k)" type="button" class="px-5 py-2 rounded-xl text-sm font-bold border-2 border-[#2563EB] text-[#2563EB] hover:bg-blue-50 transition">Lihat Kelas</button>
                  </div>
                </article>
              </div>
            </template>

            <!-- Detail View -->
            <template v-else-if="kelasView === 'detail'">
              <div class="mb-4">
                <button @click="kelasView = 'list'" type="button" class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-lg font-bold text-sm inline-flex items-center gap-2 hover:bg-gray-50 transition shadow-sm">
                  <span>←</span> Kembali
                </button>
              </div>

              <!-- Class Header Card -->
              <div class="bg-white rounded-[24px] border border-gray-200 p-8 shadow-sm">
                <div class="flex flex-col md:flex-row gap-6 items-start">
                  <div class="w-20 h-20 rounded-2xl flex items-center justify-center text-4xl shrink-0 shadow-inner" :class="selectedKelas?.bgColor || 'bg-blue-100'">
                    {{ selectedKelas?.icon }}
                  </div>
                  <div class="flex-1">
                    <h2 class="text-3xl font-black text-gray-900 mb-1">{{ selectedKelas?.subject }}</h2>
                    <span class="inline-block bg-blue-100 text-blue-700 text-xs font-bold px-3 py-1 rounded-lg">{{ selectedKelas?.level }}</span>
                    <p class="text-sm text-gray-500 font-medium mt-3 leading-relaxed">Kelas ini fokus pada pemahaman konsep dasar hingga latihan soal untuk meningkatkan kemampuan matematika siswa.</p>
                  </div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8">
                  <div class="flex items-center gap-3">
                    <span class="text-gray-400 text-xl">📅</span>
                    <div>
                      <p class="text-[10px] text-gray-400 font-bold">Jadwal</p>
                      <p class="text-xs font-bold text-gray-700">{{ selectedKelas?.jadwal }}</p>
                      <p class="text-[10px] text-gray-400">16.00 - 18.00</p>
                    </div>
                  </div>
                  <div class="flex items-center gap-3">
                    <span class="text-gray-400 text-xl">✍️</span>
                    <div>
                      <p class="text-[10px] text-gray-400 font-bold">Metode</p>
                      <p class="text-xs font-bold text-gray-700">Online dan Offline</p>
                      <p class="text-[10px] text-gray-400">Datangi ke rumah dan Online</p>
                    </div>
                  </div>
                  <div class="flex items-center gap-3">
                    <span class="text-gray-400 text-xl">👥</span>
                    <div>
                      <p class="text-[10px] text-gray-400 font-bold">Total Siswa</p>
                      <p class="text-xs font-bold text-gray-700">{{ selectedKelas?.siswaCount }} Siswa</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Students Grid -->
              <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mt-6">
                <div v-for="st in kelasDetailSiswa" :key="st.id" class="bg-white rounded-[20px] border border-gray-200 shadow-sm p-5 hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex flex-col items-center text-center">
                  <div class="w-16 h-16 rounded-full bg-blue-50 overflow-hidden border-2 border-white shadow-md mb-3">
                    <img :src="`https://ui-avatars.com/api/?name=${st.name.replace(' ','+')}&background=eff6ff&color=2563eb&size=128`" class="w-full h-full object-cover">
                  </div>
                  <h4 class="text-sm font-black text-gray-900">{{ st.name }}</h4>
                  <p class="text-[11px] font-bold text-gray-500 mt-0.5">{{ st.mapel }}</p>
                  <div class="flex flex-wrap justify-center gap-x-3 gap-y-1 mt-1.5 text-[10px] text-gray-400 font-semibold">
                    <span>🎓 {{ st.jenjang }}</span>
                    <span>📍 {{ st.lokasi }}</span>
                  </div>
                  <button @click="openKelasSiswaDetail(st)" type="button" class="mt-4 w-full py-2 rounded-xl text-xs font-bold border-2 border-[#2563EB] text-[#2563EB] hover:bg-blue-50 transition">Lihat Detail</button>
                </div>
              </div>
            </template>

            <!-- Siswa Detail View -->
            <template v-else-if="kelasView === 'siswa_detail'">
              <div class="mb-4">
                <button @click="kelasView = 'detail'" type="button" class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-lg font-bold text-sm inline-flex items-center gap-2 hover:bg-gray-50 transition shadow-sm">
                  <span>←</span> Kembali
                </button>
              </div>

              <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column -->
                <div class="lg:col-span-2 space-y-6">
                  <!-- Profile Header -->
                  <div class="bg-white rounded-[24px] border border-gray-200 p-6 shadow-sm">
                    <div class="flex flex-col md:flex-row gap-5 items-start">
                      <div class="w-20 h-20 rounded-full bg-blue-50 overflow-hidden border-4 border-white shadow-md shrink-0">
                        <img :src="`https://ui-avatars.com/api/?name=${selectedKelasSiswa?.name?.replace(' ','+')}&background=eff6ff&color=2563eb&size=160`" class="w-full h-full object-cover">
                      </div>
                      <div class="flex-1">
                        <div class="flex items-center gap-3 mb-1">
                          <h2 class="text-2xl font-black text-gray-900">{{ selectedKelasSiswa?.name }}</h2>
                          <span class="bg-blue-100 text-blue-700 text-[10px] font-bold px-2.5 py-0.5 rounded-lg">Aktif</span>
                        </div>
                        <div class="space-y-1.5 mt-2">
                          <p class="text-sm font-bold text-gray-500 flex items-center gap-2">📚 {{ selectedKelasSiswa?.mapel }} · {{ selectedKelasSiswa?.jenjang }}</p>
                          <p class="text-sm font-bold text-gray-500 flex items-center gap-2">🏠 Metode: Datang ke rumah Tukad Badung, no 12</p>
                          <p class="text-sm font-bold text-gray-500 flex items-center gap-2">📅 Senin & Rabu, 16.00-17.00</p>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Materi Terbaru -->
                  <div class="bg-white rounded-[24px] border border-gray-200 p-6 shadow-sm">
                    <div class="flex justify-between items-center mb-5">
                      <h3 class="font-bold text-gray-900">Materi Terbaru</h3>
                      <a @click.prevent="kelasView = 'materi_detail'" href="#" class="text-xs text-gray-400 font-bold hover:text-blue-600 transition cursor-pointer">Lihat Semua</a>
                    </div>
                    <div class="space-y-4">
                      <div v-for="m in materiTerbaru" :key="m.id" class="flex items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                          <div class="w-10 h-10 rounded-xl flex items-center justify-center text-lg shrink-0" :class="m.done ? 'bg-emerald-50 text-emerald-600' : 'bg-orange-50 text-orange-500'">
                            {{ m.icon }}
                          </div>
                          <div>
                            <p class="text-sm font-bold text-gray-800">{{ m.title }}</p>
                            <p class="text-[10px] text-gray-400 font-medium">Dipelajari: {{ m.date }}</p>
                          </div>
                        </div>
                        <span class="text-[11px] font-bold px-3 py-1 rounded-lg shrink-0" :class="m.done ? 'bg-emerald-50 text-emerald-600' : 'bg-orange-50 text-orange-600'">{{ m.status }}</span>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                  <!-- Progres Belajar -->
                  <div class="bg-white rounded-[24px] border border-gray-200 p-6 shadow-sm">
                    <h3 class="font-bold text-gray-900 mb-4">Progres Belajar</h3>
                    <div class="flex items-center gap-2 mb-4">
                      <span class="text-sm text-gray-500 font-bold">Keseluruhan</span>
                      <span class="text-sm font-black text-gray-900">3/4</span>
                    </div>
                    <div class="h-3 rounded-full bg-gray-100 overflow-hidden mb-6">
                      <div class="h-full rounded-full bg-gradient-to-r from-[#3B82F6] to-[#0EA5E9] progress-shine" style="width:75%"></div>
                    </div>
                    <div class="grid grid-cols-3 gap-3 text-center">
                      <div class="bg-blue-50 rounded-xl p-3">
                        <p class="text-2xl font-black text-[#2563EB]">3</p>
                        <p class="text-[10px] text-gray-500 font-bold mt-1">Soal Selesai</p>
                      </div>
                      <div class="bg-emerald-50 rounded-xl p-3">
                        <p class="text-2xl font-black text-emerald-600">4.8</p>
                        <p class="text-[10px] text-gray-500 font-bold mt-1">Tugas Selesai</p>
                      </div>
                      <div class="bg-amber-50 rounded-xl p-3">
                        <p class="text-2xl font-black text-amber-600">4.8</p>
                        <p class="text-[10px] text-gray-500 font-bold mt-1">Rata-rata Nilai</p>
                      </div>
                    </div>
                  </div>

                  <!-- Catatan Terakhir -->
                  <div class="bg-white rounded-[24px] border border-gray-200 p-6 shadow-sm">
                    <div class="flex justify-between items-center mb-3">
                      <h3 class="font-bold text-gray-900">Catatan Terakhir</h3>
                      <a @click.prevent="kelasView = 'catatan_detail'" href="#" class="text-xs text-gray-400 font-bold hover:text-blue-600 transition cursor-pointer">Lihat Semua</a>
                    </div>
                    <div class="bg-[#F5F7FF] rounded-xl p-4">
                      <p class="text-xs text-gray-600 leading-relaxed">Kenzo sudah menunjukkan perkembangan yang sangat baik dalam memahami materi pecahan, terutama pada operasi penjumlahan dan pengurangan.</p>
                      <p class="text-[10px] text-blue-500 font-bold mt-3">- Isyana Randini</p>
                    </div>
                  </div>

                  <!-- Tugas Terbaru -->
                  <div class="bg-white rounded-[24px] border border-gray-200 p-6 shadow-sm">
                    <div class="flex justify-between items-center mb-4">
                      <h3 class="font-bold text-gray-900">Tugas Terbaru</h3>
                      <a @click.prevent="kelasView = 'tugas_detail'" href="#" class="text-xs text-gray-400 font-bold hover:text-blue-600 transition cursor-pointer">Lihat Semua</a>
                    </div>
                    <div class="space-y-3">
                      <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center gap-3">
                          <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-sm">📝</div>
                          <div>
                            <p class="text-xs font-bold text-gray-800">Latihan Soal Pecahan</p>
                            <p class="text-[10px] text-gray-400">Dikumpulkan: 13 Mar</p>
                          </div>
                        </div>
                        <span class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-lg">Selesai</span>
                      </div>
                      <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center gap-3">
                          <div class="w-8 h-8 rounded-lg bg-orange-50 flex items-center justify-center text-sm">📝</div>
                          <div>
                            <p class="text-xs font-bold text-gray-800">Quiz Desimal</p>
                            <p class="text-[10px] text-gray-400">Dikumpulkan: -</p>
                          </div>
                        </div>
                        <span class="text-[10px] font-bold text-orange-600 bg-orange-50 px-2 py-0.5 rounded-lg">Belum dikerjakan</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </template>

            <!-- Materi Detail View -->
            <template v-else-if="kelasView === 'materi_detail'">
              <div class="mb-4">
                <button @click="kelasView = 'siswa_detail'" type="button" class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-lg font-bold text-sm inline-flex items-center gap-2 hover:bg-gray-50 transition shadow-sm">
                  <span>←</span> Kembali
                </button>
              </div>

              <!-- Student Header -->
              <div class="flex items-center gap-4 mb-6">
                <div class="w-16 h-16 rounded-full bg-blue-50 overflow-hidden border-4 border-white shadow-md shrink-0">
                  <img :src="`https://ui-avatars.com/api/?name=${selectedKelasSiswa?.name?.replace(' ','+')}&background=eff6ff&color=2563eb&size=128`" class="w-full h-full object-cover">
                </div>
                <div>
                  <h2 class="text-2xl font-black text-gray-900">{{ selectedKelasSiswa?.name }}</h2>
                  <p class="text-sm font-bold text-gray-500">Materi</p>
                </div>
              </div>

              <!-- Buat Materi Form -->
              <div class="bg-white rounded-[24px] border border-gray-200 p-6 shadow-sm mb-6">
                <h3 class="text-lg font-black text-gray-900 mb-4">Buat Materi</h3>
                <div class="space-y-4">
                  <div>
                    <label class="text-xs font-bold text-gray-500 mb-1.5 block">Judul Materi</label>
                    <input type="text" placeholder="Contoh: Operasi Hitung" class="w-full md:w-1/2 px-4 py-2.5 rounded-xl border-2 border-blue-200 text-sm font-medium text-gray-700 focus:border-blue-500 focus:outline-none transition">
                  </div>
                  <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                      <label class="text-xs font-bold text-gray-500 mb-1.5 block">Deskripsi Materi</label>
                      <input type="text" placeholder="Contoh: Pengertian pecahan penjumlahan." class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm font-medium text-gray-700 focus:border-blue-500 focus:outline-none transition">
                    </div>
                    <div class="w-full md:w-48">
                      <label class="text-xs font-bold text-gray-500 mb-1.5 block">File Tugas</label>
                      <div class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-gray-400 font-medium flex items-center justify-between cursor-pointer hover:border-blue-300 transition">
                        <span>Pilih File</span>
                        <span class="text-[10px] text-gray-300">(Maks. 10 MB)</span>
                      </div>
                    </div>
                    <div class="flex items-end">
                      <button type="button" class="bg-[#2563EB] text-white px-6 py-2.5 rounded-xl font-bold text-sm hover:bg-blue-700 transition shadow-sm whitespace-nowrap">Tambah Tugas</button>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Daftar Tugas -->
              <h3 class="text-lg font-black text-gray-900 mb-4">Daftar Tugas</h3>
              <div class="space-y-4">
                <div v-for="d in daftarMateri" :key="d.id" class="rounded-2xl p-5 flex items-start gap-4 shadow-sm border" :class="d.bgClass">
                  <div class="w-14 h-14 rounded-xl flex items-center justify-center text-xl font-black shrink-0 shadow-inner" :class="d.iconBg">
                    {{ d.iconText }}
                  </div>
                  <div class="flex-1 min-w-0">
                    <h4 class="text-base font-black text-gray-900">{{ d.title }}</h4>
                    <div class="flex items-center gap-2 text-[10px] text-gray-400 font-semibold mt-1">
                      <span>📅 Diunggah: {{ d.date }}</span>
                    </div>
                    <p class="text-xs text-gray-500 mt-1 leading-relaxed">{{ d.desc }}</p>
                  </div>
                  <span class="text-xs font-bold px-3 py-1 rounded-lg shrink-0 whitespace-nowrap" :class="d.statusClass">{{ d.status }}</span>
                </div>
              </div>
            </template>

            <!-- Catatan Detail View -->
            <template v-else-if="kelasView === 'catatan_detail'">
              <div class="mb-4">
                <button @click="kelasView = 'siswa_detail'" type="button" class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-lg font-bold text-sm inline-flex items-center gap-2 hover:bg-gray-50 transition shadow-sm">
                  <span>←</span> Kembali
                </button>
              </div>

              <!-- Student Header -->
              <div class="flex items-center gap-4 mb-6">
                <div class="w-16 h-16 rounded-full bg-blue-50 overflow-hidden border-4 border-white shadow-md shrink-0">
                  <img :src="`https://ui-avatars.com/api/?name=${selectedKelasSiswa?.name?.replace(' ','+')}&background=eff6ff&color=2563eb&size=128`" class="w-full h-full object-cover">
                </div>
                <div>
                  <h2 class="text-2xl font-black text-gray-900">{{ selectedKelasSiswa?.name }}</h2>
                  <p class="text-sm font-bold text-gray-500">Catatan</p>
                </div>
              </div>

              <!-- Catatan Timeline -->
              <div class="bg-white rounded-[24px] border border-gray-200 p-6 shadow-sm">
                <div class="flex items-center gap-2 mb-6">
                  <span class="text-lg">✍️</span>
                  <h3 class="font-bold text-gray-900">Catatan</h3>
                </div>

                <div class="relative pl-6 border-l-2 border-blue-100 space-y-8">
                  <div v-for="c in catatanSiswa" :key="c.id" class="relative">
                    <div class="absolute -left-[25px] top-1 w-4 h-4 rounded-full bg-[#2563EB] border-2 border-white shadow"></div>
                    <p class="text-xs font-black text-gray-800 mb-2">{{ c.tanggal }}</p>
                    <div class="bg-[#F0F7FF] rounded-xl p-4 ml-1">
                      <p class="text-sm text-gray-600 leading-relaxed font-medium">{{ c.isi }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </template>

            <!-- Tugas Detail View -->
            <template v-else-if="kelasView === 'tugas_detail'">
              <div class="mb-4">
                <button @click="kelasView = 'siswa_detail'" type="button" class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-lg font-bold text-sm inline-flex items-center gap-2 hover:bg-gray-50 transition shadow-sm">
                  <span>←</span> Kembali
                </button>
              </div>

              <!-- Student Header -->
              <div class="flex items-center gap-4 mb-6">
                <div class="w-16 h-16 rounded-full bg-blue-50 overflow-hidden border-4 border-white shadow-md shrink-0">
                  <img :src="`https://ui-avatars.com/api/?name=${selectedKelasSiswa?.name?.replace(' ','+')}&background=eff6ff&color=2563eb&size=128`" class="w-full h-full object-cover">
                </div>
                <div>
                  <h2 class="text-2xl font-black text-gray-900">{{ selectedKelasSiswa?.name }}</h2>
                  <p class="text-sm font-bold text-gray-500">Tugas</p>
                </div>
              </div>

              <!-- Buat Tugas Form -->
              <div class="bg-white rounded-[24px] border border-gray-200 p-6 shadow-sm mb-6">
                <h3 class="text-lg font-black text-gray-900 mb-4">Buat Tugas</h3>
                <div class="space-y-4">
                  <div>
                    <label class="text-xs font-bold text-gray-500 mb-1.5 block">Judul Tugas</label>
                    <input type="text" placeholder="Contoh: Operasi Hitung" class="w-full md:w-1/2 px-4 py-2.5 rounded-xl border-2 border-blue-200 text-sm font-medium text-gray-700 focus:border-blue-500 focus:outline-none transition">
                  </div>
                  <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                      <label class="text-xs font-bold text-gray-500 mb-1.5 block">Deskripsi Tugas</label>
                      <input type="text" placeholder="Contoh: Kerjakan menurut pemahaman kalian." class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm font-medium text-gray-700 focus:border-blue-500 focus:outline-none transition">
                    </div>
                    <div class="w-full md:w-48">
                      <label class="text-xs font-bold text-gray-500 mb-1.5 block">File Materi</label>
                      <div class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-gray-400 font-medium flex items-center justify-between cursor-pointer hover:border-blue-300 transition">
                        <span>Pilih File</span>
                        <span class="text-[10px] text-gray-300">(Maks. 10 MB)</span>
                      </div>
                    </div>
                    <div class="flex items-end">
                      <button type="button" class="bg-[#2563EB] text-white px-6 py-2.5 rounded-xl font-bold text-sm hover:bg-blue-700 transition shadow-sm whitespace-nowrap">Tambah Materi</button>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Daftar Tugas -->
              <h3 class="text-lg font-black text-gray-900 mb-4">Daftar Tugas</h3>
              <div class="space-y-4">
                <div v-for="t in daftarTugas" :key="t.id" class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 flex items-center gap-4 hover:shadow-md transition">
                  <div class="w-12 h-12 rounded-xl flex items-center justify-center text-xl shrink-0" :class="t.iconBg">
                    {{ t.icon }}
                  </div>
                  <div class="flex-1 min-w-0">
                    <h4 class="text-base font-black text-gray-900">{{ t.title }}</h4>
                    <p class="text-[10px] text-gray-400 font-semibold mt-0.5">📅 Batas Waktu: {{ t.deadline }}</p>
                  </div>
                  <span class="text-xs font-bold px-3 py-1 rounded-lg shrink-0" :class="t.statusClass">{{ t.status }}</span>
                </div>
              </div>
            </template>

          </div>
        </template>

        <!-- ——— Jadwal ——— -->
        <template v-else-if="activeSection === 'jadwal'">
          <div class="max-w-6xl mx-auto w-full space-y-6 animate-fade-in">
            <div>
              <h2 class="text-3xl font-black text-gray-900 mb-2">Jadwal Saya</h2>
              <p class="text-gray-500 font-medium text-sm">Kelola semua sesi mengajarmu dengan mudah.</p>
            </div>

            <!-- Tabs -->
            <div class="flex items-center gap-2">
              <div class="flex items-center rounded-xl bg-white border border-gray-200 p-1">
                <button v-for="tab in jadwalTabs" :key="tab.id" type="button"
                  class="px-6 py-2.5 rounded-lg text-sm font-bold transition"
                  :class="jadwalFilter === tab.id ? 'bg-[#2563EB] text-white shadow-sm' : 'text-gray-600 hover:text-gray-800'"
                  @click="jadwalFilter = tab.id"
                >{{ tab.label }}</button>
              </div>
              <button type="button" class="w-11 h-11 shrink-0 rounded-xl border border-gray-200 bg-white text-gray-500 hover:bg-gray-50 flex items-center justify-center shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
              </button>
            </div>

            <!-- Schedule Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <article v-for="j in filteredJadwal" :key="j.id" class="bg-white rounded-[24px] border border-gray-200 shadow-sm p-6 hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                <div class="flex items-start gap-4 mb-4">
                  <div class="w-14 h-14 rounded-full bg-blue-50 overflow-hidden shrink-0 border border-gray-100 shadow-inner">
                    <img :src="`https://ui-avatars.com/api/?name=${j.name.replace(' ','+')}&background=eff6ff&color=2563eb&size=128`" class="w-full h-full object-cover">
                  </div>
                  <div class="flex-1 min-w-0">
                    <h3 class="text-base font-black text-[#2563EB] leading-tight">{{ j.name }}</h3>
                    <p class="text-xs font-bold text-gray-500 mt-0.5">{{ j.mapel }}</p>
                    <div class="flex flex-wrap gap-x-4 gap-y-1 mt-1.5 text-[10px] text-gray-400 font-semibold">
                      <span>🎓 {{ j.jenjang }}</span>
                      <span>📍 {{ j.lokasi }}</span>
                      <span>📅 {{ j.jadwal }}</span>
                    </div>
                  </div>
                </div>
                <div class="mb-4">
                  <div class="flex justify-between text-[11px] font-bold mb-1.5">
                    <span class="text-gray-500">Progress</span>
                    <span class="text-gray-600">{{ j.progress }}/4</span>
                  </div>
                  <div class="h-2 rounded-full bg-gray-100 overflow-hidden">
                    <div class="h-full rounded-full bg-gradient-to-r from-[#3B82F6] to-[#0EA5E9] progress-shine transition-all" :style="{ width: `${(j.progress / 4) * 100}%` }"></div>
                  </div>
                </div>
                <div class="flex justify-end">
                  <button type="button" class="px-8 py-2.5 rounded-xl text-sm font-bold bg-[#2563EB] text-white hover:bg-blue-700 transition shadow-sm">Detail</button>
                </div>
              </article>
            </div>

            <div v-if="filteredJadwal.length === 0" class="bg-white rounded-[24px] border border-gray-200 shadow-sm p-12 text-center">
              <span class="text-5xl mb-3 block">📅</span>
              <p class="text-lg font-bold text-gray-700">Tidak ada jadwal</p>
              <p class="text-sm text-gray-500 mt-1">Belum ada jadwal mengajar untuk periode ini.</p>
            </div>
          </div>
        </template>

        <!-- ——— Keuangan ——— -->
        <template v-else-if="activeSection === 'keuangan'">
          <div class="max-w-6xl mx-auto w-full space-y-6 animate-fade-in">

            <!-- === Riwayat View === -->
            <template v-if="keuanganView === 'riwayat'">
              <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2">
                  <h2 class="text-3xl font-black text-gray-900 mb-2">Keuangan</h2>
                  <p class="text-gray-500 font-medium text-sm">Kelola penghasilan mengajarmu!</p>
                  <p class="text-gray-500 font-medium text-sm">Pantau saldo, lihat riwayat transaksi, dan tarik penghasilan dari siswa dengan mudah.</p>
                </div>
                <div class="bg-gradient-to-br from-[#2563EB] to-[#1D4ED8] rounded-[24px] p-6 text-white shadow-lg">
                  <div class="flex justify-between items-start mb-4">
                    <p class="text-xs font-bold text-blue-200">Saldo Saat Ini</p>
                    <span class="text-blue-200 text-xs font-bold">#FM1024</span>
                  </div>
                  <p class="text-3xl font-black mb-5">Rp 6.350.000</p>
                  <div class="space-y-2">
                    <div class="flex items-center gap-2">
                      <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                      <p class="text-xs font-bold text-blue-100">Saldo Tersedia</p>
                      <p class="text-xs font-black text-white ml-auto">Rp 4.350.000</p>
                    </div>
                    <div class="flex items-center gap-2">
                      <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                      <p class="text-xs font-bold text-blue-100">Dalam Proses</p>
                      <p class="text-xs font-black text-white ml-auto">Rp 2.000.000</p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="flex items-center gap-2 flex-wrap">
                <div class="flex items-center rounded-xl bg-white border border-gray-200 p-1">
                  <button v-for="tab in keuanganTabs" :key="tab.id" type="button"
                    class="px-6 py-2.5 rounded-lg text-sm font-bold transition"
                    :class="keuanganFilter === tab.id ? 'bg-[#2563EB] text-white shadow-sm' : 'text-gray-600 hover:text-gray-800'"
                    @click="keuanganFilter = tab.id"
                  >{{ tab.label }}</button>
                </div>
                <button type="button" class="w-11 h-11 shrink-0 rounded-xl border border-gray-200 bg-white text-gray-500 hover:bg-gray-50 flex items-center justify-center shadow-sm">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                </button>
                <button @click="keuanganView = 'analisis'" type="button" class="ml-auto bg-[#2563EB] text-white px-5 py-2.5 rounded-xl font-bold text-sm hover:bg-blue-700 transition shadow-sm inline-flex items-center gap-2">
                  📊 Analisis
                </button>
              </div>

              <div class="bg-white rounded-[24px] border border-gray-200 shadow-sm overflow-hidden">
                <div class="flex items-center gap-2 px-6 pt-6 pb-3">
                  <span class="text-lg">📋</span>
                  <h3 class="font-bold text-gray-900">Riwayat</h3>
                </div>
                <div class="divide-y divide-gray-100">
                  <div v-for="tx in filteredKeuangan" :key="tx.id" class="flex items-center gap-4 px-6 py-4 hover:bg-gray-50 transition">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg shrink-0" :class="tx.type === 'masuk' ? 'bg-emerald-50' : 'bg-red-50'">
                      🏛️
                    </div>
                    <div class="flex-1 min-w-0">
                      <div class="flex items-center gap-2">
                        <p class="text-sm font-black text-gray-900">{{ tx.title }}</p>
                        <span v-if="tx.badge" class="text-[9px] font-bold px-2 py-0.5 rounded-md" :class="tx.badgeClass">{{ tx.badge }}</span>
                      </div>
                      <p class="text-[11px] text-gray-400 font-medium mt-0.5">{{ tx.desc }}</p>
                    </div>
                    <div class="text-right shrink-0">
                      <p class="text-sm font-black" :class="tx.type === 'masuk' ? 'text-emerald-600' : 'text-red-500'">{{ tx.type === 'masuk' ? '+' : '-' }}Rp {{ tx.amount }}</p>
                      <p class="text-[10px] text-gray-400 font-medium mt-0.5">{{ tx.date }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </template>

            <!-- === Analisis View === -->
            <template v-else-if="keuanganView === 'analisis'">
              <div class="mb-4">
                <button @click="keuanganView = 'riwayat'" type="button" class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-lg font-bold text-sm inline-flex items-center gap-2 hover:bg-gray-50 transition shadow-sm">
                  <span>←</span> Kembali
                </button>
              </div>

              <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2">
                  <h2 class="text-3xl font-black text-gray-900 mb-2">Analisis Pendapatan</h2>
                  <p class="text-gray-500 font-medium text-sm">Pantau saldo, lihat riwayat transaksi, dan tarik penghasilan dari siswa dengan mudah.</p>
                </div>
                <div class="bg-white rounded-[20px] border border-gray-200 p-5 shadow-sm flex items-center gap-4">
                  <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-lg">💰</div>
                  <div>
                    <p class="text-[10px] text-gray-400 font-bold">Saldo Saat Ini</p>
                    <p class="text-xl font-black text-gray-900">Rp 6.350.000</p>
                  </div>
                </div>
              </div>

              <div class="flex justify-end">
                <select class="bg-white border border-gray-200 rounded-xl px-4 py-2 text-sm font-bold text-gray-700 focus:outline-none focus:border-blue-400 shadow-sm cursor-pointer">
                  <option>Tahun 2025</option>
                  <option>Tahun 2024</option>
                  <option>Tahun 2023</option>
                </select>
              </div>

              <!-- Chart Card -->
              <div class="bg-white rounded-[24px] border-2 border-blue-200 p-8 shadow-sm">
                <div class="mb-6">
                  <p class="text-sm font-bold text-gray-500">Tahun 2025</p>
                  <div class="flex items-center gap-3 mt-1">
                    <p class="text-3xl font-black text-[#2563EB]">Rp 45.000.000</p>
                    <span class="bg-emerald-100 text-emerald-700 text-[10px] font-bold px-2.5 py-0.5 rounded-full inline-flex items-center gap-1">🟢 6.4%</span>
                  </div>
                  <p class="text-xs text-gray-400 font-medium mt-1">Dibandingkan periode sebelumnya</p>
                </div>

                <div class="relative w-full" style="height:280px">
                  <svg viewBox="0 0 800 280" class="w-full h-full" preserveAspectRatio="none">
                    <defs>
                      <linearGradient id="areaGrad" x1="0" y1="0" x2="0" y2="1">
                        <stop offset="0%" stop-color="#3B82F6" stop-opacity="0.25"/>
                        <stop offset="100%" stop-color="#3B82F6" stop-opacity="0.02"/>
                      </linearGradient>
                    </defs>
                    <line v-for="i in 5" :key="'gl'+i" x1="0" :y1="i*50" x2="760" :y2="i*50" stroke="#f0f0f0" stroke-width="1"/>
                    <path d="M0,230 C25,215 50,200 67,190 C100,175 133,180 200,160 C267,140 300,150 333,140 C367,130 400,135 467,110 C500,100 533,105 567,65 C600,45 633,60 667,75 C700,85 733,45 767,35" fill="none" stroke="#3B82F6" stroke-width="3" stroke-linecap="round"/>
                    <path d="M0,230 C25,215 50,200 67,190 C100,175 133,180 200,160 C267,140 300,150 333,140 C367,130 400,135 467,110 C500,100 533,105 567,65 C600,45 633,60 667,75 C700,85 733,45 767,35 L767,280 L0,280 Z" fill="url(#areaGrad)"/>
                    <circle cx="567" cy="65" r="7" fill="#3B82F6" stroke="white" stroke-width="3"/>
                  </svg>
                  <!-- Tooltip -->
                  <div class="absolute bg-gray-800 text-white px-4 py-2.5 rounded-xl shadow-lg" style="top:8%;left:62%;transform:translateX(-50%)">
                    <p class="text-sm font-black">Rp 18.000.000</p>
                    <p class="text-[10px] text-gray-300 font-medium">Pendapatan</p>
                    <div class="absolute left-1/2 -bottom-1.5 w-3 h-3 bg-gray-800 rotate-45 transform -translate-x-1/2"></div>
                  </div>
                  <!-- Y labels -->
                  <div class="absolute right-0 top-0 h-full flex flex-col justify-between py-4 text-[10px] font-bold text-gray-400">
                    <span>25jt</span><span>20jt</span><span>15jt</span><span>10jt</span><span>5jt</span>
                  </div>
                </div>
                <!-- X labels -->
                <div class="flex justify-between mt-4 pr-8">
                  <span v-for="m in ['JAN','FEB','MAR','APR','MEI','JUN','JUL','AGU','SEP','OKT','NOV','DES']" :key="m" class="text-[10px] font-bold text-gray-400">{{ m }}</span>
                </div>
              </div>
            </template>

          </div>
        </template>

        <!-- ——— Pesan ——— -->
        <template v-else-if="activeSection === 'pesan'">
          <div class="max-w-6xl mx-auto w-full space-y-6 animate-fade-in">
            <div>
              <h2 class="text-3xl font-black text-gray-900 mb-2">Pesan</h2>
              <p class="text-gray-500 font-medium text-sm">Kirim dan lihat pesanmu dengan siswa.</p>
              <p class="text-gray-500 font-medium text-sm">Jaga komunikasi agar belajar semakin efektif!</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-0 bg-white rounded-[24px] border border-gray-200 shadow-sm overflow-hidden" style="min-height:520px">
              <!-- Contact List -->
              <div class="lg:col-span-1 border-r border-gray-100 overflow-y-auto" style="max-height:520px">
                <div v-for="c in pesanContacts" :key="c.id"
                  @click="selectedChat = c"
                  class="flex items-center gap-3 px-5 py-4 cursor-pointer transition border-l-4"
                  :class="selectedChat?.id === c.id ? 'bg-blue-50 border-[#2563EB]' : 'border-transparent hover:bg-gray-50'"
                >
                  <div class="relative shrink-0">
                    <div class="w-11 h-11 rounded-full bg-blue-50 overflow-hidden border border-gray-100">
                      <img :src="`https://ui-avatars.com/api/?name=${c.name.replace(' ','+')}&background=${c.avatarBg}&color=${c.avatarColor}&size=88`" class="w-full h-full object-cover">
                    </div>
                    <span v-if="c.online" class="absolute bottom-0 right-0 w-3 h-3 rounded-full bg-emerald-400 border-2 border-white"></span>
                  </div>
                  <div class="flex-1 min-w-0">
                    <div class="flex justify-between items-center">
                      <p class="text-sm font-bold text-gray-900 truncate">{{ c.name }}</p>
                      <span class="text-[10px] text-gray-400 font-medium shrink-0 ml-2">{{ c.time }}</span>
                    </div>
                    <p class="text-[11px] text-gray-400 font-medium truncate mt-0.5">{{ c.lastMsg }}</p>
                  </div>
                </div>
              </div>

              <!-- Chat Area -->
              <div class="lg:col-span-2 flex flex-col">
                <template v-if="selectedChat">
                  <!-- Chat Header -->
                  <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                    <div class="flex items-center gap-3">
                      <div class="w-10 h-10 rounded-full bg-blue-50 overflow-hidden border border-gray-100">
                        <img :src="`https://ui-avatars.com/api/?name=${selectedChat.name.replace(' ','+')}&background=${selectedChat.avatarBg}&color=${selectedChat.avatarColor}&size=80`" class="w-full h-full object-cover">
                      </div>
                      <div>
                        <p class="text-sm font-black text-gray-900">{{ selectedChat.name }}</p>
                        <p class="text-[10px] font-bold" :class="selectedChat.online ? 'text-emerald-500' : 'text-gray-400'">{{ selectedChat.online ? 'Online' : 'Offline' }}</p>
                      </div>
                    </div>
                    <div class="flex items-center gap-2">
                      <button type="button" class="w-9 h-9 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center hover:bg-emerald-100 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                      </button>
                      <button type="button" class="w-9 h-9 rounded-lg bg-gray-100 text-gray-500 flex items-center justify-center hover:bg-gray-200 transition">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="5" r="2"/><circle cx="12" cy="12" r="2"/><circle cx="12" cy="19" r="2"/></svg>
                      </button>
                    </div>
                  </div>

                  <!-- Messages -->
                  <div class="flex-1 overflow-y-auto px-6 py-5 space-y-4" style="max-height:380px">
                    <div v-for="msg in selectedChat.messages" :key="msg.id" class="flex" :class="msg.from === 'me' ? 'justify-end' : 'justify-start'">
                      <div class="max-w-[70%] px-4 py-3 rounded-2xl text-sm font-medium leading-relaxed"
                        :class="msg.from === 'me' ? 'bg-[#2563EB] text-white rounded-br-md' : 'bg-gray-100 text-gray-800 rounded-bl-md'"
                      >
                        <p>{{ msg.text }}</p>
                        <p class="text-[9px] mt-1.5 text-right" :class="msg.from === 'me' ? 'text-blue-200' : 'text-gray-400'">{{ msg.time }}</p>
                      </div>
                    </div>
                  </div>

                  <!-- Input -->
                  <div class="px-6 py-4 border-t border-gray-100">
                    <div class="flex items-center gap-3">
                      <button type="button" class="w-10 h-10 shrink-0 rounded-xl bg-gray-100 text-gray-500 flex items-center justify-center hover:bg-gray-200 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                      </button>
                      <input type="text" placeholder="Ketik pesan..." class="flex-1 px-4 py-2.5 rounded-xl border border-gray-200 text-sm font-medium focus:outline-none focus:border-blue-400 transition">
                      <button type="button" class="w-10 h-10 shrink-0 rounded-xl bg-[#2563EB] text-white flex items-center justify-center hover:bg-blue-700 transition shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                      </button>
                    </div>
                  </div>
                </template>
                <template v-else>
                  <div class="flex-1 flex items-center justify-center text-center p-8">
                    <div>
                      <span class="text-5xl mb-3 block">💬</span>
                      <p class="text-lg font-bold text-gray-700">Pilih percakapan</p>
                      <p class="text-sm text-gray-400 mt-1">Klik kontak di sebelah kiri untuk mulai chat.</p>
                    </div>
                  </div>
                </template>
              </div>
            </div>
          </div>
        </template>

        <!-- ——— Ulasan ——— -->
        <template v-else-if="activeSection === 'ulasan'">
          <div class="max-w-6xl mx-auto w-full space-y-6 animate-fade-in">

            <!-- List View -->
            <template v-if="ulasanView === 'list'">
              <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2">
                  <h2 class="text-3xl font-black text-gray-900 mb-2">Ulasan</h2>
                  <p class="text-gray-500 font-medium text-sm">Tingkatkan kualitas ajarmu.</p>
                  <p class="text-gray-500 font-medium text-sm">Baca dan kelola ulasan dari siswa untuk meningkatkan kualitas mengajarmu.</p>
                  <button type="button" class="mt-4 bg-[#2563EB] text-white px-5 py-2.5 rounded-xl font-bold text-sm hover:bg-blue-700 transition shadow-sm inline-flex items-center gap-2">📊 Analisis</button>
                </div>
                <!-- Ringkasan -->
                <div class="bg-white rounded-[24px] border border-gray-200 p-6 shadow-sm">
                  <h3 class="font-bold text-gray-900 mb-3">Ringkasan Ulasan</h3>
                  <div class="flex items-center gap-2 mb-4">
                    <span class="text-3xl">⭐</span>
                    <p class="text-3xl font-black text-gray-900">4.5 <span class="text-sm font-bold text-gray-400">dari 5</span></p>
                  </div>
                  <p class="text-sm font-bold text-gray-500 mb-3">34 Ulasan</p>
                  <div class="space-y-1.5">
                    <div v-for="s in [5,4,3,2,1]" :key="'s'+s" class="flex items-center gap-2">
                      <span class="text-[10px] font-bold text-gray-500 w-4">{{ s }}★</span>
                      <div class="flex-1 h-2 rounded-full bg-gray-100 overflow-hidden">
                        <div class="h-full rounded-full bg-amber-400" :style="{ width: s === 5 ? '65%' : s === 4 ? '20%' : s === 3 ? '10%' : s === 2 ? '3%' : '2%' }"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Reviews List -->
              <div class="bg-white rounded-[24px] border border-gray-200 shadow-sm overflow-hidden">
                <div class="flex items-center gap-2 px-6 pt-6 pb-3">
                  <span class="text-lg">💬</span>
                  <h3 class="font-bold text-gray-900">Ulasan</h3>
                </div>
                <div class="divide-y divide-gray-100">
                  <div v-for="r in ulasanItems" :key="r.id" class="px-6 py-5">
                    <div class="flex items-start justify-between gap-4">
                      <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-full bg-blue-50 overflow-hidden border border-gray-100 shrink-0">
                          <img :src="`https://ui-avatars.com/api/?name=${r.name.replace(' ','+')}&background=${r.avatarBg}&color=${r.avatarColor}&size=80`" class="w-full h-full object-cover">
                        </div>
                        <div>
                          <p class="text-sm font-black text-[#2563EB]">{{ r.name }}</p>
                          <p class="text-[10px] text-gray-400 font-medium">{{ r.mapel }} · {{ r.jenjang }}</p>
                        </div>
                      </div>
                      <div class="flex items-center gap-1 shrink-0">
                        <span v-for="i in 5" :key="'r'+r.id+'s'+i" class="text-sm" :class="i <= r.rating ? 'text-amber-400' : 'text-gray-200'">★</span>
                      </div>
                    </div>
                    <p class="text-sm text-gray-600 font-medium mt-3 leading-relaxed">{{ r.text }}</p>
                    <div class="flex justify-end mt-3">
                      <button @click="openBalasUlasan(r)" type="button" class="px-5 py-2 rounded-xl text-xs font-bold border-2 border-[#2563EB] text-[#2563EB] hover:bg-blue-50 transition">Balas</button>
                    </div>
                  </div>
                </div>
              </div>
            </template>

            <!-- Balas View -->
            <template v-else-if="ulasanView === 'balas'">
              <div class="mb-4">
                <button @click="ulasanView = 'list'" type="button" class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-lg font-bold text-sm inline-flex items-center gap-2 hover:bg-gray-50 transition shadow-sm">
                  <span>←</span> Kembali
                </button>
              </div>

              <!-- Student Review -->
              <div class="bg-white rounded-[24px] border border-gray-200 p-6 shadow-sm">
                <div class="flex items-center gap-3 mb-4">
                  <div class="w-12 h-12 rounded-full bg-blue-50 overflow-hidden border border-gray-100">
                    <img :src="`https://ui-avatars.com/api/?name=${selectedUlasan?.name?.replace(' ','+')}&background=${selectedUlasan?.avatarBg}&color=${selectedUlasan?.avatarColor}&size=96`" class="w-full h-full object-cover">
                  </div>
                  <div>
                    <p class="text-lg font-black text-gray-900">{{ selectedUlasan?.name }}</p>
                    <p class="text-[10px] text-gray-400 font-medium">📅 Diberikan: 18 Mei 2026</p>
                  </div>
                </div>
                <div class="bg-[#F0F7FF] rounded-xl p-4 mb-6">
                  <p class="text-sm text-gray-600 leading-relaxed font-medium">{{ selectedUlasan?.text }}</p>
                </div>

                <h3 class="text-lg font-black text-gray-900 mb-3">Balasan Anda</h3>
                <textarea rows="4" placeholder="Contoh: Terima kasih atas ulasannya, Kevin. Senang sekali mengetahui bahwa penjelasan yang saya berikan dapat membantu kamu lebih memahami materi matematika. Tetap semangat belajar dan jangan ragu untuk bertanya jika ada yang belum dipahami." class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm font-medium text-gray-700 focus:outline-none focus:border-blue-400 transition resize-none leading-relaxed"></textarea>
                <div class="flex justify-end mt-4">
                  <button type="button" class="bg-[#2563EB] text-white px-6 py-3 rounded-xl font-bold text-sm hover:bg-blue-700 transition shadow-sm">Kirim Balasan</button>
                </div>
              </div>
            </template>

          </div>
        </template>

        <!-- ——— Pengaturan ——— -->
        <template v-else-if="activeSection === 'pengaturan'">
          <div class="max-w-6xl mx-auto w-full space-y-6 animate-fade-in">

            <!-- Header -->
            <div>
              <h2 class="text-3xl font-black text-gray-900 mb-2">{{ pengaturanView === 'main' ? 'Pengaturan' : pengaturanView === 'profil' ? 'Pengaturan Profil' : pengaturanView === 'password' ? 'Ganti Kata Sandi' : 'Atur Notifikasi' }}</h2>
              <p class="text-gray-500 font-medium text-sm">{{ pengaturanView === 'main' ? 'Kelola akun dan pengaturanmu.' : pengaturanView === 'profil' ? 'Ubah dan kelola informasi akunmu untuk membuat profilmu lebih akurat.' : pengaturanView === 'password' ? 'Perbarui kata sandi akunmu secara berkala untuk keamanan.' : 'Kelola preferensi notifikasimu.' }}</p>
              <p v-if="pengaturanView === 'main'" class="text-gray-500 font-medium text-sm">Sesuaikan profil dan preferensi sesuai kebutuhanmu.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
              <!-- Sidebar Profile Card -->
              <div class="lg:col-span-1">
                <div class="bg-white rounded-[24px] border border-gray-200 p-6 shadow-sm text-center">
                  <p class="text-sm font-bold text-gray-700 mb-4">Profil Pengguna</p>
                  <div class="w-20 h-20 mx-auto rounded-full bg-blue-50 overflow-hidden border-4 border-white shadow-md mb-3">
                    <img src="https://ui-avatars.com/api/?name=Isyana+Randini&background=eff6ff&color=2563eb&size=160" class="w-full h-full object-cover">
                  </div>
                  <p class="text-sm font-black text-gray-900">Isyana Randini</p>
                  <p class="text-[10px] text-gray-400 font-medium">Tutor</p>
                  <button v-if="pengaturanView !== 'main'" @click="pengaturanView = 'main'" type="button" class="mt-4 text-xs font-bold text-red-500 hover:text-red-600 transition flex items-center gap-1 mx-auto">🗑️ Hapus Akun</button>
                  <button v-else type="button" class="mt-4 text-xs font-bold text-red-500 hover:text-red-600 transition flex items-center gap-1 mx-auto">← Keluar</button>
                </div>
              </div>

              <!-- Content -->
              <div class="lg:col-span-3">

                <!-- Main Settings -->
                <template v-if="pengaturanView === 'main'">
                  <div class="bg-white rounded-[24px] border border-gray-200 shadow-sm divide-y divide-gray-100">
                    <!-- Profil -->
                    <div class="flex items-center justify-between px-6 py-5">
                      <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-lg">👤</div>
                        <div>
                          <p class="text-sm font-black text-gray-900">Isyana Randini</p>
                          <p class="text-[10px] text-gray-400 font-medium">✉️ isyanarandinitutor@gmail.com</p>
                        </div>
                      </div>
                      <button @click="pengaturanView = 'profil'" type="button" class="px-5 py-2 rounded-xl text-xs font-bold border-2 border-[#2563EB] text-[#2563EB] hover:bg-blue-50 transition">Edit Profil</button>
                    </div>
                    <!-- Keamanan -->
                    <div class="flex items-center justify-between px-6 py-5">
                      <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-lg">🔒</div>
                        <div>
                          <p class="text-sm font-black text-gray-900">Keamanan</p>
                          <p class="text-[10px] text-gray-400 font-medium">Ubah dan atur keamanan akun kamu.</p>
                        </div>
                      </div>
                      <button @click="pengaturanView = 'password'" type="button" class="px-5 py-2 rounded-xl text-xs font-bold border-2 border-[#2563EB] text-[#2563EB] hover:bg-blue-50 transition">Ganti Kata Sandi</button>
                    </div>
                    <!-- Aktivitas Login -->
                    <div class="flex items-center justify-between px-6 py-5">
                      <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center text-lg">📱</div>
                        <div>
                          <p class="text-sm font-black text-gray-900">Aktivitas Login</p>
                          <p class="text-[10px] text-gray-400 font-medium">Ubah aktivitas login kamu.</p>
                        </div>
                      </div>
                    </div>
                    <!-- Notifikasi -->
                    <div class="flex items-center justify-between px-6 py-5">
                      <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-purple-50 flex items-center justify-center text-lg">🔔</div>
                        <div>
                          <p class="text-sm font-black text-gray-900">Notifikasi</p>
                          <p class="text-[10px] text-gray-400 font-medium">Atur notifikasi akun kamu.</p>
                        </div>
                      </div>
                      <button @click="pengaturanView = 'notifikasi'" type="button" class="px-5 py-2 rounded-xl text-xs font-bold border-2 border-[#2563EB] text-[#2563EB] hover:bg-blue-50 transition">Atur Notifikasi</button>
                    </div>
                    <!-- Bahasa -->
                    <div class="flex items-center justify-between px-6 py-5">
                      <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-cyan-50 flex items-center justify-center text-lg">🌐</div>
                        <div>
                          <p class="text-sm font-black text-gray-900">Bahasa</p>
                          <p class="text-[10px] text-gray-400 font-medium">Bahasa Indonesia</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </template>

                <!-- Edit Profil -->
                <template v-else-if="pengaturanView === 'profil'">
                  <div class="bg-white rounded-[24px] border border-gray-200 p-6 shadow-sm">
                    <div class="mb-4">
                      <button @click="pengaturanView = 'main'" type="button" class="text-xs font-bold text-gray-500 hover:text-gray-700 transition inline-flex items-center gap-1">← Kembali ke Pengaturan</button>
                    </div>
                    <div class="space-y-5">
                      <div>
                        <label class="text-xs font-bold text-gray-700 mb-1.5 block">Nama Lengkap *</label>
                        <div class="flex items-center gap-3 px-4 py-2.5 rounded-xl border border-gray-200">
                          <span class="text-gray-400">👤</span>
                          <input type="text" value="Isyana Randini" class="flex-1 text-sm font-medium text-gray-700 focus:outline-none">
                        </div>
                      </div>
                      <div>
                        <label class="text-xs font-bold text-gray-700 mb-1.5 block">Alamat Email *</label>
                        <div class="flex items-center gap-3 px-4 py-2.5 rounded-xl border border-gray-200">
                          <span class="text-gray-400">✉️</span>
                          <input type="email" value="isyanarandinitutor@gmail.com" class="flex-1 text-sm font-medium text-gray-700 focus:outline-none">
                        </div>
                      </div>
                      <div>
                        <label class="text-xs font-bold text-gray-700 mb-1.5 block">Nomor Telepon *</label>
                        <div class="flex items-center gap-3 px-4 py-2.5 rounded-xl border border-gray-200">
                          <span class="text-gray-400">📞</span>
                          <input type="tel" value="087793648260" class="flex-1 text-sm font-medium text-gray-700 focus:outline-none">
                        </div>
                      </div>
                      <div>
                        <label class="text-xs font-bold text-gray-700 mb-1.5 block">Alamat Rumah *</label>
                        <div class="flex items-center gap-3 px-4 py-2.5 rounded-xl border border-gray-200">
                          <span class="text-gray-400">🏠</span>
                          <input type="text" value="Jln Cung Wanara" class="flex-1 text-sm font-medium text-gray-700 focus:outline-none">
                        </div>
                      </div>
                      <div>
                        <label class="text-xs font-bold text-gray-700 mb-1.5 block">Tentang Saya *</label>
                        <div class="flex items-start gap-3 px-4 py-2.5 rounded-xl border border-gray-200">
                          <span class="text-gray-400 mt-0.5">✍️</span>
                          <textarea rows="3" class="flex-1 text-sm font-medium text-gray-700 focus:outline-none resize-none">Halo! Saya Isyana Randini, saya mengajar matematika di bidang transformasi geometri, aljabar.</textarea>
                        </div>
                      </div>
                      <div class="flex justify-end pt-2">
                        <button type="button" class="bg-[#2563EB] text-white px-6 py-3 rounded-xl font-bold text-sm hover:bg-blue-700 transition shadow-sm">Simpan Perubahan</button>
                      </div>
                    </div>
                  </div>
                </template>

                <!-- Ganti Kata Sandi -->
                <template v-else-if="pengaturanView === 'password'">
                  <div class="bg-white rounded-[24px] border border-gray-200 p-6 shadow-sm">
                    <div class="mb-4">
                      <button @click="pengaturanView = 'main'" type="button" class="text-xs font-bold text-gray-500 hover:text-gray-700 transition inline-flex items-center gap-1">← Kembali ke Pengaturan</button>
                    </div>
                    <div class="space-y-5 max-w-md">
                      <div>
                        <label class="text-xs font-bold text-gray-700 mb-1.5 block">Kata Sandi Lama *</label>
                        <div class="flex items-center gap-3 px-4 py-2.5 rounded-xl border border-gray-200">
                          <span class="text-gray-400">🔒</span>
                          <input type="password" placeholder="Masukkan kata sandi lama" class="flex-1 text-sm font-medium text-gray-700 focus:outline-none">
                        </div>
                      </div>
                      <div>
                        <label class="text-xs font-bold text-gray-700 mb-1.5 block">Kata Sandi Baru *</label>
                        <div class="flex items-center gap-3 px-4 py-2.5 rounded-xl border border-gray-200">
                          <span class="text-gray-400">🔑</span>
                          <input type="password" placeholder="Masukkan kata sandi baru" class="flex-1 text-sm font-medium text-gray-700 focus:outline-none">
                        </div>
                        <p class="text-[10px] text-gray-400 font-medium mt-1.5">Minimal 8 karakter, huruf besar, huruf kecil, dan angka.</p>
                      </div>
                      <div>
                        <label class="text-xs font-bold text-gray-700 mb-1.5 block">Konfirmasi Kata Sandi Baru *</label>
                        <div class="flex items-center gap-3 px-4 py-2.5 rounded-xl border border-gray-200">
                          <span class="text-gray-400">🔑</span>
                          <input type="password" placeholder="Ulangi kata sandi baru" class="flex-1 text-sm font-medium text-gray-700 focus:outline-none">
                        </div>
                      </div>
                      <div class="flex justify-end pt-2">
                        <button type="button" class="bg-[#2563EB] text-white px-6 py-3 rounded-xl font-bold text-sm hover:bg-blue-700 transition shadow-sm">Ubah Kata Sandi</button>
                      </div>
                    </div>
                  </div>
                </template>

                <!-- Atur Notifikasi -->
                <template v-else-if="pengaturanView === 'notifikasi'">
                  <div class="bg-white rounded-[24px] border border-gray-200 p-6 shadow-sm">
                    <div class="mb-4">
                      <button @click="pengaturanView = 'main'" type="button" class="text-xs font-bold text-gray-500 hover:text-gray-700 transition inline-flex items-center gap-1">← Kembali ke Pengaturan</button>
                    </div>
                    <div class="space-y-1 divide-y divide-gray-100">
                      <div v-for="n in notifSettings" :key="n.id" class="flex items-center justify-between py-4">
                        <div class="flex items-center gap-3">
                          <div class="w-10 h-10 rounded-xl flex items-center justify-center text-lg" :class="n.iconBg">{{ n.icon }}</div>
                          <div>
                            <p class="text-sm font-bold text-gray-900">{{ n.title }}</p>
                            <p class="text-[10px] text-gray-400 font-medium">{{ n.desc }}</p>
                          </div>
                        </div>
                        <button @click="n.active = !n.active" type="button" class="relative w-12 h-7 rounded-full transition-colors duration-300" :class="n.active ? 'bg-[#2563EB]' : 'bg-gray-200'">
                          <span class="absolute top-0.5 w-6 h-6 rounded-full bg-white shadow transition-all duration-300" :class="n.active ? 'left-[22px]' : 'left-0.5'"></span>
                        </button>
                      </div>
                    </div>
                    <div class="flex justify-end pt-4 mt-4 border-t border-gray-100">
                      <button type="button" class="bg-[#2563EB] text-white px-6 py-3 rounded-xl font-bold text-sm hover:bg-blue-700 transition shadow-sm">Simpan Pengaturan</button>
                    </div>
                  </div>
                </template>

              </div>
            </div>
          </div>
        </template>

        <!-- Placeholder Sections -->
        <template v-else>
          <div class="max-w-6xl mx-auto w-full animate-fade-in">
            <section class="bg-[#BFE4F8] rounded-xl border border-blue-100 p-8">
              <h2 class="text-4xl font-black text-gray-900">{{ currentSectionTitle }}</h2>
              <p class="text-sm text-gray-600 mt-2">Halaman ini sedang dalam pengembangan.</p>
            </section>
            <div class="mt-6 bg-white rounded-[24px] border border-gray-200 shadow-sm p-12 text-center">
              <span class="text-6xl mb-4 block">🚧</span>
              <p class="text-lg font-bold text-gray-700">Coming Soon</p>
              <p class="text-sm text-gray-500 mt-2">Fitur {{ currentSectionTitle }} akan segera hadir.</p>
            </div>
          </div>
        </template>

      </div>
    </main>
  </div>
</template>

<script setup>
import { computed, reactive, ref } from 'vue'
import { Head } from '@inertiajs/vue3'

const activeSection = ref('beranda')
const isMobileMenuOpen = ref(false)

const sideNav = [
  { id: 'beranda', name: 'Beranda', icon: '▦' },
  { id: 'cari_siswa', name: 'Cari Siswa', icon: '🔍' },
  { id: 'siswa_saya', name: 'Siswa Saya', icon: '👥' },
  { id: 'kelas_saya', name: 'Kelas Saya', icon: '🎓' },
  { id: 'jadwal', name: 'Jadwal', icon: '📅' },
  { id: 'keuangan', name: 'Keuangan', icon: '💰' },
  { id: 'pesan', name: 'Pesan', icon: '✉️' },
  { id: 'ulasan', name: 'Ulasan', icon: '⭐' },
  { id: 'pengaturan', name: 'Pengaturan', icon: '⚙️' },
]

const sectionTitles = {
  beranda: 'Beranda Tutor',
  cari_siswa: 'Cari Siswa',
  siswa_saya: 'Siswa Saya',
  kelas_saya: 'Kelas Saya',
  jadwal: 'Jadwal',
  keuangan: 'Keuangan',
  pesan: 'Pesan',
  ulasan: 'Ulasan',
  pengaturan: 'Pengaturan',
}

const currentSectionTitle = computed(() => sectionTitles[activeSection.value] || 'Beranda Tutor')
const pageTitle = computed(() => currentSectionTitle.value)

function goNav(id) {
  activeSection.value = id
}

// --- Data Mock ---

const notifikasi = [
  { id: 1, icon: '📘', title: 'Sesi mengajar hari ini', desc: 'Mengajar Dovina, 15:00-16:00', time: '1 jam lalu' },
  { id: 2, icon: '🆕', title: 'Siswa Baru', desc: 'Aninda mencari tutor matematika, segera konfirmasi!', time: '2 jam lalu' },
]

const siswaDekat = [
  { id: 1, name: 'N.Natasha', distance: '400m', schedule: '08:00-17:00' },
  { id: 2, name: 'Kenzo Aliza', distance: '1,2km', schedule: 'Jumat, 19:00-20:00' },
  { id: 3, name: 'Rina Putri', distance: '1,5km', schedule: 'Minggu, 15:00-17:00' },
]

const jadwalMengajar = [
  { id: 1, siswa: 'Kevin H', mapel: 'Matematika-SMP', waktu: 'Hari ini, 2:00-15.00' },
  { id: 2, siswa: 'Eka Savitry', mapel: 'Matematika-SMA', waktu: 'Harini, 15:00-16:00' },
  { id: 3, siswa: 'Natasha', mapel: 'Matematika-SD', waktu: 'Minggu, 15:00-13:00' },
]

const performaSiswa = [
  { id: 1, name: 'Kevin H', mapel: 'Matematika-SMP', percent: 85 },
  { id: 2, name: 'Kevin H', mapel: 'Matematika-SMP', percent: 15 },
  { id: 3, name: 'Kevin H', mapel: 'Matematika-SMP', percent: 15 },
  { id: 4, name: 'Kevin H', mapel: 'Matematika-SMP', percent: 15 },
]

// --- Cari Siswa ---
const cariSiswaFilter = ref('Semua')
const cariSiswaCategories = ['Semua', 'Fisika', 'Matematika', 'Bahasa Inggris', 'Informatika']

const cariSiswaItems = [
  { id: 1, name: 'Kenzo Aliza', mapel: 'Matematika', jenjang: 'SD', lokasi: 'Tobat/Bedung, no 01', deskripsi: 'Halo! Saya Kenzo Aliza, seorang siswa SMP yang senang belajar informatika dan matematika. Mari belajar bersama!' },
  { id: 2, name: 'Eka Savitry', mapel: 'Informatika', jenjang: 'SMP', lokasi: 'Grame', deskripsi: 'Halo! Saya Eka Savitry, seorang siswa SMP yang senang belajar informatika dan matematika. Mari belajar bersama!' },
  { id: 3, name: 'Natasha', mapel: 'Fisika', jenjang: 'SMA', lokasi: 'Online', deskripsi: 'Halo! Saya Kenzo Aliza, seorang siswa SMP yang senang belajar informatika dan matematika. Mari belajar bersama!' },
  { id: 4, name: 'Ananta Aldora', mapel: 'Bahasa Inggris', jenjang: 'SMA', lokasi: 'Tobat Bedung, no 01', deskripsi: 'Halo! Saya Kenzo Aliza, seorang siswa SMP yang senang belajar informatika dan matematika. Mari belajar bersama!' },
  { id: 5, name: 'Kenzo Aliza', mapel: 'Matematika', jenjang: 'SMP', lokasi: 'Tobat/Bedung, no 01', deskripsi: 'Halo! Saya Kenzo Aliza, seorang siswa SMP yang senang belajar informatika dan matematika. Mari belajar bersama!' },
  { id: 6, name: 'Eka Savitry', mapel: 'Informatika', jenjang: 'SMP', lokasi: 'Online', deskripsi: 'Halo! Saya Eka Savitry, seorang siswa SMP yang senang belajar informatika dan matematika. Mari belajar bersama!' },
  { id: 7, name: 'Natasha', mapel: 'Fisika', jenjang: 'SMA', lokasi: 'Online', deskripsi: 'Halo! Saya Kenzo Aliza, seorang siswa SMP yang senang belajar informatika dan matematika. Mari belajar bersama!' },
  { id: 8, name: 'Ananta Aldora', mapel: 'Bahasa Inggris', jenjang: 'SMA', lokasi: 'Tobat Bedung, no 01', deskripsi: 'Halo! Saya Kenzo Aliza, seorang siswa SMP yang senang belajar informatika dan matematika. Mari belajar bersama!' },
]

const filteredCariSiswa = computed(() => {
  if (cariSiswaFilter.value === 'Semua') return cariSiswaItems
  return cariSiswaItems.filter(s => s.mapel === cariSiswaFilter.value)
})

// --- Cari Siswa Terdekat ---
const cariSiswaView = ref('semua')
const previousCariView = ref('semua')
const selectedSiswa = ref(null)
const siswaAccepted = ref(false)

function openSiswaProfil(siswa) {
  previousCariView.value = cariSiswaView.value
  selectedSiswa.value = siswa
  siswaAccepted.value = false
  cariSiswaView.value = 'profil'
}

const siswaTerdekatList = [
  { id: 1, name: 'Kenzo Aliza', jenjang: 'SD', alamat: 'Tukad Badung, no 12', jarak: '300m' },
  { id: 2, name: 'Isyana Randini', jenjang: 'SD', alamat: 'Tukad Badung, no 12', jarak: '1.3km' },
  { id: 3, name: 'Iqbal Mustofa', jenjang: 'SD', alamat: 'Tukad Badung, no 0', jarak: '350m' },
  { id: 4, name: 'Iqbal Mustofa', jenjang: 'SD', alamat: 'Tukad Badung, no 0', jarak: '1.2km' },
  { id: 5, name: 'Tania Riana', jenjang: 'SD', alamat: 'Tukad Badung, no 12', jarak: '400m' },
  { id: 6, name: 'Tania Riana', jenjang: 'SD', alamat: 'Tukad Badung, no 12', jarak: '1.5km' },
]

// --- Siswa Saya ---
const siswaSayaFilter = ref('terkonfirmasi')
const siswaSayaTabs = [
  { id: 'terkonfirmasi', label: 'Terkonfirmasi' },
  { id: 'menunggu', label: 'Menunggu' },
]

const siswaSayaItems = [
  { id: 1, name: 'Kenzo Aliza', mapel: 'Matematika', jenjang: 'SD', lokasi: 'Tukad Badung, no 12', jadwal: 'Senin, 17:00-18:00', progress: 2, status: 'confirmed' },
  { id: 2, name: 'Eka Savitry', mapel: 'Informatika', jenjang: 'SMP', lokasi: 'Online', jadwal: 'Senin, 7:00-8:00', progress: 2, status: 'confirmed' },
  { id: 3, name: 'Natasha', mapel: 'Fisika', jenjang: 'SMA', lokasi: 'Online', jadwal: 'Senin, 17:00-18:00', progress: 2, status: 'confirmed' },
  { id: 4, name: 'Ananta Aldora', mapel: 'Bahasa Inggris', jenjang: 'SMA', lokasi: 'Tukad Badung, no 12', jadwal: 'Senin, 17:00-18:00', progress: 2, status: 'confirmed' },
  { id: 5, name: 'Kenzo Aliza', mapel: 'Matematika', jenjang: 'SD', lokasi: 'Tukad Badung, no 12', jadwal: 'Senin, 17:00-18:00', progress: 2, status: 'confirmed' },
  { id: 6, name: 'Eka Savitry', mapel: 'Informatika', jenjang: 'SMP', lokasi: 'Online', jadwal: 'Senin, 17:00-18:00', progress: 2, status: 'confirmed' },
  { id: 7, name: 'Natasha', mapel: 'Fisika', jenjang: 'SMA', lokasi: 'Online', jadwal: 'Senin, 17:00-18:00', progress: 2, status: 'confirmed' },
  { id: 8, name: 'Ananta Aldora', mapel: 'Bahasa Inggris', jenjang: 'SMA', lokasi: 'Tukad Badung, no 12', jadwal: 'Senin, 7:00-8:00', progress: 2, status: 'confirmed' },
  { id: 9, name: 'Kenzo Aliza', mapel: 'Matematika', jenjang: 'SD', lokasi: 'Tukad Badung, no 0', jadwal: 'Senin, 17:00-18:00', progress: 0, status: 'pending', expiry: '24 menit' },
  { id: 10, name: 'Eka Savitry', mapel: 'Informatika', jenjang: 'SMP', lokasi: 'Online', jadwal: 'Senin, 17:00-18:00', progress: 0, status: 'pending', expiry: '24 menit' },
  { id: 11, name: 'Natasha', mapel: 'Fisika', jenjang: 'SMA', lokasi: 'Online', jadwal: 'Senin, 17:00-18:00', progress: 0, status: 'pending', expiry: '24 menit' },
  { id: 12, name: 'Ananta Aldora', mapel: 'Bahasa Inggris', jenjang: 'SMA', lokasi: 'Tukad Badung, no 12', jadwal: 'Senin, 17:00-18:00', progress: 0, status: 'pending', expiry: '24 menit' },
  { id: 13, name: 'Kenzo Aliza', mapel: 'Matematika', jenjang: 'SD', lokasi: 'Tukad Badung, no 0', jadwal: 'Senin, 17:00-18:00', progress: 0, status: 'pending', expiry: '34 menit' },
  { id: 14, name: 'Eka Savitry', mapel: 'Informatika', jenjang: 'SMP', lokasi: 'Online', jadwal: 'Senin, 17:00-18:00', progress: 0, status: 'pending', expiry: '34 menit' },
  { id: 15, name: 'Natasha', mapel: 'Fisika', jenjang: 'SMA', lokasi: 'Online', jadwal: 'Senin, 17:00-18:00', progress: 0, status: 'pending', expiry: '24 menit' },
  { id: 16, name: 'Ananta Aldora', mapel: 'Bahasa Inggris', jenjang: 'SMA', lokasi: 'Tukad Badung, no 12', jadwal: 'Senin, 17:00-18:00', progress: 0, status: 'pending', expiry: '24 menit' },
]

const filteredSiswaSaya = computed(() => {
  if (siswaSayaFilter.value === 'menunggu') return siswaSayaItems.filter(s => s.status === 'pending')
  return siswaSayaItems.filter(s => s.status === 'confirmed')
})

// --- Kelas Saya ---
const kelasSayaItems = [
  { id: 1, subject: 'Matematika', level: 'SMP', icon: '⚛️', bgColor: 'bg-blue-100', siswaCount: 8, jadwal: 'Senin & Rabu', avatars: ['Kenzo', 'Eka', 'Natasha', 'Aldi'] },
  { id: 2, subject: 'Informatika', level: 'SMP', icon: '💡', bgColor: 'bg-amber-100', siswaCount: 5, jadwal: 'Senin & Rabu', avatars: ['Rina', 'Budi', 'Maya'] },
  { id: 3, subject: 'Fisika', level: 'SMP', icon: '⚛️', bgColor: 'bg-purple-100', siswaCount: 8, jadwal: 'Senin & Rabu', avatars: ['Iqbal', 'Tania', 'Doni', 'Sari'] },
  { id: 4, subject: 'Kimia', level: 'SMP', icon: '🧪', bgColor: 'bg-green-100', siswaCount: 5, jadwal: 'Senin & Rabu', avatars: ['Ayu', 'Reno', 'Dina'] },
  { id: 5, subject: 'Matematika Lanjutan', level: 'SMP', icon: '📐', bgColor: 'bg-gray-100', siswaCount: 8, jadwal: 'Senin & Rabu', avatars: ['Kevin', 'Lisa', 'Andi', 'Putri'] },
  { id: 6, subject: 'Bahasa Inggris', level: 'SMP', icon: '🇬🇧', bgColor: 'bg-gray-100', siswaCount: 8, jadwal: 'Senin & Rabu', avatars: ['Rini', 'Fajar', 'Dewi', 'Agus'] },
  { id: 7, subject: 'Fisika', level: 'SMP', icon: '⚛️', bgColor: 'bg-purple-100', siswaCount: 8, jadwal: 'Senin & Rabu', avatars: ['Hana', 'Rizki', 'Wulan', 'Dani'] },
  { id: 8, subject: 'Kimia', level: 'SMP', icon: '🧪', bgColor: 'bg-green-100', siswaCount: 5, jadwal: 'Senin & Rabu', avatars: ['Mega', 'Yoga', 'Sinta'] },
  { id: 9, subject: 'Matematika Lanjutan', level: 'SMP', icon: '📐', bgColor: 'bg-blue-50', siswaCount: 8, jadwal: 'Senin & Rabu', avatars: ['Rio', 'Anita', 'Bayu', 'Citra'] },
  { id: 10, subject: 'Bahasa Inggris', level: 'SMP', icon: '🇬🇧', bgColor: 'bg-gray-100', siswaCount: 8, jadwal: 'Senin & Rabu', avatars: ['Vina', 'Aldi', 'Nisa', 'Galih'] },
]

const kelasView = ref('list')
const selectedKelas = ref(null)

function openKelasDetail(kelas) {
  selectedKelas.value = kelas
  kelasView.value = 'detail'
}

const kelasDetailSiswa = [
  { id: 1, name: 'Kenzo Aliza', mapel: 'Matematika', jenjang: 'SMP', lokasi: 'Tukad Badung, no 12' },
  { id: 2, name: 'Ariana Grad', mapel: 'Matematika', jenjang: 'SD', lokasi: 'Online' },
  { id: 3, name: 'Justine', mapel: 'Matematika', jenjang: 'SD', lokasi: 'Online' },
  { id: 4, name: 'Niki', mapel: 'Matematika', jenjang: 'SD', lokasi: 'Tukad Badung, no 12' },
  { id: 5, name: 'Ngurah Arya', mapel: 'Matematika', jenjang: 'SD', lokasi: 'Tukad Badung, no 12' },
  { id: 6, name: 'Isma Yanti', mapel: 'Matematika', jenjang: 'SD', lokasi: 'Tukad Badung, no 12' },
  { id: 7, name: 'Salca Menita', mapel: 'Matematika', jenjang: 'SD', lokasi: 'Tukad Badung, no 12' },
  { id: 8, name: 'Kenzo Aliza', mapel: 'Matematika', jenjang: 'SMP', lokasi: 'Tukad Badung, no 12' },
]

const selectedKelasSiswa = ref(null)

function openKelasSiswaDetail(siswa) {
  selectedKelasSiswa.value = siswa
  kelasView.value = 'siswa_detail'
}

const materiTerbaru = [
  { id: 1, title: 'Operasi Pecahan (Penjumlahan & Pengurangan)', icon: '🟢', date: '22 Mar 2026', status: 'Selesai', done: true },
  { id: 2, title: 'Operasi Pecahan (Perkalian & Pembagian)', icon: '🟠', date: '22 Mar 2026', status: 'Belum dipelajari', done: false },
  { id: 3, title: 'Bilangan Bulat (Operasi Hitung)', icon: '🟡', date: '17 Mar 2026', status: 'Belum dipelajari', done: false },
  { id: 4, title: 'Bilangan Bulat (Operasi Hitung)', icon: '🟡', date: '17 Mar 2026', status: 'Belum dipelajari', done: false },
]

const daftarMateri = [
  { id: 1, title: 'Operasi Pecahan (Penjumlahan & Pengurangan)', date: '17 Mei, 19.34', desc: 'Pengertian pecahan penjumlahan berpenyebut sama dan pengurangan pecahan.', iconText: '÷', iconBg: 'bg-blue-100 text-blue-700', bgClass: 'bg-gradient-to-r from-blue-50 to-white border-blue-100', status: 'Selesai', statusClass: 'bg-emerald-50 text-emerald-600' },
  { id: 2, title: 'Operasi Pecahan (Perkalian & Pembagian)', date: '17 Mei, 19.34', desc: 'Pengertian pecahan penjumlahan berpenyebut sama dan pengurangan pecahan.', iconText: '1/22', iconBg: 'bg-amber-100 text-amber-700', bgClass: 'bg-gradient-to-r from-amber-50 to-white border-amber-100', status: 'Sedang dipelajari', statusClass: 'bg-amber-50 text-amber-600' },
  { id: 3, title: 'Bilangan Bulat (Operasi Hitung)', date: '17 Mei, 19.34', desc: 'Pengertian pecahan penjumlahan berpenyebut sama dan pengurangan pecahan.', iconText: '%', iconBg: 'bg-emerald-100 text-emerald-700', bgClass: 'bg-gradient-to-r from-emerald-50 to-white border-emerald-100', status: 'Belum dipelajari', statusClass: 'bg-orange-50 text-orange-600' },
  { id: 4, title: 'Desimal (Operasi Hitung Campuran)', date: '17 Mei, 19.34', desc: 'Pengertian pecahan penjumlahan berpenyebut sama dan pengurangan pecahan.', iconText: '0.5', iconBg: 'bg-cyan-100 text-cyan-700', bgClass: 'bg-gradient-to-r from-cyan-50 to-white border-cyan-100', status: 'Belum dipelajari', statusClass: 'bg-orange-50 text-orange-600' },
]

const catatanSiswa = [
  { id: 1, tanggal: 'Sabtu, 18 Mei 2026', isi: 'Kenzo sudah menunjukkan perkembangan yang sangat baik dalam memahami materi pecahan, terutama pada operasi penjumlahan dan pengurangan. Ia mulai lebih percaya diri saat mengerjakan soal tanpa bantuan.' },
  { id: 2, tanggal: 'Jumat, 17 Mei 2026', isi: 'Pada pertemuan kali ini, Kenzo sudah mampu menyelesaikan sebagian besar soal operasi pecahan dengan benar. Ia juga mulai memahami konsep dasar dengan lebih baik dibanding pertemuan sebelumnya.' },
  { id: 3, tanggal: 'Sabtu, 18 Mei 2026', isi: 'Kenzo terlihat lebih aktif dan berani bertanya selama sesi pembelajaran berlangsung. Hal ini sangat positif karena membantu mempercepat pemahaman materi. Ke depannya, perlu terus dipertahankan konsistensi belajar dan ditingkatkan latihan mandiri di rumah.' },
  { id: 4, tanggal: 'Sabtu, 18 Mei 2026', isi: 'Hari ini Kenzo belajar dengan cukup fokus dan mampu mengikuti materi dengan baik. Beberapa kesalahan kecil masih terjadi, namun sudah bisa diperbaiki setelah diberikan penjelasan. Overall, perkembangan cukup baik. 👍' },
]

const daftarTugas = [
  { id: 1, title: 'Latihan Soal Pecahan', deadline: '17 Mei, 19.34', icon: '📝', iconBg: 'bg-orange-100', status: 'Diperiksa', statusClass: 'bg-emerald-50 text-emerald-600' },
  { id: 2, title: 'Latihan Soal Pecahan', deadline: '17 Mei, 19.34', icon: '📝', iconBg: 'bg-cyan-100', status: 'Belum Dikerjakan', statusClass: 'bg-orange-50 text-orange-600' },
]

// --- Jadwal ---
const jadwalFilter = ref('hari_ini')
const jadwalTabs = [
  { id: 'hari_ini', label: 'Hari Ini' },
  { id: 'besok', label: 'Besok' },
  { id: 'mendatang', label: 'Mendatang' },
]

const jadwalItems = [
  { id: 1, name: 'Kenzo Aliza', mapel: 'Matematika', jenjang: 'SD', lokasi: 'Tukad Badung, no 12', jadwal: 'Senin, 17:00-18:00', progress: 2, day: 'hari_ini' },
  { id: 2, name: 'Eka Savitry', mapel: 'Informatika', jenjang: 'SMP', lokasi: 'Online', jadwal: 'Senin, 15:30-16:00', progress: 2, day: 'hari_ini' },
  { id: 3, name: 'Natasha', mapel: 'Fisika', jenjang: 'SMA', lokasi: 'Online', jadwal: 'Senin, 14:00-15:00', progress: 2, day: 'hari_ini' },
  { id: 4, name: 'Ananta Aldora', mapel: 'Bahasa Inggris', jenjang: 'SMA', lokasi: 'Tukad Badung, no 12', jadwal: 'Senin, 12:00-13:00', progress: 2, day: 'hari_ini' },
  { id: 5, name: 'Rina Putri', mapel: 'Matematika', jenjang: 'SMP', lokasi: 'Denpasar Barat', jadwal: 'Selasa, 09:00-10:00', progress: 1, day: 'besok' },
  { id: 6, name: 'Budi Santoso', mapel: 'Fisika', jenjang: 'SMA', lokasi: 'Online', jadwal: 'Selasa, 14:00-15:00', progress: 3, day: 'besok' },
  { id: 7, name: 'Maya Dewi', mapel: 'Kimia', jenjang: 'SMA', lokasi: 'Tukad Badung, no 5', jadwal: 'Selasa, 16:00-17:00', progress: 1, day: 'besok' },
  { id: 8, name: 'Iqbal Mustofa', mapel: 'Matematika', jenjang: 'SD', lokasi: 'Denpasar Selatan', jadwal: 'Rabu, 10:00-11:00', progress: 0, day: 'mendatang' },
  { id: 9, name: 'Tania Riana', mapel: 'Bahasa Inggris', jenjang: 'SMP', lokasi: 'Online', jadwal: 'Kamis, 13:00-14:00', progress: 1, day: 'mendatang' },
  { id: 10, name: 'Arya Wicaksana', mapel: 'Informatika', jenjang: 'SMP', lokasi: 'Tukad Badung, no 8', jadwal: 'Jumat, 15:00-16:00', progress: 0, day: 'mendatang' },
  { id: 11, name: 'Sari Indah', mapel: 'Fisika', jenjang: 'SMA', lokasi: 'Online', jadwal: 'Sabtu, 09:00-10:00', progress: 2, day: 'mendatang' },
]

const filteredJadwal = computed(() => jadwalItems.filter(j => j.day === jadwalFilter.value))

// --- Keuangan ---
const keuanganView = ref('riwayat')
const keuanganFilter = ref('semua')
const keuanganTabs = [
  { id: 'semua', label: 'Semua' },
  { id: 'pemasukan', label: 'Pemasukan' },
  { id: 'penarikan', label: 'Penarikan' },
]

const keuanganItems = [
  { id: 1, title: 'Komisi Pengajaran', desc: '1 Siswa, Kenzo Aliza', type: 'masuk', amount: '550.000', date: 'Sabtu, 08/12/2025', badge: null, badgeClass: '' },
  { id: 2, title: 'Penarikan Dana', desc: 'Penarikan ke BRI, 6343', type: 'keluar', amount: '350.000', date: 'Sabtu, 08/12/2025', badge: 'Berhasil', badgeClass: 'bg-emerald-100 text-emerald-700' },
  { id: 3, title: 'Komisi Pengajaran', desc: '2 Siswa', type: 'masuk', amount: '550.000', date: 'Sabtu, 08/12/2025', badge: null, badgeClass: '' },
  { id: 4, title: 'Komisi Pengajaran', desc: 'Penarikan ke BRI, 6343', type: 'keluar', amount: '700.000', date: 'Sabtu, 08/12/2025', badge: 'Gagal', badgeClass: 'bg-red-100 text-red-700' },
  { id: 5, title: 'Komisi Pengajaran', desc: '1 Siswa, Kenzo Aliza', type: 'masuk', amount: '550.000', date: 'Sabtu, 08/12/2025', badge: null, badgeClass: '' },
  { id: 6, title: 'Komisi Pengajaran', desc: 'Penarikan ke BRI, 6343', type: 'keluar', amount: '700.000', date: 'Sabtu, 08/12/2025', badge: 'Berhasil', badgeClass: 'bg-emerald-100 text-emerald-700' },
]

const filteredKeuangan = computed(() => {
  if (keuanganFilter.value === 'pemasukan') return keuanganItems.filter(t => t.type === 'masuk')
  if (keuanganFilter.value === 'penarikan') return keuanganItems.filter(t => t.type === 'keluar')
  return keuanganItems
})

// --- Pesan ---
const selectedChat = ref(null)
const pesanContacts = [
  { id: 1, name: 'Ananta Aldora', avatarBg: 'fce7f3', avatarColor: 'db2777', online: true, time: '10.30', lastMsg: 'Perbaiki bagian esensial, siswa su...', messages: [
    { id: 1, from: 'them', text: 'Bu Isyana, hari ini kita belajar tentang pecahan kan?', time: '10:00' },
    { id: 2, from: 'me', text: 'Betul, hari ini kita belajar tentang pecahan, desimal, persen, dan campuran.', time: '10:50' },
  ]},
  { id: 2, name: 'Aditya Satria', avatarBg: 'dbeafe', avatarColor: '2563eb', online: false, time: '07.00', lastMsg: 'Perbaiki bagian esensial, siswa su...', messages: [
    { id: 1, from: 'them', text: 'Selamat pagi bu, tugas sudah saya kerjakan.', time: '06:45' },
    { id: 2, from: 'me', text: 'Bagus Aditya! Nanti saya periksa ya.', time: '07:00' },
  ]},
  { id: 3, name: 'Jonathan Jack', avatarBg: 'd1fae5', avatarColor: '059669', online: false, time: 'Kemarin', lastMsg: 'Perbaiki bagian esensial, siswa su...', messages: [
    { id: 1, from: 'them', text: 'Bu, saya masih bingung soal pembagian pecahan.', time: '14:20' },
    { id: 2, from: 'me', text: 'Nanti di pertemuan berikutnya kita bahas lebih detail ya.', time: '14:35' },
    { id: 3, from: 'them', text: 'Baik bu, terima kasih!', time: '14:40' },
  ]},
  { id: 4, name: 'Marissa Anisa', avatarBg: 'fef3c7', avatarColor: 'd97706', online: true, time: 'Kemarin', lastMsg: 'Perbaiki bagian esensial, siswa su...', messages: [
    { id: 1, from: 'them', text: 'Bu saya mau tanya soal PR yang kemarin.', time: '18:00' },
    { id: 2, from: 'me', text: 'Silakan tanya aja.', time: '18:05' },
    { id: 3, from: 'them', text: 'Nomor 5 itu caranya gimana ya bu?', time: '18:06' },
    { id: 4, from: 'me', text: 'Coba pakai rumus yang kita pelajari hari Senin ya, step-stepnya sudah saya kirim di materi.', time: '18:15' },
  ]},
  { id: 5, name: 'Jonathan Jack', avatarBg: 'd1fae5', avatarColor: '059669', online: false, time: 'Kemarin', lastMsg: 'Perbaiki bagian esensial, siswa su...', messages: [
    { id: 1, from: 'me', text: 'Jonathan, jangan lupa kumpulkan tugas ya.', time: '09:00' },
    { id: 2, from: 'them', text: 'Siap bu, nanti malam saya kirim.', time: '09:30' },
  ]},
]

// --- Ulasan ---
const ulasanView = ref('list')
const selectedUlasan = ref(null)

function openBalasUlasan(review) {
  selectedUlasan.value = review
  ulasanView.value = 'balas'
}

const ulasanItems = [
  { id: 1, name: 'Kevin H', mapel: 'Matematika', jenjang: 'SMP', rating: 5, avatarBg: 'dbeafe', avatarColor: '2563eb', text: 'Penjelasan Bu Isyana sangat jelas dan mudah dipahami. Saya jadi lebih percaya diri belajar matematika. 👍' },
  { id: 2, name: 'Raisa Andini', mapel: 'Matematika', jenjang: 'SMP', rating: 5, avatarBg: 'fce7f3', avatarColor: 'db2777', text: 'Belajar dengan Bu Isyana benar-benar membantu saya memahami materi yang sebelumnya terasa sulit, terutama di bagian pecahan dan operasi hitung. Penjelasannya sangat runtut, mulai dari konsep dasar sampai contoh soal, jadi saya tidak merasa bingung di tengah jalan.' },
  { id: 3, name: 'Raisa Andini', mapel: 'Matematika', jenjang: 'SMP', rating: 4, avatarBg: 'fce7f3', avatarColor: 'db2777', text: 'Awalnya saya kurang suka matematika karena menurut saya susah, tapi setelah belajar dengan Bu Isyana jadi lebih enjoy. Cara ngajarnya top banget, bikin, jadi saya tidak takut belajar soal belajar.' },
  { id: 4, name: 'Kevin H', mapel: 'Matematika', jenjang: 'SMP', rating: 5, avatarBg: 'dbeafe', avatarColor: '2563eb', text: 'Penjelasan Bu Isyana sangat jelas dan mudah dipahami. Saya jadi lebih percaya diri belajar matematika. 👍' },
  { id: 5, name: 'Raisa Andini', mapel: 'Matematika', jenjang: 'SMP', rating: 5, avatarBg: 'fce7f3', avatarColor: 'db2777', text: 'Belajar dengan Bu Isyana benar-benar membantu saya memahami materi yang sebelumnya terasa sulit, terutama di bagian pecahan dan operasi hitung. Penjelasannya sangat runtut, mulai dari konsep dasar sampai contoh soal, jadi saya tidak merasa bingung di tengah jalan.' },
]

// --- Pengaturan ---
const pengaturanView = ref('main')

const notifSettings = reactive([
  { id: 1, title: 'Pesan Baru', desc: 'Notifikasi saat ada pesan dari siswa.', icon: '💬', iconBg: 'bg-blue-50', active: true },
  { id: 2, title: 'Jadwal Mengajar', desc: 'Pengingat sesi mengajar yang akan datang.', icon: '📅', iconBg: 'bg-emerald-50', active: true },
  { id: 3, title: 'Pembayaran', desc: 'Notifikasi saat ada pembayaran masuk.', icon: '💰', iconBg: 'bg-amber-50', active: true },
  { id: 4, title: 'Ulasan Baru', desc: 'Notifikasi saat siswa memberikan ulasan.', icon: '⭐', iconBg: 'bg-purple-50', active: false },
  { id: 5, title: 'Permintaan Siswa', desc: 'Notifikasi saat ada siswa baru yang mendaftar.', icon: '👤', iconBg: 'bg-cyan-50', active: true },
  { id: 6, title: 'Update Sistem', desc: 'Pemberitahuan pembaruan dan fitur baru.', icon: '🔔', iconBg: 'bg-red-50', active: false },
])
</script>
